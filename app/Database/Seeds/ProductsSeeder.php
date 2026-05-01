<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['code' => 'CONS-GEN', 'category' => 'Consultation', 'name' => 'General Consultation', 'unit_price' => 300, 'unit' => 'Visit'],
            ['code' => 'CONS-SPEC', 'category' => 'Consultation', 'name' => 'Specialist Consultation', 'unit_price' => 600, 'unit' => 'Visit'],
            ['code' => 'CONS-EMER', 'category' => 'Consultation', 'name' => 'Emergency Consultation', 'unit_price' => 800, 'unit' => 'Visit'],
            ['code' => 'CONS-TELE', 'category' => 'Consultation', 'name' => 'Tele-Consultation', 'unit_price' => 250, 'unit' => 'Visit'],
            ['code' => 'CONS-FU', 'category' => 'Consultation', 'name' => 'Follow-up Consultation', 'unit_price' => 150, 'unit' => 'Visit'],
            ['code' => 'ROOM-GEN', 'category' => 'Room & Bed', 'name' => 'General Ward (per day)', 'unit_price' => 600, 'unit' => 'Day'],
            ['code' => 'ROOM-SEM', 'category' => 'Room & Bed', 'name' => 'Semi-Private Room (per day)', 'unit_price' => 1200, 'unit' => 'Day'],
            ['code' => 'ROOM-PVT', 'category' => 'Room & Bed', 'name' => 'Private Room (per day)', 'unit_price' => 2500, 'unit' => 'Day'],
            ['code' => 'ROOM-ICU', 'category' => 'Room & Bed', 'name' => 'ICU Bed (per day)', 'unit_price' => 5000, 'unit' => 'Day'],
            ['code' => 'ROOM-NICU', 'category' => 'Room & Bed', 'name' => 'NICU Bed (per day)', 'unit_price' => 6000, 'unit' => 'Day'],
            ['code' => 'LAB-CBC', 'category' => 'Laboratory', 'name' => 'Complete Blood Count (CBC)', 'unit_price' => 180, 'unit' => 'Test'],
            ['code' => 'LAB-BSF', 'category' => 'Laboratory', 'name' => 'Blood Sugar Fasting', 'unit_price' => 80, 'unit' => 'Test'],
            ['code' => 'LAB-HBA1C', 'category' => 'Laboratory', 'name' => 'HbA1c', 'unit_price' => 400, 'unit' => 'Test'],
            ['code' => 'LAB-LFT', 'category' => 'Laboratory', 'name' => 'Liver Function Test (LFT)', 'unit_price' => 500, 'unit' => 'Test'],
            ['code' => 'LAB-KFT', 'category' => 'Laboratory', 'name' => 'Kidney Function Test (KFT)', 'unit_price' => 500, 'unit' => 'Test'],
            ['code' => 'LAB-LIPID', 'category' => 'Laboratory', 'name' => 'Lipid Profile', 'unit_price' => 450, 'unit' => 'Test'],
            ['code' => 'LAB-TFT', 'category' => 'Laboratory', 'name' => 'Thyroid Function Test (TFT)', 'unit_price' => 600, 'unit' => 'Test'],
            ['code' => 'LAB-URINE', 'category' => 'Laboratory', 'name' => 'Urine Routine & Microscopy', 'unit_price' => 120, 'unit' => 'Test'],
            ['code' => 'LAB-CXR', 'category' => 'Laboratory', 'name' => 'Chest X-Ray', 'unit_price' => 350, 'unit' => 'Test'],
            ['code' => 'LAB-ECG', 'category' => 'Laboratory', 'name' => 'ECG', 'unit_price' => 200, 'unit' => 'Test'],
            ['code' => 'LAB-ECHO', 'category' => 'Laboratory', 'name' => 'Echocardiography', 'unit_price' => 2500, 'unit' => 'Test'],
            ['code' => 'LAB-USG', 'category' => 'Laboratory', 'name' => 'USG Abdomen', 'unit_price' => 800, 'unit' => 'Test'],
            ['code' => 'LAB-CT', 'category' => 'Laboratory', 'name' => 'CT Scan (plain)', 'unit_price' => 4500, 'unit' => 'Test'],
            ['code' => 'LAB-MRI', 'category' => 'Laboratory', 'name' => 'MRI Scan', 'unit_price' => 8000, 'unit' => 'Test'],
            ['code' => 'PROC-OT', 'category' => 'Surgery', 'name' => 'Operation Theatre Charges', 'unit_price' => 10000, 'unit' => 'Nos'],
            ['code' => 'PROC-ANES', 'category' => 'Surgery', 'name' => 'Anaesthesia Charges', 'unit_price' => 5000, 'unit' => 'Nos'],
            ['code' => 'PROC-SURG', 'category' => 'Surgery', 'name' => 'Surgeon Fee', 'unit_price' => 15000, 'unit' => 'Nos'],
            ['code' => 'PROC-DRSS', 'category' => 'Surgery', 'name' => 'Dressing Charges', 'unit_price' => 200, 'unit' => 'Nos'],
            ['code' => 'PROC-INJ', 'category' => 'Surgery', 'name' => 'Injection Administration', 'unit_price' => 50, 'unit' => 'Nos'],
            ['code' => 'NURS-DAY', 'category' => 'Nursing', 'name' => 'Nursing Charges (per day)', 'unit_price' => 300, 'unit' => 'Day'],
            ['code' => 'NURS-PRIV', 'category' => 'Nursing', 'name' => 'Special Nursing (private)', 'unit_price' => 800, 'unit' => 'Day'],
            ['code' => 'PHARM-SAL', 'category' => 'Pharmacy', 'name' => 'Normal Saline 500ml', 'unit_price' => 60, 'unit' => 'Bottle'],
            ['code' => 'PHARM-DNS', 'category' => 'Pharmacy', 'name' => 'DNS 500ml', 'unit_price' => 65, 'unit' => 'Bottle'],
            ['code' => 'PHARM-MED', 'category' => 'Pharmacy', 'name' => 'Medicines & Consumables', 'unit_price' => 0, 'unit' => 'Nos'],
            ['code' => 'PHYSIO-1', 'category' => 'Physiotherapy', 'name' => 'Physiotherapy Session', 'unit_price' => 400, 'unit' => 'Session'],
            ['code' => 'AMB-LOC', 'category' => 'Ambulance', 'name' => 'Ambulance (local)', 'unit_price' => 500, 'unit' => 'Trip'],
            ['code' => 'MISC-REG', 'category' => 'Miscellaneous', 'name' => 'Registration Fee', 'unit_price' => 100, 'unit' => 'Nos'],
            ['code' => 'MISC-DIET', 'category' => 'Miscellaneous', 'name' => 'Diet Charges (per day)', 'unit_price' => 150, 'unit' => 'Day'],
            ['code' => 'MISC-LAUN', 'category' => 'Miscellaneous', 'name' => 'Linen & Laundry (per day)', 'unit_price' => 100, 'unit' => 'Day'],
            ['code' => 'MISC-CERT', 'category' => 'Miscellaneous', 'name' => 'Medical Certificate', 'unit_price' => 200, 'unit' => 'Nos'],
        ];

        $now = date('Y-m-d H:i:s');
        foreach ($data as &$row) {
            $row += ['description' => null, 'tax_percent' => 0.00, 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now, 'deleted_at' => null];
        }

        $this->db->table('products')->insertBatch($data);
    }
}