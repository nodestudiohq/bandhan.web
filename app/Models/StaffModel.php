<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table = 'staff';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'staff_id',
        'name',
        'father_name',
        'dob',
        'gender',
        'blood_group',
        'phone',
        'email',
        'emergency_contact',
        'address',
        'photo',
        'designation',
        'department',
        'joining_date',
        'id_number',
        'weekly_off',
        'status',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[100]',
        'phone' => 'required|min_length[10]|max_length[15]',
        'designation' => 'required|min_length[2]|max_length[100]',
        'department' => 'required',
    ];

    protected $validationMessages = [
        'name' => ['required' => 'Staff name is required.'],
        'phone' => ['required' => 'Phone number is required.'],
    ];

    protected $skipValidation = false;

    // ──────────────────────────────────────────────────────────────────
    // Department & prefix definitions
    // ──────────────────────────────────────────────────────────────────

    /**
     * Real departments found in a private hospital, grouped by category.
     * Each entry: [ 'name' => string, 'prefix' => string (2-3 chars), 'category' => string ]
     */
    public const DEPARTMENTS = [
        // ── Clinical / Medical ────────────────────────────────────────
        ['name' => 'General Medicine', 'prefix' => 'GM', 'category' => 'Clinical'],
        ['name' => 'General Surgery', 'prefix' => 'GS', 'category' => 'Clinical'],
        ['name' => 'Orthopaedics', 'prefix' => 'OR', 'category' => 'Clinical'],
        ['name' => 'Cardiology', 'prefix' => 'CD', 'category' => 'Clinical'],
        ['name' => 'Cardiac Surgery', 'prefix' => 'CS', 'category' => 'Clinical'],
        ['name' => 'Neurology', 'prefix' => 'NL', 'category' => 'Clinical'],
        ['name' => 'Neurosurgery', 'prefix' => 'NS', 'category' => 'Clinical'],
        ['name' => 'Gynaecology & Obstetrics', 'prefix' => 'GO', 'category' => 'Clinical'],
        ['name' => 'Paediatrics', 'prefix' => 'PD', 'category' => 'Clinical'],
        ['name' => 'Neonatology', 'prefix' => 'NE', 'category' => 'Clinical'],
        ['name' => 'Oncology', 'prefix' => 'ON', 'category' => 'Clinical'],
        ['name' => 'Urology', 'prefix' => 'UR', 'category' => 'Clinical'],
        ['name' => 'Nephrology', 'prefix' => 'NP', 'category' => 'Clinical'],
        ['name' => 'Gastroenterology', 'prefix' => 'GT', 'category' => 'Clinical'],
        ['name' => 'Pulmonology', 'prefix' => 'PL', 'category' => 'Clinical'],
        ['name' => 'Endocrinology', 'prefix' => 'EN', 'category' => 'Clinical'],
        ['name' => 'Dermatology', 'prefix' => 'DM', 'category' => 'Clinical'],
        ['name' => 'Ophthalmology', 'prefix' => 'OP', 'category' => 'Clinical'],
        ['name' => 'ENT', 'prefix' => 'ET', 'category' => 'Clinical'],
        ['name' => 'Psychiatry', 'prefix' => 'PS', 'category' => 'Clinical'],
        ['name' => 'Dentistry', 'prefix' => 'DN', 'category' => 'Clinical'],
        ['name' => 'Rheumatology', 'prefix' => 'RH', 'category' => 'Clinical'],
        ['name' => 'Haematology', 'prefix' => 'HM', 'category' => 'Clinical'],
        ['name' => 'Palliative Care', 'prefix' => 'PC', 'category' => 'Clinical'],

        // ── Emergency & Critical Care ─────────────────────────────────
        ['name' => 'Emergency & Trauma', 'prefix' => 'EM', 'category' => 'Emergency & Critical Care'],
        ['name' => 'Intensive Care Unit', 'prefix' => 'IC', 'category' => 'Emergency & Critical Care'],
        ['name' => 'Neonatal ICU', 'prefix' => 'NI', 'category' => 'Emergency & Critical Care'],
        ['name' => 'Cardiac ICU', 'prefix' => 'CI', 'category' => 'Emergency & Critical Care'],

        // ── Nursing ───────────────────────────────────────────────────
        ['name' => 'Nursing', 'prefix' => 'NU', 'category' => 'Nursing'],
        ['name' => 'Operation Theatre', 'prefix' => 'OT', 'category' => 'Nursing'],
        ['name' => 'Labour Room', 'prefix' => 'LR', 'category' => 'Nursing'],

        // ── Diagnostics & Allied ──────────────────────────────────────
        ['name' => 'Radiology & Imaging', 'prefix' => 'RI', 'category' => 'Diagnostics'],
        ['name' => 'Pathology & Lab', 'prefix' => 'PL', 'category' => 'Diagnostics'],
        ['name' => 'Microbiology', 'prefix' => 'MB', 'category' => 'Diagnostics'],
        ['name' => 'Blood Bank', 'prefix' => 'BB', 'category' => 'Diagnostics'],
        ['name' => 'Physiotherapy', 'prefix' => 'PT', 'category' => 'Diagnostics'],
        ['name' => 'Dietetics & Nutrition', 'prefix' => 'DT', 'category' => 'Diagnostics'],
        ['name' => 'Occupational Therapy', 'prefix' => 'OC', 'category' => 'Diagnostics'],
        ['name' => 'Speech Therapy', 'prefix' => 'SP', 'category' => 'Diagnostics'],

        // ── Pharmacy ──────────────────────────────────────────────────
        ['name' => 'Pharmacy', 'prefix' => 'PH', 'category' => 'Pharmacy'],
        ['name' => 'Central Sterile Supply', 'prefix' => 'SS', 'category' => 'Pharmacy'],

        // ── Administration & Management ───────────────────────────────
        ['name' => 'Administration', 'prefix' => 'AD', 'category' => 'Administration'],
        ['name' => 'Human Resources', 'prefix' => 'HR', 'category' => 'Administration'],
        ['name' => 'Finance & Accounts', 'prefix' => 'FA', 'category' => 'Administration'],
        ['name' => 'Medical Records', 'prefix' => 'MR', 'category' => 'Administration'],
        ['name' => 'Front Office & Billing', 'prefix' => 'FO', 'category' => 'Administration'],
        ['name' => 'Patient Relations', 'prefix' => 'PR', 'category' => 'Administration'],
        ['name' => 'IT & Systems', 'prefix' => 'IT', 'category' => 'Administration'],
        ['name' => 'Legal & Compliance', 'prefix' => 'LC', 'category' => 'Administration'],

        // ── Support Services ──────────────────────────────────────────
        ['name' => 'Housekeeping', 'prefix' => 'HK', 'category' => 'Support Services'],
        ['name' => 'Security', 'prefix' => 'SC', 'category' => 'Support Services'],
        ['name' => 'Laundry', 'prefix' => 'LN', 'category' => 'Support Services'],
        ['name' => 'Kitchen & Catering', 'prefix' => 'KC', 'category' => 'Support Services'],
        ['name' => 'Maintenance & Engineering', 'prefix' => 'ME', 'category' => 'Support Services'],
        ['name' => 'Biomedical Engineering', 'prefix' => 'BE', 'category' => 'Support Services'],
        ['name' => 'Mortuary', 'prefix' => 'MT', 'category' => 'Support Services'],
        ['name' => 'Transport', 'prefix' => 'TR', 'category' => 'Support Services'],
        ['name' => 'Store & Purchase', 'prefix' => 'ST', 'category' => 'Support Services'],
    ];

    /**
     * Flat list of department names for dropdowns.
     */
    public function getDepartments(): array
    {
        return array_column(self::DEPARTMENTS, 'name');
    }

    /**
     * Departments grouped by category for optgroup dropdowns.
     * Returns [ 'Clinical' => ['General Medicine', ...], ... ]
     */
    public function getDepartmentsGrouped(): array
    {
        $grouped = [];
        foreach (self::DEPARTMENTS as $dept) {
            $grouped[$dept['category']][] = $dept['name'];
        }
        return $grouped;
    }

    /**
     * prefix map: department name → prefix code.
     */
    private function getPrefixMap(): array
    {
        $map = [];
        foreach (self::DEPARTMENTS as $dept) {
            // Last-write wins for duplicate prefixes (none exist, but safe)
            $map[$dept['name']] = $dept['prefix'];
        }
        return $map;
    }

    // ──────────────────────────────────────────────────────────────────
    // Staff ID generation
    // ──────────────────────────────────────────────────────────────────

    /**
     * Generate next staff ID scoped to the department.
     * Format: BH-{PREFIX}-{NNNN}  e.g. BH-NU-0001, BH-GM-0023
     */
    public function generateStaffId(string $department): string
    {
        $prefixMap = $this->getPrefixMap();
        $prefix = $prefixMap[$department]
            ?? strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $department), 0, 3));

        // Count all rows for this dept (incl. soft-deleted) → stable ever-increasing seq
        $count = $this->db
            ->table('staff')
            ->where('department', $department)
            ->countAllResults();

        return 'BH-' . $prefix . '-' . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
    }

    // ──────────────────────────────────────────────────────────────────
    // Queries
    // ──────────────────────────────────────────────────────────────────

    /**
     * Filtered + paginated staff list.
     */
    public function getFiltered(array $filters = [], int $perPage = 20): array
    {
        $builder = $this->builder();

        if (!empty($filters['q'])) {
            $q = $filters['q'];
            $builder->groupStart()
                ->like('name', $q)
                ->orLike('staff_id', $q)
                ->orLike('department', $q)
                ->orLike('designation', $q)
                ->groupEnd();
        }

        if (!empty($filters['department'])) {
            $builder->where('department', $filters['department']);
        }

        if (!empty($filters['status'])) {
            $builder->where('status', $filters['status']);
        }

        return $this->where($builder->getCompiledSelect(false))
            ->paginate($perPage);
    }
}