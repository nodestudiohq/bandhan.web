<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table = 'invoices';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'invoice_no',
        'invoice_date',
        'due_date',
        'patient_name',
        'patient_phone',
        'patient_age',
        'patient_sex',
        'patient_address',
        'doctor_name',
        'admission_date',
        'discharge_date',
        'ward_room',
        'subtotal',
        'discount',
        'tax_percent',
        'tax_amount',
        'total_amount',
        'paid_amount',
        'status',
        'payment_mode',
        'notes',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'patient_name' => 'required|min_length[2]',
        'total_amount' => 'required|decimal',
    ];

    // ──────────────────────────────────────────────────────────────────

    /**
     * Generate next invoice number like INV-2026-0001.
     */
    public function nextInvoiceNo(): string
    {
        $year = date('Y');
        $count = $this->where("invoice_no LIKE 'INV-{$year}-%'")->countAllResults();
        return 'INV-' . $year . '-' . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Save invoice with its line items in one transaction.
     */
    public function saveWithItems(array $data, array $items): int|false
    {
        $db = \Config\Database::connect();
        $db->transStart();

        $invoiceId = $this->insert($data, true);

        if ($invoiceId) {
            $itemModel = new InvoiceItemModel();
            foreach ($items as $item) {
                $item['invoice_id'] = $invoiceId;
                $itemModel->insert($item);
            }
        }

        $db->transComplete();
        return $db->transStatus() ? $invoiceId : false;
    }

    /**
     * Update invoice and replace its line items.
     */
    public function updateWithItems(int $id, array $data, array $items): bool
    {
        $db = \Config\Database::connect();
        $db->transStart();

        $this->update($id, $data);

        $itemModel = new InvoiceItemModel();
        $itemModel->where('invoice_id', $id)->delete();
        foreach ($items as $item) {
            $item['invoice_id'] = $id;
            $itemModel->insert($item);
        }

        $db->transComplete();
        return $db->transStatus();
    }

    /**
     * Get full invoice with its line items.
     */
    public function getWithItems(int $id): ?array
    {
        $invoice = $this->find($id);
        if (!$invoice)
            return null;

        $invoice['items'] = (new InvoiceItemModel())
            ->where('invoice_id', $id)
            ->findAll();

        return $invoice;
    }

    /**
     * Filtered paginated invoice list with item count.
     */
    public function getFiltered(array $filters = [], int $perPage = 20): array
    {
        $builder = $this->db->table('invoices i')
            ->select('i.*, (SELECT COUNT(*) FROM invoice_items ii WHERE ii.invoice_id = i.id) AS item_count')
            ->where('i.deleted_at IS NULL')
            ->orderBy('i.id', 'DESC');

        if (!empty($filters['q'])) {
            $q = $filters['q'];
            $builder->groupStart()
                ->like('i.invoice_no', $q)
                ->orLike('i.patient_name', $q)
                ->groupEnd();
        }

        if (!empty($filters['status'])) {
            $builder->where('i.status', $filters['status']);
        }

        if (!empty($filters['from'])) {
            $builder->where('i.invoice_date >=', $filters['from']);
        }

        if (!empty($filters['to'])) {
            $builder->where('i.invoice_date <=', $filters['to']);
        }

        // Manual pagination
        $total = (clone $builder)->countAllResults(false);
        $page = (int) ($_GET['page'] ?? 1);
        $offset = ($page - 1) * $perPage;
        $results = $builder->limit($perPage, $offset)->get()->getResultArray();

        return ['data' => $results, 'total' => $total];
    }

    /**
     * Count invoices created in the current month.
     */
    public function countThisMonth(): int
    {
        return $this->where('MONTH(created_at)', date('n'))
            ->where('YEAR(created_at)', date('Y'))
            ->countAllResults();
    }
}