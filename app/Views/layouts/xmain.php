<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= esc($title ?? 'Hospital Admin') ?> — HospitalMS</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
    rel="stylesheet" />
  <?= $this->renderSection('head') ?>
</head>

<body>

  <!-- ─── Top Navbar ─────────────────────────────────────────────── -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom px-3 sticky-top">
    <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= base_url('/') ?>">
      <i class="bi bi-hospital text-primary fs-5"></i>
      <span>HospitalMS</span>
    </a>
    <button class="navbar-toggler ms-auto me-2" type="button" data-bs-toggle="offcanvas"
      data-bs-target="#sidebarOffcanvas">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="d-flex align-items-center gap-2 ms-auto">
      <span class="text-muted small d-none d-md-inline"><?= date('D, d M Y') ?></span>
      <div class="dropdown">
        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
          <i class="bi bi-person-circle me-1"></i>Admin
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow">
          <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>">
              <i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="d-flex" style="min-height: calc(100vh - 57px);">

    <!-- ─── Sidebar ─────────────────────────────────────────────── -->
    <div class="offcanvas-lg offcanvas-start bg-body-tertiary border-end" id="sidebarOffcanvas"
      style="width:230px; min-width:230px;">
      <div class="offcanvas-header d-lg-none border-bottom">
        <h6 class="offcanvas-title">Navigation</h6>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarOffcanvas"></button>
      </div>
      <div class="offcanvas-body flex-column p-0 d-flex">
        <ul class="nav nav-pills flex-column p-3 gap-1 flex-grow-1">

          <!-- Dashboard -->
          <li>
            <a href="<?= base_url('/') ?>" class="nav-link <?= uri_string() === '' ? 'active' : 'text-body' ?>">
              <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
          </li>

          <!-- Staff Management -->
          <li class="mt-2">
            <small class="text-muted text-uppercase px-2" style="font-size:.7rem;letter-spacing:.05em">
              Staff
            </small>
          </li>
          <li>
            <a href="<?= base_url('staff') ?>"
              class="nav-link <?= str_starts_with(uri_string(), 'staff') ? 'active' : 'text-body' ?>">
              <i class="bi bi-people me-2"></i>Staff List
            </a>
          </li>

          <li>
            <a href="<?= base_url('attendance') ?>"
              class="nav-link <?= str_starts_with(uri_string(), 'attendance') ? 'active' : 'text-body' ?>">
              <i class="bi bi-calendar-check me-2"></i>Attendance
            </a>
          </li>
          <li>
            <a href="<?= base_url('punch') ?>"
              class="nav-link <?= str_starts_with(uri_string(), 'punch') ? 'active' : 'text-body' ?>">
              <i class="bi bi-fingerprint me-2"></i>Punch Station
            </a>
          </li>

          <li>
            <a href="<?= base_url('salary') ?>"
              class="nav-link <?= str_starts_with(uri_string(), 'salary') ? 'active' : 'text-body' ?>">
              <i class="bi bi-cash-coin me-2"></i>Salary
            </a>
          </li>

          <!-- Invoice -->
          <li class="mt-2">
            <small class="text-muted text-uppercase px-2" style="font-size:.7rem;letter-spacing:.05em">
              Billing
            </small>
          </li>
          <li>
            <a href="<?= base_url('invoice') ?>"
              class="nav-link <?= str_starts_with(uri_string(), 'invoice') ? 'active' : 'text-body' ?>">
              <i class="bi bi-receipt me-2"></i>Invoices
            </a>
          </li>
        </ul>

        <div class="p-3 border-top">
          <small class="text-muted">v1.0.0 &mdash; HospitalMS</small>
        </div>
      </div>
    </div>

    <!-- ─── Main Content ─────────────────────────────────────────── -->
    <main class="flex-grow-1 p-4 overflow-auto">

      <!-- Flash Messages -->
      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="bi bi-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="bi bi-exclamation-triangle me-2"></i><?= session()->getFlashdata('error') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <?= $this->renderSection('content') ?>

    </main>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
  <?= $this->renderSection('scripts') ?>
</body>

</html>