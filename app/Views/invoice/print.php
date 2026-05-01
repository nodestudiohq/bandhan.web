<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Invoice <?= esc($invoice['invoice_no']) ?> — Bandhan Hospital</title>
  <style>
    /* ── Reset & base ─────────────────────────────────────── */
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      font-size: 13px;
      color: #1a1a2e;
      background: #f0f2f5;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }

    /* ── Screen wrapper ───────────────────────────────────── */
    .page-wrapper {
      max-width: 794px;
      /* A4 width at 96dpi */
      min-height: 1123px;
      /* A4 height at 96dpi */
      margin: 24px auto;
      background: #fff;
      box-shadow: 0 4px 32px rgba(0, 0, 0, .15);
      display: flex;
      flex-direction: column;
    }

    /* ── Print: A4 exact ──────────────────────────────────── */
    @page {
      size: A4 portrait;
      margin: 0;
    }

    @media print {
      * {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        color-adjust: exact !important;
      }

      html {
        margin: 0;
        padding: 0;
      }

      body {
        background: #ffffff !important;
        margin: 0;
        padding: 0;
      }

      .page-wrapper {
        margin: 0 !important;
        box-shadow: none !important;
        width: 210mm !important;
        max-width: 210mm !important;
        height: 297mm !important;
        min-height: 297mm !important;
      }

      .no-print {
        display: none !important;
      }

      .inv-header {
        background: #0d2a6e !important;
      }

      .inv-header-bar {
        background: linear-gradient(90deg, #f5c300 70%, #e65100 100%) !important;
      }

      .inv-footer {
        background: #f0f5ff !important;
      }

      .inv-footer-bar {
        background: linear-gradient(90deg, #0d2a6e 70%, #f5c300 85%, #e65100 100%) !important;
      }

      .items-table thead tr {
        background: #0d2a6e !important;
      }

      .t-grand {
        background: #0d2a6e !important;
      }

      .t-balance td {
        background: #f0f5ff !important;
      }

      .status-paid {
        background: #16a34a !important;
        color: #fff !important;
      }

      .status-unpaid {
        background: #dc2626 !important;
        color: #fff !important;
      }

      .status-partial {
        background: #f5c300 !important;
        color: #1a1a2e !important;
      }

      .page2 {
        break-before: page !important;
        -webkit-break-before: page !important;
        page-break-before: always !important;
        margin: 0 !important;
        box-shadow: none !important;
        width: 210mm !important;
        max-width: 210mm !important;
        height: 297mm !important;
        min-height: 297mm !important;
      }
    }

    /* ── Colours ──────────────────────────────────────────── */
    :root {
      --navy: #0d2a6e;
      --blue: #1565c0;
      --gold: #f5c300;
      --orange: #e65100;
      --light: #f0f5ff;
      --muted: #6b7280;
      --line: #e5e7eb;
    }

    /* ── HEADER ───────────────────────────────────────────── */
    .inv-header {
      background: #0d2a6e;
      padding: 0;
      position: relative;
      overflow: hidden;
    }

    .inv-header-inner {
      display: flex;
      justify-content: space-between;
      align-items: stretch;
      position: relative;
      z-index: 2;
    }

    /* Diagonal accent */
    .inv-header::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(135deg,
          rgba(255, 255, 255, .04) 0%,
          transparent 60%);
      z-index: 1;
    }

    /* Hospital name block */
    .hsp-name {
      padding: 20px 28px;
      flex: 1;
    }

    .hsp-name h1 {
      font-size: 22px;
      font-weight: 900;
      color: #f5c300;
      letter-spacing: 1.5px;
      line-height: 1;
    }

    .hsp-name h1 span {
      color: #fff;
    }

    .hsp-name .hsp-sub {
      font-size: 10.5px;
      color: #8eb8e8;
      margin-top: 5px;
      line-height: 1.6;
    }

    .hsp-name .hsp-phone {
      font-size: 11px;
      color: #f5c300;
      font-weight: 700;
      margin-top: 5px;
    }

    /* Invoice meta block (right side of header) */
    .inv-meta-block {
      background: rgba(255, 255, 255, .07);
      border-left: 1px solid rgba(255, 255, 255, .1);
      padding: 20px 28px;
      min-width: 200px;
      text-align: right;
    }

    .inv-meta-block .inv-label {
      font-size: 9px;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      color: #8eb8e8;
      font-weight: 700;
    }

    .inv-meta-block .inv-number {
      font-size: 20px;
      font-weight: 900;
      color: #fff;
      letter-spacing: 1px;
      line-height: 1.1;
    }

    .inv-meta-block .inv-date {
      font-size: 11px;
      color: #8eb8e8;
      margin-top: 3px;
    }

    /* Status pill */
    .status-pill {
      display: inline-block;
      margin-top: 10px;
      padding: 3px 14px;
      border-radius: 20px;
      font-size: 10px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .status-paid {
      background: #16a34a;
      color: #fff;
    }

    .status-unpaid {
      background: #dc2626;
      color: #fff;
    }

    .status-partial {
      background: #f5c300;
      color: #1a1a2e;
    }

    /* Gold bottom bar of header */
    .inv-header-bar {
      height: 4px;
      background: linear-gradient(90deg, #f5c300 70%, #e65100 100%);
    }

    /* ── BODY ─────────────────────────────────────────────── */
    .inv-body {
      padding: 28px 28px 20px;
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    /* ── Bill-to / Invoice-info row ───────────────────────── */
    .inv-parties {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      margin-bottom: 24px;
      padding-bottom: 20px;
      border-bottom: 1.5px solid #e5e7eb;
    }

    .party-box {}

    .party-box .party-label {
      font-size: 9px;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      color: #6b7280;
      font-weight: 700;
      margin-bottom: 6px;
      padding-bottom: 4px;
      border-bottom: 2px solid #1565c0;
      display: inline-block;
    }

    .party-box .party-name {
      font-size: 15px;
      font-weight: 700;
      color: #0d2a6e;
      line-height: 1.3;
    }

    .party-box .party-detail {
      font-size: 11.5px;
      color: #6b7280;
      margin-top: 3px;
      line-height: 1.6;
    }

    .inv-info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 8px 16px;
    }

    .info-row {
      display: flex;
      justify-content: space-between;
      font-size: 12px;
    }

    .info-row .ilabel {
      color: #6b7280;
    }

    .info-row .ival {
      font-weight: 600;
      color: #0d2a6e;
      text-align: right;
    }

    /* ── Items table ──────────────────────────────────────── */
    .items-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
      font-size: 12.5px;
    }

    .items-table thead tr {
      background: #0d2a6e;
      color: #fff;
    }

    .items-table thead th {
      padding: 9px 11px;
      font-weight: 700;
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: .6px;
    }

    .items-table thead th:first-child {
      border-radius: 0;
    }

    .items-table tbody tr {
      border-bottom: 1px solid #e5e7eb;
    }

    .items-table tbody tr:nth-child(even) {
      background: #f9fafb;
    }

    .items-table tbody tr:last-child {
      border-bottom: 2px solid #0d2a6e;
    }

    .items-table td {
      padding: 9px 11px;
      vertical-align: top;
    }

    .items-table .item-num {
      width: 32px;
      color: #6b7280;
      font-size: 11px;
    }

    .items-table .item-desc {
      font-weight: 500;
    }

    .items-table .item-cat {
      font-size: 10px;
      color: #1565c0;
      font-weight: 600;
      margin-top: 2px;
    }

    .items-table .text-right {
      text-align: right;
    }

    .items-table .text-center {
      text-align: center;
    }

    .items-table tfoot tr {
      background: #f0f5ff;
    }

    .items-table tfoot td {
      padding: 6px 11px;
      font-size: 12px;
    }

    /* ── Totals + Summary ─────────────────────────────────── */
    .inv-bottom {
      display: grid;
      grid-template-columns: 1fr auto;
      gap: 20px;
      align-items: start;
      margin-top: 4px;
    }

    /* Payment summary box */
    .totals-box {
      min-width: 240px;
      border: 1.5px solid #e5e7eb;
      border-radius: 6px;
      overflow: hidden;
    }

    .totals-box table {
      width: 100%;
      border-collapse: collapse;
    }

    .totals-box td {
      padding: 7px 14px;
      font-size: 12.5px;
    }

    .totals-box tr {
      border-bottom: 1px solid #e5e7eb;
    }

    .totals-box tr:last-child {
      border-bottom: none;
    }

    .totals-box .t-label {
      color: #6b7280;
    }

    .totals-box .t-val {
      text-align: right;
      font-weight: 600;
    }

    .totals-box .t-grand {
      background: #0d2a6e;
    }

    .totals-box .t-grand td {
      color: #fff;
      font-weight: 800;
      font-size: 14px;
      padding: 10px 14px;
    }

    .totals-box .t-balance td {
      background: #f0f5ff;
    }

    .totals-box .t-balance .t-val {
      color: #0d2a6e;
      font-size: 14px;
      font-weight: 900;
    }

    /* Notes / terms */
    .notes-box {
      flex: 1;
      font-size: 11.5px;
      color: #6b7280;
      line-height: 1.7;
    }

    .notes-box .notes-title {
      font-size: 9px;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      font-weight: 700;
      color: #0d2a6e;
      margin-bottom: 6px;
    }

    /* ── Signature row ────────────────────────────────────── */
    .sig-row {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 16px;
      padding-top: 24px;
      padding-bottom: 8px;
    }

    .sig-box {
      text-align: center;
    }

    .sig-line {
      border-top: 1.5px solid #c9d4e8;
      padding-top: 6px;
      font-size: 10.5px;
      color: #6b7280;
      font-weight: 600;
    }

    /* ── Footer ───────────────────────────────────────────── */
    .inv-footer {
      margin-top: 28px;
      padding: 12px 28px;
      background: #f0f5ff;
      border-top: 1.5px solid #e5e7eb;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 10.5px;
      color: #6b7280;
    }

    .inv-footer strong {
      color: #0d2a6e;
    }

    .inv-footer-bar {
      height: 5px;
      background: linear-gradient(90deg, #0d2a6e 70%, #f5c300 85%, #e65100 100%);
    }

    /* ── Print button (screen only) ───────────────────────── */
    .print-bar {
      background: #1e293b;
      padding: 10px 20px;
      display: flex;
      gap: 10px;
      align-items: center;
      justify-content: center;
    }

    .print-bar button,
    .print-bar a {
      padding: 8px 20px;
      border: none;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .btn-print {
      background: #1565c0;
      color: #fff;
    }

    .btn-back {
      background: #334155;
      color: #94a3b8;
    }

    .btn-print:hover {
      background: #0d2a6e;
    }

    /* ── Number to words helper ───────────────────────────── */
    .amount-words {
      font-size: 11px;
      color: #0d2a6e;
      font-style: italic;
      margin-top: 8px;
    }
  </style>
</head>

<body>

  <?php
  $balance = $invoice['total_amount'] - $invoice['paid_amount'];
  $statusCls = [
    'paid' => 'status-paid',
    'unpaid' => 'status-unpaid',
    'partial' => 'status-partial',
  ][$invoice['status']] ?? 'status-unpaid';

  // Simple number-to-words for Indian amounts
  function numToWords(float $num): string
  {
    $num = (int) round($num);
    $ones = [
      '',
      'One',
      'Two',
      'Three',
      'Four',
      'Five',
      'Six',
      'Seven',
      'Eight',
      'Nine',
      'Ten',
      'Eleven',
      'Twelve',
      'Thirteen',
      'Fourteen',
      'Fifteen',
      'Sixteen',
      'Seventeen',
      'Eighteen',
      'Nineteen'
    ];
    $tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
    if ($num === 0)
      return 'Zero';
    $words = '';
    if ($num >= 10000000) {
      $words .= numToWords($num / 10000000) . ' Crore ';
      $num %= 10000000;
    }
    if ($num >= 100000) {
      $words .= numToWords($num / 100000) . ' Lakh ';
      $num %= 100000;
    }
    if ($num >= 1000) {
      $words .= numToWords($num / 1000) . ' Thousand ';
      $num %= 1000;
    }
    if ($num >= 100) {
      $words .= $ones[(int) ($num / 100)] . ' Hundred ';
      $num %= 100;
    }
    if ($num >= 20) {
      $words .= $tens[(int) ($num / 10)] . ' ';
      $num %= 10;
    }
    if ($num > 0) {
      $words .= $ones[$num] . ' ';
    }
    return trim($words);
  }
  $amountWords = numToWords($invoice['total_amount']) . ' Rupees Only';
  ?>

  <!-- Print bar (screen only) -->
  <div class="print-bar no-print">
    <a href="javascript:history.back()" class="btn-back">← Back</a>
    <button onclick="window.print()" class="btn-print">🖨 Print / Save PDF</button>
  </div>

  <!-- A4 Page -->
  <div class="page-wrapper">

    <!-- ── HEADER ───────────────────────────────────────────── -->
    <div class="inv-header">
      <div class="inv-header-inner">

        <!-- Hospital identity -->
        <div class="hsp-name">
          <h1>BANDHAN <span>HOSPITAL</span></h1>
          <div class="hsp-sub">
            30/1 P.L.K. Maitra Road, Krishnagar, Nadia – 741101, West Bengal<br>
            ✉ bandhanhospital@gmail.com &nbsp;·&nbsp; 🌐 www.bandhanhospital.com
          </div>
          <div class="hsp-phone">8172007073 / 7318770083</div>
          <div style="font-size:9.5px;color:#8eb8e8;margin-top:5px;line-height:1.8;letter-spacing:.2px;">
            PAN: <strong style="color:#b8cef0;">AASFB0009Q</strong>
            &nbsp;·&nbsp;
            Licence No: <strong style="color:#b8cef0;">33640596/2</strong>
          </div>
        </div>

        <!-- Invoice number & status -->
        <div class="inv-meta-block">
          <div class="inv-label">Tax Invoice</div>
          <div class="inv-number"><?= esc($invoice['invoice_no']) ?></div>
          <div class="inv-date">
            Date: <?= date('d M Y', strtotime($invoice['invoice_date'])) ?>
          </div>
          <?php if (!empty($invoice['due_date'])): ?>
            <div class="inv-date">
              Due: <?= date('d M Y', strtotime($invoice['due_date'])) ?>
            </div>
          <?php endif; ?>
          <div>
            <span class="status-pill <?= $statusCls ?>">
              <?= ucfirst($invoice['status']) ?>
            </span>
          </div>
        </div>

      </div>
      <div class="inv-header-bar"></div>
    </div>

    <!-- ── BODY ─────────────────────────────────────────────── -->
    <div class="inv-body">

      <!-- Billed To + Invoice Details -->
      <div class="inv-parties">

        <div class="party-box">
          <div class="party-label">Billed To</div>
          <div class="party-name"><?= esc($invoice['patient_name']) ?></div>
          <?php
          $patMeta = [];
          if (!empty($invoice['patient_age']))
            $patMeta[] = $invoice['patient_age'] . ' yrs';
          if (!empty($invoice['patient_sex']))
            $patMeta[] = $invoice['patient_sex'];
          if ($patMeta):
            ?>
            <div class="party-detail" style="margin-top:3px;">
              <?= implode(' · ', $patMeta) ?>
            </div>
          <?php endif; ?>
          <?php if (!empty($invoice['patient_phone'])): ?>
            <div class="party-detail"><?= esc($invoice['patient_phone']) ?></div>
          <?php endif; ?>
          <?php if (!empty($invoice['patient_address'])): ?>
            <div class="party-detail"><?= nl2br(esc($invoice['patient_address'])) ?></div>
          <?php endif; ?>
        </div>

        <div class="party-box">
          <div class="party-label">Invoice Details</div>
          <div class="inv-info-grid">
            <div class="info-row">
              <span class="ilabel">Invoice No</span>
              <span class="ival"><?= esc($invoice['invoice_no']) ?></span>
            </div>
            <div class="info-row">
              <span class="ilabel">Date</span>
              <span class="ival"><?= date('d M Y', strtotime($invoice['invoice_date'])) ?></span>
            </div>
            <?php if (!empty($invoice['doctor_name'])): ?>
              <div class="info-row">
                <span class="ilabel">Doctor</span>
                <span class="ival"><?= esc($invoice['doctor_name']) ?></span>
              </div>
            <?php endif; ?>
            <?php if (!empty($invoice['ward_room'])): ?>
              <div class="info-row">
                <span class="ilabel">Ward / Room</span>
                <span class="ival"><?= esc($invoice['ward_room']) ?></span>
              </div>
            <?php endif; ?>
            <?php if (!empty($invoice['admission_date'])): ?>
              <div class="info-row">
                <span class="ilabel">Admitted</span>
                <span class="ival"><?= date('d M Y, H:i', strtotime($invoice['admission_date'])) ?></span>
              </div>
            <?php endif; ?>
            <?php if (!empty($invoice['discharge_date'])): ?>
              <div class="info-row">
                <span class="ilabel">Discharged</span>
                <span class="ival"><?= date('d M Y, H:i', strtotime($invoice['discharge_date'])) ?></span>
              </div>
            <?php endif; ?>
            <?php if (!empty($invoice['admission_date']) && !empty($invoice['discharge_date'])): ?>
              <?php
              $stayHours = (strtotime($invoice['discharge_date']) - strtotime($invoice['admission_date'])) / 3600;
              $stayDays = floor($stayHours / 24);
              $stayH = round($stayHours % 24);
              $stayStr = $stayDays > 0 ? $stayDays . 'd ' . ($stayH > 0 ? $stayH . 'h' : '') : round($stayHours) . 'h';
              ?>
              <div class="info-row">
                <span class="ilabel">Stay Duration</span>
                <span class="ival" style="color:#1565c0;font-weight:700;"><?= trim($stayStr) ?></span>
              </div>
            <?php endif; ?>
            <?php if (!empty($invoice['due_date'])): ?>
              <div class="info-row">
                <span class="ilabel">Due Date</span>
                <span class="ival"><?= date('d M Y', strtotime($invoice['due_date'])) ?></span>
              </div>
            <?php endif; ?>
            <div class="info-row" style="grid-column:1/-1">
              <span class="ilabel">Payment Mode</span>
              <span class="ival"><?= ucfirst($invoice['payment_mode'] ?? 'Cash') ?></span>
            </div>
          </div>
        </div>

      </div>

      <!-- ── Items Table ─────────────────────────────────────── -->
      <table class="items-table">
        <thead>
          <tr>
            <th class="item-num text-center">#</th>
            <th>Service / Description</th>
            <th class="text-right" style="width:100px">Rate (₹)</th>
            <th class="text-center" style="width:52px">Qty</th>
            <?php if (($invoice['tax_amount'] ?? 0) > 0): ?>
              <th class="text-center" style="width:54px">Service Tax%</th>
            <?php endif; ?>
            <th class="text-right" style="width:100px">Amount (₹)</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($invoice['items'] as $idx => $item): ?>
            <tr>
              <td class="item-num text-center"><?= $idx + 1 ?></td>
              <td>
                <div class="item-desc"><?= esc($item['description']) ?></div>
              </td>
              <td class="text-right">
                <?= number_format((float) $item['unit_price'], 2) ?>
              </td>
              <td class="text-center">
                <?= esc($item['qty']) ?>
              </td>
              <?php if (($invoice['tax_amount'] ?? 0) > 0): ?>
                <td class="text-center">
                  <?= number_format((float) ($item['tax_percent'] ?? 0), 1) ?>%
                </td>
              <?php endif; ?>
              <td class="text-right" style="font-weight:600;">
                <?= number_format((float) $item['total'], 2) ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <!-- ── Bottom: Notes + Totals ──────────────────────────── -->
      <div class="inv-bottom">

        <!-- Left: amount in words + notes -->
        <div>
          <div class="amount-words">
            <strong style="font-style:normal;">Amount in words:</strong>
            <?= $amountWords ?>
          </div>

          <?php if (!empty($invoice['notes'])): ?>
            <div class="notes-box" style="margin-top:14px;">
              <div class="notes-title">Terms & Notes</div>
              <?= nl2br(esc($invoice['notes'])) ?>
            </div>
          <?php endif; ?>

          <div class="notes-box" style="margin-top:14px;">
            <div class="notes-title">Payment Terms</div>
            Payment due upon receipt. For billing queries call 8172007073.
          </div>
        </div>

        <!-- Right: totals box -->
        <div class="totals-box">
          <table>
            <tr>
              <td class="t-label">Subtotal</td>
              <td class="t-val">
                ₹<?= number_format((float) ($invoice['subtotal'] ?? $invoice['total_amount']), 2) ?>
              </td>
            </tr>
            <?php if ((float) ($invoice['discount'] ?? 0) > 0): ?>
              <tr>
                <td class="t-label">Discount</td>
                <td class="t-val" style="color:#dc2626;">
                  − ₹<?= number_format((float) $invoice['discount'], 2) ?>
                </td>
              </tr>
            <?php endif; ?>
            <?php if ((float) ($invoice['tax_amount'] ?? 0) > 0): ?>
              <tr>
                <td class="t-label">GST (<?= $invoice['tax_percent'] ?? 0 ?>%)</td>
                <td class="t-val">+ ₹<?= number_format((float) $invoice['tax_amount'], 2) ?></td>
              </tr>
            <?php endif; ?>
            <tr class="t-grand">
              <td>Grand Total</td>
              <td>₹<?= number_format((float) $invoice['total_amount'], 2) ?></td>
            </tr>
            <tr>
              <td class="t-label" style="color:#16a34a;font-weight:600;">Amount Paid</td>
              <td class="t-val" style="color:#16a34a;">
                ₹<?= number_format((float) $invoice['paid_amount'], 2) ?>
              </td>
            </tr>
            <tr class="t-balance">
              <td class="t-label">Balance Due</td>
              <td class="t-val" style="color:<?= $balance > 0 ? '#dc2626' : '#16a34a' ?>;">
                ₹<?= number_format($balance, 2) ?>
              </td>
            </tr>
          </table>
        </div>

      </div>

      <!-- flex spacer: grows to fill remaining height, pushing sig+footer to page bottom -->
      <div style="flex:1 1 auto;"></div>

      <!-- ── Signatures ───────────────────────────────────────── -->
      <div class="sig-row">
        <div class="sig-box">
          <div style="height:28px;"></div>
          <div class="sig-line">Patient / Attendant Signature</div>
        </div>
        <div class="sig-box">
          <div style="height:28px;"></div>
          <div class="sig-line">Cashier</div>
        </div>
        <div class="sig-box">
          <div style="height:28px;"></div>
          <div class="sig-line">Authorised Signatory</div>
        </div>
      </div>

    </div>

    <!-- ── FOOTER ────────────────────────────────────────────── -->
    <div class="inv-footer">
      <div>
        <strong>Bandhan Hospital</strong> &nbsp;·&nbsp;
        30/1 P.L.K. Maitra Road, Krishnagar, Nadia – 741101
      </div>
      <div style="text-align:right;">
        This is a computer-generated invoice and is valid without a physical seal.
      </div>
    </div>
    <div class="inv-footer-bar"></div>

  </div><!-- end page-wrapper -->

  <?php
  // ── PAGE 2: Medicine detail (only if medicines exist) ─────────────
  $medicines = $invoice['medicines'] ?? [];
  if (!empty($medicines)):
    $medTotal = array_sum(array_column($medicines, 'total'));
    ?>

    <!-- Page 2 wrapper — page break via CSS class, exact A4 height -->
    <div class="page2" style="
  max-width:794px; min-height:1123px;
  background:#fff;
  box-shadow:0 4px 32px rgba(0,0,0,.15);
  display:flex; flex-direction:column;
  font-family:'Segoe UI',Arial,sans-serif;
  font-size:13px; color:#1a1a2e;
  margin:24px auto 0;
">

      <!-- Mini header -->
      <div style="background:#0d2a6e;padding:14px 28px;display:flex;justify-content:space-between;align-items:center;">
        <div>
          <div style="font-size:15px;font-weight:900;color:#f5c300;letter-spacing:1px;">BANDHAN HOSPITAL</div>
          <div style="font-size:10px;color:#8eb8e8;margin-top:2px;">Medicine &amp; Consumable Detail</div>
        </div>
        <div style="text-align:right;">
          <div style="font-size:11px;color:#8eb8e8;">Invoice: <strong
              style="color:#fff;"><?= esc($invoice['invoice_no']) ?></strong></div>
          <div style="font-size:11px;color:#8eb8e8;">Patient: <strong
              style="color:#fff;"><?= esc($invoice['patient_name']) ?></strong></div>
          <div style="font-size:11px;color:#8eb8e8;">Date: <?= date('d M Y', strtotime($invoice['invoice_date'])) ?></div>
        </div>
      </div>
      <div style="height:4px;background:linear-gradient(90deg,#f5c300 70%,#e65100 100%);"></div>

      <!-- Medicine table body -->
      <div style="padding:24px 28px;flex:1;">

        <div
          style="font-size:9px;text-transform:uppercase;letter-spacing:1.5px;color:#6b7280;font-weight:700;margin-bottom:12px;padding-bottom:6px;border-bottom:2px solid #1565c0;display:inline-block;">
          Medicines &amp; Consumables Issued
        </div>

        <table style="width:100%;border-collapse:collapse;font-size:12px;">
          <thead>
            <tr style="background:#0d2a6e;color:#fff;">
              <th
                style="padding:8px 10px;font-size:10px;text-transform:uppercase;letter-spacing:.5px;text-align:center;width:28px;">
                #</th>
              <th style="padding:8px 10px;font-size:10px;text-transform:uppercase;letter-spacing:.5px;width:70px;">Date
              </th>
              <th style="padding:8px 10px;font-size:10px;text-transform:uppercase;letter-spacing:.5px;">Medicine / Item
              </th>
              <th style="padding:8px 10px;font-size:10px;text-transform:uppercase;letter-spacing:.5px;width:70px;">Batch
                No</th>
              <th style="padding:8px 10px;font-size:10px;text-transform:uppercase;letter-spacing:.5px;width:55px;">Expiry
              </th>
              <th style="padding:8px 10px;font-size:10px;text-transform:uppercase;letter-spacing:.5px;width:40px;">Unit
              </th>
              <th
                style="padding:8px 10px;font-size:10px;text-transform:uppercase;letter-spacing:.5px;text-align:right;width:85px;">
                Rate (₹)</th>
              <th
                style="padding:8px 10px;font-size:10px;text-transform:uppercase;letter-spacing:.5px;text-align:center;width:40px;">
                Qty</th>
              <th
                style="padding:8px 10px;font-size:10px;text-transform:uppercase;letter-spacing:.5px;text-align:right;width:85px;">
                Amount (₹)</th>
              <th style="padding:8px 10px;font-size:10px;text-transform:uppercase;letter-spacing:.5px;width:90px;">
                Prescribed By</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($medicines as $idx => $med): ?>
              <tr style="border-bottom:1px solid #e5e7eb;<?= $idx % 2 === 1 ? 'background:#f9fafb;' : '' ?>">
                <td style="padding:8px 10px;text-align:center;color:#6b7280;font-size:11px;"><?= $idx + 1 ?></td>
                <td style="padding:8px 10px;font-size:11px;color:#6b7280;">
                  <?= !empty($med['date']) ? date('d/m/Y', strtotime($med['date'])) : '—' ?>
                </td>
                <td style="padding:8px 10px;font-weight:500;">
                  <?= esc($med['medicine_name']) ?>
                  <?php if (!empty($med['note'])): ?>
                    <div style="font-size:10px;color:#6b7280;margin-top:2px;"><?= esc($med['note']) ?></div>
                  <?php endif; ?>
                </td>
                <td style="padding:8px 10px;font-size:11px;color:#6b7280;"><?= esc($med['batch_no'] ?? '—') ?></td>
                <td style="padding:8px 10px;font-size:11px;color:#6b7280;"><?= esc($med['expiry'] ?? '—') ?></td>
                <td style="padding:8px 10px;font-size:11px;color:#6b7280;"><?= esc($med['unit'] ?? 'Nos') ?></td>
                <td style="padding:8px 10px;text-align:right;"><?= number_format((float) $med['unit_price'], 2) ?></td>
                <td style="padding:8px 10px;text-align:center;">
                  <?= esc($med['qty']) ?>
                </td>
                <td style="padding:8px 10px;text-align:right;font-weight:600;">
                  <?= number_format((float) $med['total'], 2) ?>
                </td>
                <td style="padding:8px 10px;font-size:11px;color:#6b7280;"><?= esc($med['prescribed_by'] ?? '—') ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr style="background:#0d2a6e;">
              <td colspan="8" style="padding:10px;text-align:right;font-weight:700;color:#fff;font-size:13px;">Total
                Medicine Cost</td>
              <td style="padding:10px;text-align:right;font-weight:900;color:#f5c300;font-size:14px;">
                ₹<?= number_format($medTotal, 2) ?></td>
              <td style="padding:10px;"></td>
            </tr>
          </tfoot>
        </table>

        <div style="margin-top:16px;font-size:11px;color:#6b7280;font-style:italic;">
          * This amount is included in the Grand Total on Page 1 under "Medicines &amp; Consumables".
        </div>

        <!-- Spacer pushes signature to bottom -->
        <div style="flex:1 1 auto;"></div>

      </div>

      <!-- Signature row -->
      <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;padding:0 28px 20px;margin-top:auto;">
        <?php foreach (['Pharmacist Signature', 'Nurse / Ward In-charge', 'Authorised Signatory'] as $sig): ?>
          <div style="text-align:center;">
            <div style="height:28px;"></div>
            <div style="border-top:1.5px solid #c9d4e8;padding-top:6px;font-size:10.5px;color:#6b7280;font-weight:600;">
              <?= $sig ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Footer -->
      <div
        style="padding:10px 28px;background:#f0f5ff;border-top:1.5px solid #e5e7eb;display:flex;justify-content:space-between;font-size:10.5px;color:#6b7280;">
        <div><strong style="color:#0d2a6e;">Bandhan Hospital</strong> · 30/1 P.L.K. Maitra Road, Krishnagar, Nadia –
          741101</div>
        <div>Page 2 of <?= count($medicines) > 0 ? 2 : 1 ?> · Medicine Detail</div>
      </div>
      <div style="height:5px;background:linear-gradient(90deg,#0d2a6e 70%,#f5c300 85%,#e65100 100%);"></div>

    </div><!-- end page 2 -->

  <?php endif; ?>

</body>

</html>