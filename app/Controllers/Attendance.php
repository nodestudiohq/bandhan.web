<?php

namespace App\Controllers;

use App\Models\StaffModel;
use App\Models\AttendanceModel;
use App\Models\AttendanceLogModel;

class Attendance extends BaseController
{
    protected AttendanceModel $model;
    protected AttendanceLogModel $logModel;
    protected StaffModel $staffModel;

    public function __construct()
    {
        $this->model = new AttendanceModel();
        $this->logModel = new AttendanceLogModel();
        $this->staffModel = new StaffModel();
    }

    // ── Monthly calendar index ────────────────────────────────────────

    public function index(): string
    {
        $month = (int) ($this->request->getGet('month') ?? date('n'));
        $year = (int) ($this->request->getGet('year') ?? date('Y'));
        $dept = $this->request->getGet('department') ?? '';

        $staffQuery = $this->staffModel->where('status', 'active');
        if ($dept)
            $staffQuery->where('department', $dept);
        $staff = $staffQuery->orderBy('name')->findAll();

        $grid = $this->model->getMonthGrid($month, $year);

        return view('staff/attendance', [
            'title' => 'Attendance — ' . date('F Y', mktime(0, 0, 0, $month, 1, $year)),
            'staff' => $staff,
            'grid' => $grid,
            'month' => $month,
            'year' => $year,
            'departments' => $this->staffModel->getDepartmentsGrouped(),
            'filters' => compact('month', 'year', 'dept'),
        ]);
    }

    // ── Manual set (from modal) ────────────────────────────────────────

    public function manualSet()
    {
        $staffId = (int) $this->request->getPost('staff_id');
        $date = $this->request->getPost('date');
        $status = $this->request->getPost('status');
        $note = $this->request->getPost('note') ?? '';
        $month = $this->request->getPost('month') ?? date('n');
        $year = $this->request->getPost('year') ?? date('Y');

        if (!$staffId || !$date || !$status) {
            session()->setFlashdata('error', 'Invalid data.');
            return redirect()->back();
        }

        $this->model->manualSet($staffId, $date, $status, $note);
        session()->setFlashdata('success', 'Attendance updated.');
        return redirect()->to(base_url("attendance?month={$month}&year={$year}"));
    }

    // ── Revert to auto-computed ────────────────────────────────────────

    public function revertAuto()
    {
        $staffId = (int) $this->request->getPost('staff_id');
        $date = $this->request->getPost('date');
        $month = $this->request->getPost('month') ?? date('n');
        $year = $this->request->getPost('year') ?? date('Y');

        // Force recompute from logs
        $this->model->computeForStaffDate($staffId, $date, true);
        session()->setFlashdata('success', 'Reverted to auto-computed attendance.');
        return redirect()->to(base_url("attendance?month={$month}&year={$year}"));
    }

    // ── Recompute full month from logs ─────────────────────────────────

    public function recompute()
    {
        $month = (int) $this->request->getPost('month');
        $year = (int) $this->request->getPost('year');
        $count = $this->model->recomputeMonth($month, $year);
        session()->setFlashdata(
            'success',
            "Recomputed {$count} attendance records from punch logs for "
            . date('F Y', mktime(0, 0, 0, $month, 1, $year)) . "."
        );
        return redirect()->to(base_url("attendance?month={$month}&year={$year}"));
    }

    // ── Web Punch Station ──────────────────────────────────────────────

    public function webPunch(): string
    {
        return view('staff/punch_station', [
            'title' => 'Punch Station',
        ]);
    }

    public function staffSearch()
    {
        $q = $this->request->getGet('q') ?? '';
        $results = [];

        if (strlen($q) >= 2) {
            $results = $this->staffModel
                ->groupStart()
                ->like('name', $q)
                ->orLike('staff_id', $q)
                ->groupEnd()
                ->where('status', 'active')
                ->orderBy('name')
                ->limit(10)
                ->findAll();

            // Return only needed fields
            $results = array_map(fn($s) => [
                'staff_id' => $s['staff_id'],
                'name' => $s['name'],
                'designation' => $s['designation'],
                'department' => $s['department'],
            ], $results);
        }

        return $this->response->setJSON($results);
    }



    // ── AJAX: punch log for a cell ─────────────────────────────────────

    public function punchLog()
    {
        $staffId = (int) $this->request->getGet('staff_id');
        $date = $this->request->getGet('date');

        $punches = $this->logModel->getForDate($staffId, $date);
        $att = $this->model->where('staff_id', $staffId)->where('date', $date)->first();

        $out = [];
        foreach ($punches as $p) {
            $out[] = [
                'type' => $p['punch_type'],
                'time' => date('H:i', strtotime($p['punched_at'])),
                'source' => $p['source'],
            ];
        }

        return $this->response->setJSON([
            'punches' => $out,
            'status' => $att ? ($att['is_manual'] ? $att['manual_status'] : $att['status']) : null,
            'note' => $att['note'] ?? null,
            'work_hours' => $att ? AttendanceModel::formatMinutes((int) $att['work_minutes']) : null,
        ]);
    }

    // ── Android QR API endpoint ────────────────────────────────────────
    // POST /api/attendance/punch
    // Body: { "staff_id": "BH-NU-0001", "device_id": "abc123" }
    // Returns JSON with punch result.

    public function apiPunch()
    {
        $this->response->setContentType('application/json');

        $input = $this->request->getJSON(true) ?? $this->request->getPost();

        // Look up staff by staff_id string
        $staffCode = $input['staff_id'] ?? null;
        if (!$staffCode) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'staff_id required']);
        }

        $staff = $this->staffModel->where('staff_id', $staffCode)->where('status', 'active')->first();
        if (!$staff) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Staff not found or inactive']);
        }

        $result = $this->logModel->recordQrPunch($staff['id'], $input['device_id'] ?? 'web');

        return $this->response->setJSON([
            'success' => true,
            'staff_id' => $staff['staff_id'],
            'name' => $staff['name'],
            'department' => $staff['department'],
            'punch_type' => $result['punch_type'],
            'punched_at' => $result['punched_at'],
            'message' => 'Punch ' . strtoupper($result['punch_type']) . ' recorded at '
                . date('H:i', strtotime($result['punched_at'])),
        ]);
    }

    // ── Summary report ─────────────────────────────────────────────────

    public function report(): string
    {
        $month = (int) ($this->request->getGet('month') ?? date('n'));
        $year = (int) ($this->request->getGet('year') ?? date('Y'));

        $staff = $this->staffModel->where('status', 'active')->orderBy('name')->findAll();
        $report = [];
        foreach ($staff as $s) {
            $summary = $this->model->monthlySummary($s['id'], $month, $year);
            $report[] = array_merge($s, $summary);
        }

        return view('staff/attendance_report', [
            'title' => 'Attendance Report',
            'report' => $report,
            'month' => $month,
            'year' => $year,
        ]);
    }
}