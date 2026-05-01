<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-semibold mb-0">Generate Monthly Salary</h4>
    <small class="text-muted">Auto-calculate salaries from attendance for all active staff</small>
  </div>
  <a href="<?= base_url('salary') ?>" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left me-1"></i>Back
  </a>
</div>

<div class="card border-0" style="max-width:480px">
  <div class="card-body">
    <form method="post" action="<?= base_url('salary/generate') ?>">
      <?= csrf_field() ?>

      <div class="mb-3">
        <label class="form-label">Month <span class="text-danger">*</span></label>
        <select name="month" class="form-select" required>
          <?php for ($m = 1; $m <= 12; $m++): ?>
            <option value="<?= $m ?>" <?= date('n') == $m ? 'selected' : '' ?>>
              <?= date('F', mktime(0, 0, 0, $m, 1)) ?>
            </option>
          <?php endfor; ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Year <span class="text-danger">*</span></label>
        <select name="year" class="form-select" required>
          <?php for ($y = date('Y'); $y >= date('Y') - 3; $y--): ?>
            <option value="<?= $y ?>" <?= date('Y') == $y ? 'selected' : '' ?>><?= $y ?></option>
          <?php endfor; ?>
        </select>
      </div>

      <div class="alert alert-info small">
        <i class="bi bi-info-circle me-1"></i>
        Generates <strong>draft</strong> salary records for all active staff
        who have a salary structure defined.<br><br>
        <strong>Rules:</strong>
        <ul class="mb-0 mt-1">
          <li>Staff with <strong>no attendance</strong> marked are treated as full-month present.</li>
          <li>Approved <strong>leave</strong> days are paid normally.</li>
          <li><strong>Absent</strong> days trigger Loss of Pay (LOP) deduction.</li>
          <li>Existing records for the selected month are skipped.</li>
          <li>Staff with no salary structure are skipped with an error.</li>
        </ul>
      </div>

      <div class="d-flex gap-2 justify-content-end">
        <a href="<?= base_url('salary') ?>" class="btn btn-outline-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-calculator me-1"></i>Generate Salary
        </button>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>