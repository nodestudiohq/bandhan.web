<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSalariesTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'staff_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'salary_structure_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'comment' => 'Snapshot of which structure was used',
            ],
            'month' => ['type' => 'TINYINT', 'constraint' => 2, 'unsigned' => true],
            'year' => ['type' => 'SMALLINT', 'constraint' => 4, 'unsigned' => true],

            // ── Attendance ────────────────────────────────────────────
            'working_days' => [
                'type' => 'TINYINT',
                'constraint' => 2,
                'unsigned' => true,
                'default' => 0,
                'comment' => 'Total payable working days in the month (excl. declared holidays)',
            ],
            'present_days' => [
                'type' => 'DECIMAL',
                'constraint' => '4,1',
                'default' => 0.0,
                'comment' => 'Full days present (0.5 per half-day)',
            ],
            'paid_leave_days' => [
                'type' => 'DECIMAL',
                'constraint' => '4,1',
                'default' => 0.0,
                'comment' => 'Approved paid leave — counted as present for pay',
            ],
            'unpaid_leave_days' => [
                'type' => 'DECIMAL',
                'constraint' => '4,1',
                'default' => 0.0,
                'comment' => 'Leaves without pay — deducted from salary',
            ],
            'lop_override' => [
                'type' => 'DECIMAL',
                'constraint' => '4,1',
                'null' => true,
                'default' => null,
                'comment' => 'HR manual override for Loss of Pay days (overrides auto calc)',
            ],

            // ── Earnings (snapshot from salary_structure) ─────────────
            'basic_pay' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'hra' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'da' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'medical_allowance' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'travel_allowance' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'special_allowance' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'night_shift_allowance' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'overtime_allowance' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'bonus_incentive' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'gross_earnings' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'comment' => 'Sum of all earnings after attendance pro-rating'
            ],

            // ── Leave / LOP deduction ─────────────────────────────────
            'lop_deduction' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'comment' => 'Loss of Pay amount = (gross/working_days) × lop_days',
            ],

            // ── Statutory deductions ──────────────────────────────────
            'pf' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'esi' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'professional_tax' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'tds' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],

            // ── Variable / custom deductions ──────────────────────────
            'loan_recovery' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'advance_recovery' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'other_deductions' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'deduction_note' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'comment' => 'HR note explaining custom deductions',
            ],

            // ── Totals ────────────────────────────────────────────────
            'total_deductions' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'net_pay' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],

            // ── Disbursement ──────────────────────────────────────────
            'payment_status' => [
                'type' => 'ENUM',
                'constraint' => ['draft', 'pending', 'approved', 'paid', 'held'],
                'default' => 'draft',
                'comment' => 'draft→pending (generate)→approved (HR)→paid (Finance)',
            ],
            'payment_mode' => [
                'type' => 'ENUM',
                'constraint' => ['Bank Transfer', 'Cash', 'Cheque', 'UPI'],
                'default' => 'Bank Transfer',
                'null' => true,
            ],
            'bank_account' => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true],
            'transaction_ref' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'comment' => 'UTR / cheque number / reference'
            ],
            'paid_date' => ['type' => 'DATE', 'null' => true],
            'approved_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'comment' => 'FK to users/admin table'
            ],
            'remarks' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],

            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['staff_id', 'month', 'year']);
        $this->forge->addKey(['month', 'year']);
        $this->forge->addKey('payment_status');
        $this->forge->addForeignKey('staff_id', 'staff', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('salaries', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('salaries', true);
    }
}