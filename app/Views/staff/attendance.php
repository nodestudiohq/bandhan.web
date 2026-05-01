<?= $this->extend('layouts/main') ?>
<?= $this->section('head') ?>
<style>
  /* ── Scroll container ─────────────────────────────── */
  .att-scroll {
    overflow: auto;
    max-height: 74vh;
    border-radius: 12px;
    border: 1px solid var(--border);
  }

  /* ── Table ────────────────────────────────────────── */
  .att-tbl {
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
    font-size: 13px;
  }

  .att-tbl th,
  .att-tbl td {
    white-space: nowrap;
  }

  /* Sticky header row */
  .att-tbl thead th {
    position: sticky;
    top: 0;
    z-index: 10;
    background: var(--subtle);
    border-bottom: 1.5px solid var(--border);
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: var(--muted);
    padding: 9px 6px;
    text-align: center;
  }

  .att-tbl thead th:first-child {
    text-align: left;
    padding-left: 14px;
    position: sticky;
    left: 0;
    z-index: 20;
    background: var(--subtle);
  }

  /* Sticky first column (staff name) */
  .att-tbl td:first-child {
    position: sticky;
    left: 0;
    z-index: 5;
    background: var(--surf);
    border-right: 1.5px solid var(--border);
    min-width: 200px;
    max-width: 200px;
    padding: 10px 12px !important;
  }

  .att-tbl tr:hover td:first-child {
    background: var(--subtle);
  }

  /* Department group header row */
  .dept-row td {
    position: sticky;
    left: 0;
    z-index: 6;
    background: linear-gradient(90deg, #eef1ff 0%, var(--subtle) 100%);
    border-top: 1.5px solid var(--border);
    border-bottom: 1px solid var(--border);
    padding: 7px 14px !important;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--indigo);
    white-space: nowrap;
  }

  .dept-row td .dept-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(59, 79, 216, .12);
    color: var(--indigo);
    border-radius: 99px;
    padding: 1px 8px;
    font-size: 10px;
    font-weight: 700;
    margin-left: 7px;
  }

  /* Fill remaining columns of dept header with same bg */
  .dept-row .dept-filler {
    background: linear-gradient(90deg, var(--subtle) 0%, #f8faff 100%);
    border-top: 1.5px solid var(--border);
    border-bottom: 1px solid var(--border);
  }

  /* Day cells */
  .att-cell {
    width: 52px;
    min-width: 52px;
    padding: 4px 3px !important;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    border-bottom: 1px solid var(--border);
    transition: background .1s;
  }

  .att-cell:hover {
    background: rgba(59, 79, 216, .06) !important;
  }

  .att-tbl tbody tr:last-child td {
    border-bottom: none;
  }

  /* Column highlights */
  .col-today {
    background: rgba(59, 79, 216, .04) !important;
  }

  .col-weekend {
    background: rgba(100, 116, 139, .04) !important;
  }

  .th-today {
    color: var(--indigo) !important;
  }

  .th-weekend {
    color: #94a3b8 !important;
  }

  /* Status badges */
  .ab {
    display: inline-block;
    border-radius: 5px;
    font-size: 10px;
    font-weight: 700;
    padding: 2px 5px;
    line-height: 1.3;
    letter-spacing: .3px;
  }

  .ab-P {
    background: #dcfce7;
    color: #166534;
  }

  .ab-A {
    background: #fef2f2;
    color: #dc2626;
  }

  .ab-H {
    background: #fef9c3;
    color: #854d0e;
  }

  .ab-S {
    background: #fff7ed;
    color: #c2410c;
  }

  .ab-L {
    background: #eff6ff;
    color: #1d4ed8;
  }

  .ab-WO {
    background: #f1f5f9;
    color: #64748b;
  }

  .ab-HO {
    background: #faf5ff;
    color: #7e22ce;
  }

  .ab-em {
    background: transparent;
    color: #d1d5db;
    border: 1px dashed #e2e5ef;
  }

  .ab-manual {
    box-shadow: 0 0 0 1.5px #f59e0b;
  }

  /* Hours sub-label */
  .att-hrs {
    display: block;
    font-size: 9px;
    color: var(--muted);
    margin-top: 1px;
    font-family: 'DM Mono', monospace;
  }

  /* Staff name cell content */
  .sn-name {
    font-size: 13px;
    font-weight: 600;
    line-height: 1.25;
    color: var(--text);
  }

  .sn-id {
    font-size: 11px;
    font-weight: 600;
    color: var(--indigo);
    margin-top: 1px;
  }

  /* Summary cell */
  .sum-cell {
    min-width: 80px;
    padding: 5px 8px !important;
    font-size: 11px;
    border-bottom: 1px solid var(--border);
    border-left: 1.5px solid var(--border);
    background: var(--subtle) !important;
  }

  .sum-chip {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    padding: 1px 6px;
    border-radius: 99px;
    font-size: 10px;
    font-weight: 700;
    margin: 1px 1px;
  }

  .sc-P {
    background: #dcfce7;
    color: #166534;
  }

  .sc-A {
    background: #fef2f2;
    color: #dc2626;
  }

  .sc-H {
    background: #fef9c3;
    color: #854d0e;
  }

  .sc-L {
    background: #eff6ff;
    color: #1d4ed8;
  }

  /* Toolbar buttons */
  .tb-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 13px;
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

  /* Month selector */
  .mon-sel {
    padding: 6px 10px;
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

  /* Legend pills */
  .legend-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: var(--muted);
  }

  .legend-dot {
    width: 18px;
    height: 16px;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 9.5px;
    font-weight: 700;
  }

  /* Modal polish */
  .punch-log-entry {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 12px;
    border-radius: 8px;
    border: 1px solid var(--border);
    margin-bottom: 6px;
    background: var(--subtle);
    font-size: 13px;
  }

  .punch-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    flex-shrink: 0;
  }

  .punch-dot-in {
    background: #16a34a;
  }

  .punch-dot-out {
    background: #dc2626;
  }

  .status-radio-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 7px;
  }

  .status-radio-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    border-radius: 8px;
    cursor: pointer;
    border: 1.5px solid var(--border);
    background: var(--surf);
    transition: border-color .12s, background .12s;
  }

  .status-radio-btn:has(input:checked) {
    border-color: var(--indigo);
    background: rgba(59, 79, 216, .06);
  }

  .status-radio-btn input {
    display: none;
  }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<?php
$today = date('Y-m-d');
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$monthLabel = date('F Y', mktime(0, 0, 0, $month, 1, $year));

// Status meta: badge text, CSS class, label
$statusMeta = [
  'present' => ['P', 'ab-P', 'Present'],
  'absent' => ['A', 'ab-A', 'Absent'],
  'half_day' => ['H', 'ab-H', 'Half Day'],
  'short' => ['S', 'ab-S', 'Short'],
  'leave' => ['L', 'ab-L', 'Leave'],
  'week_off' => ['WO', 'ab-WO', 'Week Off'],
  'holiday' => ['HO', 'ab-HO', 'Holiday'],
];

// Group staff by department
$grouped = [];
foreach ($staff as $s) {
  $grouped[$s['department']][] = $s;
}
ksort($grouped);

$prevMonth = $month == 1 ? 12 : $month - 1;
$prevYear = $month == 1 ? $year - 1 : $year;
$nextMonth = $month == 12 ? 1 : $month + 1;
$nextYear = $month == 12 ? $year + 1 : $year;
?>

<!-- ── Header ──────────────────────────────────────────────────────── -->
<div style="display:flex;flex-wrap:wrap;justify-content:space-between;align-items:center;gap:12px;margin-bottom:16px;">
  <div>
    <h5 style="font-size:17px;font-weight:700;margin-bottom:2px;">Attendance</h5>
    <span style="font-size:13px;color:var(--muted);"><?= $monthLabel ?> &mdash; <?= count($staff) ?> staff in
      <?= count($grouped) ?> departments</span>
  </div>
  <div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;">

    <!-- Month nav -->
    <a href="?month=<?= $prevMonth ?>&year=<?= $prevYear ?>" class="tb-btn" style="padding:7px 10px;">
      <i class="bi bi-chevron-left"></i>
    </a>
    <form method="get" style="display:flex;gap:6px;">
      <select name="month" class="mon-sel" onchange="this.form.submit()">
        <?php for ($m = 1; $m <= 12; $m++): ?>
          <option value="<?= $m ?>" <?= $m == $month ? 'selected' : '' ?>><?= date('F', mktime(0, 0, 0, $m, 1)) ?></option>
        <?php endfor; ?>
      </select>
      <select name="year" class="mon-sel" style="width:84px;" onchange="this.form.submit()">
        <?php for ($y = date('Y'); $y >= date('Y') - 3; $y--): ?>
          <option value="<?= $y ?>" <?= $y == $year ? 'selected' : '' ?>><?= $y ?></option>
        <?php endfor; ?>
      </select>
    </form>
    <a href="?month=<?= $nextMonth ?>&year=<?= $nextYear ?>" class="tb-btn" style="padding:7px 10px;">
      <i class="bi bi-chevron-right"></i>
    </a>

    <div style="width:1px;height:24px;background:var(--border);margin:0 2px;"></div>

    <!-- Recompute -->
    <form method="post" action="<?= base_url('attendance/recompute') ?>">
      <?= csrf_field() ?>
      <input type="hidden" name="month" value="<?= $month ?>">
      <input type="hidden" name="year" value="<?= $year ?>">
      <button type="submit" class="tb-btn">
        <i class="bi bi-arrow-clockwise"></i>Recompute
      </button>
    </form>

    <a href="<?= base_url('attendance/report?month=' . $month . '&year=' . $year) ?>" class="tb-btn">
      <i class="bi bi-table"></i>Report
    </a>

  </div>
</div>

<!-- ── Legend ──────────────────────────────────────────────────────── -->
<div style="display:flex;flex-wrap:wrap;gap:12px;margin-bottom:14px;align-items:center;">
  <?php foreach ($statusMeta as $key => [$code, $cls, $label]): ?>
    <span class="legend-pill">
      <span class="legend-dot <?= $cls ?>"><?= $code ?></span><?= $label ?>
    </span>
  <?php endforeach; ?>
  <span class="legend-pill" style="margin-left:4px;">
    <span class="legend-dot ab-em" style="border:1px dashed #d1d5db;">·</span>Future
  </span>
  <span style="color:var(--muted);font-size:12px;margin-left:4px;">
    <span
      style="display:inline-block;width:14px;height:14px;border-radius:3px;box-shadow:0 0 0 1.5px #f59e0b;background:#fef9c3;vertical-align:middle;margin-right:3px;"></span>Manual
  </span>
  <span style="color:var(--muted);font-size:12px;margin-left:auto;">Click any cell to edit</span>
</div>

<!-- ── Calendar grid ───────────────────────────────────────────────── -->
<div class="att-scroll">
  <table class="att-tbl">
    <thead>
      <tr>
        <th style="min-width:200px;text-align:left;padding-left:14px;">Staff</th>
        <?php for ($d = 1; $d <= $daysInMonth; $d++):
          $ds = sprintf('%04d-%02d-%02d', $year, $month, $d);
          $iso = (int) date('N', strtotime($ds));
          $isWknd = $iso >= 6;
          $isTdy = $ds === $today;
          ?>
          <th class="<?= $isTdy ? 'th-today' : ($isWknd ? 'th-weekend' : '') ?>"
            style="<?= $isTdy ? 'border-bottom:2px solid var(--indigo);' : '' ?>">
            <div><?= $d ?></div>
            <div style="font-size:9px;font-weight:500;letter-spacing:0;"><?= date('D', strtotime($ds)) ?></div>
          </th>
        <?php endfor; ?>
        <th style="min-width:90px;text-align:center;border-left:1.5px solid var(--border);">Summary</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($staff)): ?>
        <tr>
          <td colspan="<?= $daysInMonth + 2 ?>" style="text-align:center;padding:60px 0;color:var(--muted);">
            <i class="bi bi-people" style="font-size:36px;opacity:.2;display:block;margin-bottom:10px;"></i>
            No staff found.
          </td>
        </tr>
      <?php endif; ?>

      <?php foreach ($grouped as $deptName => $deptStaff): ?>

        <!-- ── Department group header ─────────────────────────── -->
        <tr class="dept-row">
          <td colspan="1">
            <i class="bi bi-building" style="font-size:11px;margin-right:5px;opacity:.7;"></i>
            <?= esc($deptName) ?>
            <span class="dept-count"><?= count($deptStaff) ?></span>
          </td>
          <?php for ($d = 1; $d <= $daysInMonth; $d++): ?>
            <td class="dept-filler"></td>
          <?php endfor; ?>
          <td class="dept-filler" style="border-left:1.5px solid var(--border);"></td>
        </tr>

        <!-- ── Staff rows for this department ─────────────────── -->
        <?php foreach ($deptStaff as $s):
          $attRow = $grid[$s['id']] ?? [];
          $woIso = \App\Models\AttendanceModel::dayNameToIso($s['weekly_off'] ?? 'Sunday');
          $pCount = $aCount = $hCount = $lCount = $totalMins = 0;
          ?>
          <tr>
            <!-- Sticky name cell -->
            <td>
              <div class="sn-name"><?= esc($s['name']) ?></div>
              <div class="sn-id"><?= esc($s['staff_id']) ?></div>
            </td>

            <!-- Day cells -->
            <?php for ($d = 1; $d <= $daysInMonth; $d++):
              $ds = sprintf('%04d-%02d-%02d', $year, $month, $d);
              $iso = (int) date('N', strtotime($ds));
              $isWO = $iso === $woIso;
              $isTdy = $ds === $today;
              $isFut = $ds > $today;
              $att = $attRow[$ds] ?? null;

              if ($isFut && !$att) {
                $badge = '·';
                $cls = 'ab-em';
                $hrs = '';
              } elseif ($isWO && !$att) {
                $badge = 'WO';
                $cls = 'ab-WO';
                $hrs = '';
              } elseif (!$att) {
                $badge = 'A';
                $cls = 'ab-A';
                $hrs = '';
              } else {
                $st = $att['is_manual'] ? ($att['manual_status'] ?? $att['status']) : $att['status'];
                [$badge, $cls] = [$statusMeta[$st][0] ?? '?', $statusMeta[$st][1] ?? 'ab-em'];
                $mins = (int) ($att['work_minutes'] ?? 0);
                $hrs = $mins > 0 ? \App\Models\AttendanceModel::formatMinutes($mins) : '';
                if ($st === 'present')
                  $pCount++;
                if ($st === 'absent')
                  $aCount++;
                if ($st === 'half_day')
                  $hCount++;
                if ($st === 'leave')
                  $lCount++;
                $totalMins += $mins;
              }

              $colCls = $isTdy ? 'col-today' : ($isWO ? 'col-weekend' : '');
              $manual = $att && $att['is_manual'];

              $tip = esc($s['name']) . ' — ' . $ds;
              if ($att && $att['first_in'])
                $tip .= ' | IN: ' . date('H:i', strtotime($att['first_in']));
              if ($att && $att['last_out'])
                $tip .= ' | OUT: ' . date('H:i', strtotime($att['last_out']));
              ?>
              <td class="att-cell <?= $colCls ?>" title="<?= esc($tip) ?>"
                onclick="openEdit(<?= $s['id'] ?>, '<?= esc(addslashes($s['name'])) ?>', '<?= $ds ?>')">
                <span class="ab <?= $cls ?><?= $manual ? ' ab-manual' : '' ?>"><?= $badge ?></span>
                <?php if ($hrs): ?>
                  <span class="att-hrs"><?= $hrs ?></span>
                <?php endif; ?>
              </td>
            <?php endfor; ?>

            <!-- Summary -->
            <td class="sum-cell">
              <span class="sum-chip sc-P"><?= $pCount ?>P</span>
              <span class="sum-chip sc-A"><?= $aCount ?>A</span>
              <?php if ($hCount): ?><span class="sum-chip sc-H"><?= $hCount ?>H</span><?php endif; ?>
              <?php if ($lCount): ?><span class="sum-chip sc-L"><?= $lCount ?>L</span><?php endif; ?>
              <?php if ($totalMins > 0): ?>
                <div class="att-hrs" style="margin-top:3px;">
                  <?= \App\Models\AttendanceModel::formatMinutes($totalMins) ?>
                </div>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- ── Edit Modal ──────────────────────────────────────────────────── -->
<div id="editModal" style="display:none;position:fixed;inset:0;z-index:9999;
     background:rgba(0,0,0,.35);backdrop-filter:blur(3px);
     align-items:center;justify-content:center;">
  <div style="background:var(--surf);border-radius:14px;width:100%;max-width:460px;
              border:1px solid var(--border);box-shadow:0 20px 60px rgba(0,0,0,.15);
              margin:0 16px;max-height:92vh;overflow-y:auto;">
    <form method="post" action="<?= base_url('attendance/manualSet') ?>">
      <?= csrf_field() ?>
      <input type="hidden" name="staff_id" id="editStaffId">
      <input type="hidden" name="date" id="editDate">
      <input type="hidden" name="month" value="<?= $month ?>">
      <input type="hidden" name="year" value="<?= $year ?>">

      <!-- Modal header -->
      <div style="padding:18px 20px;border-bottom:1px solid var(--border);
                  display:flex;justify-content:space-between;align-items:center;">
        <div>
          <div style="font-size:15px;font-weight:700;" id="editName"></div>
          <div style="font-size:12.5px;color:var(--muted);margin-top:2px;" id="editDateLabel"></div>
        </div>
        <button type="button" onclick="closeModal()"
          style="width:30px;height:30px;border-radius:7px;border:1px solid var(--border);
                       background:var(--surf);cursor:pointer;display:flex;align-items:center;justify-content:center;color:var(--muted);">
          <i class="bi bi-x" style="font-size:16px;"></i>
        </button>
      </div>

      <!-- Punch log -->
      <div style="padding:16px 20px 0;">
        <div
          style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:var(--muted);margin-bottom:8px;">
          Punch Log
        </div>
        <div id="punchLogArea">
          <div style="padding:12px;text-align:center;color:var(--muted);font-size:13px;">Loading…</div>
        </div>
      </div>

      <!-- Status override -->
      <div style="padding:16px 20px 0;">
        <div
          style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:var(--muted);margin-bottom:8px;">
          Override Status <span
            style="background:#fef9c3;color:#92400e;padding:2px 8px;border-radius:5px;font-size:10px;font-weight:600;text-transform:none;letter-spacing:0;">Manual</span>
        </div>
        <div class="status-radio-grid" id="statusBtns">
          <?php foreach ($statusMeta as $key => [$code, $cls, $label]): ?>
            <label class="status-radio-btn">
              <input type="radio" name="status" value="<?= $key ?>">
              <span class="ab <?= $cls ?>"><?= $code ?></span>
              <span style="font-size:13px;font-weight:500;"><?= $label ?></span>
            </label>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Note -->
      <div style="padding:14px 20px;">
        <div
          style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:var(--muted);margin-bottom:6px;">
          Note (optional)</div>
        <input type="text" name="note" id="editNote" style="width:100%;padding:9px 12px;border:1px solid var(--border);border-radius:8px;
                      font-size:13.5px;background:var(--surf);color:var(--text);outline:none;"
          placeholder="Reason for override…">
      </div>

      <!-- Footer -->
      <div style="padding:14px 20px;border-top:1px solid var(--border);
                  display:flex;justify-content:space-between;align-items:center;gap:10px;">
        <button type="button" onclick="revertToAuto()" style="display:flex;align-items:center;gap:6px;padding:8px 13px;
                       border-radius:8px;border:1px solid var(--border);background:var(--surf);
                       font-size:13px;color:var(--muted);cursor:pointer;">
          <i class="bi bi-arrow-clockwise"></i>Revert to Auto
        </button>
        <div style="display:flex;gap:8px;">
          <button type="button" onclick="closeModal()" style="padding:8px 16px;border-radius:8px;border:1px solid var(--border);
                         background:var(--surf);font-size:13px;color:var(--muted);cursor:pointer;">
            Cancel
          </button>
          <button type="submit" style="padding:8px 18px;border-radius:8px;background:var(--indigo);
                         color:#fff;border:none;font-size:13px;font-weight:600;cursor:pointer;">
            <i class="bi bi-check-lg me-1"></i>Save
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Revert form -->
<form method="post" action="<?= base_url('attendance/revertAuto') ?>" id="revertForm" style="display:none;">
  <?= csrf_field() ?>
  <input type="hidden" name="staff_id" id="revertStaffId">
  <input type="hidden" name="date" id="revertDate">
  <input type="hidden" name="month" value="<?= $month ?>">
  <input type="hidden" name="year" value="<?= $year ?>">
</form>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
  const modal = document.getElementById('editModal');

  function openEdit(staffId, staffName, date) {
    document.getElementById('editStaffId').value = staffId;
    document.getElementById('editDate').value = date;
    document.getElementById('revertStaffId').value = staffId;
    document.getElementById('revertDate').value = date;
    document.getElementById('editName').textContent = staffName;
    document.getElementById('editDateLabel').textContent = date;
    document.getElementById('editNote').value = '';
    document.querySelectorAll('#statusBtns input').forEach(r => r.checked = false);

    // Load punch log
    const area = document.getElementById('punchLogArea');
    area.innerHTML = '<div style="padding:12px;text-align:center;color:var(--muted);font-size:13px;">Loading…</div>';

    fetch('<?= base_url('attendance/punchLog') ?>?staff_id=' + staffId + '&date=' + date)
      .then(r => r.json())
      .then(data => {
        if (data.punches && data.punches.length) {
          let html = '';
          data.punches.forEach(p => {
            const isIn = p.type === 'in';
            html += `<div class="punch-log-entry">
            <span class="punch-dot ${isIn ? 'punch-dot-in' : 'punch-dot-out'}"></span>
            <span style="font-weight:600;font-size:12px;text-transform:uppercase;color:${isIn ? '#166534' : '#dc2626'};">${p.type}</span>
            <span style="font-family:'DM Mono',monospace;font-weight:500;">${p.time}</span>
            <span style="color:var(--muted);font-size:12px;margin-left:auto;">${p.source}</span>
          </div>`;
          });
          if (data.work_hours) {
            html += `<div style="font-size:12.5px;font-weight:600;color:var(--indigo);padding:6px 0 0;">
            <i class="bi bi-clock" style="margin-right:5px;"></i>${data.work_hours} worked
          </div>`;
          }
          area.innerHTML = html;
        } else {
          area.innerHTML = '<div style="padding:10px 12px;background:var(--subtle);border-radius:8px;font-size:13px;color:var(--muted);">No punch records for this date.</div>';
        }
        if (data.status) {
          const r = document.querySelector(`#statusBtns input[value="${data.status}"]`);
          if (r) r.checked = true;
        }
        if (data.note) document.getElementById('editNote').value = data.note;
      })
      .catch(() => {
        area.innerHTML = '<div style="padding:10px 12px;background:#fef2f2;border-radius:8px;font-size:13px;color:#dc2626;">Could not load punch log.</div>';
      });

    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    modal.style.display = 'none';
    document.body.style.overflow = '';
  }

  function revertToAuto() {
    if (confirm('Revert to auto-computed status from punch logs?')) {
      document.getElementById('revertForm').submit();
    }
  }

  // Close on backdrop click
  modal.addEventListener('click', e => {
    if (e.target === modal) closeModal();
  });
  // Close on Escape
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeModal();
  });
</script>
<?= $this->endSection() ?>