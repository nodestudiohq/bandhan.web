<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="color-scheme" content="light">
  <title>Salary Slip — <?= esc($staff['name']) ?> —
    <?= date('F Y', mktime(0, 0, 0, $salary['month'], 1, $salary['year'])) ?>
  </title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
    rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap');

    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    :root {
      --navy: #0c1a3a;
      --indigo: #3b4fd8;
      --gold: #f5c300;
      --orange: #e65100;
      --bg: #f0f2f8;
      --surf: #ffffff;
      --border: #e2e5ef;
      --text: #0f172a;
      --muted: #64748b;
      --subtle: #f8faff;
      --green: #16a34a;
      --red: #dc2626;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: #f0f2f8;
      color: #0f172a;
      font-size: 13px;
      -webkit-font-smoothing: antialiased;
    }

    /* ── Print bar (screen only) ──────────────── */
    .print-bar {
      background: #0c1a3a;
      padding: 10px 20px;
      display: flex;
      gap: 10px;
      align-items: center;
      justify-content: center;
    }

    .print-bar a,
    .print-bar button {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 18px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 600;
      border: none;
      cursor: pointer;
      text-decoration: none;
      transition: opacity .15s;
      font-family: 'DM Sans', sans-serif;
    }

    .print-bar a {
      background: #1e293b;
      color: #94a3b8;
    }

    .print-bar button {
      background: #3b4fd8;
      color: #fff;
    }

    .print-bar a:hover,
    .print-bar button:hover {
      opacity: .85;
    }

    /* ── Page wrapper ─────────────────────────── */
    .page {
      max-width: 794px;
      min-height: 1123px;
      margin: 24px auto;
      background: #ffffff;
      box-shadow: 0 4px 32px rgba(0, 0, 0, .12);
      display: flex;
      flex-direction: column;
    }

    /* ── Header ───────────────────────────────── */
    .slip-header {
      background: #0c1a3a;
      position: relative;
      overflow: hidden;
    }

    .slip-header::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(255, 255, 255, .04), transparent 60%);
    }

    .slip-header-inner {
      display: flex;
      justify-content: space-between;
      align-items: stretch;
      position: relative;
      z-index: 2;
    }

    .hsp-block {
      padding: 18px 24px;
    }

    .hsp-name {
      font-size: 19px;
      font-weight: 900;
      color: #f5c300;
      letter-spacing: 1px;
      line-height: 1;
    }

    .hsp-sub {
      font-size: 10px;
      color: #8eb8e8;
      margin-top: 4px;
      line-height: 1.6;
    }

    .hsp-phone {
      font-size: 11px;
      color: #f5c300;
      font-weight: 700;
      margin-top: 5px;
    }

    .slip-meta-block {
      background: rgba(255, 255, 255, .07);
      border-left: 1px solid rgba(255, 255, 255, .1);
      padding: 18px 24px;
      min-width: 190px;
      text-align: right;
    }

    .slip-label {
      font-size: 9px;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      color: #8eb8e8;
      font-weight: 700;
    }

    .slip-period {
      font-size: 18px;
      font-weight: 900;
      color: #fff;
      line-height: 1.1;
    }

    .slip-date {
      font-size: 10.5px;
      color: #8eb8e8;
      margin-top: 3px;
    }

    .status-pill {
      display: inline-block;
      margin-top: 8px;
      padding: 3px 12px;
      border-radius: 99px;
      font-size: 10px;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .status-paid {
      background: #16a34a;
      color: #fff;
    }

    .status-pending {
      background: #f5c300;
      color: #0c1a3a;
    }

    .status-draft {
      background: #64748b;
      color: #fff;
    }

    .status-preview {
      background: #6366f1;
      color: #fff;
    }

    .slip-header-bar {
      height: 4px;
      background: linear-gradient(90deg, #f5c300 70%, #e65100 100%);
    }

    /* ── Body ─────────────────────────────────── */
    .slip-body {
      padding: 24px 28px 0;
      flex: 1;
    }

    /* ── Spacer inside body still needed to keep net-box from stretching ── */

    /* ── Staff / pay-period grid ──────────────── */
    .info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      margin-bottom: 22px;
      padding-bottom: 20px;
      border-bottom: 1.5px solid #e2e5ef;
    }

    .info-block-title {
      font-size: 9px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      color: #64748b;
      margin-bottom: 10px;
      padding-bottom: 5px;
      border-bottom: 2px solid #3b4fd8;
      display: inline-block;
    }

    .info-row {
      display: flex;
      justify-content: space-between;
      align-items: baseline;
      padding: 5px 0;
      border-bottom: 1px solid #e2e5ef;
      font-size: 12.5px;
    }

    .info-row:last-child {
      border-bottom: none;
    }

    .info-key {
      color: #64748b;
    }

    .info-val {
      font-weight: 500;
      text-align: right;
      font-family: 'DM Mono', monospace;
      font-size: 12px;
    }

    /* ── Attendance bar ───────────────────────── */
    .att-bar {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
      margin-bottom: 22px;
      padding: 14px 16px;
      background: #f8faff;
      border: 1px solid #e2e5ef;
      border-radius: 10px;
    }

    .att-item {
      text-align: center;
    }

    .att-num {
      font-size: 20px;
      font-weight: 700;
      line-height: 1;
    }

    .att-lbl {
      font-size: 10px;
      color: #64748b;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: .5px;
      margin-top: 3px;
    }

    /* ── Earnings / Deductions columns ───────── */
    .earn-ded {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
      margin-bottom: 20px;
    }

    .col-card {
      border: 1.5px solid #e2e5ef;
      border-radius: 10px;
      overflow: hidden;
    }

    .col-hdr {
      padding: 10px 14px;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .8px;
    }

    .col-hdr-earn {
      background: #f0fdf4;
      color: #16a34a;
      border-bottom: 1px solid #d1fae5;
    }

    .col-hdr-ded {
      background: #fef2f2;
      color: #dc2626;
      border-bottom: 1px solid #fecaca;
    }

    .slip-tbl {
      width: 100%;
      border-collapse: collapse;
    }

    .slip-tbl td {
      padding: 7px 14px;
      font-size: 12.5px;
      border-bottom: 1px solid #e2e5ef;
    }

    .slip-tbl tr:last-child td {
      border-bottom: none;
    }

    .slip-tbl .td-label {
      color: #64748b;
    }

    .slip-tbl .td-amt {
      text-align: right;
      font-weight: 400;
      font-family: 'DM Mono', monospace;
    }

    .slip-tbl .td-amt-earn {
      color: #16a34a;
    }

    .slip-tbl .td-amt-ded {
      color: #dc2626;
    }

    .slip-tbl .tfoot-row td {
      font-weight: 700;
      background: #f8faff;
    }

    /* ── Net pay box ──────────────────────────── */
    .net-box {
      background: #0c1a3a;
      border-radius: 10px;
      padding: 16px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .net-label {
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #8eb8e8;
    }

    .net-mode {
      font-size: 11px;
      color: #64748b;
      margin-top: 3px;
    }

    .net-amount {
      font-size: 28px;
      font-weight: 900;
      color: #f5c300;
      font-family: 'DM Mono', monospace;
      letter-spacing: 1px;
    }

    /* Amount in words */
    .amount-words {
      font-size: 11px;
      color: #64748b;
      font-style: italic;
      margin-bottom: 18px;
    }

    .amount-words strong {
      font-style: normal;
      color: #0c1a3a;
    }

    /* ── Spacer ───────────────────────────────── */
    .spacer {
      flex: 1 1 auto;
    }

    /* ── Signatures ───────────────────────────── */
    .sig-row {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 16px;
      padding-top: 20px;
    }

    .sig-box {
      text-align: center;
    }

    .sig-line {
      border-top: 1.5px solid #c9d4e8;
      padding-top: 6px;
      font-size: 10.5px;
      color: #64748b;
      font-weight: 600;
    }

    /* ── Footer ───────────────────────────────── */
    .slip-footer {
      padding: 10px 28px;
      background: #f8faff;
      border-top: 1.5px solid #e2e5ef;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 10px;
      color: #64748b;
    }

    .slip-footer strong {
      color: #0c1a3a;
    }

    .slip-footer-bar {
      height: 5px;
      background: linear-gradient(90deg, #0c1a3a 70%, #f5c300 85%, #e65100 100%);
    }

    /* ── Print ────────────────────────────────── */
    @page {
      size: A4 portrait;
      margin: 0;
    }

    @media print {

      html,
      body {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        margin: 0;
        padding: 0;
        background: #ffffff !important;
        height: 297mm;
      }

      .print-bar {
        display: none !important;
      }

      .page {
        margin: 0 !important;
        box-shadow: none !important;
        width: 210mm !important;
        max-width: 210mm !important;
        height: 297mm !important;
        min-height: 297mm !important;
        display: flex !important;
        flex-direction: column !important;
      }

      .slip-body {
        flex: 1 !important;
      }
    }
  </style>
</head>

<body>

  <?php
  // ── Calculations ──────────────────────────────────────────────────
  $gross = (float) ($salary['gross_earnings'] ?? (
    ($salary['basic_pay'] ?? 0) + ($salary['hra'] ?? 0) + ($salary['da'] ?? 0) +
    ($salary['medical_allowance'] ?? 0) + ($salary['travel_allowance'] ?? 0) +
    ($salary['special_allowance'] ?? 0) + ($salary['night_shift_allowance'] ?? 0) +
    ($salary['overtime_allowance'] ?? 0) + ($salary['bonus_incentive'] ?? 0)
  ));
  $lop = (float) ($salary['lop_deduction'] ?? 0);
  $pf = (float) ($salary['pf'] ?? 0);
  $esi = (float) ($salary['esi'] ?? 0);
  $profTax = (float) ($salary['professional_tax'] ?? 0);
  $tds = (float) ($salary['tds'] ?? 0);
  $loanRec = (float) ($salary['loan_recovery'] ?? 0);
  $advRec = (float) ($salary['advance_recovery'] ?? 0);
  $otherDed = (float) ($salary['other_deductions'] ?? 0);
  $totalDed = (float) ($salary['total_deductions'] ?? ($lop + $pf + $esi + $profTax + $tds + $loanRec + $advRec + $otherDed));
  $net = (float) ($salary['net_pay'] ?? ($gross - $totalDed));

  $monthLabel = date('F Y', mktime(0, 0, 0, $salary['month'], 1, $salary['year']));
  $status = $salary['payment_status'] ?? 'preview';
  $statusMap = [
    'paid' => ['Paid', 'status-paid'],
    'pending' => ['Pending', 'status-pending'],
    'draft' => ['Draft', 'status-draft'],
    'approved' => ['Approved', 'status-pending'],
    'held' => ['Held', 'status-draft'],
    'preview' => ['Preview', 'status-preview'],
  ];
  [$statusLabel, $statusCls] = $statusMap[$status] ?? ['Unknown', 'status-draft'];

  // Indian amount-in-words
  function amtWords(float $num): string
  {
    $parts = explode('.', number_format($num, 2, '.', ''));
    $rupees = (int) $parts[0];
    $paise = (int) $parts[1];

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

    function inWords(int $n, array $ones, array $tens): string
    {
      if ($n === 0)
        return '';
      $w = '';
      if ($n >= 10000000) {
        $w .= inWords((int) ($n / 10000000), $ones, $tens) . ' Crore ';
        $n %= 10000000;
      }
      if ($n >= 100000) {
        $w .= inWords((int) ($n / 100000), $ones, $tens) . ' Lakh ';
        $n %= 100000;
      }
      if ($n >= 1000) {
        $w .= inWords((int) ($n / 1000), $ones, $tens) . ' Thousand ';
        $n %= 1000;
      }
      if ($n >= 100) {
        $w .= $ones[(int) ($n / 100)] . ' Hundred ';
        $n %= 100;
      }
      if ($n >= 20) {
        $w .= $tens[(int) ($n / 10)] . ' ';
        $n %= 10;
      }
      if ($n > 0) {
        $w .= $ones[$n] . ' ';
      }
      return $w;
    }

    $result = trim(inWords($rupees, $ones, $tens)) . ' Rupees';
    if ($paise > 0) {
      $result .= ' and ' . trim(inWords($paise, $ones, $tens)) . ' Paise';
    }
    return $result . ' Only';
  }
  ?>

  <!-- Print bar (screen only) -->
  <div class="print-bar">
    <a href="javascript:history.back()">← Back</a>
    <button onclick="window.print()">🖨 Print / Save PDF</button>
  </div>

  <!-- Salary Slip Page -->
  <div class="page">

    <!-- Header -->
    <div class="slip-header" style="background:#0c1a3a;position:relative;overflow:hidden;">
      <div class="slip-header-inner"
        style="display:flex;justify-content:space-between;align-items:stretch;position:relative;z-index:2;">
        <div class="hsp-block" style="padding:18px 24px;">
          <div class="hsp-name" style="font-size:19px;font-weight:700;color:#f5c300;letter-spacing:.5px;line-height:1;">
            BANDHAN HOSPITAL</div>
          <div class="hsp-sub" style="font-size:10px;color:#8eb8e8;margin-top:4px;line-height:1.6;">
            30/1 P.L.K. Maitra Road, Krishnagar, Nadia – 741101, West Bengal<br>
            ✉ bandhanhospital@gmail.com &nbsp;·&nbsp; 🌐 www.bandhanhospital.com
          </div>
          <div class="hsp-phone" style="font-size:11px;color:#f5c300;font-weight:600;margin-top:5px;">📞 8172007073 /
            7318770083</div>
        </div>
        <div class="slip-meta-block"
          style="background:rgba(255,255,255,.08);border-left:1px solid rgba(255,255,255,.12);padding:18px 24px;min-width:190px;text-align:right;">
          <div class="slip-label"
            style="font-size:9px;text-transform:uppercase;letter-spacing:1.5px;color:#8eb8e8;font-weight:700;">Salary
            Slip</div>
          <div class="slip-period" style="font-size:18px;font-weight:700;color:#ffffff;line-height:1.1;">
            <?= $monthLabel ?>
          </div>
          <?php if (!empty($salary['paid_date'])): ?>
            <div class="slip-date" style="font-size:10.5px;color:#8eb8e8;margin-top:3px;">Paid:
              <?= date('d M Y', strtotime($salary['paid_date'])) ?>
            </div>
          <?php endif; ?>
          <div style="margin-top:8px;">
            <span class="status-pill <?= $statusCls ?>"><?= $statusLabel ?></span>
          </div>
        </div>
      </div>
      <div class="slip-header-bar" style="height:4px;background:linear-gradient(90deg,#f5c300 70%,#e65100 100%);"></div>
    </div>

    <!-- Body -->
    <div class="slip-body">

      <!-- Staff info grid -->
      <div class="info-grid">
        <div>
          <div class="info-block-title">Employee Details</div>
          <?php foreach ([
            ['Staff ID', '<span style="color:#3b4fd8;font-family:\'DM Mono\',monospace;font-weight:500;">' . esc($staff['staff_id']) . '</span>'],
            ['Name', esc($staff['name'])],
            ['Designation', esc($staff['designation'])],
            ['Department', esc($staff['department'])],
            ['Blood Group', !empty($staff['blood_group']) ? '<span style="color:#dc2626;font-weight:500;">' . esc($staff['blood_group']) . '</span>' : '—'],
          ] as [$k, $v]): ?>
            <div class="info-row">
              <span class="info-key"><?= $k ?></span>
              <span class="info-val"><?= $v ?></span>
            </div>
          <?php endforeach; ?>
        </div>
        <div>
          <div class="info-block-title">Pay Period Details</div>
          <?php foreach ([
            ['Pay Month', $monthLabel],
            ['Joining Date', !empty($staff['joining_date']) ? date('d M Y', strtotime($staff['joining_date'])) : '—'],
            ['Payment Mode', ucwords($salary['payment_mode'] ?? 'Bank Transfer')],
            ['Transaction', !empty($salary['transaction_ref']) ? esc($salary['transaction_ref']) : '—'],
          ] as [$k, $v]): ?>
            <div class="info-row">
              <span class="info-key"><?= $k ?></span>
              <span class="info-val"><?= $v ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Attendance summary -->
      <div class="att-bar">
        <?php foreach ([
          ['Working Days', $salary['working_days'] ?? '—', '#3b4fd8'],
          ['Present', $salary['present_days'] ?? '—', '#16a34a'],
          ['Paid Leave', $salary['paid_leave_days'] ?? 0, '#2563eb'],
          ['LOP Days', $salary['lop_override'] ?? $salary['unpaid_leave_days'] ?? 0, '#dc2626'],
        ] as [$lbl, $val, $col]): ?>
          <div class="att-item">
            <div class="att-num" style="color:<?= $col ?>;"><?= $val ?></div>
            <div class="att-lbl"><?= $lbl ?></div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Earnings & Deductions -->
      <div class="earn-ded">

        <!-- Earnings -->
        <div class="col-card">
          <div class="col-hdr col-hdr-earn"
            style="background:#f0fdf4;color:#16a34a;border-bottom:1px solid #d1fae5;padding:10px 14px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.8px;">
            <i class="bi bi-plus-circle" style="margin-right:5px;"></i>Earnings
          </div>
          <table class="slip-tbl">
            <?php
            $earnings = [
              'Basic Pay' => $salary['basic_pay'] ?? 0,
              'HRA' => $salary['hra'] ?? 0,
              'Dearness Allowance' => $salary['da'] ?? 0,
              'Medical Allowance' => $salary['medical_allowance'] ?? 0,
              'Travel Allowance' => $salary['travel_allowance'] ?? 0,
              'Special Allowance' => $salary['special_allowance'] ?? 0,
              'Night Shift Allow.' => $salary['night_shift_allowance'] ?? 0,
              'Overtime Allowance' => $salary['overtime_allowance'] ?? 0,
              'Bonus / Incentive' => $salary['bonus_incentive'] ?? 0,
            ];
            foreach ($earnings as $lbl => $val):
              if ((float) $val <= 0)
                continue;
              ?>
              <tr>
                <td class="td-label"><?= $lbl ?></td>
                <td class="td-amt">₹<?= number_format((float) $val, 2) ?></td>
              </tr>
            <?php endforeach; ?>
            <?php if ($lop > 0): ?>
              <tr>
                <td class="td-label" style="color:#dc2626;">LOP Deduction</td>
                <td class="td-amt" style="color:#dc2626;">- ₹<?= number_format($lop, 2) ?></td>
              </tr>
            <?php endif; ?>
            <tr class="tfoot-row">
              <td>Gross Earnings</td>
              <td class="td-amt td-amt-earn">₹<?= number_format($gross, 2) ?></td>
            </tr>
          </table>
        </div>

        <!-- Deductions -->
        <div class="col-card">
          <div class="col-hdr col-hdr-ded"
            style="background:#fef2f2;color:#dc2626;border-bottom:1px solid #fecaca;padding:10px 14px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.8px;">
            <i class="bi bi-dash-circle" style="margin-right:5px;"></i>Deductions
          </div>
          <table class="slip-tbl">
            <?php
            $deductions = [
              'Provident Fund (PF)' => $pf,
              'ESI (Employee)' => $esi,
              'Professional Tax' => $profTax,
              'Income Tax (TDS)' => $tds,
              'Loan Recovery' => $loanRec,
              'Advance Recovery' => $advRec,
              'Other Deductions' => $otherDed,
            ];
            foreach ($deductions as $lbl => $val):
              if ((float) $val <= 0)
                continue;
              ?>
              <tr>
                <td class="td-label"><?= $lbl ?></td>
                <td class="td-amt td-amt-ded">₹<?= number_format((float) $val, 2) ?></td>
              </tr>
            <?php endforeach; ?>
            <tr class="tfoot-row">
              <td>Total Deductions</td>
              <td class="td-amt td-amt-ded">₹<?= number_format($totalDed, 2) ?></td>
            </tr>
          </table>
        </div>

      </div>

      <div class="amount-words">
        <strong>Net Pay in Words:</strong>
        <?= amtWords($net) ?>
      </div>

      <!-- Net Pay -->
      <div class="net-box"
        style="background:#0c1a3a;border-radius:10px;padding:16px 20px;display:flex;justify-content:space-between;align-items:center;margin-bottom:0;">
        <div>
          <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#8eb8e8;">Net
            Take-Home Pay</div>
          <div style="font-size:11px;color:#8eb8e8;margin-top:3px;opacity:.7;">
            <?= ucwords($salary['payment_mode'] ?? 'Bank Transfer') ?>
          </div>
        </div>
        <div style="font-size:26px;font-weight:700;color:#f5c300;font-family:'DM Mono',monospace;letter-spacing:1px;">
          ₹<?= number_format($net, 2) ?></div>
      </div>

    </div><!-- end slip-body -->

    <!-- Signature sits directly above footer — no spacer needed -->
    <div style="padding:20px 28px 16px;text-align:right;margin-top:auto;">
      <div style="display:inline-block;min-width:200px;">
        <div style="height:36px;"></div>
        <div style="border-top:1.5px solid #c9d4e8;padding-top:6px;font-size:10.5px;
                  color:#64748b;font-weight:600;">
          Authorised Signatory
        </div>
      </div>
    </div>

    <!-- Footer pinned to bottom of page -->
    <div style="padding:10px 28px;background:#f8faff;border-top:1.5px solid #e2e5ef;
              display:flex;justify-content:space-between;align-items:center;font-size:10px;color:#64748b;">
      <strong style="color:#0c1a3a;">Bandhan Hospital</strong>
      &nbsp;·&nbsp; 30/1 P.L.K. Maitra Road, Krishnagar, Nadia – 741101
      <span>Computer-generated · Valid without physical seal</span>
    </div>
    <div style="height:5px;background:linear-gradient(90deg,#0c1a3a 70%,#f5c300 85%,#e65100 100%);"></div>

  </div><!-- end page -->

</body>

</html>