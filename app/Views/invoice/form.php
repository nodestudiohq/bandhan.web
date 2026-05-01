<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php $editing = isset($invoice); ?>

<style>
  /* ── Section titles ───────────────────────────────── */
  .form-section {
    font-size: 10.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    color: var(--muted);
    padding-bottom: 8px;
    margin-bottom: 14px;
    border-bottom: 1.5px solid var(--border);
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .form-section i {
    font-size: 13px;
    color: var(--indigo);
  }

  /* ── Form label ───────────────────────────────────── */
  .fl {
    font-size: 12px;
    font-weight: 600;
    color: var(--muted);
    margin-bottom: 5px;
    display: block;
  }

  /* ── Input base ───────────────────────────────────── */
  .fi {
    width: 100%;
    padding: 8px 11px;
    border: 1px solid var(--border);
    border-radius: 8px;
    font-size: 13.5px;
    color: var(--text);
    background: var(--surf);
    outline: none;
    transition: border-color .15s, box-shadow .15s;
    font-family: 'DM Sans', sans-serif;
  }

  .fi:focus {
    border-color: var(--indigo);
    box-shadow: 0 0 0 3px rgba(59, 79, 216, .1);
  }

  .fi[readonly] {
    background: var(--subtle);
    color: var(--muted);
  }

  select.fi {
    cursor: pointer;
  }

  textarea.fi {
    resize: vertical;
    min-height: 68px;
  }

  /* ── Grid helpers ─────────────────────────────────── */
  .fg2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
  }

  .fg3 {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 14px;
  }

  .fg4 {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    gap: 14px;
  }

  @media(max-width:768px) {

    .fg2,
    .fg3,
    .fg4 {
      grid-template-columns: 1fr;
    }
  }

  /* ── Card sections ────────────────────────────────── */
  .form-card {
    background: var(--surf);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 20px 22px;
    margin-bottom: 14px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .04);
  }

  /* ── Items table ──────────────────────────────────── */
  .inv-tbl {
    width: 100%;
    border-collapse: collapse;
  }

  .inv-tbl th {
    font-size: 10.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .6px;
    color: var(--muted);
    padding: 9px 10px;
    border-bottom: 1.5px solid var(--border);
    background: var(--subtle);
    text-align: left;
    white-space: nowrap;
  }

  .inv-tbl td {
    padding: 6px 6px;
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
  }

  .inv-tbl tbody tr:last-child td {
    border-bottom: none;
  }

  .inv-tbl .fi {
    font-size: 13px;
    padding: 6px 9px;
  }

  /* ── Totals panel ─────────────────────────────────── */
  .totals-panel {
    background: var(--subtle);
    border: 1px solid var(--border);
    border-radius: 10px;
    overflow: hidden;
  }

  .tot-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 9px 16px;
    border-bottom: 1px solid var(--border);
    font-size: 13.5px;
  }

  .tot-row:last-child {
    border-bottom: none;
  }

  .tot-row-grand {
    background: var(--indigo);
    padding: 12px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .tot-row-grand span:first-child {
    color: rgba(255, 255, 255, .8);
    font-size: 12px;
    font-weight: 600;
  }

  .tot-row-grand span:last-child {
    color: #fff;
    font-size: 17px;
    font-weight: 700;
    font-family: 'DM Mono', monospace;
  }

  .tot-label {
    color: var(--muted);
    font-size: 13px;
  }

  .tot-val {
    font-weight: 600;
    font-family: 'DM Mono', monospace;
    font-size: 13px;
  }

  .tot-input-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 7px 16px;
    border-bottom: 1px solid var(--border);
  }

  .tot-input-row label {
    color: var(--muted);
    font-size: 13px;
  }

  .tot-input {
    width: 90px;
    padding: 5px 8px;
    border: 1px solid var(--border);
    border-radius: 7px;
    font-size: 13px;
    text-align: right;
    background: var(--surf);
    outline: none;
  }

  .tot-input:focus {
    border-color: var(--indigo);
  }

  /* ── Med table ────────────────────────────────────── */
  .med-card {
    border: 1px solid #fde68a;
    border-radius: 12px;
    overflow: hidden;
  }

  .med-card-hdr {
    background: #fffbeb;
    border-bottom: 1px solid #fde68a;
    padding: 12px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
  }

  .med-card-title {
    font-size: 13px;
    font-weight: 600;
    color: #92400e;
    display: flex;
    align-items: center;
    gap: 7px;
  }

  .med-badge {
    background: #fde68a;
    color: #92400e;
    border-radius: 5px;
    padding: 2px 8px;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
  }

  /* ── Action buttons ───────────────────────────────── */
  .act-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 500;
    border: 1px solid var(--border);
    background: var(--surf);
    color: var(--muted);
    text-decoration: none;
    cursor: pointer;
    transition: background .12s, color .12s;
  }

  .act-btn:hover {
    background: var(--subtle);
    color: var(--text);
  }

  .act-btn-primary {
    background: var(--indigo);
    color: #fff;
    border-color: var(--indigo);
  }

  .act-btn-primary:hover {
    opacity: .9;
    color: #fff;
  }

  .act-btn-sm {
    padding: 6px 12px;
    font-size: 12.5px;
  }

  /* ── Delete button ────────────────────────────────── */
  .del-btn {
    width: 28px;
    height: 28px;
    border-radius: 7px;
    border: 1px solid var(--border);
    background: transparent;
    color: var(--muted);
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: background .12s, color .12s, border-color .12s;
  }

  .del-btn:hover {
    background: #fef2f2;
    color: #dc2626;
    border-color: #fca5a5;
  }

  /* ── Table overflow: visible so portal can escape ─ */
  .form-card,
  .med-card {
    overflow: visible;
  }

  .stay-duration {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: rgba(59, 79, 216, .08);
    color: var(--indigo);
    border-radius: 7px;
    padding: 4px 10px;
    font-size: 12px;
    font-weight: 600;
    margin-top: 6px;
  }
</style>

<!-- Header -->
<div
  style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:20px;flex-wrap:wrap;gap:10px;">
  <div>
    <h5 style="font-size:17px;font-weight:700;margin-bottom:2px;">
      <?= $editing ? 'Edit Invoice' : 'New Invoice' ?>
    </h5>
    <span style="font-size:13px;color:var(--muted);">
      <?= $editing ? 'Updating #' . esc($invoice['invoice_no']) : 'Create a new patient invoice' ?>
    </span>
  </div>
  <a href="<?= base_url('invoice') ?>" class="act-btn">
    <i class="bi bi-arrow-left"></i>Back
  </a>
</div>

<form method="post" action="<?= $editing ? base_url('invoice/update/' . $invoice['id']) : base_url('invoice/store') ?>">
  <?= csrf_field() ?>
  <?php if ($editing): ?><input type="hidden" name="_method" value="PUT"><?php endif; ?>

  <!-- ── SECTION 1: Invoice Details ──────────────────────────────── -->
  <div class="form-card">
    <div class="form-section"><i class="bi bi-receipt"></i>Invoice Details</div>
    <div class="fg4">
      <div>
        <label class="fl">Invoice No</label>
        <input type="text" name="invoice_no" class="fi"
          value="<?= old('invoice_no', $invoice['invoice_no'] ?? $next_invoice_no) ?>" readonly>
      </div>
      <div>
        <label class="fl">Invoice Date</label>
        <input type="date" name="invoice_date" class="fi"
          value="<?= old('invoice_date', $invoice['invoice_date'] ?? date('Y-m-d')) ?>">
      </div>
      <div>
        <label class="fl">Due Date</label>
        <input type="date" name="due_date" class="fi" value="<?= old('due_date', $invoice['due_date'] ?? '') ?>">
      </div>
      <div>
        <label class="fl">Payment Status</label>
        <select name="status" class="fi">
          <?php foreach (['unpaid' => 'Unpaid', 'partial' => 'Partial', 'paid' => 'Paid'] as $v => $l): ?>
            <option value="<?= $v ?>" <?= old('status', $invoice['status'] ?? 'unpaid') === $v ? 'selected' : '' ?>>
              <?= $l ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  </div>

  <!-- ── SECTION 2: Patient Information ──────────────────────────── -->
  <div class="form-card">
    <div class="form-section"><i class="bi bi-person-lines-fill"></i>Patient Information</div>

    <div class="fg3" style="margin-bottom:14px;">
      <div>
        <label class="fl">Patient Name <span style="color:#dc2626;">*</span></label>
        <input type="text" name="patient_name" class="fi" required
          value="<?= old('patient_name', $invoice['patient_name'] ?? '') ?>">
      </div>
      <div>
        <label class="fl">Phone</label>
        <input type="text" name="patient_phone" class="fi"
          value="<?= old('patient_phone', $invoice['patient_phone'] ?? '') ?>">
      </div>
      <div>
        <label class="fl">Doctor / Referred By</label>
        <input type="text" name="doctor_name" class="fi"
          value="<?= old('doctor_name', $invoice['doctor_name'] ?? '') ?>">
      </div>
    </div>

    <div class="fg3" style="margin-bottom:14px;">
      <div>
        <label class="fl">Age <span style="color:var(--muted);font-weight:400;">(years)</span></label>
        <input type="number" name="patient_age" class="fi"
          value="<?= old('patient_age', $invoice['patient_age'] ?? '') ?>" min="0" max="120" placeholder="e.g. 35">
      </div>
      <div>
        <label class="fl">Sex</label>
        <div style="display:flex;gap:8px;padding-top:4px;">
          <?php foreach (['Male', 'Female', 'Other'] as $sex):
            $checked = old('patient_sex', $invoice['patient_sex'] ?? '') === $sex ? 'checked' : '';
            ?>
            <label style="display:flex;align-items:center;gap:6px;cursor:pointer;
                          padding:7px 14px;border-radius:8px;font-size:13.5px;font-weight:500;
                          border:1.5px solid var(--border);background:var(--surf);
                          transition:all .12s;user-select:none;" class="sex-label">
              <input type="radio" name="patient_sex" value="<?= $sex ?>" <?= $checked ?> style="display:none;"
                onchange="highlightSex()">
              <?= $sex ?>
            </label>
          <?php endforeach; ?>
        </div>
      </div>
      <div>
        <label class="fl">Patient Address</label>
        <textarea name="patient_address" class="fi"
          rows="2"><?= old('patient_address', $invoice['patient_address'] ?? '') ?></textarea>
      </div>
    </div>

    <!-- Admission / Discharge row -->
    <div style="background:var(--subtle);border:1px solid var(--border);border-radius:10px;padding:14px 16px;">
      <div
        style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:var(--muted);margin-bottom:12px;">
        <i class="bi bi-hospital" style="color:var(--indigo);margin-right:5px;"></i>Admission / Discharge
        <span
          style="font-size:10px;font-weight:400;text-transform:none;letter-spacing:0;margin-left:6px;color:#94a3b8;">(optional
          — for inpatient billing)</span>
      </div>
      <div class="fg3">
        <div>
          <label class="fl">Admission Date &amp; Time</label>
          <input type="datetime-local" name="admission_date" class="fi"
            value="<?= old('admission_date', !empty($invoice['admission_date']) ? date('Y-m-d\TH:i', strtotime($invoice['admission_date'])) : '') ?>">
        </div>
        <div>
          <label class="fl">Discharge Date &amp; Time</label>
          <input type="datetime-local" name="discharge_date" class="fi" id="dischargeInput"
            value="<?= old('discharge_date', !empty($invoice['discharge_date']) ? date('Y-m-d\TH:i', strtotime($invoice['discharge_date'])) : '') ?>">
          <div id="stayDuration" class="stay-duration" style="display:none;">
            <i class="bi bi-clock" style="font-size:11px;"></i>
            <span></span>
          </div>
        </div>
        <div>
          <label class="fl">Ward / Room</label>
          <input type="text" name="ward_room" class="fi" placeholder="e.g. Ward 3, Room 12"
            value="<?= old('ward_room', $invoice['ward_room'] ?? '') ?>">
        </div>
      </div>
    </div>
  </div>

  <!-- ── SECTION 3: Services / Items ─────────────────────────────── -->
  <div class="form-card">
    <div class="form-section"><i class="bi bi-list-check"></i>Services &amp; Items</div>

    <div style="overflow:visible;overflow-x:auto;">
      <table class="inv-tbl" id="itemsTable">
        <thead>
          <tr>
            <th style="width:40%;min-width:220px;">Description</th>
            <th style="width:8%;min-width:60px;">Qty</th>
            <th style="width:15%;min-width:100px;">Unit Price (₹)</th>
            <th style="width:13%;min-width:90px;">Total (₹)</th>
            <th style="width:8%;min-width:60px;">Tax %</th>
            <th style="width:4%;min-width:36px;"></th>
          </tr>
        </thead>
        <tbody id="itemsBody">
          <?php
          $items = old('items', $invoice['items'] ?? [['description' => '', 'qty' => 1, 'unit_price' => 0, 'tax_percent' => 0]]);
          ?>
          <?php foreach ($items as $i => $item): ?>
            <tr class="item-row">
              <td>
                <input type="text" name="items[<?= $i ?>][description]" class="fi item-desc"
                  value="<?= esc($item['description'] ?? '') ?>" placeholder="Type to search services…" autocomplete="off"
                  required>
                <input type="hidden" name="items[<?= $i ?>][product_id]" class="item-product-id" value="">
              </td>
              <td>
                <input type="number" name="items[<?= $i ?>][qty]" class="fi qty" value="<?= esc($item['qty'] ?? 1) ?>"
                  min="0.5" step="0.5">
              </td>
              <td>
                <input type="number" name="items[<?= $i ?>][unit_price]" class="fi unit-price"
                  value="<?= esc($item['unit_price'] ?? 0) ?>" min="0" step="0.01">
              </td>
              <td>
                <input type="text" name="items[<?= $i ?>][total]" class="fi row-total"
                  style="background:var(--subtle);color:var(--muted);"
                  value="<?= number_format(($item['qty'] ?? 1) * ($item['unit_price'] ?? 0), 2) ?>" readonly>
              </td>
              <td>
                <input type="number" name="items[<?= $i ?>][tax_percent]" class="fi"
                  value="<?= esc($item['tax_percent'] ?? 0) ?>" min="0" max="100" step="0.01">
              </td>
              <td style="text-align:center;">
                <button type="button" onclick="removeRow(this)" style="width:28px;height:28px;border-radius:7px;border:1px solid var(--border);
                               background:transparent;color:var(--muted);cursor:pointer;display:inline-flex;
                               align-items:center;justify-content:center;transition:background .12s;"
                  onmouseover="this.style.background='#fef2f2';this.style.color='#dc2626';"
                  onmouseout="this.style.background='transparent';this.style.color='var(--muted)';">
                  <i class="bi bi-trash" style="font-size:12px;"></i>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div style="margin-top:10px;">
      <button type="button" onclick="addRow()" class="act-btn act-btn-sm">
        <i class="bi bi-plus"></i>Add Item
      </button>
    </div>
  </div>

  <!-- ── SECTION 4: Totals + Payment ─────────────────────────────── -->
  <div class="form-card">
    <div class="form-section"><i class="bi bi-calculator"></i>Totals &amp; Payment</div>

    <div style="display:grid;grid-template-columns:1fr 320px;gap:20px;align-items:start;">

      <!-- Left: payment mode + notes -->
      <div>
        <div style="margin-bottom:14px;">
          <label class="fl">Payment Mode</label>
          <select name="payment_mode" class="fi" style="max-width:220px;">
            <?php foreach (['cash' => 'Cash', 'online' => 'Online / UPI', 'bank' => 'Bank Transfer', 'card' => 'Card', 'cheque' => 'Cheque'] as $v => $l): ?>
              <option value="<?= $v ?>" <?= old('payment_mode', $invoice['payment_mode'] ?? 'cash') === $v ? 'selected' : '' ?>>
                <?= $l ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div>
          <label class="fl">Notes / Terms</label>
          <textarea name="notes" class="fi" rows="3"
            placeholder="Payment terms, bank details, special instructions…"><?= old('notes', $invoice['notes'] ?? '') ?></textarea>
        </div>
      </div>

      <!-- Right: totals panel -->
      <div class="totals-panel">
        <div class="tot-row">
          <span class="tot-label">Subtotal</span>
          <span class="tot-val" id="subtotal">₹0.00</span>
        </div>
        <div class="tot-input-row">
          <label class="tot-label">Discount (₹)</label>
          <input type="number" name="discount" id="discountInput" class="tot-input"
            value="<?= old('discount', $invoice['discount'] ?? 0) ?>" min="0" step="0.01">
        </div>
        <div class="tot-row" id="discountRow" style="display:none;">
          <span class="tot-label">After Discount</span>
          <span class="tot-val" id="discountDisplay" style="color:#dc2626;"></span>
        </div>
        <div class="tot-input-row">
          <label class="tot-label">Tax (%)</label>
          <input type="number" name="tax_percent" id="taxInput" class="tot-input"
            value="<?= old('tax_percent', $invoice['tax_percent'] ?? 0) ?>" min="0" max="100" step="0.01">
        </div>
        <div class="tot-row" id="taxRow" style="display:none;">
          <span class="tot-label">Tax Amount</span>
          <span class="tot-val" id="taxDisplay" style="color:#16a34a;"></span>
        </div>
        <div class="tot-row-grand">
          <span>Grand Total</span>
          <span id="grandTotal">₹0.00</span>
        </div>
        <div class="tot-input-row" style="background:var(--surf);">
          <label class="tot-label" style="color:#16a34a;font-weight:600;">Amount Paid</label>
          <input type="number" name="paid_amount" id="paidInput" class="tot-input" style="border-color:#d1fae5;"
            value="<?= old('paid_amount', $invoice['paid_amount'] ?? 0) ?>" min="0" step="0.01">
        </div>
        <div class="tot-row" style="background:#fef2f2;">
          <span class="tot-label" style="color:#dc2626;font-weight:600;">Balance Due</span>
          <span class="tot-val" id="paidDisplay" style="color:#dc2626;">₹0.00</span>
        </div>
      </div>
    </div>
  </div>

  <!-- ── SECTION 5: Medicines ─────────────────────────────────────── -->
  <div class="med-card" style="margin-bottom:14px;">
    <div class="med-card-hdr">
      <div class="med-card-title">
        <i class="bi bi-capsule"></i>
        Medicine &amp; Consumable Detail
        <span class="med-badge">Page 2 of print</span>
      </div>
      <span style="font-size:12px;color:#92400e;">Detailed breakdown on the 2nd page of the printed invoice</span>
    </div>

    <div style="overflow:visible;overflow-x:auto;">
      <table class="inv-tbl" id="medTable" style="border-radius:0;">
        <thead>
          <tr>
            <th style="width:90px;">Date</th>
            <th style="min-width:180px;">Medicine / Item</th>
            <th style="width:80px;">Batch No</th>
            <th style="width:70px;">Expiry</th>
            <th style="width:55px;">Qty</th>
            <th style="width:55px;">Unit</th>
            <th style="width:90px;">Rate (₹)</th>
            <th style="width:90px;">Total (₹)</th>
            <th style="width:110px;">Prescribed By</th>
            <th style="width:36px;"></th>
          </tr>
        </thead>
        <tbody id="medBody">
          <?php
          $medicines = old('medicines', $invoice['medicines'] ?? []);
          if (empty($medicines))
            $medicines = [[]];
          ?>
          <?php foreach ($medicines as $mi => $med): ?>
            <tr class="med-row">
              <td><input type="date" name="medicines[<?= $mi ?>][date]" class="fi"
                  value="<?= esc($med['date'] ?? date('Y-m-d')) ?>"></td>
              <td><input type="text" name="medicines[<?= $mi ?>][medicine_name]" class="fi med-name"
                  value="<?= esc($med['medicine_name'] ?? '') ?>" placeholder="Medicine name" autocomplete="off"></td>
              <td><input type="text" name="medicines[<?= $mi ?>][batch_no]" class="fi"
                  value="<?= esc($med['batch_no'] ?? '') ?>" placeholder="Batch"></td>
              <td><input type="text" name="medicines[<?= $mi ?>][expiry]" class="fi"
                  value="<?= esc($med['expiry'] ?? '') ?>" placeholder="MM/YY"></td>
              <td><input type="number" name="medicines[<?= $mi ?>][qty]" class="fi med-qty"
                  value="<?= esc($med['qty'] ?? 1) ?>" min="0.5" step="0.5" oninput="recalcMed(this)"></td>
              <td><input type="text" name="medicines[<?= $mi ?>][unit]" class="fi"
                  value="<?= esc($med['unit'] ?? 'Nos') ?>"></td>
              <td><input type="number" name="medicines[<?= $mi ?>][unit_price]" class="fi med-price"
                  value="<?= esc($med['unit_price'] ?? 0) ?>" min="0" step="0.01" oninput="recalcMed(this)"></td>
              <td><input type="text" name="medicines[<?= $mi ?>][total]" class="fi med-total"
                  value="<?= number_format(($med['qty'] ?? 1) * ($med['unit_price'] ?? 0), 2) ?>" readonly
                  style="background:var(--subtle);color:var(--muted);"></td>
              <td><input type="text" name="medicines[<?= $mi ?>][prescribed_by]" class="fi"
                  value="<?= esc($med['prescribed_by'] ?? '') ?>" placeholder="Dr. name"></td>
              <td style="text-align:center;">
                <button type="button" onclick="removeMedRow(this)" style="width:28px;height:28px;border-radius:7px;border:1px solid var(--border);
                               background:transparent;color:var(--muted);cursor:pointer;display:inline-flex;
                               align-items:center;justify-content:center;"
                  onmouseover="this.style.background='#fef2f2';this.style.color='#dc2626';"
                  onmouseout="this.style.background='transparent';this.style.color='var(--muted)';">
                  <i class="bi bi-trash" style="font-size:12px;"></i>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr style="background:var(--subtle);">
            <td colspan="7"
              style="text-align:right;padding:9px 10px;font-size:12px;font-weight:600;color:var(--muted);">
              Medicine Total:
            </td>
            <td style="padding:9px 10px;">
              <span id="medTotal"
                style="font-weight:700;color:var(--indigo);font-family:'DM Mono',monospace;">₹0.00</span>
            </td>
            <td colspan="2"></td>
          </tr>
        </tfoot>
      </table>
    </div>

    <div style="padding:10px 14px;border-top:1px solid #fde68a;display:flex;align-items:center;gap:12px;">
      <button type="button" onclick="addMedRow()" class="act-btn act-btn-sm"
        style="border-color:#fde68a;color:#92400e;background:#fffbeb;">
        <i class="bi bi-plus"></i>Add Medicine Row
      </button>
      <span style="font-size:12px;color:#b45309;">
        <i class="bi bi-info-circle me-1"></i>
        Total carried to invoice summary as "Medicines &amp; Consumables"
      </span>
    </div>
  </div>

  <!-- Hidden fields + submit -->
  <input type="hidden" name="subtotal" id="h_subtotal">
  <input type="hidden" name="tax_amount" id="h_tax">
  <input type="hidden" name="total_amount" id="h_total">

  <div style="display:flex;gap:10px;justify-content:flex-end;padding-top:4px;">
    <a href="<?= base_url('invoice') ?>" class="act-btn">Cancel</a>
    <button type="submit" class="act-btn act-btn-primary">
      <i class="bi bi-check-lg"></i><?= $editing ? 'Update Invoice' : 'Save Invoice' ?>
    </button>
  </div>

</form>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>

<!-- Portal dropdown — appended to body, always above everything -->
<div id="portalDropdown"></div>

<style>
  #portalDropdown {
    position: fixed;
    /* fixed = relative to viewport, unaffected by any scroll */
    z-index: 99999;
    background: #ffffff;
    border: 1px solid #e2e5ef;
    border-radius: 10px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, .16), 0 2px 8px rgba(0, 0, 0, .08);
    max-height: 260px;
    overflow-y: auto;
    min-width: 280px;
    display: none;
    font-family: 'DM Sans', sans-serif;
  }

  #portalDropdown .pd-cat {
    padding: 5px 12px 4px;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .8px;
    color: #94a3b8;
    background: #f8faff;
    border-bottom: 1px solid #e2e5ef;
    position: sticky;
    top: 0;
  }

  #portalDropdown .pd-opt {
    padding: 9px 12px;
    cursor: pointer;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    transition: background .1s;
  }

  #portalDropdown .pd-opt:last-child {
    border-bottom: none;
  }

  #portalDropdown .pd-opt:hover,
  #portalDropdown .pd-opt.ac {
    background: #f0f4ff;
  }

  #portalDropdown .pd-name {
    font-size: 13.5px;
    font-weight: 500;
    color: #0f172a;
  }

  #portalDropdown .pd-sub {
    font-size: 11px;
    color: #94a3b8;
    margin-top: 1px;
  }

  #portalDropdown .pd-price {
    font-size: 13px;
    font-weight: 700;
    color: #3b4fd8;
    white-space: nowrap;
    flex-shrink: 0;
  }

  #portalDropdown .pd-empty {
    padding: 14px 14px;
    font-size: 13px;
    color: #94a3b8;
    text-align: center;
  }
</style>

<script>
  const PRODUCT_SEARCH_URL = '<?= base_url('invoice/productSearch') ?>';
  const MEDICINE_SEARCH_URL = '<?= base_url('invoice/medicineSearch') ?>';

  // ── Portal ────────────────────────────────────────────────────────────
  const portal = document.getElementById('portalDropdown');
  let activeInput = null, pickCb = null, srchTimer = null;

  function posPortal(inp) {
    // getBoundingClientRect() is always relative to viewport (fixed coords)
    // so for position:fixed this is exactly what we need — no scroll offset needed
    const r = inp.getBoundingClientRect();
    const vw = window.innerWidth;
    const vh = window.innerHeight;
    const pw = Math.max(r.width, 280);
    const ph = Math.min(260, portal.scrollHeight || 260);

    // Horizontal: align to input left, but don't overflow viewport right edge
    let left = r.left;
    if (left + pw > vw - 8) left = vw - pw - 8;
    if (left < 8) left = 8;

    // Vertical: prefer below, fall back to above if not enough space
    const spaceBelow = vh - r.bottom - 6;
    const spaceAbove = r.top - 6;

    portal.style.width = pw + 'px';
    portal.style.left = left + 'px';

    if (spaceBelow >= 120 || spaceBelow >= spaceAbove) {
      // below the input
      portal.style.top = (r.bottom + 4) + 'px';
      portal.style.bottom = 'auto';
      portal.style.maxHeight = Math.max(spaceBelow, 120) + 'px';
    } else {
      // above the input
      portal.style.top = 'auto';
      portal.style.bottom = (vh - r.top + 4) + 'px';
      portal.style.maxHeight = Math.max(spaceAbove, 120) + 'px';
    }
  }

  function showPortal(inp, results, cb) {
    pickCb = cb; activeInput = inp;
    if (!results || !results.length) {
      portal.innerHTML = '<div class="pd-empty">No results found</div>';
      portal.style.display = 'block';
      posPortal(inp);
      return;
    }

    let html = '', lastCat = '';
    results.forEach(p => {
      if (p.category !== lastCat) {
        html += `<div class="pd-cat">${esc(p.category)}</div>`;
        lastCat = p.category;
      }
      html += `<div class="pd-opt"
                  data-id="${p.id}" data-name="${esc(p.name)}"
                  data-price="${p.unit_price}" data-unit="${esc(p.unit || 'Nos')}" data-tax="${p.tax_percent}">
               <div>
                 <div class="pd-name">${esc(p.name)}</div>
                 <div class="pd-sub">${esc(p.code || '')}${p.unit ? ' · ' + esc(p.unit) : ''}</div>
               </div>
               <div class="pd-price">₹${parseFloat(p.unit_price).toFixed(2)}</div>
             </div>`;
    });
    portal.innerHTML = html;
    portal.style.display = 'block';
    posPortal(inp);

    portal.querySelectorAll('.pd-opt').forEach(opt => {
      opt.addEventListener('mousedown', e => {
        e.preventDefault();
        pickCb && pickCb({
          id: opt.dataset.id, name: opt.dataset.name,
          price: opt.dataset.price, unit: opt.dataset.unit, tax: opt.dataset.tax,
        });
        hidePortal();
      });
    });
  }

  function hidePortal() {
    portal.style.display = 'none';
    portal.innerHTML = '';
    activeInput = null;
  }

  // Reposition on any scroll (capture phase catches inner scrollable divs too)
  window.addEventListener('scroll', () => activeInput && posPortal(activeInput), true);
  window.addEventListener('resize', () => activeInput && posPortal(activeInput));

  // Close on outside click/focus
  document.addEventListener('mousedown', e => {
    if (!portal.contains(e.target) && e.target !== activeInput) hidePortal();
  });

  function esc(s) {
    return String(s || '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
  }

  // ── Arrow / Enter / Escape ────────────────────────────────────────────
  function portalKeys(e) {
    if (portal.style.display === 'none') return;
    const opts = [...portal.querySelectorAll('.pd-opt')];
    const cur = portal.querySelector('.pd-opt.ac');
    const idx = opts.indexOf(cur);

    if (e.key === 'ArrowDown') {
      e.preventDefault();
      cur?.classList.remove('ac');
      const next = opts[idx + 1] ?? opts[0];
      next?.classList.add('ac'); next?.scrollIntoView({ block: 'nearest' });
    } else if (e.key === 'ArrowUp') {
      e.preventDefault();
      cur?.classList.remove('ac');
      const prev = opts[idx - 1] ?? opts[opts.length - 1];
      prev?.classList.add('ac'); prev?.scrollIntoView({ block: 'nearest' });
    } else if (e.key === 'Enter') {
      e.preventDefault();
      cur?.dispatchEvent(new MouseEvent('mousedown', { bubbles: true }));
    } else if (e.key === 'Escape') {
      hidePortal();
    }
  }

  // ── Generic autocomplete init ─────────────────────────────────────────
  function initAC(input, url, cb) {
    let lastQ = '';
    input.addEventListener('input', function () {
      const q = this.value.trim();
      if (q === lastQ) return;
      lastQ = q;
      clearTimeout(srchTimer);
      if (q.length < 1) { hidePortal(); return; }
      srchTimer = setTimeout(() => {
        fetch(url + '?q=' + encodeURIComponent(q))
          .then(r => r.json())
          .then(res => showPortal(input, res, cb))
          .catch(() => hidePortal());
      }, 180);
    });
    input.addEventListener('keydown', portalKeys);
    input.addEventListener('focus', function () {
      if (this.value.trim().length >= 1) this.dispatchEvent(new Event('input'));
    });
  }

  // ── Items ─────────────────────────────────────────────────────────────
  let rowIndex = <?= count($items ?? [['']]) ?>;

  function initItemRow(row) {
    const d = row.querySelector('.item-desc');
    initAC(d, PRODUCT_SEARCH_URL, p => {
      d.value = p.name;
      row.querySelector('.item-product-id').value = p.id;
      row.querySelector('.unit-price').value = parseFloat(p.price).toFixed(2);
      const t = row.querySelector('input[name*="tax_percent"]'); if (t) t.value = p.tax;
      recalc();
      setTimeout(() => row.querySelector('.qty')?.select(), 50);
    });
  }

  function addRow() {
    const tbody = document.getElementById('itemsBody');
    const tr = document.createElement('tr'); tr.className = 'item-row';
    tr.innerHTML = `
    <td>
      <input type="text" name="items[${rowIndex}][description]" class="fi item-desc"
             placeholder="Type to search services…" autocomplete="off" required>
      <input type="hidden" name="items[${rowIndex}][product_id]" class="item-product-id" value="">
    </td>
    <td><input type="number" name="items[${rowIndex}][qty]" class="fi qty" value="1" min="0.5" step="0.5"></td>
    <td><input type="number" name="items[${rowIndex}][unit_price]" class="fi unit-price" value="0" min="0" step="0.01"></td>
    <td><input type="text" name="items[${rowIndex}][total]" class="fi row-total" value="0.00" readonly style="background:var(--subtle);color:var(--muted);"></td>
    <td><input type="number" name="items[${rowIndex}][tax_percent]" class="fi" value="0" min="0" max="100" step="0.01"></td>
    <td style="text-align:center;">
      <button type="button" onclick="removeRow(this)" class="del-btn">
        <i class="bi bi-trash" style="font-size:12px;"></i>
      </button>
    </td>`;
    tbody.appendChild(tr);
    rowIndex++;
    initItemRow(tr);
    bindCalc(tr);
    recalc();
    tr.querySelector('.item-desc').focus();
  }

  function removeRow(btn) {
    if (document.querySelectorAll('.item-row').length <= 1) return;
    btn.closest('tr').remove();
    recalc();
  }

  function bindCalc(row) {
    row.querySelectorAll('.qty, .unit-price').forEach(i => i.addEventListener('input', recalc));
  }

  function recalc() {
    let sub = 0;
    document.querySelectorAll('.item-row').forEach(row => {
      const qty = parseFloat(row.querySelector('.qty')?.value) || 0;
      const up = parseFloat(row.querySelector('.unit-price')?.value) || 0;
      const tot = qty * up;
      row.querySelector('.row-total').value = tot.toFixed(2);
      sub += tot;
    });
    const disc = parseFloat(document.getElementById('discountInput').value) || 0;
    const taxP = parseFloat(document.getElementById('taxInput').value) || 0;
    const after = sub - disc;
    const tax = after * taxP / 100;
    const total = after + tax;
    const paid = parseFloat(document.getElementById('paidInput').value) || 0;

    document.getElementById('subtotal').textContent = '₹' + sub.toFixed(2);

    const dr = document.getElementById('discountRow');
    if (disc > 0) { document.getElementById('discountDisplay').textContent = '-₹' + disc.toFixed(2); dr.style.display = 'flex'; }
    else dr.style.display = 'none';

    const tr2 = document.getElementById('taxRow');
    if (taxP > 0) { document.getElementById('taxDisplay').textContent = '+₹' + tax.toFixed(2); tr2.style.display = 'flex'; }
    else tr2.style.display = 'none';

    document.getElementById('grandTotal').textContent = '₹' + total.toFixed(2);
    document.getElementById('paidDisplay').textContent = '₹' + (Math.max(0, total - paid)).toFixed(2);
    document.getElementById('h_subtotal').value = sub.toFixed(2);
    document.getElementById('h_tax').value = tax.toFixed(2);
    document.getElementById('h_total').value = total.toFixed(2);
  }

  // ── Medicines ─────────────────────────────────────────────────────────
  let medIndex = <?= count($medicines ?? [[]]) ?>;

  function initMedRow(row) {
    const n = row.querySelector('.med-name');
    initAC(n, MEDICINE_SEARCH_URL, p => {
      n.value = p.name;
      row.querySelector('.med-price').value = parseFloat(p.price).toFixed(2);
      const u = row.querySelector('input[name*="[unit]"]');
      if (u && p.unit) u.value = p.unit;
      recalcMed(row.querySelector('.med-price'));
      setTimeout(() => row.querySelector('.med-qty')?.select(), 50);
    });
  }

  function addMedRow() {
    const tbody = document.getElementById('medBody');
    const tr = document.createElement('tr'); tr.className = 'med-row';
    tr.innerHTML = `
    <td><input type="date"   name="medicines[${medIndex}][date]"          class="fi" value="<?= date('Y-m-d') ?>"></td>
    <td><input type="text"   name="medicines[${medIndex}][medicine_name]" class="fi med-name" placeholder="Medicine name" autocomplete="off"></td>
    <td><input type="text"   name="medicines[${medIndex}][batch_no]"      class="fi" placeholder="Batch"></td>
    <td><input type="text"   name="medicines[${medIndex}][expiry]"        class="fi" placeholder="MM/YY"></td>
    <td><input type="number" name="medicines[${medIndex}][qty]"           class="fi med-qty" value="1" min="0.5" step="0.5" oninput="recalcMed(this)"></td>
    <td><input type="text"   name="medicines[${medIndex}][unit]"          class="fi" value="Nos"></td>
    <td><input type="number" name="medicines[${medIndex}][unit_price]"    class="fi med-price" value="0" min="0" step="0.01" oninput="recalcMed(this)"></td>
    <td><input type="text"   name="medicines[${medIndex}][total]"         class="fi med-total" value="0.00" readonly style="background:var(--subtle);color:var(--muted);"></td>
    <td><input type="text"   name="medicines[${medIndex}][prescribed_by]" class="fi" placeholder="Dr. name"></td>
    <td style="text-align:center;">
      <button type="button" onclick="removeMedRow(this)" class="del-btn">
        <i class="bi bi-trash" style="font-size:12px;"></i>
      </button>
    </td>`;
    tbody.appendChild(tr);
    medIndex++;
    initMedRow(tr);
    updateMedTotal();
    tr.querySelector('.med-name').focus();
  }

  function removeMedRow(btn) { btn.closest('tr').remove(); updateMedTotal(); }

  function recalcMed(inp) {
    const row = inp.closest ? inp.closest('tr') : inp;
    const qty = parseFloat(row.querySelector('.med-qty')?.value) || 0;
    const price = parseFloat(row.querySelector('.med-price')?.value) || 0;
    row.querySelector('.med-total').value = (qty * price).toFixed(2);
    updateMedTotal();
  }

  function updateMedTotal() {
    let t = 0;
    document.querySelectorAll('.med-total').forEach(i => { t += parseFloat(i.value) || 0; });
    const el = document.getElementById('medTotal');
    if (el) el.textContent = '₹' + t.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  }

  // ── Sex radio highlight ───────────────────────────────────────────────
  function highlightSex() {
    document.querySelectorAll('.sex-label').forEach(label => {
      const inp = label.querySelector('input[type="radio"]');
      label.style.borderColor = inp.checked ? 'var(--indigo)' : 'var(--border)';
      label.style.background = inp.checked ? 'rgba(59,79,216,.08)' : 'var(--surf)';
      label.style.color = inp.checked ? 'var(--indigo)' : 'var(--text)';
      label.style.fontWeight = inp.checked ? '600' : '500';
    });
  }
  highlightSex(); // init on load for edit mode

  // ── Stay duration ─────────────────────────────────────────────────────
  function calcStay() {
    const adm = document.querySelector('input[name="admission_date"]')?.value;
    const dis = document.getElementById('dischargeInput')?.value;
    const el = document.getElementById('stayDuration');
    if (!adm || !dis || !el) { el && (el.style.display = 'none'); return; }
    const diff = (new Date(dis) - new Date(adm)) / 3600000;
    if (diff <= 0) { el.style.display = 'none'; return; }
    const days = Math.floor(diff / 24), hours = Math.round(diff % 24);
    el.querySelector('span').textContent = days > 0
      ? `${days} day${days > 1 ? 's' : ''} ${hours > 0 ? hours + 'h' : ''} stay`
      : `${hours}h stay`;
    el.style.display = 'inline-flex';
  }
  document.querySelector('input[name="admission_date"]')?.addEventListener('change', calcStay);
  document.getElementById('dischargeInput')?.addEventListener('change', calcStay);
  calcStay();

  // ── Init on load ──────────────────────────────────────────────────────
  document.querySelectorAll('.item-row').forEach(row => { initItemRow(row); bindCalc(row); });
  document.querySelectorAll('.med-row').forEach(row => {
    initMedRow(row);
    const qty = parseFloat(row.querySelector('.med-qty')?.value) || 0;
    const price = parseFloat(row.querySelector('.med-price')?.value) || 0;
    if (row.querySelector('.med-total')) row.querySelector('.med-total').value = (qty * price).toFixed(2);
  });
  document.getElementById('discountInput')?.addEventListener('input', recalc);
  document.getElementById('taxInput')?.addEventListener('input', recalc);
  document.getElementById('paidInput')?.addEventListener('input', recalc);
  recalc();
  updateMedTotal();
</script>
<?= $this->endSection() ?>