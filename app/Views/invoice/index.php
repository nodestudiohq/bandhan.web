<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-semibold mb-0">Invoices</h4>
    <small class="text-muted">Patient billing and invoices</small>
  </div>
  <a href="<?= base_url('invoice/create') ?>" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-lg me-1"></i>New Invoice
  </a>
</div>

<!-- Filters -->
<div class="card border-0 mb-3">
  <div class="card-body py-2">
    <form method="get" class="row g-2 align-items-end">
      <div class="col-md-4">
        <input type="search" name="q" class="form-control form-control-sm"
               placeholder="Invoice no, patient name…" value="<?= esc($filters['q'] ?? '') ?>">
      </div>
      <div class="col-auto">
        <select name="status" class="form-select form-select-sm">
          <option value="">All Status</option>
          <option value="paid"    <?= ($filters['status'] ?? '') === 'paid'    ? 'selected' : '' ?>>Paid</option>
          <option value="unpaid"  <?= ($filters['status'] ?? '') === 'unpaid'  ? 'selected' : '' ?>>Unpaid</option>
          <option value="partial" <?= ($filters['status'] ?? '') === 'partial' ? 'selected' : '' ?>>Partial</option>
        </select>
      </div>
      <div class="col-auto">
        <input type="date" name="from" class="form-control form-control-sm"
               value="<?= esc($filters['from'] ?? '') ?>" placeholder="From">
      </div>
      <div class="col-auto">
        <input type="date" name="to" class="form-control form-control-sm"
               value="<?= esc($filters['to'] ?? '') ?>" placeholder="To">
      </div>
      <div class="col-auto">
        <button class="btn btn-primary btn-sm">Filter</button>
        <a href="<?= base_url('invoice') ?>" class="btn btn-outline-secondary btn-sm">Reset</a>
      </div>
    </form>
  </div>
</div>

<div class="card border-0">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-secondary">
          <tr>
            <th class="ps-3">Invoice #</th>
            <th>Patient</th>
            <th>Date</th>
            <th>Services</th>
            <th>Total</th>
            <th>Paid</th>
            <th>Balance</th>
            <th>Status</th>
            <th class="pe-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($invoices)): ?>
            <?php foreach ($invoices as $inv): ?>
              <?php $balance = $inv['total_amount'] - $inv['paid_amount']; ?>
              <tr>
                <td class="ps-3 fw-semibold text-primary"><?= esc($inv['invoice_no']) ?></td>
                <td>
                  <div class="fw-semibold"><?= esc($inv['patient_name']) ?></div>
                  <small class="text-muted"><?= esc($inv['patient_phone'] ?? '') ?></small>
                </td>
                <td><?= date('d M Y', strtotime($inv['created_at'])) ?></td>
                <td><span class="badge bg-secondary-subtle text-secondary"><?= $inv['item_count'] ?? 0 ?> items</span></td>
                <td class="fw-semibold">₹<?= number_format($inv['total_amount'], 2) ?></td>
                <td class="text-success">₹<?= number_format($inv['paid_amount'], 2) ?></td>
                <td class="<?= $balance > 0 ? 'text-danger' : 'text-success' ?>">
                  ₹<?= number_format($balance, 2) ?>
                </td>
                <td>
                  <?php
                    $statMap = [
                      'paid'    => 'bg-success-subtle text-success',
                      'unpaid'  => 'bg-danger-subtle text-danger',
                      'partial' => 'bg-warning-subtle text-warning',
                    ];
                    $cls = $statMap[$inv['status']] ?? 'bg-secondary-subtle text-secondary';
                  ?>
                  <span class="badge <?= $cls ?>"><?= ucfirst($inv['status']) ?></span>
                </td>
                <td class="pe-3">
                  <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary py-0 dropdown-toggle"
                            data-bs-toggle="dropdown">Actions</button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                      <li><a class="dropdown-item" href="<?= base_url('invoice/' . $inv['id']) ?>">
                        <i class="bi bi-eye me-2"></i>View</a></li>
                      <li><a class="dropdown-item" href="<?= base_url('invoice/print/' . $inv['id']) ?>" target="_blank">
                        <i class="bi bi-printer me-2"></i>Print PDF</a></li>
                      <li><a class="dropdown-item" href="<?= base_url('invoice/edit/' . $inv['id']) ?>">
                        <i class="bi bi-pencil me-2"></i>Edit</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                        <form method="post" action="<?= base_url('invoice/delete/' . $inv['id']) ?>"
                              onsubmit="return confirm('Delete this invoice?')">
                          <?= csrf_field() ?>
                          <input type="hidden" name="_method" value="DELETE">
                          <button type="submit" class="dropdown-item text-danger">
                            <i class="bi bi-trash me-2"></i>Delete</button>
                        </form>
                      </li>
                    </ul>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="9" class="text-center text-muted py-4">
                <i class="bi bi-receipt fs-3 d-block mb-2"></i>No invoices found.
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php if (!empty($pager)): ?>
    <div class="card-footer bg-transparent d-flex justify-content-between align-items-center">
      <small class="text-muted">Showing <?= count($invoices) ?> of <?= $total ?> invoices</small>
      <?= $pager->links() ?>
    </div>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>
