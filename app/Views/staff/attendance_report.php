<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
$monthLabel = date('F Y', mktime(0, 0, 0, $month, 1, $year));
$workingDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

// Group by department
$grouped = [];
foreach ($report as $r) {
  $grouped[$r['department']][] = $r;
}
ksort($grouped);

// Overall stats
$totalPresent = array_sum(array_column($report, 'present'));
$totalAbsent = array_sum(array_column($report, 'absent'));
$totalHalf = array_sum(array_column($report, 'half_day'));
$totalLeave = array_sum(array_column($report, 'leave'));
$avgPct = count($report) > 0
  ? round(array_sum(array_map(
    fn($r) =>
    $workingDays > 0 ? ($r['present'] + $r['half_day'] * 0.5) / $workingDays * 100 : 0,
    $report
  )) / count($report))
  : 0;
?>

<style>
  /* ── Toolbar ────────────────────────────────────────── */
  .tb-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
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

  .tb-btn:hover {
    background: var(--subtle);
    color: var(--text);
  }

  .tb-btn-primary {
    background: var(--indigo);
    color: #fff;
    border-color: var(--indigo);
  }

  .tb-btn-primary:hover {
    opacity: .9;
    color: #fff;
  }

  .mon-sel {
    padding: 7px 10px;
    border: 1px solid var(--border);
    border-radius: 8px;
    font-size: 13px;
    background: var(--surf);
    color: var(--text);
    outline: none;
  }

  .mon-sel:focus {
    border-color: var(--indigo);
  }

  /* ── KPI cards ──────────────────────────────────────── */
  .kpi-row {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 12px;
    margin-bottom: 18px;
  }

  @media(max-width:768px) {
    .kpi-row {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  .kpi {
    background: var(--surf);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .04);
  }

  .kpi-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .6px;
    color: var(--muted);
  }

  .kpi-val {
    font-size: 26px;
    font-weight: 700;
    margin: 4px 0 2px;
    line-height: 1;
  }

  /* ── Dept group header ──────────────────────────────── */
  .dept-hdr {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: linear-gradient(90deg, #eef1ff, var(--subtle));
    border-top: 1.5px solid var(--border);
    border-bottom: 1px solid var(--border);
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--indigo);
  }

  .dept-count {
    background: rgba(59, 79, 216, .12);
    color: var(--indigo);
    border-radius: 99px;
    padding: 1px 8px;
    font-size: 10px;
    font-weight: 700;
  }

  /* ── Table ──────────────────────────────────────────── */
  .rpt-tbl {
    width: 100%;
    border-collapse: collapse;
  }

  .rpt-tbl th {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .6px;
    color: var(--muted);
    padding: 10px 14px;
    border-bottom: 1.5px solid var(--border);
    background: var(--subtle);
    white-space: nowrap;
  }

  .rpt-tbl td {
    padding: 12px 14px;
    border-bottom: 1px solid var(--border);
    font-size: 13.5px;
    vertical-align: middle;
  }

  .rpt-tbl tbody tr:last-child td {
    border-bottom: none;
  }

  .rpt-tbl tbody tr:hover td {
    background: var(--subtle);
  }

  /* ── Status chips ───────────────────────────────────── */
  .chip {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 3px 10px;
    border-radius: 99px;
    font-size: 12px;
    font-weight: 600;
    min-width: 36px;
  }

  .chip-P {
    background: #dcfce7;
    color: #166534;
  }

  .chip-A {
    background: #fef2f2;
    color: #dc2626;
  }

  .chip-H {
    background: #fef9c3;
    color: #854d0e;
  }

  .chip-L {
    background: #eff6ff;
    color: #1d4ed8;
  }

  .chip-0 {
    background: var(--subtle);
    color: var(--muted);
  }

  /* ── Progress bar ───────────────────────────────────── */
  .prog-wrap {
    display: flex;
    align-items: center;
    gap: 8px;
    min-width: 130px;
  }

  .prog-bar-bg {
    flex: 1;
    height: 6px;
    background: var(--border);
    border-radius: 99px;
    overflow: hidden;
  }

  .prog-fill {
    height: 100%;
    border-radius: 99px;
    transition: width .3s;
  }

  .pct-label {
    font-size: 12px;
    font-weight: 600;
    color: var(--muted);
    min-width: 34px;
    text-align: right;
  }

  /* ── Staff ID ───────────────────────────────────────── */
  .sid {
    font-size: 12px;
    font-weight: 500;
    color: var(--indigo);
    font-family: 'DM Mono', monospace;
  }

  /* ── Print styles ───────────────────────────────────── */
  @media print {
    .no-print {
      display: none !important;
    }

    .sb,
    .tb {
      display: none !important;
    }

    .main {
      margin: 0 !important;
      padding: 16px !important;
    }

    body {
      background: #fff !important;
    }

    .card {
      box-shadow: none !important;
      border: 1px solid #e2e5ef !important;
    }

    .dept-hdr {
      background: #eef1ff !important;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }

    .chip {
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }

    .prog-fill {
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }
  }
</style>

<!-- ── Header ──────────────────────────────────────────────────────── -->
<div class="no-print"
  style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:10px;">
  <div>
    <h5 style="font-size:17px;font-weight:700;margin-bottom:2px;">Attendance Report</h5>
    <span style="font-size:13px;color:var(--muted);"><?= $monthLabel ?> &mdash; <?= count($report) ?> staff</span>
  </div>
  <div style="display:flex;gap:8px;flex-wrap:wrap;">
    <a href="<?= base_url('attendance?month=' . $month . '&year=' . $year) ?>" class="tb-btn">
      <i class="bi bi-arrow-left"></i>Back to Calendar
    </a>
    <button onclick="window.print()" class="tb-btn tb-btn-primary">
      <i class="bi bi-printer"></i>Print / PDF
    </button>
  </div>
</div>

<!-- ── Filter bar ──────────────────────────────────────────────────── -->
<div class="card no-print" style="border-radius:12px;margin-bottom:14px;">
  <div class="card-body" style="padding:10px 16px;">
    <form method="get" style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
      <select name="month" class="mon-sel">
        <?php for ($m = 1; $m <= 12; $m++): ?>
          <option value="<?= $m ?>" <?= $month == $m ? 'selected' : '' ?>>
            <?= date('F', mktime(0, 0, 0, $m, 1)) ?>
          </option>
        <?php endfor; ?>
      </select>
      <select name="year" class="mon-sel" style="width:86px;">
        <?php for ($y = date('Y'); $y >= date('Y') - 3; $y--): ?>
          <option value="<?= $y ?>" <?= $year == $y ? 'selected' : '' ?>><?= $y ?></option>
        <?php endfor; ?>
      </select>
      <button type="submit" class="tb-btn tb-btn-primary" style="padding:7px 16px;">View</button>
    </form>
  </div>
</div>

<!-- ── KPI summary ─────────────────────────────────────────────────── -->
<div class="kpi-row no-print">
  <div class="kpi">
    <div class="kpi-label">Total Staff</div>
    <div class="kpi-val" style="color:var(--text);"><?= count($report) ?></div>
  </div>
  <div class="kpi">
    <div class="kpi-label">Avg Attendance</div>
    <div class="kpi-val" style="color:<?= $avgPct >= 80 ? '#16a34a' : ($avgPct >= 50 ? '#d97706' : '#dc2626') ?>;">
      <?= $avgPct ?>%
    </div>
  </div>
  <div class="kpi">
    <div class="kpi-label">Total Present</div>
    <div class="kpi-val" style="color:#16a34a;"><?= $totalPresent ?></div>
  </div>
  <div class="kpi">
    <div class="kpi-label">Total Absent</div>
    <div class="kpi-val" style="color:#dc2626;"><?= $totalAbsent ?></div>
  </div>
  <div class="kpi">
    <div class="kpi-label">On Leave</div>
    <div class="kpi-val" style="color:#2563eb;"><?= $totalLeave ?></div>
  </div>
</div>

<!-- ── Report table ────────────────────────────────────────────────── -->
<!-- Print header (shown only on print) -->
<div style="display:none;" class="print-only">
  <div
    style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:18px;padding-bottom:14px;border-bottom:2px solid #0c1a3a;">
    <div>
      <div style="font-size:20px;font-weight:900;color:#0c1a3a;letter-spacing:.5px;">BANDHAN HOSPITAL</div>
      <div style="font-size:11px;color:#64748b;margin-top:2px;">30/1 P.L.K. Maitra Road, Krishnagar, Nadia – 741101
      </div>
    </div>
    <div style="text-align:right;">
      <div style="font-size:14px;font-weight:700;color:#0c1a3a;">Attendance Report</div>
      <div style="font-size:12px;color:#64748b;"><?= $monthLabel ?> &mdash; <?= count($report) ?> staff</div>
      <div style="font-size:11px;color:#94a3b8;">Generated: <?= date('d M Y, H:i') ?></div>
    </div>
  </div>
</div>
<style>
  @media print {
    .print-only {
      display: block !important;
    }
  }
</style>

<div class="card" style="border-radius:12px;overflow:hidden;">
  <!-- Table header -->
  <div
    style="padding:14px 18px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;">
    <span style="font-size:14px;font-weight:600;"><?= $monthLabel ?> — Attendance Summary</span>
    <span style="font-size:12.5px;color:var(--muted);">Working days: <?= $workingDays ?></span>
  </div>

  <?php if (empty($report)): ?>
    <div style="padding:60px 24px;text-align:center;color:var(--muted);">
      <i class="bi bi-calendar-x" style="font-size:40px;opacity:.2;display:block;margin-bottom:12px;"></i>
      <div style="font-size:14px;">No attendance data for <?= $monthLabel ?>.</div>
    </div>
  <?php else: ?>
    <div style="overflow-x:auto;">
      <table class="rpt-tbl">
        <thead>
          <tr>
            <th style="padding-left:18px;">Staff</th>
            <th>Department</th>
            <th style="text-align:center;">Present</th>
            <th style="text-align:center;">Half Day</th>
            <th style="text-align:center;">Leave</th>
            <th style="text-align:center;">Absent</th>
            <th>Attendance</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($grouped as $dept => $rows): ?>

            <!-- Department separator -->
            <tr>
              <td colspan="7" style="padding:0;">
                <div class="dept-hdr">
                  <i class="bi bi-building" style="font-size:11px;opacity:.7;"></i>
                  <?= esc($dept) ?>
                  <span class="dept-count"><?= count($rows) ?></span>
                </div>
              </td>
            </tr>

            <?php foreach ($rows as $r):
              $effective = $r['present'] + ($r['half_day'] * 0.5);
              $pct = $workingDays > 0 ? round($effective / $workingDays * 100) : 0;
              $barColor = $pct >= 80 ? '#16a34a' : ($pct >= 50 ? '#d97706' : '#dc2626');
              ?>
              <tr>
                <!-- Staff -->
                <td style="padding-left:18px;">
                  <div style="font-size:14px;font-weight:600;line-height:1.25;"><?= esc($r['name']) ?></div>
                  <div class="sid"><?= esc($r['staff_id']) ?></div>
                </td>

                <!-- Dept (redundant but useful for print) -->
                <td style="font-size:13px;color:var(--muted);"><?= esc($r['department']) ?></td>

                <!-- Present -->
                <td style="text-align:center;">
                  <span class="chip <?= $r['present'] > 0 ? 'chip-P' : 'chip-0' ?>">
                    <?= $r['present'] ?>
                  </span>
                </td>

                <!-- Half Day -->
                <td style="text-align:center;">
                  <span class="chip <?= $r['half_day'] > 0 ? 'chip-H' : 'chip-0' ?>">
                    <?= $r['half_day'] ?>
                  </span>
                </td>

                <!-- Leave -->
                <td style="text-align:center;">
                  <span class="chip <?= $r['leave'] > 0 ? 'chip-L' : 'chip-0' ?>">
                    <?= $r['leave'] ?>
                  </span>
                </td>

                <!-- Absent -->
                <td style="text-align:center;">
                  <span class="chip <?= $r['absent'] > 0 ? 'chip-A' : 'chip-0' ?>">
                    <?= $r['absent'] ?>
                  </span>
                </td>

                <!-- Attendance % with progress bar -->
                <td>
                  <div class="prog-wrap">
                    <div class="prog-bar-bg">
                      <div class="prog-fill" style="width:<?= $pct ?>%;background:<?= $barColor ?>;"></div>
                    </div>
                    <span class="pct-label" style="color:<?= $barColor ?>;"><?= $pct ?>%</span>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>

          <?php endforeach; ?>
        </tbody>

        <!-- Overall footer -->
        <tfoot>
          <tr style="background:var(--subtle);border-top:1.5px solid var(--border);">
            <td style="padding:12px 18px;font-weight:700;font-size:13.5px;" colspan="2">
              Overall — <?= count($report) ?> Staff
            </td>
            <td style="text-align:center;font-weight:700;color:#16a34a;"><?= $totalPresent ?></td>
            <td style="text-align:center;font-weight:700;color:#854d0e;"><?= $totalHalf ?></td>
            <td style="text-align:center;font-weight:700;color:#2563eb;"><?= $totalLeave ?></td>
            <td style="text-align:center;font-weight:700;color:#dc2626;"><?= $totalAbsent ?></td>
            <td>
              <div class="prog-wrap">
                <div class="prog-bar-bg">
                  <div class="prog-fill"
                    style="width:<?= $avgPct ?>%;background:<?= $avgPct >= 80 ? '#16a34a' : ($avgPct >= 50 ? '#d97706' : '#dc2626') ?>;">
                  </div>
                </div>
                <span class="pct-label"
                  style="font-weight:700;color:<?= $avgPct >= 80 ? '#16a34a' : ($avgPct >= 50 ? '#d97706' : '#dc2626') ?>;">
                  <?= $avgPct ?>%
                </span>
              </div>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  <?php endif; ?>
</div>

<!-- Print footer -->
<div class="print-only" style="display:none;margin-top:32px;padding-top:12px;border-top:1px solid #e2e5ef;
     display:flex;justify-content:space-between;font-size:10px;color:#94a3b8;">
  <span>Bandhan Hospital — Confidential</span>
  <span>Printed: <?= date('d M Y, H:i') ?></span>
</div>

<?= $this->endSection() ?>