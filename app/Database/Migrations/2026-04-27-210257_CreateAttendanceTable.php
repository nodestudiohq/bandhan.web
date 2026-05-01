<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAttendanceTable extends Migration
{
    public function up(): void
    {
        // ── attendance_logs — raw punch events (IN / OUT) ─────────────
        // Written by the Android QR scanner app OR manual entry.
        // One row per punch. Multiple IN/OUT pairs possible per day.
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'staff_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'punched_at' => [
                'type' => 'DATETIME',
                'comment' => 'Exact timestamp of the punch',
            ],
            'punch_type' => [
                'type' => 'ENUM',
                'constraint' => ['in', 'out'],
            ],
            'source' => [
                'type' => 'ENUM',
                'constraint' => ['qr_scan', 'manual', 'api'],
                'default' => 'manual',
                'comment' => 'qr_scan = Android app, manual = admin panel, api = external',
            ],
            'device_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'comment' => 'Android device ID for audit',
            ],
            'note' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey(['staff_id', 'punched_at']);
        $this->forge->addKey('punched_at');
        $this->forge->addForeignKey('staff_id', 'staff', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('attendance_logs', true);

        // ── attendance — computed daily record ────────────────────────
        // One row per staff per date. Can be auto-computed from logs
        // OR manually overridden by HR.
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
            'date' => [
                'type' => 'DATE',
                'comment' => 'Attendance date = date of punch-IN (even for night shift)',
            ],
            // ── computed from logs ─────────────────────────────────────
            'first_in' => [
                'type' => 'DATETIME',
                'null' => true,
                'comment' => 'First IN punch of the day',
            ],
            'last_out' => [
                'type' => 'DATETIME',
                'null' => true,
                'comment' => 'Last OUT punch — may be next calendar day (night shift)',
            ],
            'work_minutes' => [
                'type' => 'SMALLINT',
                'constraint' => 5,
                'unsigned' => true,
                'default' => 0,
                'comment' => 'Total worked minutes = last_out - first_in',
            ],
            // ── status ────────────────────────────────────────────────
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['present', 'absent', 'half_day', 'short', 'leave', 'holiday', 'week_off'],
                'default' => 'absent',
                'comment' => 'present≥480min, half_day=240-479, short<240, absent=no punch',
            ],
            // ── override ──────────────────────────────────────────────
            'is_manual' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'comment' => '1 = HR manually set this record, overrides auto-compute',
            ],
            'manual_status' => [
                'type' => 'ENUM',
                'constraint' => ['present', 'absent', 'half_day', 'short', 'leave', 'holiday', 'week_off'],
                'null' => true,
                'comment' => 'HR override status — used when is_manual=1',
            ],
            'note' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['staff_id', 'date']);
        $this->forge->addKey('date');
        $this->forge->addKey('status');
        $this->forge->addForeignKey('staff_id', 'staff', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('attendance', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('attendance', true);
        $this->forge->dropTable('attendance_logs', true);
    }
}