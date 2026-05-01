<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * salary_structures — one row per staff per revision.
 * Multiple rows allowed per staff: effective_from differentiates revisions.
 */
class CreateSalaryStructuresTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([

            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'staff_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'comment' => 'FK → staff.id'],

            // ── Earnings ──────────────────────────────────────────────
            'basic_pay' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'comment' => 'Core basic pay — basis for PF, HRA calculations',
            ],
            'hra' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'comment' => 'House Rent Allowance — typically 40-50% of basic',
            ],
            'da' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'comment' => 'Dearness Allowance',
            ],
            'medical_allowance' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 1250.00,
                'comment' => 'Tax-free limit ₹15,000/yr → ₹1,250/month',
            ],
            'travel_allowance' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 800.00,
                'comment' => 'Conveyance / transport allowance',
            ],
            'special_allowance' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'comment' => 'Skill/role-based top-up',
            ],
            'night_shift_allowance' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'comment' => 'For nursing/ICU/ER night duty staff',
            ],
            'overtime_allowance' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'comment' => 'Monthly OT — updated each payroll cycle',
            ],
            'bonus_incentive' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'comment' => 'Performance bonus / festive bonus',
            ],

            // ── PF ────────────────────────────────────────────────────
            'pf_applicable' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'comment' => '1 = PF deducted; 0 = exempt (contract/consultant)',
            ],
            'pf_percent' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'default' => 12.00,
                'comment' => 'Employee PF % — statutory 12% of basic',
            ],

            // ── ESI ───────────────────────────────────────────────────
            'esi_applicable' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
                'comment' => '1 = ESI applicable; auto-disabled if gross > ₹21,000',
            ],
            'esi_percent' => [
                'type' => 'DECIMAL',
                'constraint' => '5,2',
                'default' => 0.75,
                'comment' => 'Employee ESI % — statutory 0.75% of gross',
            ],

            // ── Other deductions ──────────────────────────────────────
            'professional_tax' => [
                'type' => 'DECIMAL',
                'constraint' => '8,2',
                'default' => 200.00,
                'comment' => 'State PT — West Bengal ₹200/month for salary > ₹10,000',
            ],
            'tds' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'comment' => 'Estimated monthly income tax deduction at source',
            ],
            'loan_recovery' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'comment' => 'Fixed monthly EMI for hospital loan to staff',
            ],
            'advance_recovery' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'comment' => 'Ad-hoc salary advance recovery — reset after recovery',
            ],
            'other_deductions' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'comment' => 'Any miscellaneous deduction',
            ],

            // ── Revision metadata ─────────────────────────────────────
            'effective_from' => [
                'type' => 'DATE',
                'comment' => 'Date from which this structure is active (salary revision)',
            ],
            'remarks' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'comment' => 'e.g. Annual increment, Promotion, Joining',
            ],

            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['staff_id', 'effective_from']); // fast active-structure lookup
        $this->forge->addForeignKey('staff_id', 'staff', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('salary_structures', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('salary_structures', true);
    }
}