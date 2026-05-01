<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
  /* ── Page-level tokens (inherit from main layout) ─────────────── */
  .staff-tbl th {
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

  .staff-tbl td {
    padding: 13px 14px;
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
  }

  .staff-tbl tbody tr:last-child td {
    border-bottom: none;
  }

  .staff-tbl tbody tr {
    transition: background .12s;
  }

  .staff-tbl tbody tr:hover td {
    background: var(--subtle);
  }

  /* Avatar */
  .staff-avatar {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 700;
    color: var(--indigo);
    background: rgba(59, 79, 216, .1);
    flex-shrink: 0;
    letter-spacing: .5px;
  }

  /* Status pills */
  .pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 3px 10px;
    border-radius: 99px;
    font-size: 12px;
    font-weight: 600;
  }

  .pill-active {
    background: #dcfce7;
    color: #166534;
  }

  .pill-inactive {
    background: #f1f5f9;
    color: #64748b;
  }

  .pill-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    flex-shrink: 0;
  }

  .pill-active .pill-dot {
    background: #16a34a;
  }

  .pill-inactive .pill-dot {
    background: #94a3b8;
  }

  /* Icon action buttons */
  .act-btn {
    width: 30px;
    height: 30px;
    border-radius: 7px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: transparent;
    border: 1px solid var(--border);
    color: var(--muted);
    text-decoration: none;
    cursor: pointer;
    transition: background .12s, color .12s, border-color .12s;
    font-size: 13px;
  }

  .act-btn:hover {
    background: var(--subtle);
    color: var(--text);
    border-color: #c8cee0;
  }

  .act-btn.act-danger:hover {
    background: #fef2f2;
    color: #dc2626;
    border-color: #fca5a5;
  }

  /* Search input icon wrapper */
  .search-wrap {
    position: relative;
  }

  .search-wrap .bi-search {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--muted);
    font-size: 13px;
    pointer-events: none;
  }

  .search-wrap input {
    padding-left: 32px !important;
  }

  /* Empty state */
  .empty-state {
    padding: 60px 0;
    text-align: center;
    color: var(--muted);
  }

  .empty-state i {
    font-size: 40px;
    opacity: .25;
    display: block;
    margin-bottom: 12px;
  }

  .empty-state p {
    font-size: 14px;
    margin: 0;
  }
</style>

<!-- ── Header ──────────────────────────────────────────────────────── -->
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h5 class="fw-bold mb-1">Staff</h5>
    <span class="text-muted" style="font-size:13px;">Manage all hospital staff members</span>
  </div>
  <a href="<?= base_url('staff/create') ?>" class="btn btn-primary btn-sm d-flex align-items-center gap-2">
    <i class="bi bi-person-plus"></i> Add Staff
  </a>
</div>

<!-- ── Filter bar ──────────────────────────────────────────────────── -->
<div class="card mb-3" style="border-radius:12px;">
  <div class="card-body py-2 px-3">
    <form method="get" class="d-flex flex-wrap gap-2 align-items-center">

      <div class="search-wrap flex-grow-1" style="min-width:200px;max-width:280px;">
        <i class="bi bi-search"></i>
        <input type="search" name="q" class="form-control form-control-sm" placeholder="Search name, ID…"
          value="<?= esc($filters['q'] ?? '') ?>">
      </div>

      <select name="department" class="form-select form-select-sm" style="width:180px;">
        <option value="">All Departments</option>
        <?php foreach ($departments as $category => $depts): ?>
          <optgroup label="<?= esc($category) ?>">
            <?php foreach ($depts as $dept): ?>
              <option value="<?= esc($dept) ?>" <?= ($filters['department'] ?? '') === $dept ? 'selected' : '' ?>>
                <?= esc($dept) ?>
              </option>
            <?php endforeach; ?>
          </optgroup>
        <?php endforeach; ?>
      </select>

      <select name="status" class="form-select form-select-sm" style="width:120px;">
        <option value="">All Status</option>
        <option value="active" <?= ($filters['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
        <option value="inactive" <?= ($filters['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
      </select>

      <button class="btn btn-primary btn-sm">Filter</button>

      <?php if (!empty($filters['q']) || !empty($filters['department']) || !empty($filters['status'])): ?>
        <a href="<?= base_url('staff') ?>" class="btn btn-sm d-flex align-items-center gap-1"
          style="background:var(--subtle);border:1px solid var(--border);color:var(--muted);">
          <i class="bi bi-x"></i> Clear
        </a>
      <?php endif; ?>

      <!-- Results count pushed to the right -->
      <span class="ms-auto text-muted" style="font-size:12.5px;">
        <?= count($staff ?? []) ?> staff
        <?php if (!empty($filters['department'])): ?>
          in <strong><?= esc($filters['department']) ?></strong>
        <?php endif; ?>
      </span>
    </form>
  </div>
</div>

<!-- ── Table ───────────────────────────────────────────────────────── -->
<div class="card p-0" style="border-radius:12px;overflow:hidden;">

  <div class="table-responsive">
    <table class="table staff-tbl mb-0" style="min-width:680px;">
      <thead>
        <tr>
          <th style="width:36%">Staff Member</th>
          <th>Department</th>
          <th>Designation</th>
          <th>Phone</th>
          <th>Status</th>
          <th class="text-end pe-3">Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php if (!empty($staff)): ?>
          <?php foreach ($staff as $s):
            $parts = explode(' ', trim($s['name']));
            $initials = strtoupper(
              substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : substr($parts[0], 1, 1))
            );
            ?>
            <tr>
              <!-- Staff member -->
              <td>
                <div class="d-flex align-items-center gap-3">
                  <div class="staff-avatar"><?= esc($initials) ?></div>
                  <div>
                    <div class="fw-semibold" style="font-size:14px;"><?= esc($s['name']) ?></div>
                    <div class="text-muted" style="font-size:12px;margin-top:1px;">
                      <span class="fw-semibold" style="color:var(--indigo);"><?= esc($s['staff_id']) ?></span>
                      <?php if (!empty($s['email'])): ?>
                        · <?= esc($s['email']) ?>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </td>

              <!-- Department -->
              <td>
                <span style="font-size:13.5px;"><?= esc($s['department']) ?></span>
              </td>

              <!-- Designation -->
              <td>
                <span style="font-size:13.5px;"><?= esc($s['designation']) ?></span>
              </td>

              <!-- Phone -->
              <td>
                <span style="font-size:13.5px;font-family:'DM Mono',monospace;"><?= esc($s['phone']) ?></span>
              </td>

              <!-- Status -->
              <td>
                <?php if ($s['status'] === 'active'): ?>
                  <span class="pill pill-active">
                    <span class="pill-dot"></span>Active
                  </span>
                <?php else: ?>
                  <span class="pill pill-inactive">
                    <span class="pill-dot"></span>Inactive
                  </span>
                <?php endif; ?>
              </td>

              <!-- Actions -->
              <td class="text-end pe-3">
                <div class="d-flex justify-content-end gap-1">
                  <a href="<?= base_url('staff/' . $s['id']) ?>" class="act-btn" title="View profile">
                    <i class="bi bi-eye"></i>
                  </a>
                  <a href="<?= base_url('staff/edit/' . $s['id']) ?>" class="act-btn" title="Edit">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <a href="<?= base_url('staff/idcard/' . $s['id']) ?>" class="act-btn" title="ID Card" target="_blank">
                    <i class="bi bi-person-badge"></i>
                  </a>
                  <form method="post" action="<?= base_url('staff/delete/' . $s['id']) ?>"
                    onsubmit="return confirm('Delete <?= esc(addslashes($s['name'])) ?>? This cannot be undone.')">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="act-btn act-danger" title="Delete">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>

        <?php else: ?>
          <tr>
            <td colspan="6">
              <div class="empty-state">
                <i class="bi bi-people"></i>
                <p>
                  <?php if (!empty($filters['q']) || !empty($filters['department'])): ?>
                    No staff match your filters.
                    <a href="<?= base_url('staff') ?>">Clear filters</a>
                  <?php else: ?>
                    No staff added yet.
                    <a href="<?= base_url('staff/create') ?>">Add the first staff member →</a>
                  <?php endif; ?>
                </p>
              </div>
            </td>
          </tr>
        <?php endif; ?>

      </tbody>
    </table>
  </div>

  <!-- Pagination footer -->
  <?php if (!empty($pager)): ?>
    <div class="d-flex justify-content-between align-items-center px-4 py-3"
      style="border-top:1px solid var(--border);background:var(--subtle);">
      <span class="text-muted" style="font-size:12.5px;">
        Showing <?= count($staff) ?>
        <?php if (!empty($total)): ?> of <?= $total ?><?php endif; ?>
        staff members
      </span>
      <?= $pager->links() ?>
    </div>
  <?php endif; ?>

</div>

<?= $this->endSection() ?>