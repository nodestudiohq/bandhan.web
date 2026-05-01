<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
$monthLabel = date('F Y', mktime(0, 0, 0, $salary['month'], 1, $salary['year']));
$lopDays = $salary['lop_override'] ?? $salary['unpaid_leave_days'];
$dayRate = $salary['working_days'] > 0
    ? round($salary['gross_earnings'] / $salary['working_days'], 2) : 0;
$otherDed = $salary['total_deductions']
    - $salary['lop_deduction'] - ($salary['pf'] ?? 0)
    - ($salary['esi'] ?? 0) - ($salary['professional_tax'] ?? 0) - ($salary['tds'] ?? 0);
?>

<style>
    /* ── tokens ───────────────────────────────────────── */
    .fl {
        font-size: 12px;
        font-weight: 600;
        color: var(--muted);
        margin-bottom: 5px;
        display: block;
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
        transition: border-color .15s, box-shadow .15s;
        font-family: 'DM Sans', sans-serif;
    }

    .fi:focus {
        border-color: var(--indigo);
        box-shadow: 0 0 0 3px rgba(59, 79, 216, .1);
    }

    .fi[readonly] {
        background: var(--subtle);
        color: var(--muted);
        cursor: default;
    }

    select.fi,
    textarea.fi {
        cursor: pointer;
    }

    textarea.fi {
        resize: vertical;
    }

    /* price prefix wrapper */
    .price-wrap span {
        padding: 9px 11px;
        background: var(--subtle);
        border: 1px solid var(--border);
        border-right: none;
        border-radius: 8px 0 0 8px;
        font-size: 13.5px;
        color: var(--muted);
        font-weight: 600;
    }

    .price-wrap .fi {
        border-radius: 0 8px 8px 0;
        border-left: none;
    }

    .price-wrap {
        display: flex;
    }

    /* ── cards ────────────────────────────────────────── */
    .form-card {
        background: var(--surf);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 22px 24px;
        margin-bottom: 14px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .04);
    }

    .form-section {
        font-size: 10.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: var(--muted);
        padding-bottom: 10px;
        margin-bottom: 18px;
        border-bottom: 1.5px solid var(--border);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-section i {
        font-size: 13px;
        color: var(--indigo);
    }

    /* ── grid ─────────────────────────────────────────── */
    .fg2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    .fg3 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 14px;
    }

    .fg4 {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }

    @media(max-width:700px) {

        .fg2,
        .fg3,
        .fg4 {
            grid-template-columns: 1fr;
        }
    }

    /* ── KPI attendance tiles ─────────────────────────── */
    .att-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }

    @media(max-width:600px) {
        .att-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .att-tile {
        border-radius: 10px;
        padding: 14px 16px;
        text-align: center;
        border: 1px solid var(--border);
    }

    .att-num {
        font-size: 24px;
        font-weight: 700;
        line-height: 1;
    }

    .att-lbl {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: var(--muted);
        margin-top: 4px;
    }

    /* ── Breakdown table ──────────────────────────────── */
    .bk-tbl {
        width: 100%;
        border-collapse: collapse;
    }

    .bk-tbl tr {
        border-bottom: 1px solid var(--border);
    }

    .bk-tbl tr:last-child {
        border-bottom: none;
    }

    .bk-tbl td {
        padding: 9px 0;
        font-size: 13px;
    }

    .bk-tbl .bk-label {
        color: var(--muted);
    }

    .bk-tbl .bk-val {
        text-align: right;
        font-weight: 500;
        font-family: 'DM Mono', monospace;
    }

    .bk-tbl .bk-earn {
        color: #16a34a;
    }

    .bk-tbl .bk-ded {
        color: #dc2626;
    }

    .bk-tbl .bk-net {
        font-size: 17px;
        font-weight: 700;
        color: var(--indigo);
        font-family: 'DM Mono', monospace;
        text-align: right;
    }

    /* Net Pay highlight box */
    .net-box {
        background: var(--indigo);
        border-radius: 10px;
        padding: 14px 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 14px;
    }

    .net-box .nl {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(255, 255, 255, .7);
    }

    .net-box .nv {
        font-size: 22px;
        font-weight: 700;
        color: #fff;
        font-family: 'DM Mono', monospace;
    }

    /* Info strip */
    .info-strip {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 8px;
        padding: 9px 13px;
        font-size: 12.5px;
        color: #1d4ed8;
        display: flex;
        align-items: flex-start;
        gap: 8px;
    }

    .info-strip i {
        flex-shrink: 0;
        margin-top: 1px;
    }

    /* LOP override strip */
    .lop-strip {
        background: #fff7ed;
        border: 1px solid #fed7aa;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 12.5px;
        color: #92400e;
        margin-bottom: 14px;
    }

    /* ── Buttons ──────────────────────────────────────── */
    .act-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 18px;
        border-radius: 8px;
        font-size: 13.5px;
        font-weight: 500;
        border: 1px solid var(--border);
        background: var(--surf);
        color: var(--muted);
        text-decoration: none;
        cursor: pointer;
        transition: background .12s, color .12s;
    }

    .act-btn:hover {
        background: var(--subtle);
        color: var(--text);
    }

    .act-btn-primary {
        background: var(--indigo);
        color: #fff;
        border-color: var(--indigo);
    }

    .act-btn-primary:hover {
        opacity: .9;
        color: #fff;
    }
</style>

<!-- Header -->
<div
    style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:20px;flex-wrap:wrap;gap:10px;">
    <div>
        <h5 style="font-size:17px;font-weight:700;margin-bottom:2px;">Edit Salary</h5>
        <span style="font-size:13px;color:var(--muted);">
            <span style="color:var(--text);font-weight:600;"><?= esc($staff['name']) ?></span>
            &nbsp;·&nbsp;
            <span
                style="color:var(--indigo);font-family:'DM Mono',monospace;font-weight:600;"><?= esc($staff['staff_id']) ?></span>
            &nbsp;·&nbsp; <?= $monthLabel ?>
        </span>
    </div>
    <a href="<?= base_url('salary?month=' . $salary['month'] . '&year=' . $salary['year']) ?>" class="act-btn">
        <i class="bi bi-arrow-left"></i>Back
    </a>
</div>

<form method="post" action="<?= base_url('salary/update/' . $salary['id']) ?>">
    <?= csrf_field() ?>

    <!-- ── Attendance summary ────────────────────────────────────────── -->
    <div class="form-card">
        <div class="form-section"><i class="bi bi-calendar-check"></i>Attendance Summary</div>
        <div class="att-grid">
            <?php foreach ([
                [$salary['working_days'], 'Working Days', 'var(--indigo)', '#eff6ff'],
                [$salary['present_days'], 'Present', '#16a34a', '#dcfce7'],
                [$salary['paid_leave_days'], 'Paid Leave', '#2563eb', '#eff6ff'],
                [$salary['unpaid_leave_days'], 'Unpaid LOP', '#dc2626', '#fef2f2'],
            ] as [$val, $lbl, $col, $bg]): ?>
                <div class="att-tile" style="background:<?= $bg ?>;border-color:transparent;">
                    <div class="att-num" style="color:<?= $col ?>;"><?= $val ?></div>
                    <div class="att-lbl"><?= $lbl ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- ── Two columns: LOP + Variable Earnings | Deductions + Breakdown ── -->
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;">

        <!-- Left column -->
        <div style="display:flex;flex-direction:column;gap:14px;">

            <!-- LOP Override -->
            <div class="form-card" style="margin-bottom:0;">
                <div class="form-section" style="border-color:#fed7aa;color:#92400e;">
                    <i class="bi bi-sliders" style="color:#d97706;"></i>LOP Override
                </div>
                <div style="font-size:12.5px;color:var(--muted);margin-bottom:12px;line-height:1.6;">
                    <strong style="color:var(--text);">Loss of Pay (LOP)</strong> — salary deducted for days an employee
                    was absent <em>without</em> approved leave. Auto-calculated from attendance; override only if
                    records differ.
                </div>
                <div class="lop-strip">
                    <strong>Auto LOP:</strong> <?= $salary['unpaid_leave_days'] ?> days
                    &nbsp;·&nbsp;
                    <strong>Day rate:</strong> ₹<?= number_format($dayRate, 2) ?>
                    &nbsp;·&nbsp;
                    <strong>Deduction:</strong>
                    <span style="color:#dc2626;">₹<?= number_format($salary['lop_deduction'], 2) ?></span>
                </div>
                <div>
                    <label class="fl">HR Override Days
                        <span style="font-weight:400;">(leave blank to use auto)</span>
                    </label>
                    <input type="number" name="lop_override" class="fi" value="<?= $salary['lop_override'] ?? '' ?>"
                        step="0.5" min="0" max="<?= $salary['working_days'] ?>"
                        placeholder="Auto: <?= $salary['unpaid_leave_days'] ?> days">
                </div>
            </div>

            <!-- Variable Earnings -->
            <div class="form-card" style="margin-bottom:0;">
                <div class="form-section" style="border-color:#d1fae5;color:#16a34a;">
                    <i class="bi bi-plus-circle" style="color:#16a34a;"></i>Variable Earnings
                </div>
                <div style="display:flex;flex-direction:column;gap:12px;">
                    <?php foreach ([
                        ['overtime_allowance', 'Overtime Allowance'],
                        ['night_shift_allowance', 'Night Shift Allowance'],
                        ['bonus_incentive', 'Bonus / Incentive'],
                    ] as [$name, $label]): ?>
                        <div>
                            <label class="fl"><?= $label ?></label>
                            <div class="price-wrap">
                                <span>₹</span>
                                <input type="number" name="<?= $name ?>" class="fi" value="<?= $salary[$name] ?? 0 ?>"
                                    step="0.01" min="0">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>

        <!-- Right column -->
        <div style="display:flex;flex-direction:column;gap:14px;">

            <!-- Custom Deductions -->
            <div class="form-card" style="margin-bottom:0;">
                <div class="form-section" style="border-color:#fecaca;color:#dc2626;">
                    <i class="bi bi-dash-circle" style="color:#dc2626;"></i>Custom Deductions
                </div>
                <div style="display:flex;flex-direction:column;gap:12px;">
                    <?php foreach ([
                        ['loan_recovery', 'Loan Recovery'],
                        ['advance_recovery', 'Advance Recovery'],
                        ['other_deductions', 'Other Deductions'],
                    ] as [$name, $label]): ?>
                        <div>
                            <label class="fl"><?= $label ?></label>
                            <div class="price-wrap">
                                <span>₹</span>
                                <input type="number" name="<?= $name ?>" class="fi" value="<?= $salary[$name] ?? 0 ?>"
                                    step="0.01" min="0">
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div>
                        <label class="fl">Deduction Note</label>
                        <input type="text" name="deduction_note" class="fi"
                            value="<?= esc($salary['deduction_note'] ?? '') ?>"
                            placeholder="Reason for custom deductions">
                    </div>
                </div>
            </div>

            <!-- Current Breakdown -->
            <div class="form-card" style="margin-bottom:0;flex:1;">
                <div class="form-section"><i class="bi bi-bar-chart-line"></i>Current Breakdown</div>
                <table class="bk-tbl">
                    <tr>
                        <td class="bk-label">Gross Earnings</td>
                        <td class="bk-val bk-earn">₹<?= number_format($salary['gross_earnings'], 2) ?></td>
                    </tr>
                    <?php if ($salary['lop_deduction'] > 0): ?>
                        <tr>
                            <td class="bk-label">LOP (<?= $lopDays ?> days)</td>
                            <td class="bk-val bk-ded">–₹<?= number_format($salary['lop_deduction'], 2) ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ([
                        ['pf', 'Provident Fund'],
                        ['esi', 'ESI'],
                        ['professional_tax', 'Professional Tax'],
                        ['tds', 'TDS'],
                    ] as [$key, $lbl]):
                        if (($salary[$key] ?? 0) <= 0)
                            continue; ?>
                        <tr>
                            <td class="bk-label"><?= $lbl ?></td>
                            <td class="bk-val bk-ded">–₹<?= number_format($salary[$key], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if ($otherDed > 0): ?>
                        <tr>
                            <td class="bk-label">Other Deductions</td>
                            <td class="bk-val bk-ded">–₹<?= number_format($otherDed, 2) ?></td>
                        </tr>
                    <?php endif; ?>
                </table>

                <div class="net-box">
                    <div class="nl">Net Pay</div>
                    <div class="nv">₹<?= number_format($salary['net_pay'], 2) ?></div>
                </div>

                <div class="info-strip" style="margin-top:14px;">
                    <i class="bi bi-info-circle"></i>
                    Totals will recalculate automatically when you save.
                </div>
            </div>

        </div>
    </div>

    <!-- ── Payment & Remarks ──────────────────────────────────────────── -->
    <div class="form-card">
        <div class="form-section"><i class="bi bi-credit-card"></i>Payment &amp; Notes</div>
        <div class="fg2">
            <div>
                <label class="fl">Payment Mode</label>
                <select name="payment_mode" class="fi">
                    <?php foreach (['bank' => 'Bank Transfer', 'cash' => 'Cash', 'cheque' => 'Cheque', 'upi' => 'UPI / Online'] as $v => $l): ?>
                        <option value="<?= $v ?>" <?= ($salary['payment_mode'] ?? '') === $v ? 'selected' : '' ?>>
                            <?= $l ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="fl">Internal Remarks</label>
                <input type="text" name="remarks" class="fi" value="<?= esc($salary['remarks'] ?? '') ?>"
                    placeholder="Internal HR note">
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div style="display:flex;gap:10px;justify-content:flex-end;">
        <a href="<?= base_url('salary?month=' . $salary['month'] . '&year=' . $salary['year']) ?>"
            class="act-btn">Cancel</a>
        <button type="submit" class="act-btn act-btn-primary">
            <i class="bi bi-calculator"></i>Save &amp; Recalculate
        </button>
    </div>

</form>
<?= $this->endSection() ?>