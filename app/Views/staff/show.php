<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php
$initials = strtoupper(implode('', array_map(fn($w) => $w[0], explode(' ', trim($staff['name'])))));
$initials = substr($initials, 0, 2);
$activeTab = $tab ?? 'info';
$monthLabel = date('F Y', mktime(0, 0, 0, $month, 1, $year));
?>

<style>
    /* ── Profile card ─────────────────────────────────────────── */
    .profile-card {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        align-items: center;
    }

    .profile-av {
        width: 68px;
        height: 68px;
        border-radius: 16px;
        background: rgba(59, 79, 216, .12);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        font-weight: 700;
        color: var(--indigo);
        flex-shrink: 0;
        letter-spacing: 1px;
        border: 2px solid rgba(59, 79, 216, .15);
    }

    .profile-av img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 14px;
    }

    .profile-name {
        font-size: 18px;
        font-weight: 700;
        line-height: 1.2;
    }

    .profile-meta {
        font-size: 13px;
        color: var(--muted);
        margin-top: 4px;
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .profile-meta span {
        display: flex;
        align-items: center;
        gap: 5px;
    }

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

    /* ── Tabs ─────────────────────────────────────────────────── */
    .tabs {
        display: flex;
        gap: 2px;
        border-bottom: 1.5px solid var(--border);
        margin-bottom: 20px;
    }

    .tab-link {
        display: flex;
        align-items: center;
        gap: 7px;
        padding: 9px 16px;
        font-size: 13.5px;
        font-weight: 500;
        color: var(--muted);
        text-decoration: none;
        border-bottom: 2.5px solid transparent;
        margin-bottom: -1.5px;
        transition: color .15s, border-color .15s;
        white-space: nowrap;
    }

    .tab-link:hover {
        color: var(--text);
    }

    .tab-link.on {
        color: var(--indigo);
        border-bottom-color: var(--indigo);
        font-weight: 600;
    }

    /* ── Info grid ────────────────────────────────────────────── */
    .info-section {
        margin-bottom: 0;
    }

    .info-section-title {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: var(--muted);
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .info-section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border);
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        padding: 8px 0;
        border-bottom: 1px solid var(--border);
        font-size: 13.5px;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: var(--muted);
        font-size: 12.5px;
        flex-shrink: 0;
        margin-right: 12px;
    }

    .info-val {
        font-weight: 500;
        text-align: right;
    }

    /* ── KPI cards ────────────────────────────────────────────── */
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-bottom: 20px;
    }

    @media(max-width:768px) {
        .kpi-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .kpi {
        background: var(--surf);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .04);
    }

    .kpi-label {
        font-size: 11.5px;
        color: var(--muted);
        font-weight: 600;
    }

    .kpi-val {
        font-size: 22px;
        font-weight: 700;
        margin: 4px 0 2px;
        line-height: 1;
    }

    .kpi-sub {
        font-size: 12px;
        color: var(--muted);
    }

    /* ── Attendance calendar ──────────────────────────────────── */
    .att-cal {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .att-day {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 3px;
        width: 34px;
    }

    .att-d {
        font-size: 9.5px;
        color: var(--muted);
        font-weight: 500;
    }

    .att-bubble {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .3px;
    }

    .att-P {
        background: #dcfce7;
        color: #166534;
    }

    .att-A {
        background: #fef2f2;
        color: #dc2626;
    }

    .att-H {
        background: #fef9c3;
        color: #854d0e;
    }

    .att-S {
        background: #fff7ed;
        color: #c2410c;
    }

    .att-L {
        background: #eff6ff;
        color: #1d4ed8;
    }

    .att-WO {
        background: #f1f5f9;
        color: #64748b;
    }

    .att-HO {
        background: #faf5ff;
        color: #7e22ce;
    }

    .att-em {
        background: #f8faff;
        color: #c8d0e0;
        border: 1px dashed var(--border);
    }

    .att-manual {
        box-shadow: 0 0 0 2px #f59e0b;
    }

    .att-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 14px;
    }

    .att-legend span {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        color: var(--muted);
    }

    .att-legend .dot {
        width: 10px;
        height: 10px;
        border-radius: 3px;
    }

    /* ── Salary table ─────────────────────────────────────────── */
    .sal-tbl th {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .6px;
        color: var(--muted);
        padding: 10px 14px;
        border-bottom: 1.5px solid var(--border);
        background: var(--subtle);
    }

    .sal-tbl td {
        padding: 11px 14px;
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

    /* ── Salary breakdown table ───────────────────────────────── */
    .brk-tbl td {
        padding: 8px 14px;
        border-bottom: 1px solid var(--border);
        font-size: 13px;
    }

    .brk-tbl tr:last-child td {
        border-bottom: none;
    }

    .brk-tbl .brk-total td {
        font-weight: 700;
        background: var(--subtle);
    }

    /* ── Act btn ──────────────────────────────────────────────── */
    .act-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        border: 1px solid var(--border);
        color: var(--muted);
        background: var(--surf);
        cursor: pointer;
        transition: background .12s, color .12s, border-color .12s;
    }

    .act-btn:hover {
        background: var(--subtle);
        color: var(--text);
        border-color: #c8cee0;
    }

    .act-btn-primary {
        background: var(--indigo);
        color: #fff;
        border-color: var(--indigo);
    }

    .act-btn-primary:hover {
        background: #3241c4;
        color: #fff;
        border-color: #3241c4;
    }

    /* ── Month nav ────────────────────────────────────────────── */
    .month-nav {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .month-nav a {
        width: 28px;
        height: 28px;
        border-radius: 7px;
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--muted);
        text-decoration: none;
        font-size: 12px;
        background: var(--surf);
        transition: background .12s;
    }

    .month-nav a:hover {
        background: var(--subtle);
    }

    .month-nav select {
        padding: 5px 10px;
        border: 1px solid var(--border);
        border-radius: 7px;
        font-size: 13px;
        background: var(--subtle);
        color: var(--text);
        outline: none;
    }
</style>

<!-- ── Profile header ─────────────────────────────────────────────── -->
<div class="card mb-3" style="border-radius:12px;">
    <div class="card-body" style="padding:20px 22px;">
        <div class="profile-card">

            <!-- Avatar -->
            <div class="profile-av">
                <?php if (!empty($staff['photo'])): ?>
                    <img src="<?= base_url('uploads/staff/' . esc($staff['photo'])) ?>">
                <?php else: ?>
                    <?= esc($initials) ?>
                <?php endif; ?>
            </div>

            <!-- Info -->
            <div style="flex:1;min-width:0;">
                <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                    <span class="profile-name"><?= esc($staff['name']) ?></span>
                    <?php if ($staff['status'] === 'active'): ?>
                        <span class="pill pill-active"><span class="pill-dot"></span>Active</span>
                    <?php else: ?>
                        <span class="pill pill-inactive"><span class="pill-dot"></span>Inactive</span>
                    <?php endif; ?>
                </div>
                <div class="profile-meta">
                    <span style="color:var(--indigo);font-weight:700;"><?= esc($staff['staff_id']) ?></span>
                    <span><i class="bi bi-briefcase"
                            style="font-size:12px;"></i><?= esc($staff['designation']) ?></span>
                    <span><i class="bi bi-building" style="font-size:12px;"></i><?= esc($staff['department']) ?></span>
                    <?php if (!empty($staff['phone'])): ?>
                        <span><i class="bi bi-telephone" style="font-size:12px;"></i><?= esc($staff['phone']) ?></span>
                    <?php endif; ?>
                    <?php if (!empty($staff['joining_date'])): ?>
                        <span><i class="bi bi-calendar3" style="font-size:12px;"></i>Joined
                            <?= date('d M Y', strtotime($staff['joining_date'])) ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Actions -->
            <div style="display:flex;gap:8px;flex-wrap:wrap;">
                <a href="<?= base_url('staff/edit/' . $staff['id']) ?>" class="act-btn act-btn-primary">
                    <i class="bi bi-pencil" style="font-size:13px;"></i>Edit
                </a>
                <a href="<?= base_url('staff/idcard/' . $staff['id']) ?>" target="_blank" class="act-btn">
                    <i class="bi bi-person-badge" style="font-size:13px;"></i>ID Card
                </a>
                <a href="<?= base_url('staff') ?>" class="act-btn">
                    <i class="bi bi-arrow-left" style="font-size:13px;"></i>Back
                </a>
            </div>

        </div>
    </div>
</div>

<!-- ── Tabs ───────────────────────────────────────────────────────── -->
<div class="tabs">
    <?php
    $tabs = [
        'info' => ['bi-person-lines-fill', 'Basic Info'],
        'salary_structure' => ['bi-wallet2', 'Salary Structure'],
        'attendance' => ['bi-calendar-check', 'Attendance'],
        'salaries' => ['bi-cash-coin', 'Salaries'],
    ];
    foreach ($tabs as $key => [$icon, $label]):
        ?>
        <a href="<?= base_url('staff/' . $staff['id']) ?>?tab=<?= $key ?>"
            class="tab-link <?= $activeTab === $key ? 'on' : '' ?>">
            <i class="bi <?= $icon ?>" style="font-size:14px;"></i><?= $label ?>
        </a>
    <?php endforeach; ?>
</div>


<?php /* ════════════════════ TAB 1 — BASIC INFO ════════════════════ */ ?>
<?php if ($activeTab === 'info'): ?>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;" class="two-col">
        <style>
            .two-col {
                @media(max-width:768px) {
                    grid-template-columns: 1fr !important;
                }
            }
        </style>

        <!-- Personal -->
        <div class="card" style="border-radius:12px;">
            <div class="card-body" style="padding:20px 22px;">
                <div class="info-section-title"><i class="bi bi-person" style="color:var(--indigo);"></i>Personal</div>
                <?php foreach ([
                    ['Full Name', esc($staff['name'])],
                    ["Father's Name", esc($staff['father_name'] ?? '—')],
                    ['Date of Birth', !empty($staff['dob']) ? date('d M Y', strtotime($staff['dob'])) . ' <span style="color:var(--muted);font-size:12px;">(' . (new DateTime($staff['dob']))->diff(new DateTime())->y . ' yrs)</span>' : '—'],
                    ['Gender', esc($staff['gender'] ?? '—')],
                    ['Blood Group', !empty($staff['blood_group']) ? '<span style="background:#fef2f2;color:#dc2626;padding:2px 9px;border-radius:6px;font-size:12px;font-weight:700;">' . esc($staff['blood_group']) . '</span>' : '—'],
                    ['Aadhar / ID', esc($staff['id_number'] ?? '—')],
                    ['Weekly Off', esc($staff['weekly_off'] ?? 'Sunday')],
                    ['Address', nl2br(esc($staff['address'] ?? '—'))],
                ] as [$l, $v]): ?>
                    <div class="info-row">
                        <span class="info-label"><?= $l ?></span>
                        <span class="info-val"><?= $v ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div style="display:flex;flex-direction:column;gap:16px;">
            <!-- Contact -->
            <div class="card" style="border-radius:12px;">
                <div class="card-body" style="padding:20px 22px;">
                    <div class="info-section-title"><i class="bi bi-telephone" style="color:var(--indigo);"></i>Contact
                    </div>
                    <?php foreach ([
                        ['Phone', esc($staff['phone'])],
                        ['Email', esc($staff['email'] ?? '—')],
                        ['Emergency Contact', esc($staff['emergency_contact'] ?? '—')],
                    ] as [$l, $v]): ?>
                        <div class="info-row">
                            <span class="info-label"><?= $l ?></span>
                            <span class="info-val"><?= $v ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- Employment -->
            <div class="card" style="border-radius:12px;">
                <div class="card-body" style="padding:20px 22px;">
                    <div class="info-section-title"><i class="bi bi-briefcase" style="color:var(--indigo);"></i>Employment
                    </div>
                    <?php foreach ([
                        ['Staff ID', '<span style="color:var(--indigo);font-weight:700;">' . esc($staff['staff_id']) . '</span>'],
                        ['Designation', esc($staff['designation'])],
                        ['Department', esc($staff['department'])],
                        ['Joining Date', !empty($staff['joining_date']) ? date('d M Y', strtotime($staff['joining_date'])) : '—'],
                        [
                            'Status',
                            $staff['status'] === 'active'
                            ? '<span class="pill pill-active"><span class="pill-dot"></span>Active</span>'
                            : '<span class="pill pill-inactive"><span class="pill-dot"></span>Inactive</span>'
                        ],
                    ] as [$l, $v]): ?>
                        <div class="info-row">
                            <span class="info-label"><?= $l ?></span>
                            <span class="info-val"><?= $v ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>


<?php /* ════════════════ TAB 2 — SALARY STRUCTURE ════════════════ */ ?>
<?php elseif ($activeTab === 'salary_structure'): ?>

    <?php if (empty($salaryStructure)): ?>
        <div class="card" style="border-radius:12px;">
            <div class="card-body" style="text-align:center;padding:60px 24px;">
                <i class="bi bi-wallet2" style="font-size:40px;color:var(--border);display:block;margin-bottom:14px;"></i>
                <div style="font-size:16px;font-weight:600;margin-bottom:6px;">No Salary Structure Defined</div>
                <p style="color:var(--muted);font-size:13.5px;margin-bottom:18px;">
                    Set up the salary structure for <?= esc($staff['name']) ?> to generate salary slips.
                </p>
                <a href="<?= base_url('staff/salary-structure/' . $staff['id']) ?>" class="act-btn act-btn-primary">
                    <i class="bi bi-plus-lg"></i>Define Salary Structure
                </a>
            </div>
        </div>

    <?php else:
        $ss = $salaryStructure;
        $gross = $ss['basic_pay'] + $ss['hra'] + $ss['da'] + $ss['medical_allowance']
            + $ss['travel_allowance'] + $ss['special_allowance']
            + $ss['night_shift_allowance'] + $ss['overtime_allowance'] + $ss['bonus_incentive'];
        $pf = $ss['pf_applicable'] ? round($ss['basic_pay'] * $ss['pf_percent'] / 100, 2) : 0;
        $esi = ($ss['esi_applicable'] && $gross <= 21000) ? round($gross * $ss['esi_percent'] / 100, 2) : 0;
        $totalDed = $pf + $esi + $ss['professional_tax'] + $ss['tds']
            + $ss['loan_recovery'] + $ss['advance_recovery'] + $ss['other_deductions'];
        $net = $gross - $totalDed;
        $ctc = $gross
            + ($ss['pf_applicable'] ? round($ss['basic_pay'] * $ss['pf_percent'] / 100, 2) : 0)
            + ($ss['esi_applicable'] && $gross <= 21000 ? round($gross * 3.25 / 100, 2) : 0);
        ?>

        <!-- KPI row -->
        <div class="kpi-grid" style="margin-bottom:20px;">
            <?php foreach ([
                ['Gross Earnings', $gross, '#16a34a'],
                ['Total Deductions', $totalDed, '#dc2626'],
                ['Net Take-Home', $net, 'var(--indigo)'],
                ['Monthly CTC', $ctc, 'var(--muted)'],
            ] as [$l, $v, $c]): ?>
                <div class="kpi">
                    <div class="kpi-label"><?= $l ?></div>
                    <div class="kpi-val" style="color:<?= $c ?>;">₹<?= number_format($v, 0) ?></div>
                    <?php if ($l === 'Monthly CTC'): ?>
                        <div class="kpi-sub">₹<?= number_format($ctc * 12, 0) ?>/yr</div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Breakdown + meta -->
        <div style="display:grid;grid-template-columns:1fr 1fr 260px;gap:16px;">

            <!-- Earnings -->
            <div class="card" style="border-radius:12px;overflow:hidden;">
                <div
                    style="padding:14px 16px;border-bottom:1px solid var(--border);font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.8px;color:#16a34a;background:#f0fdf4;">
                    <i class="bi bi-plus-circle me-2"></i>Earnings
                </div>
                <table class="brk-tbl" style="width:100%;border-collapse:collapse;">
                    <?php foreach ([
                        ['Basic Pay', $ss['basic_pay']],
                        ['HRA', $ss['hra']],
                        ['Dearness Allowance', $ss['da']],
                        ['Medical Allowance', $ss['medical_allowance']],
                        ['Travel Allowance', $ss['travel_allowance']],
                        ['Special Allowance', $ss['special_allowance']],
                        ['Night Shift', $ss['night_shift_allowance']],
                        ['Overtime', $ss['overtime_allowance']],
                        ['Bonus / Incentive', $ss['bonus_incentive']],
                    ] as [$l, $v]):
                        if ((float) $v <= 0)
                            continue; ?>
                        <tr>
                            <td style="color:var(--muted);"><?= $l ?></td>
                            <td style="text-align:right;font-weight:500;">₹<?= number_format((float) $v, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="brk-total">
                        <td>Gross Total</td>
                        <td style="text-align:right;color:#16a34a;">₹<?= number_format($gross, 2) ?></td>
                    </tr>
                </table>
            </div>

            <!-- Deductions -->
            <div class="card" style="border-radius:12px;overflow:hidden;">
                <div
                    style="padding:14px 16px;border-bottom:1px solid var(--border);font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.8px;color:#dc2626;background:#fef2f2;">
                    <i class="bi bi-dash-circle me-2"></i>Deductions
                </div>
                <table class="brk-tbl" style="width:100%;border-collapse:collapse;">
                    <?php foreach ([
                        ['PF (' . $ss['pf_percent'] . '%)', $pf, $ss['pf_applicable']],
                        ['ESI (' . $ss['esi_percent'] . '%)', $esi, $ss['esi_applicable']],
                        ['Professional Tax', $ss['professional_tax'], true],
                        ['TDS', $ss['tds'], true],
                        ['Loan Recovery', $ss['loan_recovery'], true],
                        ['Advance Recovery', $ss['advance_recovery'], true],
                        ['Other Deductions', $ss['other_deductions'], true],
                    ] as [$l, $v, $ok]):
                        if (!$ok || (float) $v <= 0)
                            continue; ?>
                        <tr>
                            <td style="color:var(--muted);"><?= $l ?></td>
                            <td style="text-align:right;font-weight:500;color:#dc2626;">₹<?= number_format((float) $v, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="brk-total">
                        <td>Total</td>
                        <td style="text-align:right;color:#dc2626;">₹<?= number_format($totalDed, 2) ?></td>
                    </tr>
                </table>
            </div>

            <!-- Meta + actions -->
            <div style="display:flex;flex-direction:column;gap:16px;">
                <div class="card" style="border-radius:12px;">
                    <div class="card-body" style="padding:18px 18px;">
                        <div class="info-section-title" style="margin-bottom:12px;"><i class="bi bi-info-circle"
                                style="color:var(--indigo);"></i>Details</div>
                        <div class="info-row" style="font-size:13px;">
                            <span class="info-label">Effective From</span>
                            <span class="info-val"><?= date('d M Y', strtotime($ss['effective_from'])) ?></span>
                        </div>
                        <div class="info-row" style="font-size:13px;">
                            <span class="info-label">Annual CTC</span>
                            <span class="info-val"
                                style="color:var(--indigo);font-weight:700;">₹<?= number_format($ctc * 12, 0) ?></span>
                        </div>
                        <?php if (!empty($ss['remarks'])): ?>
                            <div class="info-row" style="font-size:13px;">
                                <span class="info-label">Remarks</span>
                                <span class="info-val"><?= esc($ss['remarks']) ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <a href="<?= base_url('staff/salary-structure/' . $staff['id']) ?>" class="act-btn act-btn-primary"
                    style="justify-content:center;">
                    <i class="bi bi-pencil"></i>Edit / Revise
                </a>
                <a href="<?= base_url('salary/slip/' . $staff['id']) ?>" target="_blank" class="act-btn"
                    style="justify-content:center;">
                    <i class="bi bi-file-earmark-text"></i>Salary Slip
                </a>

                <!-- History -->
                <?php if (count($salaryHistory) > 1): ?>
                    <div>
                        <div
                            style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:var(--muted);margin-bottom:8px;">
                            Revision History</div>
                        <?php foreach ($salaryHistory as $h): ?>
                            <div
                                style="display:flex;justify-content:space-between;align-items:center;padding:7px 10px;border:1px solid var(--border);border-radius:8px;margin-bottom:5px;font-size:12.5px;">
                                <span style="color:var(--muted);"><?= date('d M Y', strtotime($h['effective_from'])) ?></span>
                                <span style="font-weight:600;color:var(--indigo);">₹<?= number_format($h['basic_pay'], 0) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    <?php endif; ?>


<?php /* ════════════════════ TAB 3 — ATTENDANCE ════════════════════ */ ?>
<?php elseif ($activeTab === 'attendance'): ?>

    <?php
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $today = date('Y-m-d');

    $statusMeta = [
        'present' => ['P', 'att-P', 'Present'],
        'absent' => ['A', 'att-A', 'Absent'],
        'half_day' => ['H', 'att-H', 'Half Day'],
        'short' => ['S', 'att-S', 'Short'],
        'leave' => ['L', 'att-L', 'Leave'],
        'week_off' => ['WO', 'att-WO', 'Week Off'],
        'holiday' => ['HO', 'att-HO', 'Holiday'],
    ];

    $staffWeekOffIso = \App\Models\AttendanceModel::dayNameToIso($staff['weekly_off'] ?? 'Sunday');
    ?>

    <!-- Summary KPIs -->
    <div class="kpi-grid" style="margin-bottom:20px;">
        <?php foreach ([
            ['Present', $attSummary['present'], '#16a34a'],
            ['Absent', $attSummary['absent'], '#dc2626'],
            ['Half Day', $attSummary['half_day'], '#d97706'],
            ['Leave', $attSummary['leave'], '#2563eb'],
        ] as [$l, $v, $c]): ?>
            <div class="kpi">
                <div class="kpi-label"><?= $l ?></div>
                <div class="kpi-val" style="color:<?= $c ?>;"><?= $v ?></div>
                <div class="kpi-sub"><?= $monthLabel ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Calendar card -->
    <div class="card" style="border-radius:12px;">
        <div
            style="padding:14px 20px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;">
            <span style="font-size:14px;font-weight:600;">Attendance — <?= $monthLabel ?></span>
            <div class="month-nav">
                <?php
                $pm = $month == 1 ? 12 : $month - 1;
                $py = $month == 1 ? $year - 1 : $year;
                $nm = $month == 12 ? 1 : $month + 1;
                $ny = $month == 12 ? $year + 1 : $year;
                ?>
                <a href="?tab=attendance&month=<?= $pm ?>&year=<?= $py ?>"><i class="bi bi-chevron-left"></i></a>
                <select onchange="window.location='?tab=attendance&month='+this.value+'&year=<?= $year ?>'">
                    <?php for ($m2 = 1; $m2 <= 12; $m2++): ?>
                        <option value="<?= $m2 ?>" <?= $m2 == $month ? 'selected' : '' ?>><?= date('F', mktime(0, 0, 0, $m2, 1)) ?>
                        </option>
                    <?php endfor; ?>
                </select>
                <select onchange="window.location='?tab=attendance&month=<?= $month ?>&year='+this.value">
                    <?php for ($y2 = date('Y'); $y2 >= date('Y') - 3; $y2--): ?>
                        <option value="<?= $y2 ?>" <?= $y2 == $year ? 'selected' : '' ?>><?= $y2 ?></option>
                    <?php endfor; ?>
                </select>
                <a href="?tab=attendance&month=<?= $nm ?>&year=<?= $ny ?>"><i class="bi bi-chevron-right"></i></a>
            </div>
        </div>
        <div style="padding:20px;">
            <div class="att-cal">
                <?php for ($d = 1; $d <= $daysInMonth; $d++):
                    $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $d);
                    $dayIso = (int) date('N', strtotime($dateStr));
                    $isWO = $dayIso === $staffWeekOffIso;
                    $isFut = $dateStr > $today;
                    $rec = $attGrid[$dateStr] ?? null;
                    $dayName = date('D', strtotime($dateStr));

                    if ($isFut && !$rec) {
                        $code = '';
                        $cls = 'att-em';
                        $label = '';
                    } elseif ($isWO && !$rec) {
                        $code = 'WO';
                        $cls = 'att-WO';
                        $label = 'Week Off';
                    } elseif (!$rec) {
                        $code = 'A';
                        $cls = 'att-A';
                        $label = 'Absent';
                    } else {
                        $status = $rec['is_manual'] ? ($rec['manual_status'] ?? $rec['status']) : $rec['status'];
                        $meta = $statusMeta[$status] ?? ['?', 'att-em', $status];
                        $code = $meta[0];
                        $cls = $meta[1];
                        $label = $meta[2];
                        if ($rec['is_manual'])
                            $cls .= ' att-manual';
                    }
                    $mins = (int) ($rec['work_minutes'] ?? 0);
                    $title = $dateStr . ($label ? " — $label" : '');
                    if ($rec && $rec['first_in'])
                        $title .= "\nIN: " . date('H:i', strtotime($rec['first_in']));
                    if ($rec && $rec['last_out'])
                        $title .= "  OUT: " . date('H:i', strtotime($rec['last_out']));
                    if ($mins > 0)
                        $title .= "\n" . \App\Models\AttendanceModel::formatMinutes($mins);
                    ?>
                    <div class="att-day" title="<?= esc($title) ?>">
                        <span class="att-d"><?= $d ?></span>
                        <div class="att-bubble <?= $cls ?>"><?= $code ?: '·' ?></div>
                        <span class="att-d"
                            style="color:<?= $isWO ? '#94a3b8' : 'transparent' ?>;font-size:8px;"><?= $dayName ?></span>
                    </div>
                <?php endfor; ?>
            </div>

            <!-- Legend -->
            <div class="att-legend">
                <?php foreach ([
                    ['att-P', 'Present'],
                    ['att-A', 'Absent'],
                    ['att-H', 'Half Day'],
                    ['att-S', 'Short'],
                    ['att-L', 'Leave'],
                    ['att-WO', 'Week Off'],
                ] as [$c, $l]): ?>
                    <span><span class="dot <?= $c ?>"
                            style="display:inline-block;width:10px;height:10px;border-radius:3px;"></span><?= $l ?></span>
                <?php endforeach; ?>
                <span style="margin-left:8px;"><span
                        style="display:inline-block;width:10px;height:10px;border-radius:3px;box-shadow:0 0 0 2px #f59e0b;background:#fef9c3;"></span>
                    Manual override</span>
            </div>

            <div style="margin-top:16px;text-align:right;">
                <a href="<?= base_url('attendance?month=' . $month . '&year=' . $year) ?>" class="act-btn"
                    style="font-size:12.5px;">
                    <i class="bi bi-calendar-check"></i>Full Attendance Module
                </a>
            </div>
        </div>
    </div>


<?php /* ════════════════════ TAB 4 — SALARIES ════════════════════ */ ?>
<?php elseif ($activeTab === 'salaries'): ?>

    <?php
    $lastRecord = !empty($salaryRecords) ? $salaryRecords[0] : null;
    $totalDedYtd = array_sum(array_column(
        array_filter($salaryRecords, fn($r) => $r['year'] == date('Y') && $r['payment_status'] === 'paid'),
        'total_deductions'
    ));
    ?>

    <!-- KPI row -->
    <div class="kpi-grid" style="margin-bottom:20px;">
        <div class="kpi">
            <div class="kpi-label">YTD Paid (<?= date('Y') ?>)</div>
            <div class="kpi-val" style="color:var(--indigo);">₹<?= number_format($ytdPaid, 0) ?></div>
        </div>
        <div class="kpi">
            <div class="kpi-label">Last Month Net</div>
            <div class="kpi-val" style="color:#16a34a;">
                <?= $lastRecord ? '₹' . number_format($lastRecord['net_pay'], 0) : '—' ?>
            </div>
            <?php if ($lastRecord): ?>
                <div class="kpi-sub"><?= date('F Y', mktime(0, 0, 0, $lastRecord['month'], 1, $lastRecord['year'])) ?></div>
            <?php endif; ?>
        </div>
        <div class="kpi">
            <div class="kpi-label">YTD Deductions</div>
            <div class="kpi-val" style="color:#dc2626;">₹<?= number_format($totalDedYtd, 0) ?></div>
        </div>
        <div class="kpi">
            <div class="kpi-label">Records</div>
            <div class="kpi-val" style="color:var(--muted);"><?= count($salaryRecords) ?></div>
            <div class="kpi-sub">last 12 months</div>
        </div>
    </div>

    <!-- History table -->
    <div class="card" style="border-radius:12px;overflow:hidden;">
        <div style="padding:14px 20px;border-bottom:1px solid var(--border);font-size:14px;font-weight:600;">
            Salary History
        </div>
        <?php if (empty($salaryRecords)): ?>
            <div style="padding:60px 24px;text-align:center;color:var(--muted);">
                <i class="bi bi-cash-coin" style="font-size:36px;opacity:.2;display:block;margin-bottom:12px;"></i>
                No salary records yet. Generate salary from the
                <a href="<?= base_url('salary') ?>" style="color:var(--indigo);">Salary module</a>.
            </div>
        <?php else: ?>
            <div style="overflow-x:auto;">
                <table class="sal-tbl" style="width:100%;border-collapse:collapse;min-width:600px;">
                    <thead>
                        <tr>
                            <th style="padding-left:20px;">Month</th>
                            <th>Working</th>
                            <th>Present</th>
                            <th>Gross</th>
                            <th>Deductions</th>
                            <th>Net Pay</th>
                            <th>Status</th>
                            <th style="padding-right:16px;text-align:right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($salaryRecords as $rec):
                            $statusStyles = [
                                'paid' => ['#dcfce7', '#166534', 'Paid'],
                                'draft' => ['#f1f5f9', '#64748b', 'Draft'],
                                'pending' => ['#fef9c3', '#854d0e', 'Pending'],
                                'approved' => ['#eff6ff', '#1d4ed8', 'Approved'],
                                'held' => ['#fef2f2', '#dc2626', 'Held'],
                            ];
                            [$bg, $col, $lbl] = $statusStyles[$rec['payment_status']] ?? ['#f1f5f9', '#64748b', ucfirst($rec['payment_status'])];
                            ?>
                            <tr>
                                <td style="padding-left:20px;font-weight:600;">
                                    <?= date('F Y', mktime(0, 0, 0, $rec['month'], 1, $rec['year'])) ?></td>
                                <td style="color:var(--muted);"><?= $rec['working_days'] ?></td>
                                <td style="color:var(--muted);"><?= $rec['present_days'] ?></td>
                                <td>₹<?= number_format($rec['gross_earnings'], 0) ?></td>
                                <td style="color:#dc2626;">₹<?= number_format($rec['total_deductions'], 0) ?></td>
                                <td style="font-weight:700;color:#16a34a;">₹<?= number_format($rec['net_pay'], 0) ?></td>
                                <td>
                                    <span
                                        style="background:<?= $bg ?>;color:<?= $col ?>;padding:3px 10px;border-radius:99px;font-size:12px;font-weight:600;">
                                        <?= $lbl ?>
                                    </span>
                                </td>
                                <td style="padding-right:16px;text-align:right;">
                                    <a href="<?= base_url('salary/slip/' . $staff['id'] . '?month=' . $rec['month'] . '&year=' . $rec['year']) ?>"
                                        target="_blank" class="act-btn" style="padding:5px 10px;font-size:12px;">
                                        <i class="bi bi-file-earmark-text" style="font-size:12px;"></i>Slip
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

<?php endif; ?>

<?= $this->endSection() ?>