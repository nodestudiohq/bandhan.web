<?php

namespace App\Controllers;

use App\Models\StaffModel;
use App\Models\SalaryModel;
use App\Models\SalaryStructureModel;

class Salary extends BaseController
{
    protected SalaryModel $model;
    protected StaffModel $staffModel;

    public function __construct()
    {
        $this->model = new SalaryModel();
        $this->staffModel = new StaffModel();
    }

    // ── Monthly list ─────────────────────────────────────────────────

    public function index(): string
    {
        $month = (int) ($this->request->getGet('month') ?? date('n'));
        $year = (int) ($this->request->getGet('year') ?? date('Y'));
        $status = $this->request->getGet('status') ?? '';

        return view('staff/salary', [
            'title' => 'Monthly Salary',
            'salaries' => $this->model->getMonthlyList($month, $year, $status),
            'total_salary' => $this->model->totalForMonth($month, $year),
            'summary' => $this->model->statusSummary($month, $year),
            'filters' => compact('month', 'year', 'status'),
        ]);
    }

    // ── Generate ─────────────────────────────────────────────────────

    public function generateForm(): string
    {
        return view('staff/salary_generate', ['title' => 'Generate Salary']);
    }

    public function generateProcess()
    {
        $month = (int) $this->request->getPost('month');
        $year = (int) $this->request->getPost('year');

        if ($month < 1 || $month > 12 || $year < 2000) {
            session()->setFlashdata('error', 'Invalid month or year.');
            return redirect()->to(base_url('salary/generate'));
        }

        $result = $this->model->generateForMonth($month, $year);

        $msg = "{$result['generated']} salary records generated for "
            . date('F Y', mktime(0, 0, 0, $month, 1, $year)) . ".";

        if ($result['skipped']) {
            $msg .= " {$result['skipped']} already existed (skipped).";
        }

        if (!empty($result['errors'])) {
            session()->setFlashdata(
                'error',
                'Issues: ' . implode('; ', $result['errors'])
            );
        }

        session()->setFlashdata('success', $msg);
        return redirect()->to(base_url("salary?month={$month}&year={$year}"));
    }

    // ── Edit individual salary (LOP / custom deductions) ─────────────

    public function edit(int $id): string
    {
        $salary = $this->model->find($id);
        $staff = $this->staffModel->find($salary['staff_id']);

        return view('staff/salary_edit', [
            'title' => 'Edit Salary — ' . $staff['name'],
            'salary' => $salary,
            'staff' => $staff,
        ]);
    }

    public function update(int $id)
    {
        $salary = $this->model->find($id);
        $post = $this->request->getPost();

        // Update adjustable fields
        $this->model->update($id, [
            'lop_override' => $post['lop_override'] !== '' ? (float) $post['lop_override'] : null,
            'loan_recovery' => (float) ($post['loan_recovery'] ?? $salary['loan_recovery']),
            'advance_recovery' => (float) ($post['advance_recovery'] ?? $salary['advance_recovery']),
            'other_deductions' => (float) ($post['other_deductions'] ?? $salary['other_deductions']),
            'deduction_note' => $post['deduction_note'] ?? null,
            'overtime_allowance' => (float) ($post['overtime_allowance'] ?? $salary['overtime_allowance']),
            'bonus_incentive' => (float) ($post['bonus_incentive'] ?? $salary['bonus_incentive']),
            'night_shift_allowance' => (float) ($post['night_shift_allowance'] ?? $salary['night_shift_allowance']),
            'remarks' => $post['remarks'] ?? null,
            'payment_mode' => $post['payment_mode'] ?? $salary['payment_mode'],
        ]);

        // Recalculate totals
        $this->model->recalculate($id);

        session()->setFlashdata('success', 'Salary updated and recalculated.');
        return redirect()->to(base_url("salary?month={$salary['month']}&year={$salary['year']}"));
    }

    // ── Approve (HR) ─────────────────────────────────────────────────

    public function approve(int $id)
    {
        $salary = $this->model->find($id);
        if (!in_array($salary['payment_status'], ['draft', 'pending'])) {
            session()->setFlashdata('error', 'Only draft/pending salaries can be approved.');
            return redirect()->back();
        }
        $this->model->update($id, ['payment_status' => 'approved']);
        session()->setFlashdata('success', 'Salary approved.');
        return redirect()->back();
    }

    public function approveAll()
    {
        $month = (int) $this->request->getPost('month');
        $year = (int) $this->request->getPost('year');
        $count = $this->model->approveMonth($month, $year, 1); // TODO: pass logged-in user ID
        session()->setFlashdata('success', "$count salaries approved for "
            . date('F Y', mktime(0, 0, 0, $month, 1, $year)) . ".");
        return redirect()->to(base_url("salary?month={$month}&year={$year}"));
    }

    // ── Disburse / Mark Paid ─────────────────────────────────────────

    public function disburse(int $id)
    {
        $salary = $this->model->find($id);
        if ($salary['payment_status'] !== 'approved') {
            session()->setFlashdata('error', 'Salary must be approved before disbursement.');
            return redirect()->back();
        }

        $this->model->markPaid($id, [
            'payment_mode' => $this->request->getPost('payment_mode') ?? 'Bank Transfer',
            'transaction_ref' => $this->request->getPost('transaction_ref') ?? null,
            'bank_account' => $this->request->getPost('bank_account') ?? null,
            'paid_date' => $this->request->getPost('paid_date') ?? date('Y-m-d'),
            'remarks' => $this->request->getPost('remarks') ?? null,
        ]);

        session()->setFlashdata('success', 'Salary marked as paid.');
        return redirect()->back();
    }

    public function disburseAll()
    {
        $month = (int) $this->request->getPost('month');
        $year = (int) $this->request->getPost('year');
        $count = $this->model->disburseBulk($month, $year, [
            'payment_mode' => $this->request->getPost('payment_mode') ?? 'Bank Transfer',
            'paid_date' => $this->request->getPost('paid_date') ?? date('Y-m-d'),
        ]);
        session()->setFlashdata(
            'success',
            "$count salaries disbursed for " . date('F Y', mktime(0, 0, 0, $month, 1, $year)) . "."
        );
        return redirect()->to(base_url("salary?month={$month}&year={$year}"));
    }

    // ── Hold ─────────────────────────────────────────────────────────

    public function hold(int $id)
    {
        $salary = $this->model->find($id);
        $reason = $this->request->getPost('reason') ?? 'On hold';
        $this->model->holdSalary($id, $reason);
        session()->setFlashdata('success', 'Salary placed on hold.');
        return redirect()->back();
    }

    // ── Salary Slip ───────────────────────────────────────────────────

    public function slip(int $staffId): string
    {
        $month = (int) ($this->request->getGet('month') ?? date('n'));
        $year = (int) ($this->request->getGet('year') ?? date('Y'));
        $staff = $this->staffModel->find($staffId);
        $salary = $this->model->getSlip($staffId, $month, $year);

        if (!$salary) {
            // Preview from structure
            $ssModel = new SalaryStructureModel();
            $ss = $ssModel->getActive($staffId);
            $salary = $ss ? array_merge($ss, [
                'month' => $month,
                'year' => $year,
                'working_days' => $this->model->calcWorkingDays($month, $year),
                'present_days' => '—',
                'paid_leave_days' => 0,
                'unpaid_leave_days' => 0,
                'lop_deduction' => 0,
                'gross_earnings' => 0,
                'total_deductions' => 0,
                'net_pay' => 0,
                'payment_status' => 'preview',
                'payment_mode' => 'Bank Transfer',
            ]) : null;
        }

        return view('staff/salary_slip', [
            'title' => 'Salary Slip — ' . $staff['name'],
            'staff' => $staff,
            'salary' => $salary,
        ]);
    }
}