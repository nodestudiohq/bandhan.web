<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
$monthLabel = date('F Y', mktime(0, 0, 0, $filters['month'], 1, $filters['year']));
$statusMeta = [
  'draft' => ['Draft', '#64748b', '#f1f5f9'],
  'pending' => ['Pending', '#d97706', '#fffbeb'],
  'approved' => ['Approved', '#2563eb', '#eff6ff'],
  'paid' => ['Paid', '#16a34a', '#dcfce7'],
  'held' => ['Held', '#dc2626', '#fef2f2'],
];
?>

<style>
  /* ── KPI cards ─────────────────────────────────────── */
  .kpi-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 12px;
    margin-bottom: 18px;
  }

  @media(max-width:900px) {
    .kpi-grid {
      grid-template-columns: repeat(3, 1fr);
    }
  }

  @media(max-width:560px) {
    .kpi-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  .kpi {
    background: var(--surf);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 14px 16px;
    cursor: pointer;
    text-decoration: none;
    display: block;
    transition: box-shadow .15s, transform .1s;
  }

  .kpi:hover {
    box-shadow: 0 4px 16px rgba(0, 0, 0, .08);
    transform: translateY(-1px);
  }

  .kpi.active {
    border-width: 2px;
  }

  .kpi-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .6px;
    color: var(--muted);
    margin-bottom: 4px;
  }

  .kpi-val {
    font-size: 22px;
    font-weight: 700;
    line-height: 1;
  }

  .kpi-sub {
    font-size: 11.5px;
    color: var(--muted);
    margin-top: 3px;
  }

  /* ── Toolbar ───────────────────────────────────────── */
  .tb-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
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

  .tb-btn-success {
    background: #16a34a;
    color: #fff;
    border-color: #16a34a;
  }

  .tb-btn-success:hover {
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

  /* ── Table ─────────────────────────────────────────── */
  .sal-tbl {
    width: 100%;
    border-collapse: collapse;
  }

  .sal-tbl th {
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

  .sal-tbl td {
    padding: 13px 14px;
    border-bottom: 1px solid var(--border);
    font-size: 13.5px;
    vertical-align: middle;
  }

  .sal-tbl tbody tr:last-child td {
    border-bottom: none;
  }

  .sal-tbl tbody tr:hover td {
    background: var(--subtle);
  }

  .mono {
    font-family: 'DM Mono', monospace;
    font-size: 13px;
  }

  /* ── Status pills ──────────────────────────────────── */
  .stat-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 10px;
    border-radius: 99px;
    font-size: 12px;
    font-weight: 600;
  }

  .stat-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    flex-shrink: 0;
    background: currentColor;
  }

  /* ── Icon action buttons ───────────────────────────── */
  .act-icon {
    width: 30px;
    height: 30px;
    border-radius: 7px;
    border: 1px solid var(--border);
    background: transparent;
    color: var(--muted);
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    text-decoration: none;
    transition: background .12s, color .12s;
  }

  .act-icon:hover {
    background: var(--subtle);
    color: var(--text);
  }

  .act-icon-info:hover {
    background: #eff6ff;
    color: #2563eb;
    border-color: #93c5fd;
  }

  .act-icon-success:hover {
    background: #f0fdf4;
    color: #16a34a;
    border-color: #86efac;
  }

  .act-icon-danger:hover {
    background: #fef2f2;
    color: #dc2626;
    border-color: #fca5a5;
  }

  /* ── LOP highlight ─────────────────────────────────── */
  .lop-val {
    color: #dc2626;
    font-weight: 700;
  }

  /* ── Custom modal (no Bootstrap dependency) ────────── */
  .c-modal-bg {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(0, 0, 0, .35);
    backdrop-filter: blur(3px);
    align-items: center;
    justify-content: center;
  }

  .c-modal-bg.open {
    display: flex;
  }

  .c-modal {
    background: var(--surf);
    border-radius: 14px;
    width: 100%;
    max-width: 440px;
    border: 1px solid var(--border);
    box-shadow: 0 20px 60px rgba(0, 0, 0, .15);
    margin: 0 16px;
    max-height: 92vh;
    overflow-y: auto;
  }

  .c-modal-hdr {
    padding: 18px 20px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .c-modal-title {
    font-size: 15px;
    font-weight: 700;
  }

  .c-modal-body {
    padding: 18px 20px;
  }

  .c-modal-foot {
    padding: 14px 20px;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: flex-end;
    gap: 8px;
  }

  .c-close {
    width: 30px;
    height: 30px;
    border-radius: 7px;
    border: 1px solid var(--border);
    background: var(--surf);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--muted);
    font-size: 16px;
  }

  .c-close:hover {
    background: var(--subtle);
  }

  .fi {
    width: 100%;
    padding: 9px 12px;
    border: 1px solid var(--border);
    border-radius: 8px;
    font-size: 13.5px;
    color: var(--text);
    background: var(--surf);
    outline: none;
    font-family: 'DM Sans', sans-serif;
  }

  .fi:focus {
    border-color: var(--indigo);
    box-shadow: 0 0 0 3px rgba(59, 79, 216, .1);
  }

  textarea.fi {
    resize: vertical;
  }

  .fl {
    font-size: 12px;
    font-weight: 600;
    color: var(--muted);
    margin-bottom: 5px;
    display: block;
  }

  .fgroup {
    margin-bottom: 14px;
  }

  .fgroup:last-child {
    margin-bottom: 0;
  }

  /* ── Alert info strip ──────────────────────────────── */
  .info-strip {
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 13px;
    color: #1d4ed8;
    margin-bottom: 14px;
  }
</style>

<!-- ── Header ──────────────────────────────────────────────────────── -->
<div
  style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:18px;flex-wrap:wrap;gap:10px;">
  <div>
    <h5 style="font-size:17px;font-weight:700;margin-bottom:2px;">Salary</h5>
    <span style="font-size:13px;color:var(--muted);"><?= $monthLabel ?> &mdash; <?= count($salaries) ?> records</span>
  </div>
  <div style="display:flex;gap:8px;flex-wrap:wrap;">
    <a href="<?= base_url('salary/generate') ?>" class="tb-btn">
      <i class="bi bi-magic"></i>Generate
    </a>
    <form method="post" action="<?= base_url('salary/approve-all') ?>">
      <?= csrf_field() ?>
      <input type="hidden" name="month" value="<?= $filters['month'] ?>">
      <input type="hidden" name="year" value="<?= $filters['year'] ?>">
      <button type="submit" class="tb-btn"
        onclick="return confirm('Approve all draft/pending salaries for <?= $monthLabel ?>?')">
        <i class="bi bi-check-all"></i>Approve All
      </button>
    </form>
    <button onclick="openModal('disburseAllModal')" class="tb-btn tb-btn-success">
      <i class="bi bi-send"></i>Disburse All
    </button>
  </div>
</div>

<!-- ── KPI cards ───────────────────────────────────────────────────── -->
<div class="kpi-grid">
  <?php foreach ([
    ['draft', 'Draft', 'bi-file-earmark', '#64748b'],
    ['pending', 'Pending', 'bi-hourglass-split', '#d97706'],
    ['approved', 'Approved', 'bi-check-circle', '#2563eb'],
    ['paid', 'Paid', 'bi-cash-stack', '#16a34a'],
    ['held', 'Held', 'bi-pause-circle', '#dc2626'],
  ] as [$key, $label, $icon, $col]):
    $isActive = $filters['status'] === $key;
    $cnt = $summary[$key] ?? 0;
    ?>
    <a href="?month=<?= $filters['month'] ?>&year=<?= $filters['year'] ?>&status=<?= $key ?>"
      class="kpi <?= $isActive ? 'active' : '' ?>" style="<?= $isActive ? "border-color:{$col};" : '' ?>">
      <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:6px;">
        <div class="kpi-label"><?= $label ?></div>
        <i class="bi <?= $icon ?>" style="font-size:16px;color:<?= $col ?>;opacity:<?= $isActive ? 1 : .45 ?>;"></i>
      </div>
      <div class="kpi-val" style="color:<?= $col ?>;"><?= $cnt ?></div>
    </a>
  <?php endforeach; ?>

  <!-- Total payout card -->
  <div class="kpi" style="background:var(--indigo);border-color:var(--indigo);">
    <div class="kpi-label" style="color:rgba(255,255,255,.7);">Total Payout</div>
    <div class="kpi-val" style="color:#fff;font-size:18px;">
      ₹<?= number_format($total_salary / 1000, 1) ?>K
    </div>
    <div class="kpi-sub" style="color:rgba(255,255,255,.6);">
      ₹<?= number_format($total_salary, 0) ?>
    </div>
  </div>
</div>

<!-- ── Filter bar ───────────────────────────────────────────────────── -->
<div class="card mb-3" style="border-radius:12px;">
  <div class="card-body" style="padding:10px 16px;">
    <form method="get" style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
      <select name="month" class="mon-sel" onchange="this.form.submit()">
        <?php for ($m = 1; $m <= 12; $m++): ?>
          <option value="<?= $m ?>" <?= $filters['month'] == $m ? 'selected' : '' ?>>
            <?= date('F', mktime(0, 0, 0, $m, 1)) ?>
          </option>
        <?php endfor; ?>
      </select>
      <select name="year" class="mon-sel" style="width:84px;" onchange="this.form.submit()">
        <?php for ($y = date('Y'); $y >= date('Y') - 3; $y--): ?>
          <option value="<?= $y ?>" <?= $filters['year'] == $y ? 'selected' : '' ?>><?= $y ?></option>
        <?php endfor; ?>
      </select>
      <select name="status" class="mon-sel" onchange="this.form.submit()">
        <option value="">All Status</option>
        <?php foreach (['draft', 'pending', 'approved', 'paid', 'held'] as $s): ?>
          <option value="<?= $s ?>" <?= $filters['status'] === $s ? 'selected' : '' ?>>
            <?= ucfirst($s) ?>
          </option>
        <?php endforeach; ?>
      </select>
      <?php if (!empty($filters['status'])): ?>
        <a href="?month=<?= $filters['month'] ?>&year=<?= $filters['year'] ?>" class="tb-btn"
          style="padding:7px 12px;font-size:12.5px;">
          <i class="bi bi-x"></i>Clear
        </a>
      <?php endif; ?>
      <span style="margin-left:auto;font-size:12.5px;color:var(--muted);">
        <?= count($salaries) ?> records
      </span>
    </form>
  </div>
</div>

<!-- ── Table ────────────────────────────────────────────────────────── -->
<div class="card" style="border-radius:12px;overflow:hidden;">
  <?php if (empty($salaries)): ?>
    <div style="padding:60px 24px;text-align:center;color:var(--muted);">
      <i class="bi bi-cash-coin" style="font-size:40px;opacity:.2;display:block;margin-bottom:12px;"></i>
      <div style="font-size:14px;">
        No salary records for <?= $monthLabel ?>.
        <a href="<?= base_url('salary/generate') ?>" style="color:var(--indigo);">Generate now →</a>
      </div>
    </div>
  <?php else: ?>
    <div style="overflow-x:auto;">
      <table class="sal-tbl">
        <thead>
          <tr>
            <th style="padding-left:18px;">Staff</th>
            <th>Department</th>
            <th style="text-align:center;">Working</th>
            <th style="text-align:center;">Present</th>
            <th style="text-align:center;">LOP</th>
            <th style="text-align:right;">Gross</th>
            <th style="text-align:right;">Deductions</th>
            <th style="text-align:right;">Net Pay</th>
            <th>Status</th>
            <th style="text-align:right;padding-right:16px;width:130px;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($salaries as $s):
            $lopDays = $s['lop_override'] ?? $s['unpaid_leave_days'] ?? 0;
            [$statLabel, $statCol, $statBg] = $statusMeta[$s['payment_status']] ?? ['Unknown', '#94a3b8', '#f1f5f9'];
            ?>
            <tr>
              <td style="padding-left:18px;">
                <div style="font-size:14px;font-weight:600;"><?= esc($s['name']) ?></div>
                <div style="font-size:11.5px;color:var(--indigo);font-weight:600;font-family:'DM Mono',monospace;">
                  <?= esc($s['staff_code']) ?>
                </div>
              </td>
              <td style="font-size:13px;color:var(--muted);"><?= esc($s['department']) ?></td>
              <td style="text-align:center;color:var(--muted);"><?= $s['working_days'] ?></td>
              <td style="text-align:center;"><?= $s['present_days'] ?></td>
              <td style="text-align:center;">
                <?php if ($lopDays > 0): ?>
                  <span class="lop-val"><?= $lopDays ?></span>
                <?php else: ?>
                  <span style="color:var(--border);">—</span>
                <?php endif; ?>
              </td>
              <td style="text-align:right;" class="mono">₹<?= number_format($s['gross_earnings'], 2) ?></td>
              <td style="text-align:right;color:#dc2626;" class="mono">
                ₹<?= number_format($s['total_deductions'], 2) ?>
              </td>
              <td style="text-align:right;font-weight:700;color:#16a34a;" class="mono">
                ₹<?= number_format($s['net_pay'], 2) ?>
              </td>
              <td>
                <span class="stat-pill" style="color:<?= $statCol ?>;background:<?= $statBg ?>;">
                  <span class="stat-dot"></span>
                  <?= $statLabel ?>
                </span>
                <?php if (!empty($s['remarks'])): ?>
                  <span title="<?= esc($s['remarks']) ?>"
                    style="font-size:11px;color:var(--muted);cursor:help;margin-left:4px;">
                    <i class="bi bi-chat-left-text"></i>
                  </span>
                <?php endif; ?>
              </td>
              <td style="padding-right:16px;">
                <div style="display:flex;justify-content:flex-end;gap:4px;flex-wrap:nowrap;">

                  <?php if (in_array($s['payment_status'], ['draft', 'pending', 'approved'])): ?>
                    <a href="<?= base_url('salary/edit/' . $s['id']) ?>" class="act-icon" title="Edit">
                      <i class="bi bi-pencil"></i>
                    </a>
                  <?php endif; ?>

                  <?php if (in_array($s['payment_status'], ['draft', 'pending'])): ?>
                    <form method="post" action="<?= base_url('salary/approve/' . $s['id']) ?>">
                      <?= csrf_field() ?>
                      <button type="submit" class="act-icon act-icon-info" title="Approve">
                        <i class="bi bi-check-lg"></i>
                      </button>
                    </form>
                  <?php endif; ?>

                  <?php if ($s['payment_status'] === 'approved'): ?>
                    <button class="act-icon act-icon-success" title="Disburse"
                      onclick="openDisburse(<?= $s['id'] ?>, '<?= esc(addslashes($s['name'])) ?>', '₹<?= number_format($s['net_pay'], 2) ?>')">
                      <i class="bi bi-send"></i>
                    </button>
                  <?php endif; ?>

                  <?php if (in_array($s['payment_status'], ['draft', 'pending', 'approved'])): ?>
                    <button class="act-icon act-icon-danger" title="Hold"
                      onclick="openHold(<?= $s['id'] ?>, '<?= esc(addslashes($s['name'])) ?>')">
                      <i class="bi bi-pause-circle"></i>
                    </button>
                  <?php endif; ?>

                  <a href="<?= base_url('salary/slip/' . $s['staff_id_fk']
                    . '?month=' . $filters['month'] . '&year=' . $filters['year']) ?>" target="_blank"
                    class="act-icon" title="Salary Slip">
                    <i class="bi bi-file-earmark-text"></i>
                  </a>

                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>


<!-- ══ Modals (custom, no Bootstrap JS needed) ═══════════════════════ -->

<!-- Disburse Single -->
<div class="c-modal-bg" id="disburseModal">
  <div class="c-modal">
    <form method="post" id="disburseForm">
      <?= csrf_field() ?>
      <div class="c-modal-hdr">
        <div>
          <div class="c-modal-title">Disburse Salary</div>
          <div style="font-size:13px;color:var(--muted);margin-top:2px;">
            <span id="disburseName" style="font-weight:600;"></span> &mdash;
            <span id="disburseAmount" style="color:#16a34a;font-weight:700;"></span>
          </div>
        </div>
        <button type="button" class="c-close" onclick="closeModal('disburseModal')">
          <i class="bi bi-x" style="font-size:16px;"></i>
        </button>
      </div>
      <div class="c-modal-body">
        <div class="fgroup">
          <label class="fl">Payment Mode</label>
          <select name="payment_mode" class="fi">
            <option value="bank">Bank Transfer</option>
            <option value="cash">Cash</option>
            <option value="cheque">Cheque</option>
            <option value="upi">UPI / Online</option>
          </select>
        </div>
        <div class="fgroup">
          <label class="fl">Transaction Ref / UTR / Cheque No</label>
          <input type="text" name="transaction_ref" class="fi" placeholder="Optional reference number">
        </div>
        <div class="fgroup">
          <label class="fl">Paid Date</label>
          <input type="date" name="paid_date" class="fi" value="<?= date('Y-m-d') ?>">
        </div>
        <div class="fgroup">
          <label class="fl">Remarks</label>
          <input type="text" name="remarks" class="fi" placeholder="Optional note">
        </div>
      </div>
      <div class="c-modal-foot">
        <button type="button" class="tb-btn" onclick="closeModal('disburseModal')">Cancel</button>
        <button type="submit" class="tb-btn tb-btn-success">
          <i class="bi bi-send"></i>Mark as Paid
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Disburse All -->
<div class="c-modal-bg" id="disburseAllModal">
  <div class="c-modal">
    <form method="post" action="<?= base_url('salary/disburse-all') ?>">
      <?= csrf_field() ?>
      <input type="hidden" name="month" value="<?= $filters['month'] ?>">
      <input type="hidden" name="year" value="<?= $filters['year'] ?>">
      <div class="c-modal-hdr">
        <div class="c-modal-title">Bulk Disburse — <?= $monthLabel ?></div>
        <button type="button" class="c-close" onclick="closeModal('disburseAllModal')">
          <i class="bi bi-x" style="font-size:16px;"></i>
        </button>
      </div>
      <div class="c-modal-body">
        <div class="info-strip">
          <i class="bi bi-info-circle me-2"></i>
          This will mark all <strong><?= $summary['approved'] ?? 0 ?> approved</strong>
          salaries as paid for <?= $monthLabel ?>.
        </div>
        <div class="fgroup">
          <label class="fl">Payment Mode</label>
          <select name="payment_mode" class="fi">
            <option value="bank">Bank Transfer</option>
            <option value="cash">Cash</option>
            <option value="cheque">Cheque</option>
            <option value="upi">UPI / Online</option>
          </select>
        </div>
        <div class="fgroup">
          <label class="fl">Disbursement Date</label>
          <input type="date" name="paid_date" class="fi" value="<?= date('Y-m-d') ?>">
        </div>
      </div>
      <div class="c-modal-foot">
        <button type="button" class="tb-btn" onclick="closeModal('disburseAllModal')">Cancel</button>
        <button type="submit" class="tb-btn tb-btn-success">
          <i class="bi bi-send"></i>Disburse All Approved
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Hold -->
<div class="c-modal-bg" id="holdModal">
  <div class="c-modal">
    <form method="post" id="holdForm">
      <?= csrf_field() ?>
      <div class="c-modal-hdr">
        <div>
          <div class="c-modal-title">Hold Salary</div>
          <div style="font-size:13px;color:var(--muted);margin-top:2px;">
            <span id="holdName" style="font-weight:600;"></span>
          </div>
        </div>
        <button type="button" class="c-close" onclick="closeModal('holdModal')">
          <i class="bi bi-x" style="font-size:16px;"></i>
        </button>
      </div>
      <div class="c-modal-body">
        <div class="fgroup">
          <label class="fl">Reason for Hold <span style="color:#dc2626;">*</span></label>
          <textarea name="reason" class="fi" rows="3" required
            placeholder="e.g. Investigation pending, document missing…"></textarea>
        </div>
      </div>
      <div class="c-modal-foot">
        <button type="button" class="tb-btn" onclick="closeModal('holdModal')">Cancel</button>
        <button type="submit" class="tb-btn" style="background:#dc2626;color:#fff;border-color:#dc2626;">
          <i class="bi bi-pause-circle"></i>Hold Salary
        </button>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
  function openModal(id) {
    document.getElementById(id).classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeModal(id) {
    document.getElementById(id).classList.remove('open');
    document.body.style.overflow = '';
  }

  function openDisburse(id, name, amount) {
    document.getElementById('disburseName').textContent = name;
    document.getElementById('disburseAmount').textContent = amount;
    document.getElementById('disburseForm').action = '<?= base_url('salary/disburse/') ?>' + id;
    openModal('disburseModal');
  }
  function openHold(id, name) {
    document.getElementById('holdName').textContent = name;
    document.getElementById('holdForm').action = '<?= base_url('salary/hold/') ?>' + id;
    openModal('holdModal');
  }

  // Close on backdrop click
  document.querySelectorAll('.c-modal-bg').forEach(bg => {
    bg.addEventListener('click', e => { if (e.target === bg) closeModal(bg.id); });
  });
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') document.querySelectorAll('.c-modal-bg.open').forEach(m => closeModal(m.id));
  });
</script>
<?= $this->endSection() ?>