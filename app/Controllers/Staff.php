<?php

namespace App\Controllers;

use App\Models\StaffModel;

class Staff extends BaseController
{
    protected StaffModel $model;

    public function __construct()
    {
        $this->model = new StaffModel();
    }

    // ── List ──────────────────────────────────────────────────────────

    public function index(): string
    {
        $filters = $this->request->getGet(['q', 'department', 'status']);

        $builder = $this->model;

        if (!empty($filters['q'])) {
            $q = $filters['q'];
            $builder = $builder->groupStart()
                ->like('name', $q)
                ->orLike('staff_id', $q)
                ->orLike('department', $q)
                ->groupEnd();
        }
        if (!empty($filters['department'])) {
            $builder = $builder->where('department', $filters['department']);
        }
        if (!empty($filters['status'])) {
            $builder = $builder->where('status', $filters['status']);
        }

        $staff = $builder->orderBy('id', 'DESC')->paginate(20);

        return view('staff/index', [
            'title' => 'Staff',
            'staff' => $staff,
            'total' => $this->model->countAllResults(),
            'pager' => $this->model->pager,
            'filters' => $filters,
            'departments' => $this->model->getDepartmentsGrouped(),
        ]);
    }

    // ── Create ────────────────────────────────────────────────────────

    public function create(): string
    {
        return view('staff/form', [
            'title' => 'Add Staff',
            'departments' => $this->model->getDepartmentsGrouped(),
        ]);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[2]',
            'phone' => 'required',
            'designation' => 'required',
            'department' => 'required',
            'basic_salary' => 'required|decimal',
        ];

        if (!$this->validate($rules)) {
            return view('staff/form', [
                'title' => 'Add Staff',
                'errors' => $this->validator->getErrors(),
                'departments' => $this->model->getDepartmentsGrouped(),
            ]);
        }

        $data = $this->request->getPost([
            'name',
            'father_name',
            'dob',
            'gender',
            'blood_group',
            'phone',
            'email',
            'emergency_contact',
            'address',
            'designation',
            'department',
            'joining_date',
            'id_number',
            'weekly_off',
            'status',
        ]);

        // Handle photo upload
        $photo = $this->request->getFile('photo');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $newName = $photo->getRandomName();
            $photo->move(WRITEPATH . 'uploads', $newName);
            $data['photo'] = $newName;
        }

        $data['staff_id'] = $this->model->generateStaffId($data['department']);

        $this->model->insert($data);
        session()->setFlashdata('success', 'Staff member added successfully.');
        return redirect()->to(base_url('staff'));
    }

    // ── View (tabbed) ─────────────────────────────────────────────────

    public function show(int $id): string
    {
        $staff = $this->model->find($id);
        $tab = $this->request->getGet('tab') ?? 'info';
        $month = (int) ($this->request->getGet('month') ?? date('n'));
        $year = (int) ($this->request->getGet('year') ?? date('Y'));

        $ssModel = new \App\Models\SalaryStructureModel();
        $attModel = new \App\Models\AttendanceModel();
        $salModel = new \App\Models\SalaryModel();

        // Salary structure
        $salaryStructure = $ssModel->getActive($id);
        $salaryHistory = $ssModel->getHistory($id);

        // Attendance — monthly grid + summary
        $attSummary = $attModel->monthlySummary($id, $month, $year);
        $attGrid = $this->buildAttendanceGrid($id, $month, $year, $attModel);

        // Salary history (real, latest 12 months)
        $salaryRecords = \Config\Database::connect()
            ->table('salaries')
            ->where('staff_id', $id)
            ->orderBy('year', 'DESC')
            ->orderBy('month', 'DESC')
            ->limit(12)
            ->get()->getResultArray();

        // YTD paid this calendar year
        $ytd = \Config\Database::connect()
            ->table('salaries')
            ->selectSum('net_pay')
            ->where('staff_id', $id)
            ->where('year', date('Y'))
            ->where('payment_status', 'paid')
            ->get()->getRowArray();

        return view('staff/show', [
            'title' => $staff['name'],
            'staff' => $staff,
            'tab' => $tab,
            'month' => $month,
            'year' => $year,
            'salaryStructure' => $salaryStructure,
            'salaryHistory' => $salaryHistory,
            'attSummary' => $attSummary,
            'attGrid' => $attGrid,
            'salaryRecords' => $salaryRecords,
            'ytdPaid' => (float) ($ytd['net_pay'] ?? 0),
        ]);
    }

    private function buildAttendanceGrid(int $staffId, int $month, int $year, \App\Models\AttendanceModel $model): array
    {
        $start = "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . '-01';
        $end = date('Y-m-t', strtotime($start));
        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $rows = $model->where('staff_id', $staffId)
            ->where('date >=', $start)
            ->where('date <=', $end)
            ->findAll();
        $grid = [];
        foreach ($rows as $r) {
            $grid[$r['date']] = $r;
        }
        return $grid;
    }

    // ── Edit ──────────────────────────────────────────────────────────

    public function edit(int $id): string
    {
        $staff = $this->model->find($id);
        return view('staff/form', [
            'title' => 'Edit Staff',
            'staff' => $staff,
            'departments' => $this->model->getDepartmentsGrouped(),
        ]);
    }

    public function update(int $id)
    {
        $staff = $this->model->find($id);

        $rules = [
            'name' => 'required|min_length[2]',
            'phone' => 'required',
            'designation' => 'required',
            'department' => 'required',
        ];

        if (!$this->validate($rules)) {
            return view('staff/form', [
                'title' => 'Edit Staff',
                'staff' => $staff,
                'errors' => $this->validator->getErrors(),
                'departments' => $this->model->getDepartmentsGrouped(),
            ]);
        }

        $data = $this->request->getPost([
            'name',
            'father_name',
            'dob',
            'gender',
            'blood_group',
            'phone',
            'email',
            'emergency_contact',
            'address',
            'designation',
            'department',
            'joining_date',
            'id_number',
            'weekly_off',
            'status',
        ]);

        // Handle photo upload
        $photo = $this->request->getFile('photo');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $newName = $photo->getRandomName();
            $photo->move(WRITEPATH . 'uploads', $newName);
            $data['photo'] = $newName;
        }

        $this->model->update($id, $data);
        session()->setFlashdata('success', 'Staff updated successfully.');
        return redirect()->to(base_url('staff'));
    }

    // ── Delete ────────────────────────────────────────────────────────

    public function delete(int $id)
    {
        $this->model->find($id);
        $this->model->delete($id);
        session()->setFlashdata('success', 'Staff member deleted.');
        return redirect()->to(base_url('staff'));
    }

    // ── ID Card ───────────────────────────────────────────────────────

    public function idcard(int $id): string
    {
        $staff = $this->model->find($id);
        return view('staff/idcard', [
            'title' => 'ID Card — ' . $staff['name'],
            'staff' => $staff,
        ]);
    }

    // ── Salary Structure ─────────────────────────────────────────────

    public function salaryStructure(int $id): string
    {
        $staff = $this->model->find($id);
        $model = new \App\Models\SalaryStructureModel();

        return view('staff/salary_structure', [
            'title' => 'Salary Structure — ' . $staff['name'],
            'staff' => $staff,
            'structure' => $model->getActive($id),
            'history' => $model->getHistory($id),
            // tell the view which URL to use for the back button
            'back_url' => base_url('staff/' . $id . '?tab=salary_structure'),
        ]);
    }

    public function saveSalaryStructure(int $staffId)
    {
        $staff = $this->model->find($staffId);
        $model = new \App\Models\SalaryStructureModel();
        $post = $this->request->getPost();

        $data = [
            'staff_id' => $staffId,
            'basic_pay' => (float) ($post['basic_pay'] ?? 0),
            'hra' => (float) ($post['hra'] ?? 0),
            'da' => (float) ($post['da'] ?? 0),
            'medical_allowance' => (float) ($post['medical_allowance'] ?? 1250),
            'travel_allowance' => (float) ($post['travel_allowance'] ?? 800),
            'special_allowance' => (float) ($post['special_allowance'] ?? 0),
            'night_shift_allowance' => (float) ($post['night_shift_allowance'] ?? 0),
            'overtime_allowance' => (float) ($post['overtime_allowance'] ?? 0),
            'bonus_incentive' => (float) ($post['bonus_incentive'] ?? 0),
            'pf_applicable' => !empty($post['pf_applicable']) ? 1 : 0,
            'pf_percent' => (float) ($post['pf_percent'] ?? 12),
            'esi_applicable' => !empty($post['esi_applicable']) ? 1 : 0,
            'esi_percent' => (float) ($post['esi_percent'] ?? 0.75),
            'professional_tax' => (float) ($post['professional_tax'] ?? 200),
            'tds' => (float) ($post['tds'] ?? 0),
            'loan_recovery' => (float) ($post['loan_recovery'] ?? 0),
            'advance_recovery' => (float) ($post['advance_recovery'] ?? 0),
            'other_deductions' => (float) ($post['other_deductions'] ?? 0),
            'effective_from' => $post['effective_from'] ?? date('Y-m-d'),
            'remarks' => $post['remarks'] ?? '',
        ];

        $model->insert($data);
        session()->setFlashdata('success', 'Salary structure saved for ' . $staff['name']);

        // ← redirect back to the tabbed show page, salary_structure tab
        return redirect()->to(base_url('staff/' . $staffId . '?tab=salary_structure'));
    }

}