<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Salary Structure — one row per staff member.
 *
 * Earnings                    Deductions
 * ─────────────────────────── ───────────────────────────────
 * Basic Pay                   Provident Fund (PF) — 12% basic
 * House Rent Allowance (HRA)  Employee State Insurance (ESI)
 * Dearness Allowance (DA)     Professional Tax (PT)
 * Medical Allowance           Income Tax (TDS)
 * Travel Allowance (TA)       Loan Recovery
 * Special Allowance           Advance Recovery
 * Night Shift Allowance       Other Deductions
 * Overtime Allowance
 * Bonus / Incentive
 */
class SalaryStructureModel extends Model
{
    protected $table = 'salary_structures';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'staff_id',

        // ── Earnings ──────────────────────────────────────────────────
        'basic_pay',
        'hra',                  // House Rent Allowance
        'da',                   // Dearness Allowance
        'medical_allowance',
        'travel_allowance',
        'special_allowance',
        'night_shift_allowance',
        'overtime_allowance',
        'bonus_incentive',

        // ── Deduction config ──────────────────────────────────────────
        'pf_applicable',        // TINYINT 0|1 — whether PF is deducted
        'pf_percent',           // default 12.00
        'esi_applicable',       // TINYINT 0|1
        'esi_percent',          // default 0.75 (employee share)
        'professional_tax',     // fixed monthly amount (state-specific)
        'tds',                  // monthly TDS estimate
        'loan_recovery',        // fixed monthly loan EMI deduction
        'advance_recovery',     // ad-hoc advance recovery
        'other_deductions',

        // ── Effective date ────────────────────────────────────────────
        'effective_from',       // DATE — salary revision date
        'remarks',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // ──────────────────────────────────────────────────────────────────
    // Defaults
    // ──────────────────────────────────────────────────────────────────

    /**
     * Indian private-hospital standard defaults.
     * HRA = 40% of basic (metro), DA = 0% (private), Medical = ₹1,250 (tax-free limit).
     */
    public const DEFAULTS = [
        'hra' => 0,      // calculated as % of basic on save
        'da' => 0,
        'medical_allowance' => 1250,
        'travel_allowance' => 800,
        'special_allowance' => 0,
        'night_shift_allowance' => 0,
        'overtime_allowance' => 0,
        'bonus_incentive' => 0,
        'pf_applicable' => 1,
        'pf_percent' => 12.00,
        'esi_applicable' => 1,
        'esi_percent' => 0.75,
        'professional_tax' => 200,    // West Bengal slab (adjust per state)
        'tds' => 0,
        'loan_recovery' => 0,
        'advance_recovery' => 0,
        'other_deductions' => 0,
        'effective_from' => null,
        'remarks' => '',
    ];

    // ──────────────────────────────────────────────────────────────────
    // Queries
    // ──────────────────────────────────────────────────────────────────

    /**
     * Get the active salary structure for a staff member.
     * "Active" = latest effective_from that is <= today.
     */
    public function getActive(int $staffId): ?array
    {
        return $this->where('staff_id', $staffId)
            ->where('effective_from <=', date('Y-m-d'))
            ->orderBy('effective_from', 'DESC')
            ->first();
    }

    /**
     * All historical salary structures for a staff member (latest first).
     */
    public function getHistory(int $staffId): array
    {
        return $this->where('staff_id', $staffId)
            ->orderBy('effective_from', 'DESC')
            ->findAll();
    }

    // ──────────────────────────────────────────────────────────────────
    // Calculation helpers
    // ──────────────────────────────────────────────────────────────────

    /**
     * Compute all earnings, deductions and net from a structure row.
     * Pass $presentDays / $workingDays to pro-rate by attendance.
     *
     * Returns array with keys:
     *   gross_earnings, total_deductions, net_pay,
     *   earnings[] (label => amount), deductions[] (label => amount)
     */
    public function calculate(array $structure, ?float $presentDays = null, ?int $workingDays = null): array
    {
        $basic = (float) $structure['basic_pay'];

        // ── Earnings ──────────────────────────────────────────────────
        $earnings = [
            'Basic Pay' => $basic,
            'HRA' => (float) $structure['hra'],
            'Dearness Allowance' => (float) $structure['da'],
            'Medical Allowance' => (float) $structure['medical_allowance'],
            'Travel Allowance' => (float) $structure['travel_allowance'],
            'Special Allowance' => (float) $structure['special_allowance'],
            'Night Shift Allowance' => (float) $structure['night_shift_allowance'],
            'Overtime Allowance' => (float) $structure['overtime_allowance'],
            'Bonus / Incentive' => (float) $structure['bonus_incentive'],
        ];

        // Remove zero entries for clean slip display
        $earnings = array_filter($earnings, fn($v) => $v > 0);

        $grossEarnings = array_sum($earnings);

        // Pro-rate if attendance provided
        if ($presentDays !== null && $workingDays > 0) {
            $ratio = $presentDays / $workingDays;
            // Only basic, HRA, DA and special are pro-rated.
            // Fixed allowances (medical, travel) paid in full per convention.
            $proRated = ['Basic Pay', 'HRA', 'Dearness Allowance', 'Special Allowance'];
            foreach ($proRated as $label) {
                if (isset($earnings[$label])) {
                    $earnings[$label] = round($earnings[$label] * $ratio, 2);
                }
            }
            $grossEarnings = array_sum($earnings);
        }

        // ── Deductions ────────────────────────────────────────────────
        $deductions = [];

        if (!empty($structure['pf_applicable'])) {
            $pf = round($basic * ((float) $structure['pf_percent'] / 100), 2);
            if ($pf > 0)
                $deductions['Provident Fund (PF)'] = $pf;
        }

        if (!empty($structure['esi_applicable'])) {
            // ESI applies only if gross <= ₹21,000/month (Indian rule)
            if ($grossEarnings <= 21000) {
                $esi = round($grossEarnings * ((float) $structure['esi_percent'] / 100), 2);
                if ($esi > 0)
                    $deductions['ESI (Employee)'] = $esi;
            }
        }

        if ((float) $structure['professional_tax'] > 0) {
            $deductions['Professional Tax'] = (float) $structure['professional_tax'];
        }

        if ((float) $structure['tds'] > 0) {
            $deductions['Income Tax (TDS)'] = (float) $structure['tds'];
        }

        if ((float) $structure['loan_recovery'] > 0) {
            $deductions['Loan Recovery'] = (float) $structure['loan_recovery'];
        }

        if ((float) $structure['advance_recovery'] > 0) {
            $deductions['Advance Recovery'] = (float) $structure['advance_recovery'];
        }

        if ((float) $structure['other_deductions'] > 0) {
            $deductions['Other Deductions'] = (float) $structure['other_deductions'];
        }

        $totalDeductions = array_sum($deductions);
        $netPay = round($grossEarnings - $totalDeductions, 2);

        return [
            'earnings' => $earnings,
            'deductions' => $deductions,
            'gross_earnings' => round($grossEarnings, 2),
            'total_deductions' => round($totalDeductions, 2),
            'net_pay' => $netPay,
        ];
    }

    /**
     * CTC (Cost to Company) = gross + employer PF (12%) + employer ESI (3.25%).
     */
    public function calculateCTC(array $structure): float
    {
        $calc = $this->calculate($structure);
        $basic = (float) $structure['basic_pay'];
        $gross = $calc['gross_earnings'];
        $employerPF = !empty($structure['pf_applicable'])
            ? round($basic * ((float) $structure['pf_percent'] / 100), 2)
            : 0;
        $employerESI = (!empty($structure['esi_applicable']) && $gross <= 21000)
            ? round($gross * 3.25 / 100, 2)
            : 0;

        return round($gross + $employerPF + $employerESI, 2);
    }
}