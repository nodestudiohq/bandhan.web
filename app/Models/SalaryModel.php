<?php

namespace App\Models;

use CodeIgniter\Model;

class SalaryModel extends Model
{
    protected $table = 'salaries';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'staff_id',
        'salary_structure_id',
        'month',
        'year',
        // attendance
        'working_days',
        'present_days',
        'paid_leave_days',
        'unpaid_leave_days',
        'lop_override',
        // earnings snapshot
        'basic_pay',
        'hra',
        'da',
        'medical_allowance',
        'travel_allowance',
        'special_allowance',
        'night_shift_allowance',
        'overtime_allowance',
        'bonus_incentive',
        'gross_earnings',
        // lop
        'lop_deduction',
        // deductions
        'pf',
        'esi',
        'professional_tax',
        'tds',
        'loan_recovery',
        'advance_recovery',
        'other_deductions',
        'deduction_note',
        // totals
        'total_deductions',
        'net_pay',
        // disbursement
        'payment_status',
        'payment_mode',
        'bank_account',
        'transaction_ref',
        'paid_date',
        'approved_by',
        'remarks',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // ──────────────────────────────────────────────────────────────────
    // Generation
    // ──────────────────────────────────────────────────────────────────

    /**
     * Generate salary drafts for all active staff for a given month/year.
     * Pulls salary structure, computes attendance, applies LOP.
     * Returns ['generated' => N, 'skipped' => N, 'errors' => [...]]
     */
    public function generateForMonth(int $month, int $year): array
    {
        $staffModel = new StaffModel();
        $ssModel = new SalaryStructureModel();
        $attendanceModel = new AttendanceModel();

        $allStaff = $staffModel->where('status', 'active')->findAll();
        $workingDays = $this->calcWorkingDays($month, $year);
        $result = ['generated' => 0, 'skipped' => 0, 'errors' => []];

        foreach ($allStaff as $s) {
            // Skip if already exists for this month
            if ($this->existsFor($s['id'], $month, $year)) {
                $result['skipped']++;
                continue;
            }

            // Get active salary structure
            $ss = $ssModel->getActive($s['id']);
            if (!$ss) {
                $result['errors'][] = $s['name'] . ' — no salary structure defined.';
                continue;
            }

            // Attendance summary
            $att = $attendanceModel->monthlySummary($s['id'], $month, $year);
            $presentDays = (float) ($att['present'] + ($att['half_day'] * 0.5));
            $leaveDays = (float) $att['leave'];   // approved paid leave
            $absentDays = (float) $att['absent'];  // unauthorized = LOP

            // If NO attendance has been marked at all, assume full month present
            $totalMarked = $att['present'] + $att['absent'] + $att['half_day'] + $att['leave'];
            if ($totalMarked === 0) {
                $presentDays = (float) $workingDays;
                $leaveDays = 0.0;
                $absentDays = 0.0;
            }

            $payableDays = $presentDays + $leaveDays;
            $lopDays = $absentDays;

            // Calculate earnings & statutory deductions
            $calc = $ssModel->calculate($ss, $payableDays, $workingDays);

            // LOP = per-day rate × unpaid days
            $lopDeduction = ($workingDays > 0 && $lopDays > 0)
                ? round($calc['gross_earnings'] / $workingDays * $lopDays, 2)
                : 0.0;

            $totalDeductions = $lopDeduction + $calc['total_deductions'];
            $netPay = round($calc['gross_earnings'] - $totalDeductions, 2);

            $inserted = $this->insert([
                'staff_id' => $s['id'],
                'salary_structure_id' => $ss['id'],
                'month' => $month,
                'year' => $year,
                'working_days' => $workingDays,
                'present_days' => $presentDays,
                'paid_leave_days' => $leaveDays,
                'unpaid_leave_days' => $lopDays,
                // earnings snapshot
                'basic_pay' => $calc['earnings']['Basic Pay'] ?? 0,
                'hra' => $calc['earnings']['HRA'] ?? 0,
                'da' => $calc['earnings']['Dearness Allowance'] ?? 0,
                'medical_allowance' => $calc['earnings']['Medical Allowance'] ?? 0,
                'travel_allowance' => $calc['earnings']['Travel Allowance'] ?? 0,
                'special_allowance' => $calc['earnings']['Special Allowance'] ?? 0,
                'night_shift_allowance' => $calc['earnings']['Night Shift Allowance'] ?? 0,
                'overtime_allowance' => $calc['earnings']['Overtime Allowance'] ?? 0,
                'bonus_incentive' => $calc['earnings']['Bonus / Incentive'] ?? 0,
                'gross_earnings' => $calc['gross_earnings'],
                'lop_deduction' => $lopDeduction,
                // statutory deductions
                'pf' => $calc['deductions']['Provident Fund (PF)'] ?? 0,
                'esi' => $calc['deductions']['ESI (Employee)'] ?? 0,
                'professional_tax' => $calc['deductions']['Professional Tax'] ?? 0,
                'tds' => $calc['deductions']['Income Tax (TDS)'] ?? 0,
                // variable deductions from structure
                'loan_recovery' => (float) ($ss['loan_recovery'] ?? 0),
                'advance_recovery' => (float) ($ss['advance_recovery'] ?? 0),
                'other_deductions' => (float) ($ss['other_deductions'] ?? 0),
                'total_deductions' => $totalDeductions,
                'net_pay' => $netPay,
                'payment_status' => 'draft',
                'payment_mode' => 'Bank Transfer',
            ]);

            if (!$inserted) {
                $dbErr = $this->db->error();
                $result['errors'][] = $s['name'] . ' — DB insert failed: '
                    . ($dbErr['message'] ?? 'unknown error');
                continue;
            }

            $result['generated']++;
        }

        return $result;
    }

    /**
     * Recalculate a single salary record (e.g. after HR edits LOP/custom deductions).
     */
    public function recalculate(int $salaryId): bool
    {
        $record = $this->find($salaryId);
        if (!$record)
            return false;

        $ssModel = new SalaryStructureModel();
        $ss = $ssModel->find($record['salary_structure_id'])
            ?? $ssModel->getActive($record['staff_id']);
        if (!$ss)
            return false;

        // Use lop_override if HR set it, else use stored unpaid_leave_days
        $lopDays = $record['lop_override'] ?? $record['unpaid_leave_days'];
        $payableDays = $record['present_days'] + $record['paid_leave_days'];
        $workingDays = $record['working_days'];

        $calc = $ssModel->calculate($ss, $payableDays, $workingDays);

        $lopDeduction = $workingDays > 0
            ? round($calc['gross_earnings'] / $workingDays * $lopDays, 2)
            : 0;

        $totalDeductions = $lopDeduction + $calc['total_deductions']
            + (float) $record['loan_recovery']
            + (float) $record['advance_recovery']
            + (float) $record['other_deductions'];

        $netPay = $calc['gross_earnings'] - $totalDeductions;

        return $this->update($salaryId, [
            'lop_deduction' => $lopDeduction,
            'pf' => $calc['deductions']['Provident Fund (PF)'] ?? 0,
            'esi' => $calc['deductions']['ESI (Employee)'] ?? 0,
            'professional_tax' => $calc['deductions']['Professional Tax'] ?? 0,
            'tds' => $calc['deductions']['Income Tax (TDS)'] ?? 0,
            'gross_earnings' => $calc['gross_earnings'],
            'total_deductions' => $totalDeductions,
            'net_pay' => $netPay,
        ]);
    }

    // ──────────────────────────────────────────────────────────────────
    // Disbursement workflow
    // ──────────────────────────────────────────────────────────────────

    /**
     * Bulk approve all draft/pending salaries for a month (HR action).
     */
    public function approveMonth(int $month, int $year, int $approvedBy): int
    {
        return $this->db->table('salaries')
            ->where('month', $month)
            ->where('year', $year)
            ->whereIn('payment_status', ['draft', 'pending'])
            ->update([
                'payment_status' => 'approved',
                'approved_by' => $approvedBy,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
    }

    /**
     * Mark a salary as paid (Finance action).
     */
    public function markPaid(int $id, array $paymentData): bool
    {
        return (bool) $this->update($id, [
            'payment_status' => 'paid',
            'payment_mode' => $paymentData['payment_mode'] ?? 'Bank Transfer',
            'transaction_ref' => $paymentData['transaction_ref'] ?? null,
            'bank_account' => $paymentData['bank_account'] ?? null,
            'paid_date' => $paymentData['paid_date'] ?? date('Y-m-d'),
            'remarks' => $paymentData['remarks'] ?? null,
        ]);
    }

    /**
     * Bulk mark all approved salaries for a month as paid.
     */
    public function disburseBulk(int $month, int $year, array $paymentData): int
    {
        $records = $this->where('month', $month)
            ->where('year', $year)
            ->where('payment_status', 'approved')
            ->findAll();

        $count = 0;
        foreach ($records as $r) {
            $this->markPaid($r['id'], $paymentData);
            $count++;
        }
        return $count;
    }

    /**
     * Put a salary on hold.
     */
    public function holdSalary(int $id, string $reason): bool
    {
        return (bool) $this->update($id, [
            'payment_status' => 'held',
            'remarks' => $reason,
        ]);
    }

    // ──────────────────────────────────────────────────────────────────
    // Queries
    // ──────────────────────────────────────────────────────────────────

    public function existsFor(int $staffId, int $month, int $year): bool
    {
        return (bool) $this->where('staff_id', $staffId)
            ->where('month', $month)
            ->where('year', $year)
            ->first();
    }

    public function getMonthlyList(int $month, int $year, string $status = ''): array
    {
        $builder = $this->db->table('salaries s')
            ->select('s.*, st.name, st.staff_id AS staff_code,
                      st.designation, st.department, st.id AS staff_id_fk')
            ->join('staff st', 'st.id = s.staff_id')
            ->where('s.month', $month)
            ->where('s.year', $year)
            ->where('st.deleted_at IS NULL')
            ->orderBy('st.name');

        if ($status) {
            $builder->where('s.payment_status', $status);
        }

        return $builder->get()->getResultArray();
    }

    public function getSlip(int $staffId, ?int $month = null, ?int $year = null): ?array
    {
        return $this->where('staff_id', $staffId)
            ->where('month', $month ?? (int) date('n'))
            ->where('year', $year ?? (int) date('Y'))
            ->first();
    }

    public function totalForMonth(int $month, int $year): float
    {
        $r = $this->selectSum('net_pay')
            ->where('month', $month)->where('year', $year)->first();
        return (float) ($r['net_pay'] ?? 0);
    }

    public function statusSummary(int $month, int $year): array
    {
        $rows = $this->select('payment_status, COUNT(*) as cnt, SUM(net_pay) as total')
            ->where('month', $month)->where('year', $year)
            ->groupBy('payment_status')
            ->findAll();

        $summary = ['draft' => 0, 'pending' => 0, 'approved' => 0, 'paid' => 0, 'held' => 0];
        foreach ($rows as $r) {
            $summary[$r['payment_status']] = (int) $r['cnt'];
        }
        return $summary;
    }

    // ──────────────────────────────────────────────────────────────────
    // Helpers
    // ──────────────────────────────────────────────────────────────────

    /**
     * Working days = calendar days minus Sundays (adjust for holidays if needed).
     */
    public function calcWorkingDays(int $month, int $year): int
    {
        // Guard against invalid values (e.g. 0 from missing POST data)
        if ($month < 1 || $month > 12 || $year < 2000) {
            return 26; // safe fallback
        }

        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $sundays = 0;
        for ($d = 1; $d <= $days; $d++) {
            if (date('N', mktime(0, 0, 0, $month, $d, $year)) == 7) {
                $sundays++;
            }
        }
        return $days - $sundays;
    }
}