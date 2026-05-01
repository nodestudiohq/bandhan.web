<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= esc($title ?? 'Print') ?> — HospitalMS</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    @media print {
      .no-print { display: none !important; }
      body { background: white !important; }
    }
  </style>
  <?= $this->renderSection('head') ?>
</head>
<body class="bg-light">

  <div class="no-print d-flex gap-2 p-3 bg-white border-bottom">
    <button onclick="window.print()" class="btn btn-primary btn-sm">
      <i class="bi bi-printer me-1"></i>Print / Save PDF
    </button>
    <a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm">
      <i class="bi bi-arrow-left me-1"></i>Back
    </a>
  </div>

  <div class="container py-4">
    <?= $this->renderSection('content') ?>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
  <?= $this->renderSection('scripts') ?>
</body>
</html>
