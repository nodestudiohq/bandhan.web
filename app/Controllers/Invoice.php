<?php

namespace App\Controllers;

use App\Models\InvoiceModel;

class Invoice extends BaseController
{
    protected InvoiceModel $model;

    public function __construct()
    {
        $this->model = new InvoiceModel();
    }

    // ── List ──────────────────────────────────────────────────────────

    public function index(): string
    {
        $filters = $this->request->getGet(['q', 'status', 'from', 'to']);

        $result = $this->model->getFiltered($filters);

        return view('invoice/index', [
            'title' => 'Invoices',
            'invoices' => $result['data'],
            'total' => $result['total'],
            'filters' => $filters,
        ]);
    }

    // ── Create ────────────────────────────────────────────────────────

    public function create(): string
    {
        return view('invoice/form', [
            'title' => 'New Invoice',
            'next_invoice_no' => $this->model->nextInvoiceNo(),
        ]);
    }

    public function store()
    {
        $rules = [
            'patient_name' => 'required|min_length[2]',
            'total_amount' => 'required|decimal',
        ];

        if (!$this->validate($rules)) {
            return view('invoice/form', [
                'title' => 'New Invoice',
                'next_invoice_no' => $this->model->nextInvoiceNo(),
                'errors' => $this->validator->getErrors(),
            ]);
        }

        $data = $this->buildInvoiceData();
        $items = $this->buildItems();

        $id = $this->model->saveWithItems($data, $items);

        if ($id) {
            $meds = $this->buildMedicines();
            if (!empty($meds)) {
                (new \App\Models\InvoiceMedicineModel())->replaceForInvoice($id, $meds);
            }
            session()->setFlashdata('success', 'Invoice ' . $data['invoice_no'] . ' created.');
            return redirect()->to(base_url('invoice/print/' . $id));
        }

        session()->setFlashdata('error', 'Failed to save invoice.');
        return redirect()->back()->withInput();
    }

    // ── Edit ──────────────────────────────────────────────────────────

    public function edit(int $id): string
    {
        $invoice = $this->model->getWithItems($id);
        if (!$invoice) {
            session()->setFlashdata('error', 'Invoice not found.');
            return redirect()->to(base_url('invoice'));
        }

        $invoice['medicines'] = (new \App\Models\InvoiceMedicineModel())->getByInvoice($id);
        return view('invoice/form', [
            'title' => 'Edit Invoice',
            'invoice' => $invoice,
            'next_invoice_no' => $invoice['invoice_no'],
        ]);
    }

    public function update(int $id)
    {
        $invoice = $this->model->getWithItems($id);
        if (!$invoice) {
            session()->setFlashdata('error', 'Invoice not found.');
            return redirect()->to(base_url('invoice'));
        }

        $data = $this->buildInvoiceData();
        $items = $this->buildItems();

        $ok = $this->model->updateWithItems($id, $data, $items);

        if ($ok) {
            (new \App\Models\InvoiceMedicineModel())->replaceForInvoice($id, $this->buildMedicines());
            session()->setFlashdata('success', 'Invoice updated.');
            return redirect()->to(base_url('invoice/print/' . $id));
        }

        session()->setFlashdata('error', 'Update failed.');
        return redirect()->back()->withInput();
    }

    // ── View (detail) ─────────────────────────────────────────────────

    public function show(int $id): string
    {
        $invoice = $this->model->getWithItems($id);
        if (!$invoice) {
            session()->setFlashdata('error', 'Invoice not found.');
            return redirect()->to(base_url('invoice'));
        }

        return view('invoice/print', [
            'title' => 'Invoice ' . $invoice['invoice_no'],
            'invoice' => $invoice,
        ]);
    }

    // ── Print / PDF ───────────────────────────────────────────────────

    public function print(int $id): string
    {
        $invoice = $this->model->getWithItems($id);
        if (!$invoice) {
            session()->setFlashdata('error', 'Invoice not found.');
            return redirect()->to(base_url('invoice'));
        }

        $invoice['medicines'] = (new \App\Models\InvoiceMedicineModel())->getByInvoice($id);

        return view('invoice/print', [
            'title' => 'Invoice ' . $invoice['invoice_no'],
            'invoice' => $invoice,
        ]);
    }

    // ── Delete ────────────────────────────────────────────────────────

    public function delete(int $id)
    {
        $this->model->findOrFail($id);
        $this->model->delete($id);
        session()->setFlashdata('success', 'Invoice deleted.');
        return redirect()->to(base_url('invoice'));
    }

    // ── Product autocomplete (AJAX) ───────────────────────────────────

    public function productSearch()
    {
        $q = $this->request->getGet('q') ?? '';
        $results = strlen($q) >= 1
            ? (new \App\Models\ProductModel())->search($q)
            : [];

        return $this->response->setJSON($results);
    }

    public function medicineSearch()
    {
        $q = $this->request->getGet('q') ?? '';
        $results = strlen($q) >= 1
            ? (new \App\Models\ProductModel())->search($q, 15, 'Pharmacy')
            : [];

        return $this->response->setJSON($results);
    }

    private function buildInvoiceData(): array
    {
        $post = $this->request->getPost();

        // Convert datetime-local inputs to MySQL format
        $admDate = !empty($post['admission_date'])
            ? date('Y-m-d H:i:s', strtotime($post['admission_date'])) : null;
        $disDate = !empty($post['discharge_date'])
            ? date('Y-m-d H:i:s', strtotime($post['discharge_date'])) : null;

        return [
            'invoice_no' => $post['invoice_no'],
            'invoice_date' => $post['invoice_date'] ?? date('Y-m-d'),
            'due_date' => $post['due_date'] ?? null,
            'patient_name' => $post['patient_name'],
            'patient_phone' => $post['patient_phone'] ?? null,
            'patient_age' => !empty($post['patient_age']) ? (int) $post['patient_age'] : null,
            'patient_sex' => !empty($post['patient_sex']) ? $post['patient_sex'] : null,
            'patient_address' => $post['patient_address'] ?? null,
            'doctor_name' => $post['doctor_name'] ?? null,
            'admission_date' => $admDate,
            'discharge_date' => $disDate,
            'ward_room' => $post['ward_room'] ?? null,
            'subtotal' => (float) ($post['subtotal'] ?? 0),
            'discount' => (float) ($post['discount'] ?? 0),
            'tax_percent' => (float) ($post['tax_percent'] ?? 0),
            'tax_amount' => (float) ($post['tax_amount'] ?? 0),
            'total_amount' => (float) ($post['total_amount'] ?? 0),
            'paid_amount' => (float) ($post['paid_amount'] ?? 0),
            'status' => $post['status'] ?? 'unpaid',
            'payment_mode' => $post['payment_mode'] ?? 'cash',
            'notes' => $post['notes'] ?? null,
        ];
    }

    private function buildMedicines(): array
    {
        $raw = $this->request->getPost('medicines') ?? [];
        $rows = [];
        foreach ($raw as $row) {
            if (empty($row['medicine_name']))
                continue;
            $rows[] = $row;
        }
        return $rows;
    }

    private function buildItems(): array
    {
        $rawItems = $this->request->getPost('items') ?? [];
        $items = [];
        foreach ($rawItems as $item) {
            if (empty($item['description']))
                continue;
            $qty = (float) ($item['qty'] ?? 1);
            $price = (float) ($item['unit_price'] ?? 0);
            $items[] = [
                'description' => $item['description'],
                'qty' => $qty,
                'unit_price' => $price,
                'total' => round($qty * $price, 2),
            ];
        }
        return $items;
    }
}