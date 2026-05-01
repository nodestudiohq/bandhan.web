<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Dashboard') ?> — Bandhan Hospital</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap"
        rel="stylesheet">
    <?= $this->renderSection('head') ?>
    <style>
        /* ── Variables ─────────────────────────────────────────────── */
        :root {
            --sw: 252px;
            --sc: 64px;
            --th: 60px;

            --navy: #0c1a3a;
            --navy2: #0f2050;
            --indigo: #3b4fd8;
            --gold: #f5c300;
            --gold2: #e6b400;

            --bg: #f0f2f8;
            --surf: #ffffff;
            --border: #e2e5ef;
            --text: #0f172a;
            --muted: #64748b;
            --subtle: #f8faff;

            --sb-bg: #0c1a3a;
            --sb-hover: rgba(255, 255, 255, .07);
            --sb-active: rgba(255, 255, 255, .12);
            --sb-text: #94a8d0;
            --sb-bright: #ffffff;
            --sb-label: rgba(148, 168, 208, .5);

            --radius: 12px;
            --shadow: 0 1px 3px rgba(0, 0, 0, .06), 0 4px 16px rgba(0, 0, 0, .06);
            --shadow-md: 0 4px 24px rgba(0, 0, 0, .10);
        }

        /* ── Reset ────────────────────────────────────────────────── */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            font-size: 14px;
            line-height: 1.55;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Sidebar ──────────────────────────────────────────────── */
        .sb {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sw);
            height: 100vh;
            background: var(--sb-bg);
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: width .25s cubic-bezier(.4, 0, .2, 1);
            overflow: hidden;
        }

        .sb.col {
            width: var(--sc);
        }

        /* Brand */
        .sb-brand {
            padding: 18px 16px 14px;
            display: flex;
            align-items: center;
            gap: 11px;
            border-bottom: 1px solid rgba(255, 255, 255, .06);
            flex-shrink: 0;
        }

        .sb-logo {
            width: 34px;
            height: 34px;
            background: linear-gradient(135deg, var(--indigo), #1e3a8a);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(59, 79, 216, .4);
        }

        .sb-logo svg {
            fill: var(--gold);
        }

        .sb-title {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: opacity .2s, width .25s;
        }

        .sb-title .line1 {
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            letter-spacing: .3px;
            white-space: nowrap;
        }

        .sb-title .line2 {
            font-size: 10px;
            color: var(--gold);
            font-weight: 600;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .sb.col .sb-title {
            opacity: 0;
            width: 0;
        }

        /* Scroll area */
        .sb-scroll {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 10px 10px;
            scrollbar-width: none;
        }

        .sb-scroll::-webkit-scrollbar {
            display: none;
        }

        /* Section label */
        .sb-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--sb-label);
            padding: 14px 10px 5px;
            white-space: nowrap;
            overflow: hidden;
            transition: opacity .2s;
        }

        .sb.col .sb-label {
            opacity: 0;
        }

        /* Nav link */
        .sb-link {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 9px 10px;
            border-radius: 9px;
            color: var(--sb-text);
            text-decoration: none;
            position: relative;
            white-space: nowrap;
            transition: background .15s, color .15s;
            margin-bottom: 1px;
        }

        .sb-link i {
            font-size: 16px;
            flex-shrink: 0;
            width: 20px;
            text-align: center;
        }

        .sb-link span {
            font-size: 13.5px;
            font-weight: 500;
            transition: opacity .2s;
        }

        .sb.col .sb-link span {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        .sb-link:hover {
            background: var(--sb-hover);
            color: #fff;
        }

        .sb-link.on {
            background: var(--sb-active);
            color: #fff;
        }

        .sb-link.on::before {
            content: '';
            position: absolute;
            left: 0;
            top: 6px;
            bottom: 6px;
            width: 3px;
            background: var(--gold);
            border-radius: 0 2px 2px 0;
        }

        .sb-link.on i {
            color: var(--gold);
        }

        /* Tooltip when collapsed */
        .sb.col .sb-link {
            justify-content: center;
        }

        .sb.col .sb-link[data-tip]:hover::after {
            content: attr(data-tip);
            position: absolute;
            left: calc(var(--sc) - 4px);
            background: var(--navy2);
            color: #fff;
            font-size: 12px;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 7px;
            white-space: nowrap;
            pointer-events: none;
            box-shadow: var(--shadow-md);
            z-index: 999;
        }

        /* Footer */
        .sb-foot {
            padding: 12px 10px;
            border-top: 1px solid rgba(255, 255, 255, .06);
            flex-shrink: 0;
        }

        .sb-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 8px;
            border-radius: 9px;
            cursor: pointer;
            transition: background .15s;
            text-decoration: none;
        }

        .sb-user:hover {
            background: var(--sb-hover);
        }

        .sb-avatar {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--indigo), #1e3a8a);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .sb-user-info {
            overflow: hidden;
            transition: opacity .2s, width .2s;
        }

        .sb-user-info .uname {
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            white-space: nowrap;
        }

        .sb-user-info .urole {
            font-size: 11px;
            color: var(--sb-text);
            white-space: nowrap;
            text-transform: capitalize;
        }

        .sb.col .sb-user {
            justify-content: center;
        }

        .sb.col .sb-user-info {
            opacity: 0;
            width: 0;
        }

        /* ── Topbar ───────────────────────────────────────────────── */
        .tb {
            position: fixed;
            top: 0;
            left: var(--sw);
            right: 0;
            height: var(--th);
            background: rgba(255, 255, 255, .85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 22px;
            z-index: 999;
            transition: left .25s cubic-bezier(.4, 0, .2, 1);
        }

        .sb.col~.tb {
            left: var(--sc);
        }

        .tb-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .tb-toggle {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            border: 1px solid var(--border);
            background: var(--surf);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--muted);
            transition: background .15s, color .15s;
            flex-shrink: 0;
        }

        .tb-toggle:hover {
            background: var(--subtle);
            color: var(--text);
        }

        .tb-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--muted);
        }

        .tb-breadcrumb .page-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--text);
        }

        .tb-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .tb-date {
            font-size: 12px;
            color: var(--muted);
            background: var(--subtle);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 5px 12px;
            font-family: 'DM Mono', monospace;
            font-weight: 500;
        }

        .tb-btn {
            height: 34px;
            padding: 0 14px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: opacity .15s, transform .1s;
        }

        .tb-btn:active {
            transform: scale(.97);
        }

        .tb-btn-primary {
            background: var(--indigo);
            color: #fff;
        }

        .tb-btn-primary:hover {
            opacity: .9;
        }

        .tb-icon-btn {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            border: 1px solid var(--border);
            background: var(--surf);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--muted);
            transition: background .15s, color .15s;
            position: relative;
        }

        .tb-icon-btn:hover {
            background: var(--subtle);
            color: var(--text);
        }

        /* User dropdown in topbar */
        .tb-avatar {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: linear-gradient(135deg, var(--navy), var(--indigo));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            cursor: pointer;
            border: 2px solid var(--border);
        }

        /* ── Main ─────────────────────────────────────────────────── */
        .main {
            margin-left: var(--sw);
            margin-top: var(--th);
            padding: 24px 26px;
            min-height: calc(100vh - var(--th));
            transition: margin-left .25s cubic-bezier(.4, 0, .2, 1);
        }

        .sb.col~.main {
            margin-left: var(--sc);
        }

        /* ── Cards ────────────────────────────────────────────────── */
        .card {
            border-radius: var(--radius) !important;
            border-color: var(--border) !important;
            box-shadow: var(--shadow);
        }

        .card-header {
            border-radius: var(--radius) var(--radius) 0 0 !important;
            border-color: var(--border) !important;
            background: var(--surf) !important;
            font-size: 13.5px;
            padding: 13px 16px !important;
        }

        .card-body {
            padding: 16px !important;
        }

        /* ── Tables ───────────────────────────────────────────────── */
        .table {
            font-size: 13.5px;
        }

        .table th {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: var(--muted) !important;
            border-color: var(--border) !important;
        }

        .table td {
            border-color: var(--border) !important;
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background: var(--subtle) !important;
        }

        .table-secondary {
            background: var(--subtle) !important;
        }

        /* ── Buttons ──────────────────────────────────────────────── */
        .btn {
            border-radius: 8px !important;
            font-size: 13px !important;
            font-weight: 500 !important;
        }

        .btn-primary {
            background: var(--indigo) !important;
            border-color: var(--indigo) !important;
        }

        .btn-sm {
            padding: 5px 12px !important;
            font-size: 12.5px !important;
        }

        /* ── Badges ───────────────────────────────────────────────── */
        .badge {
            border-radius: 6px !important;
            font-weight: 600 !important;
            font-size: 11px !important;
        }

        /* ── Forms ────────────────────────────────────────────────── */
        .form-control,
        .form-select {
            border-radius: 8px !important;
            border-color: var(--border) !important;
            font-size: 13.5px !important;
            box-shadow: none !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--indigo) !important;
            box-shadow: 0 0 0 3px rgba(59, 79, 216, .12) !important;
        }

        .form-label {
            font-size: 12.5px !important;
            font-weight: 600 !important;
            color: var(--muted);
            margin-bottom: 5px !important;
        }

        .input-group-text {
            border-color: var(--border) !important;
            border-radius: 8px 0 0 8px !important;
            font-size: 13.5px !important;
        }

        /* ── Alerts ───────────────────────────────────────────────── */
        .alert {
            border-radius: 10px !important;
            border: none !important;
            font-size: 13.5px !important;
            padding: 12px 16px !important;
        }

        .alert-success {
            background: #f0fdf4 !important;
            color: #166534 !important;
            border-left: 3px solid #16a34a !important;
        }

        .alert-danger {
            background: #fef2f2 !important;
            color: #991b1b !important;
            border-left: 3px solid #dc2626 !important;
        }

        /* ── Tabs ─────────────────────────────────────────────────── */
        .nav-tabs {
            border-color: var(--border) !important;
            gap: 2px;
        }

        .nav-tabs .nav-link {
            border-radius: 8px 8px 0 0 !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            color: var(--muted) !important;
            border: 1px solid transparent !important;
            padding: 8px 16px !important;
        }

        .nav-tabs .nav-link.active {
            color: var(--indigo) !important;
            background: var(--surf) !important;
            border-color: var(--border) var(--border) var(--surf) !important;
            font-weight: 600 !important;
        }

        /* ── Modals ───────────────────────────────────────────────── */
        .modal-content {
            border-radius: 14px !important;
            border: 1px solid var(--border) !important;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .15) !important;
        }

        .modal-header {
            border-color: var(--border) !important;
            padding: 16px 20px !important;
        }

        .modal-body {
            padding: 20px !important;
        }

        .modal-footer {
            border-color: var(--border) !important;
            padding: 14px 20px !important;
        }

        /* ── Progress ─────────────────────────────────────────────── */
        .progress {
            border-radius: 99px !important;
            background: var(--border) !important;
        }

        .progress-bar {
            border-radius: 99px !important;
        }

        /* ── Flash ────────────────────────────────────────────────── */
        .flash-wrap {
            margin-bottom: 18px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        /* ── Offcanvas (mobile sidebar) ──────────────────────────── */
        @media (max-width: 991.98px) {
            .sb {
                transform: translateX(-100%);
                transition: transform .25s cubic-bezier(.4, 0, .2, 1);
            }

            .sb.mob-open {
                transform: translateX(0);
            }

            .sb-backdrop {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, .4);
                z-index: 999;
                backdrop-filter: blur(2px);
            }

            .sb-backdrop.show {
                display: block;
            }

            .tb {
                left: 0 !important;
            }

            .main {
                margin-left: 0 !important;
            }
        }

        @media (min-width: 992px) {
            .sb-backdrop {
                display: none !important;
            }
        }

        /* ── Scrollbar ────────────────────────────────────────────── */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 99px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }

        /* ── Print ────────────────────────────────────────────────── */
        @media print {

            .sb,
            .tb,
            .sb-backdrop {
                display: none !important;
            }

            .main {
                margin: 0 !important;
                padding: 16px !important;
            }

            body {
                background: #fff !important;
            }
        }
    </style>
</head>

<body>

    <?php
    $uri = uri_string();
    $userName = session()->get('user_name') ?? 'Admin';
    $userRole = session()->get('user_role') ?? 'admin';
    $initials = strtoupper(implode('', array_map(fn($w) => $w[0], explode(' ', trim($userName)))));
    $initials = substr($initials, 0, 2);

    function sbLink(string $href, string $icon, string $label, string $uri, string $match = ''): string
    {
        $active = $match
            ? str_starts_with($uri, $match)
            : ($uri === ltrim(parse_url($href, PHP_URL_PATH), '/'));
        $cls = $active ? 'sb-link on' : 'sb-link';
        return "<a href=\"{$href}\" class=\"{$cls}\" data-tip=\"{$label}\">
      <i class=\"bi {$icon}\"></i><span>{$label}</span></a>";
    }
    ?>

    <!-- Mobile backdrop -->
    <div class="sb-backdrop" id="sbBackdrop" onclick="closeMobile()"></div>

    <!-- ═══ SIDEBAR ════════════════════════════════════════════════════ -->
    <aside class="sb" id="sb">

        <!-- Brand -->
        <div class="sb-brand">
            <div class="sb-logo">
                <svg width="18" height="18" viewBox="0 0 24 24">
                    <rect x="10" y="2" width="4" height="20" rx="2" />
                    <rect x="2" y="10" width="20" height="4" rx="2" />
                    <circle cx="12" cy="12" r="2.5" fill="#0f172a" />
                </svg>
            </div>
            <div class="sb-title">
                <span class="line1">Bandhan Hospital</span>
                <span class="line2">Management</span>
            </div>
        </div>

        <!-- Nav -->
        <nav class="sb-scroll">

            <?= sbLink(base_url('/'), 'bi-speedometer2', 'Dashboard', $uri) ?>

            <div class="sb-label">Staff</div>
            <?= sbLink(base_url('staff'), 'bi-people', 'Staff', $uri, 'staff') ?>
            <?= sbLink(
                base_url('attendance'),
                'bi-calendar-check',
                'Attendance',
                $uri,
                str_contains($uri, 'punch') ? '__none__' : 'attendance'
            ) ?>
            <?= sbLink(base_url('punch'), 'bi-fingerprint', 'Punch Station', $uri, 'attendance/punch') ?>
            <?= sbLink(base_url('salary'), 'bi-cash-coin', 'Salary', $uri, 'salary') ?>

            <div class="sb-label">Billing</div>
            <?= sbLink(base_url('invoice'), 'bi-receipt', 'Invoices', $uri, 'invoice') ?>
            <?= sbLink(base_url('products'), 'bi-box-seam', 'Products', $uri, 'products') ?>

            <div class="sb-label">System</div>
            <?= sbLink(base_url('users'), 'bi-shield-lock', 'Users', $uri, 'users') ?>


        </nav>

        <!-- User footer -->
        <div class="sb-foot">
            <a href="<?= base_url('auth/logout') ?>" class="sb-user" onclick="return confirm('Log out?')"
                data-tip="Logout">
                <div class="sb-avatar"><?= esc($initials) ?></div>
                <div class="sb-user-info">
                    <div class="uname"><?= esc($userName) ?></div>
                    <div class="urole"><?= esc($userRole) ?></div>
                </div>
            </a>
        </div>

    </aside>

    <!-- ═══ TOPBAR ═════════════════════════════════════════════════════ -->
    <header class="tb" id="tb">

        <div class="tb-left">
            <!-- Toggle -->
            <div class="tb-toggle" onclick="toggleSb()" title="Toggle sidebar">
                <i class="bi bi-list" style="font-size:18px;"></i>
            </div>
            <!-- Breadcrumb -->
            <div class="tb-breadcrumb">
                <i class="bi bi-hospital text-muted" style="font-size:13px;"></i>
                <span style="color:var(--border);">/</span>
                <span class="page-title"><?= esc($title ?? 'Dashboard') ?></span>
            </div>
        </div>

        <div class="tb-right">
            <!-- Date -->
            <div class="tb-date d-none d-md-flex">
                <?= date('D, d M Y') ?>
            </div>

            <!-- New Invoice shortcut -->
            <a href="<?= base_url('invoice/create') ?>" class="tb-btn tb-btn-primary" style="text-decoration:none;">
                <i class="bi bi-plus" style="font-size:15px;"></i>
                New Invoice
            </a>

            <!-- User dropdown -->
            <div class="dropdown">
                <div class="tb-avatar" data-bs-toggle="dropdown" title="Account">
                    <?= esc($initials) ?>
                </div>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2"
                    style="border-radius:12px;min-width:180px;font-size:13px;padding:6px;">
                    <li class="px-3 py-2">
                        <div style="font-weight:700;font-size:13.5px;"><?= esc($userName) ?></div>
                        <div style="font-size:11px;color:var(--muted);text-transform:capitalize;"><?= esc($userRole) ?>
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider my-1">
                    </li>
                    <li>
                        <a class="dropdown-item rounded-2" href="#" style="font-size:13px;padding:8px 12px;">
                            <i class="bi bi-person me-2 text-muted"></i>Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item rounded-2" href="#" style="font-size:13px;padding:8px 12px;">
                            <i class="bi bi-gear me-2 text-muted"></i>Settings
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider my-1">
                    </li>
                    <li>
                        <a class="dropdown-item rounded-2 text-danger" href="<?= base_url('auth/logout') ?>"
                            style="font-size:13px;padding:8px 12px;" onclick="return confirm('Log out?')">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </header>

    <!-- ═══ MAIN ════════════════════════════════════════════════════════ -->
    <main class="main" id="main">

        <!-- Flash messages -->
        <?php if (session()->getFlashdata('success') || session()->getFlashdata('error')): ?>
            <div class="flash-wrap">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success d-flex align-items-center gap-2 alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill"></i>
                        <span><?= session()->getFlashdata('success') ?></span>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"
                            style="font-size:11px;"></button>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger d-flex align-items-center gap-2 alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <span><?= session()->getFlashdata('error') ?></span>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"
                            style="font-size:11px;"></button>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>

    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script>
        const sb = document.getElementById('sb');
        const tb = document.getElementById('tb');
        const main = document.getElementById('main');
        const backdrop = document.getElementById('sbBackdrop');
        const COLL_KEY = 'bh_sb_collapsed';

        // Restore collapse state on desktop
        if (window.innerWidth >= 992 && localStorage.getItem(COLL_KEY) === '1') {
            sb.classList.add('col');
        }

        function toggleSb() {
            if (window.innerWidth < 992) {
                // Mobile: slide in/out
                sb.classList.toggle('mob-open');
                backdrop.classList.toggle('show');
            } else {
                // Desktop: collapse/expand
                sb.classList.toggle('col');
                localStorage.setItem(COLL_KEY, sb.classList.contains('col') ? '1' : '0');
            }
        }

        function closeMobile() {
            sb.classList.remove('mob-open');
            backdrop.classList.remove('show');
        }

        // Close mobile sidebar on nav click
        document.querySelectorAll('.sb-link').forEach(a => {
            a.addEventListener('click', () => {
                if (window.innerWidth < 992) closeMobile();
            });
        });
    </script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>