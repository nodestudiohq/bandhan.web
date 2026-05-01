<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStaffTable extends Migration
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
                'type' => 'VARCHAR',
                'constraint' => 20,
                'unique' => true,
                'comment' => 'Format: BH-{DEPT_PREFIX}-{NNNN} e.g. BH-NU-0001',
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'father_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'dob' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'gender' => [
                'type' => 'ENUM',
                'constraint' => ['Male', 'Female', 'Other'],
                'null' => true,
            ],
            'blood_group' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => true,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'emergency_contact' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'photo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'designation' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'department' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'comment' => 'Must match a value from StaffModel::DEPARTMENTS',
            ],
            'joining_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'id_number' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'comment' => 'Aadhar or other govt ID',
            ],
            'weekly_off' => [
                'type' => 'ENUM',
                'constraint' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                'default' => 'Sunday',
                'comment' => 'Staff weekly off day — varies by shift/department',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['active', 'inactive'],
                'default' => 'active',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('department');         // filter by department
        $this->forge->addKey('status');             // active/inactive filter
        $this->forge->addKey('deleted_at');         // soft-delete scans
        $this->forge->createTable('staff', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('staff', true);
    }
}