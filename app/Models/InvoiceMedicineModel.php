<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceMedicineModel extends Model
{
    protected $table = 'invoice_medicines';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

    protected $allowedFields = [
        'invoice_id',
        'date',
        'medicine_name',
        'batch_no',
        'expiry',
        'qty',
        'unit',
        'unit_price',
        'total',
        'prescribed_by',
        'note',
        'sort_order',
    ];

    public function getByInvoice(int $invoiceId): array
    {
        return $this->where('invoice_id', $invoiceId)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->findAll();
    }

    /** Total medicine cost for an invoice — used as summary line on page 1. */
    public function totalForInvoice(int $invoiceId): float
    {
        $r = $this->selectSum('total')
            ->where('invoice_id', $invoiceId)
            ->first();
        return (float) ($r['total'] ?? 0);
    }

    /** Bulk replace all medicines for an invoice. */
    public function replaceForInvoice(int $invoiceId, array $rows): void
    {
        $this->where('invoice_id', $invoiceId)->delete();
        foreach ($rows as $i => $row) {
            if (empty($row['medicine_name']))
                continue;
            $qty = (float) ($row['qty'] ?? 1);
            $price = (float) ($row['unit_price'] ?? 0);
            $this->insert([
                'invoice_id' => $invoiceId,
                'date' => $row['date'] ?? null,
                'medicine_name' => $row['medicine_name'],
                'batch_no' => $row['batch_no'] ?? null,
                'expiry' => $row['expiry'] ?? null,
                'qty' => $qty,
                'unit' => $row['unit'] ?? 'Nos',
                'unit_price' => $price,
                'total' => round($qty * $price, 2),
                'prescribed_by' => $row['prescribed_by'] ?? null,
                'note' => $row['note'] ?? null,
                'sort_order' => $i,
            ]);
        }
    }
}