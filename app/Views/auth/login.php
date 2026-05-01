<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — Bandhan Hospital</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Mono:wght@400;500&display=swap');

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --navy: #0c1a3a;
            --indigo: #3b4fd8;
            --gold: #f5c300;
            --border: #e2e5ef;
            --muted: #64748b;
            --text: #0f172a;
            --subtle: #f8faff;
        }

        html,
        body {
            height: 100%;
            font-family: 'DM Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        body {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
        }

        /* ── Left panel — branding ──────────────────────── */
        .left {
            background: var(--navy);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px 52px;
            position: relative;
            overflow: hidden;
        }

        /* Decorative circles */
        .left::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(59, 79, 216, .18);
            top: -180px;
            right: -180px;
        }

        .left::after {
            content: '';
            position: absolute;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: rgba(245, 195, 0, .08);
            bottom: -100px;
            left: -100px;
        }

        .left-content {
            position: relative;
            z-index: 2;
        }

        /* Logo mark */
        .logo-mark {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, var(--indigo), #1e3a8a);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            box-shadow: 0 8px 24px rgba(59, 79, 216, .4);
        }

        .logo-mark svg {
            fill: var(--gold);
        }

        .brand-name {
            font-size: 28px;
            font-weight: 800;
            color: #fff;
            letter-spacing: .5px;
            line-height: 1.1;
        }

        .brand-name span {
            color: var(--gold);
        }

        .brand-sub {
            font-size: 13px;
            color: #8eb8e8;
            margin-top: 8px;
            line-height: 1.6;
        }

        /* Feature list */
        .features {
            margin-top: 48px;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .feat {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .feat-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: rgba(255, 255, 255, .08);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 16px;
            color: var(--gold);
        }

        .feat-title {
            font-size: 14px;
            font-weight: 600;
            color: #fff;
        }

        .feat-desc {
            font-size: 12.5px;
            color: #8eb8e8;
            margin-top: 2px;
        }

        /* Footer */
        .left-foot {
            position: relative;
            z-index: 2;
            font-size: 11.5px;
            color: rgba(148, 168, 208, .5);
            line-height: 1.6;
        }

        .left-foot strong {
            color: rgba(148, 168, 208, .8);
        }

        /* ── Right panel — form ─────────────────────────── */
        .right {
            background: var(--subtle);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 32px;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
        }

        .login-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
        }

        .login-sub {
            font-size: 13.5px;
            color: var(--muted);
            margin-bottom: 32px;
        }

        /* Form elements */
        .fl {
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
            margin-bottom: 6px;
            display: block;
        }

        .fi {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            color: var(--text);
            background: #fff;
            outline: none;
            font-family: 'DM Sans', sans-serif;
            transition: border-color .15s, box-shadow .15s;
        }

        .fi:focus {
            border-color: var(--indigo);
            box-shadow: 0 0 0 3px rgba(59, 79, 216, .1);
        }

        .fi-wrap {
            position: relative;
        }

        .fi-wrap .fi {
            padding-right: 42px;
        }

        .fi-wrap .fi-icon {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            cursor: pointer;
            font-size: 16px;
            transition: color .15s;
        }

        .fi-wrap .fi-icon:hover {
            color: var(--text);
        }

        .fgroup {
            margin-bottom: 18px;
        }

        /* Alert */
        .alert {
            padding: 11px 14px;
            border-radius: 9px;
            font-size: 13.5px;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #d1fae5;
            color: #16a34a;
        }

        /* Remember me */
        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 22px;
        }

        .remember-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--indigo);
            cursor: pointer;
        }

        .remember-row label {
            font-size: 13.5px;
            color: var(--muted);
            cursor: pointer;
        }

        /* Submit button */
        .btn-login {
            width: 100%;
            padding: 13px;
            background: var(--indigo);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14.5px;
            font-weight: 700;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: opacity .15s, transform .1s;
            letter-spacing: .3px;
        }

        .btn-login:hover {
            opacity: .92;
        }

        .btn-login:active {
            transform: scale(.98);
        }

        /* Hint */
        .login-hint {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: var(--border);
        }

        /* ── Mobile: stack vertically ───────────────────── */
        @media (max-width: 768px) {
            body {
                grid-template-columns: 1fr;
            }

            .left {
                padding: 32px 28px 36px;
                min-height: auto;
            }

            .left::before {
                width: 260px;
                height: 260px;
                top: -80px;
                right: -80px;
            }

            .left::after {
                display: none;
            }

            .features {
                display: none;
            }

            .left-foot {
                display: none;
            }

            .brand-name {
                font-size: 22px;
            }

            .right {
                padding: 32px 24px;
            }
        }
    </style>
</head>

<body>

    <!-- ── LEFT: Branding ──────────────────────────────────────────────── -->
    <div class="left">
        <div class="left-content">

            <!-- Logo -->
            <div>
                <div class="logo-mark">
                    <svg width="26" height="26" viewBox="0 0 24 24">
                        <rect x="10" y="2" width="4" height="20" rx="2" />
                        <rect x="2" y="10" width="20" height="4" rx="2" />
                        <circle cx="12" cy="12" r="2.5" fill="#0c1a3a" />
                    </svg>
                </div>
                <div class="brand-name">Bandhan <span>Hospital</span></div>
                <div class="brand-sub">
                    30/1 P.L.K. Maitra Road, Krishnagar<br>
                    Nadia – 741101, West Bengal
                </div>
            </div>

            <!-- Features -->
            <div class="features">
                <div class="feat">
                    <div class="feat-icon"><i class="bi bi-people"></i></div>
                    <div>
                        <div class="feat-title">Staff Management</div>
                        <div class="feat-desc">Manage 56+ departments, attendance, salary &amp; ID cards</div>
                    </div>
                </div>
                <div class="feat">
                    <div class="feat-icon"><i class="bi bi-receipt"></i></div>
                    <div>
                        <div class="feat-title">Billing &amp; Invoicing</div>
                        <div class="feat-desc">Patient invoices, medicine details, admission tracking</div>
                    </div>
                </div>
                <div class="feat">
                    <div class="feat-icon"><i class="bi bi-fingerprint"></i></div>
                    <div>
                        <div class="feat-title">Attendance &amp; Payroll</div>
                        <div class="feat-desc">QR punch station, auto LOP calculation, salary slips</div>
                    </div>
                </div>
            </div>

        </div>

        <div class="left-foot">
            <strong>📞 8172007073 / 7318770083</strong><br>
            bandhanhospital@gmail.com
            &nbsp;·&nbsp; v1.0.0
        </div>
    </div>

    <!-- ── RIGHT: Login form ───────────────────────────────────────────── -->
    <div class="right">
        <div class="login-box">

            <div class="login-title">Welcome back 👋</div>
            <div class="login-sub">Sign in to access the management dashboard</div>

            <!-- Flash messages -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('auth/login') ?>" novalidate>
                <?= csrf_field() ?>

                <div class="fgroup">
                    <label class="fl" for="email">Username</label>
                    <input type="text" name="username" id="username" class="fi" value="<?= old('username') ?>"
                        placeholder="admin" required autofocus>
                </div>

                <div class="fgroup">
                    <label class="fl" for="password">Password</label>
                    <div class="fi-wrap">
                        <input type="password" name="password" id="password" class="fi" placeholder="••••••••" required
                            autocomplete="current-password">
                        <i class="bi bi-eye fi-icon" id="toggleEye" onclick="togglePwd()"></i>
                    </div>
                </div>

                <div class="remember-row">
                    <input type="checkbox" name="remember" id="remember" value="1">
                    <label for="remember">Keep me signed in</label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Sign In
                </button>

            </form>

            <div class="login-hint">
                Default: username: admin · password: Admin@1234
            </div>

        </div>
    </div>

    <script>
        function togglePwd() {
            const inp = document.getElementById('password');
            const icon = document.getElementById('toggleEye');
            if (inp.type === 'password') {
                inp.type = 'text';
                icon.className = 'bi bi-eye-slash fi-icon';
            } else {
                inp.type = 'password';
                icon.className = 'bi bi-eye fi-icon';
            }
        }
    </script>

</body>

</html>