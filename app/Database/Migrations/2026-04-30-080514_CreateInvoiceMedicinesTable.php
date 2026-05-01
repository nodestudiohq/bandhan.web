<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * invoice_medicines — per-invoice medicine/consumable detail log.
 * Page 1 of the invoice: one summary line "Medicines & Consumables ₹X"
 * Page 2+: full breakdown from this table.
 */
class CreateInvoiceMedicinesTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'invoice_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'date' => ['type' => 'DATE', 'null' => true, 'comment' => 'Date medicine was given'],
            'medicine_name' => ['type' => 'VARCHAR', 'constraint' => 200],
            'batch_no' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'expiry' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true, 'comment' => 'MM/YYYY'],
            'qty' => ['type' => 'DECIMAL', 'constraint' => '8,2', 'default' => 1],
            'unit' => ['type' => 'VARCHAR', 'constraint' => 30, 'null' => true, 'default' => 'Nos'],
            'unit_price' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'total' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],
            'prescribed_by' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'note' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'sort_order' => ['type' => 'SMALLINT', 'constraint' => 5, 'unsigned' => true, 'default' => 0],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('invoice_id');
        $this->forge->addForeignKey('invoice_id', 'invoices', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('invoice_medicines', true);
    }

    public function down(): void
    {
        $this->forge->dropTable('invoice_medicines', true);
    }
}