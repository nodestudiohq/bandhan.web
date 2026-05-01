<?php

namespace App\Controllers;

use App\Models\StaffModel;
use App\Models\AttendanceModel;
use App\Models\AttendanceLogModel;
use App\Models\SalaryModel;
use App\Models\InvoiceModel;

class Dashboard extends BaseController
{

    public function home()
    {
        if (session()->get('user_id')) {
            return $this->index();
        }
        return view('index');
    }

    public function index(): string
    {
        $staffModel = new StaffModel();
        $attModel = new AttendanceModel();
        $logModel = new AttendanceLogModel();
        $salaryModel = new SalaryModel();
        $invoiceModel = new InvoiceModel();

        $today = date('Y-m-d');
        $month = (int) date('n');
        $year = (int) date('Y');

        // ── KPI cards ─────────────────────────────────────────────────
        $totalStaff = $staffModel->where('status', 'active')->countAllResults();
        $presentToday = $attModel->countPresent($today);
        $absentToday = $totalStaff - $presentToday;

        // Today's punch activity (last 8 punches)
        $recentPunches = $logModel
            ->where('punched_at >=', $today . ' 00:00:00')
            ->orderBy('punched_at', 'DESC')
            ->limit(8)
            ->findAll();

        // Salary summary this month
        $salarySummary = $salaryModel->statusSummary($month, $year);
        $salaryPayout = $salaryModel->totalForMonth($month, $year);

        // Invoice stats
        $invoiceRevenue = $this->invoiceRevenueStats($invoiceModel, $month, $year);

        // Attendance by department today
        $deptAttendance = $this->deptAttendanceToday($staffModel, $attModel, $today);

        // Monthly attendance overview (last 7 days)
        $weekAttendance = $this->weekAttendanceTrend($attModel);

        // Monthly revenue trend (last 6 months)
        $revenueTrend = $this->revenueTrend($invoiceModel);

        // Recent invoices
        $recentInvoices = $invoiceModel
            ->orderBy('id', 'DESC')
            ->limit(6)
            ->findAll();

        // Staff by department breakdown
        $deptBreakdown = $this->deptBreakdown($staffModel);

        // Pending actions
        $pendingActions = [
            'salary_draft' => $salarySummary['draft'] ?? 0,
            'salary_pending' => $salarySummary['pending'] ?? 0,
            'salary_approved' => $salarySummary['approved'] ?? 0,
            'salary_held' => $salarySummary['held'] ?? 0,
            'invoice_unpaid' => $invoiceRevenue['unpaid_count'],
        ];

        return view('dashboard/index', compact(
            'totalStaff',
            'presentToday',
            'absentToday',
            'recentPunches',
            'salarySummary',
            'salaryPayout',
            'invoiceRevenue',
            'deptAttendance',
            'weekAttendance',
            'revenueTrend',
            'recentInvoices',
            'deptBreakdown',
            'pendingActions',
            'month',
            'year'
        ));
    }

    // ── Helpers ───────────────────────────────────────────────────────

    private function invoiceRevenueStats(InvoiceModel $m, int $month, int $year): array
    {
        $db = \Config\Database::connect();
        $start = "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . '-01';
        $end = date('Y-m-t', strtotime($start));

        $row = $db->table('invoices')
            ->select('
                COUNT(*) as total_count,
                SUM(total_amount) as total_billed,
                SUM(paid_amount)  as total_collected,
                SUM(CASE WHEN status="unpaid"  THEN 1 ELSE 0 END) as unpaid_count,
                SUM(CASE WHEN status="partial" THEN 1 ELSE 0 END) as partial_count,
                SUM(CASE WHEN status="paid"    THEN 1 ELSE 0 END) as paid_count,
                SUM(CASE WHEN status="unpaid"  THEN total_amount - paid_amount ELSE 0 END) +
                SUM(CASE WHEN status="partial" THEN total_amount - paid_amount ELSE 0 END) as outstanding
            ')
            ->where('invoice_date >=', $start)
            ->where('invoice_date <=', $end)
            ->where('deleted_at IS NULL')
            ->get()->getRowArray();

        return [
            'total_count' => (int) ($row['total_count'] ?? 0),
            'total_billed' => (float) ($row['total_billed'] ?? 0),
            'total_collected' => (float) ($row['total_collected'] ?? 0),
            'unpaid_count' => (int) ($row['unpaid_count'] ?? 0),
            'partial_count' => (int) ($row['partial_count'] ?? 0),
            'paid_count' => (int) ($row['paid_count'] ?? 0),
            'outstanding' => (float) ($row['outstanding'] ?? 0),
        ];
    }

    private function deptAttendanceToday(StaffModel $sm, AttendanceModel $am, string $date): array
    {
        $depts = $sm->select('department, COUNT(*) as total')
            ->where('status', 'active')
            ->where('deleted_at IS NULL')
            ->groupBy('department')
            ->orderBy('total', 'DESC')
            ->limit(8)
            ->findAll();

        $attByDept = \Config\Database::connect()
            ->table('attendance a')
            ->select('s.department, COUNT(*) as present')
            ->join('staff s', 's.id = a.staff_id')
            ->where('a.date', $date)
            ->whereIn('a.status', ['present', 'half_day', 'short'])
            ->groupBy('s.department')
            ->get()->getResultArray();

        $presentMap = array_column($attByDept, 'present', 'department');

        $result = [];
        foreach ($depts as $d) {
            $total = (int) $d['total'];
            $present = (int) ($presentMap[$d['department']] ?? 0);
            $result[] = [
                'dept' => $d['department'],
                'total' => $total,
                'present' => $present,
                'absent' => $total - $present,
                'pct' => $total > 0 ? round($present / $total * 100) : 0,
            ];
        }
        return $result;
    }

    private function weekAttendanceTrend(AttendanceModel $am): array
    {
        $db = \Config\Database::connect();
        $result = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-{$i} days"));
            $row = $db->table('attendance')
                ->select('
                    SUM(CASE WHEN status="present"  THEN 1 ELSE 0 END) as present,
                    SUM(CASE WHEN status="absent"   THEN 1 ELSE 0 END) as absent,
                    SUM(CASE WHEN status="half_day" THEN 1 ELSE 0 END) as half_day,
                    SUM(CASE WHEN status="leave"    THEN 1 ELSE 0 END) as `leave`
                ')
                ->where('date', $date)
                ->get()->getRowArray();

            $result[] = [
                'date' => $date,
                'label' => date('D', strtotime($date)),
                'present' => (int) ($row['present'] ?? 0),
                'absent' => (int) ($row['absent'] ?? 0),
                'half_day' => (int) ($row['half_day'] ?? 0),
                'leave' => (int) ($row['leave'] ?? 0),
            ];
        }
        return $result;
    }

    private function revenueTrend(InvoiceModel $m): array
    {
        $db = \Config\Database::connect();
        $result = [];
        for ($i = 5; $i >= 0; $i--) {
            $ts = strtotime("first day of -$i month");
            $mon = (int) date('n', $ts);
            $yr = (int) date('Y', $ts);
            $start = date('Y-m-01', $ts);
            $end = date('Y-m-t', $ts);

            $row = $db->table('invoices')
                ->select('SUM(paid_amount) as collected, SUM(total_amount) as billed, COUNT(*) as cnt')
                ->where('invoice_date >=', $start)
                ->where('invoice_date <=', $end)
                ->where('deleted_at IS NULL')
                ->get()->getRowArray();

            $result[] = [
                'label' => date('M Y', $ts),
                'collected' => (float) ($row['collected'] ?? 0),
                'billed' => (float) ($row['billed'] ?? 0),
                'count' => (int) ($row['cnt'] ?? 0),
            ];
        }
        return $result;
    }

    private function deptBreakdown(StaffModel $sm): array
    {
        return $sm->select('department, COUNT(*) as count')
            ->where('status', 'active')
            ->where('deleted_at IS NULL')
            ->groupBy('department')
            ->orderBy('count', 'DESC')
            ->limit(10)
            ->findAll();
    }
}