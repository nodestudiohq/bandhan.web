<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
$monthLabel = date('F Y');
$today = date('D, d M Y');
?>

<!-- ── Page heading ──────────────────────────────────────────────── -->
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-semibold mb-0">Dashboard</h4>
    <small class="text-muted"><?= $today ?> &mdash; <?= $monthLabel ?></small>
  </div>
  <div class="d-flex gap-2">
    <a href="<?= base_url('punch') ?>" class="btn btn-primary btn-sm">
      <i class="bi bi-fingerprint me-1"></i>Punch Station
    </a>
    <a href="<?= base_url('invoice/create') ?>" class="btn btn-outline-primary btn-sm">
      <i class="bi bi-plus-lg me-1"></i>New Invoice
    </a>
  </div>
</div>

<!-- ── ROW 1: KPI cards ───────────────────────────────────────────── -->
<div class="row g-3 mb-4">

  <!-- Total Staff -->
  <div class="col-6 col-md-3">
    <div class="card border-0 h-100">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <p class="text-muted small mb-1">Total Staff</p>
            <h3 class="fw-bold mb-0"><?= $totalStaff ?></h3>
            <small class="text-muted">Active employees</small>
          </div>
          <div class="bg-primary bg-opacity-10 rounded p-2">
            <i class="bi bi-people fs-5 text-primary"></i>
          </div>
        </div>
        <div class="mt-2 pt-2 border-top d-flex gap-2 small">
          <span class="text-success"><i class="bi bi-circle-fill me-1" style="font-size:.5rem"></i><?= $presentToday ?>
            present</span>
          <span class="text-danger"><i class="bi bi-circle-fill me-1" style="font-size:.5rem"></i><?= $absentToday ?>
            absent</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Today Attendance -->
  <div class="col-6 col-md-3">
    <div class="card border-0 h-100">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <p class="text-muted small mb-1">Present Today</p>
            <h3 class="fw-bold mb-0"><?= $presentToday ?></h3>
            <small class="text-muted">of <?= $totalStaff ?> staff</small>
          </div>
          <div class="bg-success bg-opacity-10 rounded p-2">
            <i class="bi bi-calendar-check fs-5 text-success"></i>
          </div>
        </div>
        <div class="mt-2">
          <div class="progress" style="height:5px;">
            <div class="progress-bar bg-success"
              style="width:<?= $totalStaff > 0 ? round($presentToday / $totalStaff * 100) : 0 ?>%"></div>
          </div>
          <small class="text-muted"><?= $totalStaff > 0 ? round($presentToday / $totalStaff * 100) : 0 ?>% attendance
            rate</small>
        </div>
      </div>
    </div>
  </div>

  <!-- Monthly Revenue -->
  <div class="col-6 col-md-3">
    <div class="card border-0 h-100">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <p class="text-muted small mb-1">Revenue <?= date('M') ?></p>
            <h3 class="fw-bold mb-0">₹<?= number_format($invoiceRevenue['total_collected'] / 1000, 1) ?>K</h3>
            <small class="text-muted">₹<?= number_format($invoiceRevenue['outstanding'] / 1000, 1) ?>K
              outstanding</small>
          </div>
          <div class="bg-warning bg-opacity-10 rounded p-2">
            <i class="bi bi-currency-rupee fs-5 text-warning"></i>
          </div>
        </div>
        <div class="mt-2 pt-2 border-top d-flex gap-2 small">
          <span class="text-success"><?= $invoiceRevenue['paid_count'] ?> paid</span>
          <span class="text-warning"><?= $invoiceRevenue['partial_count'] ?> partial</span>
          <span class="text-danger"><?= $invoiceRevenue['unpaid_count'] ?> unpaid</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Salary Disbursement -->
  <div class="col-6 col-md-3">
    <div class="card border-0 h-100">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <p class="text-muted small mb-1">Salary <?= date('M') ?></p>
            <h3 class="fw-bold mb-0">₹<?= number_format($salaryPayout / 1000, 1) ?>K</h3>
            <small class="text-muted">Net payout</small>
          </div>
          <div class="bg-info bg-opacity-10 rounded p-2">
            <i class="bi bi-cash-coin fs-5 text-info"></i>
          </div>
        </div>
        <div class="mt-2 pt-2 border-top d-flex gap-2 small flex-wrap">
          <?php if (($salarySummary['draft'] ?? 0) > 0): ?>
            <span class="text-secondary"><?= $salarySummary['draft'] ?> draft</span>
          <?php endif; ?>
          <?php if (($salarySummary['approved'] ?? 0) > 0): ?>
            <span class="text-info"><?= $salarySummary['approved'] ?> approved</span>
          <?php endif; ?>
          <span class="text-success"><?= $salarySummary['paid'] ?? 0 ?> paid</span>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- ── ROW 2: Revenue chart + Attendance week ─────────────────────── -->
<div class="row g-3 mb-4">

  <!-- Revenue trend (6 months) -->
  <div class="col-md-8">
    <div class="card border-0 h-100">
      <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
        <span class="fw-semibold">Revenue Trend (6 Months)</span>
        <a href="<?= base_url('invoice') ?>" class="btn btn-link btn-sm p-0 text-muted">View all</a>
      </div>
      <div class="card-body pb-2">
        <canvas id="revenueChart" height="110"></canvas>
      </div>
    </div>
  </div>

  <!-- Attendance 7-day bar -->
  <div class="col-md-4">
    <div class="card border-0 h-100">
      <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
        <span class="fw-semibold">Attendance (7 Days)</span>
        <a href="<?= base_url('attendance') ?>" class="btn btn-link btn-sm p-0 text-muted">Calendar</a>
      </div>
      <div class="card-body pb-2">
        <canvas id="attChart" height="170"></canvas>
      </div>
    </div>
  </div>

</div>

<!-- ── ROW 3: Dept attendance + Pending actions + Live punches ────── -->
<div class="row g-3 mb-4">

  <!-- Department attendance today -->
  <div class="col-md-5">
    <div class="card border-0 h-100">
      <div class="card-header bg-transparent fw-semibold">
        <i class="bi bi-building me-2 text-primary"></i>Department Attendance Today
      </div>
      <div class="card-body p-0">
        <?php if (empty($deptAttendance)): ?>
          <div class="text-center text-muted py-4 small">No attendance data yet today.</div>
        <?php else: ?>
          <div class="list-group list-group-flush">
            <?php foreach ($deptAttendance as $d): ?>
              <div class="list-group-item d-flex align-items-center gap-3 px-3 py-2">
                <div style="min-width:130px;font-size:.82rem;font-weight:600;
                            white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="<?= esc($d['dept']) ?>">
                  <?= esc($d['dept']) ?>
                </div>
                <div class="flex-grow-1">
                  <div class="progress" style="height:7px;">
                    <div
                      class="progress-bar <?= $d['pct'] >= 80 ? 'bg-success' : ($d['pct'] >= 50 ? 'bg-warning' : 'bg-danger') ?>"
                      style="width:<?= $d['pct'] ?>%"></div>
                  </div>
                </div>
                <div class="text-end" style="min-width:70px;font-size:.78rem;">
                  <span class="text-success fw-semibold"><?= $d['present'] ?></span>
                  <span class="text-muted"> / <?= $d['total'] ?></span>
                  <span class="text-muted ms-1">(<?= $d['pct'] ?>%)</span>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Pending actions -->
  <div class="col-md-3">
    <div class="card border-0 h-100">
      <div class="card-header bg-transparent fw-semibold">
        <i class="bi bi-exclamation-circle me-2 text-warning"></i>Pending Actions
      </div>
      <div class="card-body p-0">
        <div class="list-group list-group-flush">
          <?php
          $actions = [
            ['label' => 'Salary Drafts', 'count' => $pendingActions['salary_draft'], 'color' => 'secondary', 'url' => base_url('salary?status=draft'), 'icon' => 'bi-file-earmark'],
            ['label' => 'Awaiting Approve', 'count' => $pendingActions['salary_pending'], 'color' => 'warning', 'url' => base_url('salary?status=pending'), 'icon' => 'bi-hourglass-split'],
            ['label' => 'Approved, Unpaid', 'count' => $pendingActions['salary_approved'], 'color' => 'info', 'url' => base_url('salary?status=approved'), 'icon' => 'bi-check-circle'],
            ['label' => 'Salary On Hold', 'count' => $pendingActions['salary_held'], 'color' => 'danger', 'url' => base_url('salary?status=held'), 'icon' => 'bi-pause-circle'],
            ['label' => 'Unpaid Invoices', 'count' => $pendingActions['invoice_unpaid'], 'color' => 'danger', 'url' => base_url('invoice?status=unpaid'), 'icon' => 'bi-receipt'],
          ];
          ?>
          <?php foreach ($actions as $a):
            if ($a['count'] === 0)
              continue; ?>
            <a href="<?= $a['url'] ?>"
              class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-3 py-2">
              <span class="small"><i
                  class="bi <?= $a['icon'] ?> me-2 text-<?= $a['color'] ?>"></i><?= $a['label'] ?></span>
              <span class="badge bg-<?= $a['color'] ?> rounded-pill"><?= $a['count'] ?></span>
            </a>
          <?php endforeach; ?>
          <?php if (array_sum(array_column($actions, 'count')) === 0): ?>
            <div class="text-center text-muted py-4 small">
              <i class="bi bi-check-circle-fill text-success fs-4 d-block mb-2"></i>
              All clear — nothing pending!
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Live punch feed -->
  <div class="col-md-4">
    <div class="card border-0 h-100">
      <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
        <span class="fw-semibold"><i class="bi bi-activity me-2 text-success"></i>Today's Punches</span>
        <a href="<?= base_url('attendance/punch') ?>" class="btn btn-link btn-sm p-0 text-muted">Station</a>
      </div>
      <div class="card-body p-0">
        <?php if (empty($recentPunches)): ?>
          <div class="text-center text-muted py-4 small">No punches recorded today.</div>
        <?php else: ?>
          <div class="list-group list-group-flush">
            <?php foreach ($recentPunches as $punch):
              $isIn = $punch['punch_type'] === 'in';
              $staffQ = (new \App\Models\StaffModel())->find($punch['staff_id']);
              $initials = $staffQ
                ? strtoupper(implode('', array_map(fn($w) => $w[0], explode(' ', trim($staffQ['name'])))))
                : '??';
              $initials = substr($initials, 0, 2);
              ?>
              <div class="list-group-item d-flex align-items-center gap-2 px-3 py-2">
                <div class="rounded-circle bg-<?= $isIn ? 'success' : 'danger' ?>-subtle
                             d-flex align-items-center justify-content-center fw-bold
                             text-<?= $isIn ? 'success' : 'danger' ?> flex-shrink-0"
                  style="width:32px;height:32px;font-size:.65rem;">
                  <?= esc($initials) ?>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                  <div class="fw-semibold text-truncate" style="font-size:.82rem;">
                    <?= esc($staffQ['name'] ?? 'Unknown') ?>
                  </div>
                  <small class="text-muted"><?= esc($staffQ['department'] ?? '') ?></small>
                </div>
                <div class="text-end flex-shrink-0">
                  <span class="badge bg-<?= $isIn ? 'success' : 'danger' ?>-subtle
                               text-<?= $isIn ? 'success' : 'danger' ?>" style="font-size:.68rem;">
                    <?= strtoupper($punch['punch_type']) ?>
                  </span>
                  <div class="text-muted" style="font-size:.68rem;">
                    <?= date('H:i', strtotime($punch['punched_at'])) ?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

</div>

<!-- ── ROW 4: Recent invoices + Staff breakdown ───────────────────── -->
<div class="row g-3">

  <!-- Recent Invoices -->
  <div class="col-md-8">
    <div class="card border-0">
      <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
        <span class="fw-semibold">Recent Invoices</span>
        <a href="<?= base_url('invoice') ?>" class="btn btn-link btn-sm p-0 text-muted">View all</a>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0" style="font-size:.85rem">
            <thead class="table-secondary">
              <tr>
                <th class="ps-3">Invoice</th>
                <th>Patient</th>
                <th>Date</th>
                <th class="text-end">Amount</th>
                <th class="text-end">Paid</th>
                <th>Status</th>
                <th class="pe-3"></th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($recentInvoices)): ?>
                <tr>
                  <td colspan="7" class="text-center text-muted py-4">No invoices yet.</td>
                </tr>
              <?php endif; ?>
              <?php foreach ($recentInvoices as $inv):
                $statCls = ['paid' => 'bg-success-subtle text-success', 'unpaid' => 'bg-danger-subtle text-danger', 'partial' => 'bg-warning-subtle text-warning'][$inv['status']] ?? 'bg-secondary-subtle text-secondary';
                ?>
                <tr>
                  <td class="ps-3 fw-semibold text-primary"><?= esc($inv['invoice_no']) ?></td>
                  <td><?= esc($inv['patient_name']) ?></td>
                  <td class="text-muted"><?= date('d M', strtotime($inv['invoice_date'])) ?></td>
                  <td class="text-end fw-semibold">₹<?= number_format($inv['total_amount'], 0) ?></td>
                  <td class="text-end text-success">₹<?= number_format($inv['paid_amount'], 0) ?></td>
                  <td><span class="badge <?= $statCls ?>"><?= ucfirst($inv['status']) ?></span></td>
                  <td class="pe-3">
                    <a href="<?= base_url('invoice/print/' . $inv['id']) ?>" target="_blank"
                      class="btn btn-sm btn-outline-secondary py-0">
                      <i class="bi bi-printer"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Staff by department -->
  <div class="col-md-4">
    <div class="card border-0 h-100">
      <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
        <span class="fw-semibold">Staff by Department</span>
        <a href="<?= base_url('staff') ?>" class="btn btn-link btn-sm p-0 text-muted">All staff</a>
      </div>
      <div class="card-body pb-2">
        <canvas id="deptChart" height="200"></canvas>
      </div>
    </div>
  </div>

</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
  // ── Shared config ────────────────────────────────────────────────────
  const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
  const gridColor = isDark ? 'rgba(255,255,255,.07)' : 'rgba(0,0,0,.06)';
  const textColor = isDark ? '#94a3b8' : '#6b7280';
  Chart.defaults.color = textColor;
  Chart.defaults.font.family = "'Segoe UI', Arial, sans-serif";
  Chart.defaults.font.size = 11;

  // ── Revenue trend chart ──────────────────────────────────────────────
  const revData = <?= json_encode($revenueTrend) ?>;
  new Chart(document.getElementById('revenueChart'), {
    type: 'bar',
    data: {
      labels: revData.map(r => r.label),
      datasets: [
        {
          label: 'Collected',
          data: revData.map(r => r.collected),
          backgroundColor: 'rgba(21,101,192,.75)',
          borderRadius: 4,
          order: 2,
        },
        {
          label: 'Billed',
          data: revData.map(r => r.billed),
          type: 'line',
          borderColor: '#f5c300',
          backgroundColor: 'rgba(245,195,0,.12)',
          borderWidth: 2,
          pointRadius: 4,
          pointBackgroundColor: '#f5c300',
          tension: .3,
          fill: true,
          order: 1,
        }
      ]
    },
    options: {
      responsive: true,
      interaction: { mode: 'index', intersect: false },
      plugins: {
        legend: { position: 'top', labels: { boxWidth: 12, padding: 16 } },
        tooltip: {
          callbacks: {
            label: ctx => ' ₹' + ctx.parsed.y.toLocaleString('en-IN')
          }
        }
      },
      scales: {
        x: { grid: { color: gridColor } },
        y: {
          grid: { color: gridColor },
          ticks: {
            callback: v => '₹' + (v >= 1000 ? (v / 1000).toFixed(0) + 'K' : v)
          }
        }
      }
    }
  });

  // ── 7-day attendance bar chart ───────────────────────────────────────
  const attData = <?= json_encode($weekAttendance) ?>;
  new Chart(document.getElementById('attChart'), {
    type: 'bar',
    data: {
      labels: attData.map(d => d.label),
      datasets: [
        { label: 'Present', data: attData.map(d => d.present), backgroundColor: 'rgba(22,163,74,.75)', borderRadius: 3 },
        { label: 'Half Day', data: attData.map(d => d.half_day), backgroundColor: 'rgba(234,179,8,.75)', borderRadius: 3 },
        { label: 'Absent', data: attData.map(d => d.absent), backgroundColor: 'rgba(220,38,38,.65)', borderRadius: 3 },
      ]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, padding: 10 } } },
      scales: {
        x: { stacked: true, grid: { display: false } },
        y: { stacked: true, grid: { color: gridColor }, ticks: { stepSize: 1 } }
      }
    }
  });

  // ── Staff by department donut ────────────────────────────────────────
  const deptData = <?= json_encode($deptBreakdown) ?>;
  const palette = [
    '#1565c0', '#0891b2', '#059669', '#d97706', '#dc2626',
    '#7c3aed', '#db2777', '#0d9488', '#65a30d', '#6b7280'
  ];
  new Chart(document.getElementById('deptChart'), {
    type: 'doughnut',
    data: {
      labels: deptData.map(d => d.department),
      datasets: [{
        data: deptData.map(d => d.count),
        backgroundColor: palette.slice(0, deptData.length),
        borderWidth: 2,
        borderColor: isDark ? '#1e293b' : '#fff',
      }]
    },
    options: {
      responsive: true,
      cutout: '62%',
      plugins: {
        legend: {
          position: 'right',
          labels: {
            boxWidth: 10, padding: 8, font: { size: 10 },
            generateLabels: chart => {
              const data = chart.data;
              return data.labels.map((label, i) => ({
                text: label.length > 18 ? label.substring(0, 18) + '…' : label,
                fillStyle: data.datasets[0].backgroundColor[i],
                hidden: false, index: i,
              }));
            }
          }
        },
        tooltip: {
          callbacks: {
            label: ctx => ` ${ctx.label}: ${ctx.parsed} staff`
          }
        }
      }
    }
  });
</script>
<?= $this->endSection() ?>