<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php $editing = isset($structure); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-semibold mb-0">Salary Structure</h4>
        <small class="text-muted">
            <?= esc($staff['name']) ?> &mdash;
            <?= esc($staff['staff_id']) ?>
            &bull;
            <?= esc($staff['designation']) ?>,
            <?= esc($staff['department']) ?>
        </small>
    </div>
    <div class="d-flex gap-2">
        <?php if (!empty($history)): ?>
            <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#historyModal">
                <i class="bi bi-clock-history me-1"></i>History (
                <?= count($history) ?>)
            </button>
        <?php endif; ?>
        <a href="<?= base_url('staff/' . $staff['id']) ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Back
        </a>
    </div>
</div>

<form method="post" action="<?= base_url('staff/salary-structure/save/' . $staff['id']) ?>">
    <?= csrf_field() ?>

    <div class="row g-4">

        <!-- ── EARNINGS ───────────────────────────────────────────────── -->
        <div class="col-lg-6">
            <div class="card border-0 h-100">
                <div class="card-header bg-success bg-opacity-10 border-0">
                    <span class="fw-semibold text-success">
                        <i class="bi bi-plus-circle me-2"></i>Earnings
                    </span>
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Basic Pay <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" name="basic_pay" id="basicPay" class="form-control" step="0.01" min="0"
                                required value="<?= old('basic_pay', $structure['basic_pay'] ?? '') ?>"
                                oninput="recalc()">
                        </div>
                        <div class="form-text">Core pay — basis for PF, HRA calculations</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            House Rent Allowance (HRA)
                            <span class="badge bg-secondary-subtle text-secondary ms-1" id="hraPct"></span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" name="hra" id="hra" class="form-control" step="0.01" min="0"
                                value="<?= old('hra', $structure['hra'] ?? '') ?>" oninput="recalc()">
                            <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle"
                                data-bs-toggle="dropdown">Auto</button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" onclick="setHra(40)">40% of Basic (Non-metro)</a></li>
                                <li><a class="dropdown-item" onclick="setHra(50)">50% of Basic (Metro)</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Dearness Allowance (DA)</label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" name="da" class="form-control" step="0.01" min="0"
                                value="<?= old('da', $structure['da'] ?? 0) ?>" oninput="recalc()">
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col">
                            <label class="form-label">Medical Allowance</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₹</span>
                                <input type="number" name="medical_allowance" class="form-control" step="0.01" min="0"
                                    value="<?= old('medical_allowance', $structure['medical_allowance'] ?? 1250) ?>"
                                    oninput="recalc()">
                            </div>
                            <div class="form-text">Tax-free ₹1,250/mo</div>
                        </div>
                        <div class="col">
                            <label class="form-label">Travel Allowance</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₹</span>
                                <input type="number" name="travel_allowance" class="form-control" step="0.01" min="0"
                                    value="<?= old('travel_allowance', $structure['travel_allowance'] ?? 800) ?>"
                                    oninput="recalc()">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Special Allowance</label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" name="special_allowance" class="form-control" step="0.01" min="0"
                                value="<?= old('special_allowance', $structure['special_allowance'] ?? 0) ?>"
                                oninput="recalc()">
                        </div>
                        <div class="form-text">Skill/role-based top-up</div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col">
                            <label class="form-label">Night Shift Allowance</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₹</span>
                                <input type="number" name="night_shift_allowance" class="form-control" step="0.01"
                                    min="0"
                                    value="<?= old('night_shift_allowance', $structure['night_shift_allowance'] ?? 0) ?>"
                                    oninput="recalc()">
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Overtime Allowance</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₹</span>
                                <input type="number" name="overtime_allowance" class="form-control" step="0.01" min="0"
                                    value="<?= old('overtime_allowance', $structure['overtime_allowance'] ?? 0) ?>"
                                    oninput="recalc()">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bonus / Incentive</label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" name="bonus_incentive" class="form-control" step="0.01" min="0"
                                value="<?= old('bonus_incentive', $structure['bonus_incentive'] ?? 0) ?>"
                                oninput="recalc()">
                        </div>
                    </div>

                    <!-- Gross summary -->
                    <div class="alert alert-success py-2 mb-0 d-flex justify-content-between align-items-center">
                        <span class="fw-semibold">Gross Earnings</span>
                        <span class="fw-bold fs-5" id="grossEarnings">₹0.00</span>
                    </div>

                </div>
            </div>
        </div>

        <!-- ── DEDUCTIONS ─────────────────────────────────────────────── -->
        <div class="col-lg-6">
            <div class="card border-0 h-100">
                <div class="card-header bg-danger bg-opacity-10 border-0">
                    <span class="fw-semibold text-danger">
                        <i class="bi bi-dash-circle me-2"></i>Deductions
                    </span>
                </div>
                <div class="card-body">

                    <!-- PF -->
                    <div class="card bg-body-secondary border-0 mb-3 p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="fw-semibold mb-0">Provident Fund (PF)</label>
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" id="pfApplicable" name="pf_applicable"
                                    value="1" <?= old('pf_applicable', $structure['pf_applicable'] ?? 1) ? 'checked' : '' ?>
                                onchange="recalc()">
                                <label class="form-check-label small" for="pfApplicable">Applicable</label>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                <label class="form-label small text-muted">Employee % (statutory 12%)</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" name="pf_percent" id="pfPercent" class="form-control"
                                        step="0.01" min="0" max="100"
                                        value="<?= old('pf_percent', $structure['pf_percent'] ?? 12) ?>"
                                        oninput="recalc()">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <div class="col d-flex flex-column justify-content-end">
                                <div class="text-muted small">Monthly deduction</div>
                                <div class="fw-bold text-danger" id="pfAmount">₹0.00</div>
                            </div>
                        </div>
                    </div>

                    <!-- ESI -->
                    <div class="card bg-body-secondary border-0 mb-3 p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <label class="fw-semibold mb-0">ESI <span
                                        class="badge bg-info-subtle text-info ms-1 small">Gross ≤ ₹21,000</span></label>
                            </div>
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" id="esiApplicable" name="esi_applicable"
                                    value="1" <?= old('esi_applicable', $structure['esi_applicable'] ?? 1) ? 'checked' : '' ?>
                                onchange="recalc()">
                                <label class="form-check-label small" for="esiApplicable">Applicable</label>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col">
                                <label class="form-label small text-muted">Employee % (statutory 0.75%)</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" name="esi_percent" id="esiPercent" class="form-control"
                                        step="0.01" min="0" max="100"
                                        value="<?= old('esi_percent', $structure['esi_percent'] ?? 0.75) ?>"
                                        oninput="recalc()">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <div class="col d-flex flex-column justify-content-end">
                                <div class="text-muted small">Monthly deduction</div>
                                <div class="fw-bold text-danger" id="esiAmount">₹0.00</div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col">
                            <label class="form-label">Professional Tax</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₹</span>
                                <input type="number" name="professional_tax" class="form-control" step="0.01" min="0"
                                    value="<?= old('professional_tax', $structure['professional_tax'] ?? 200) ?>"
                                    oninput="recalc()">
                            </div>
                            <div class="form-text">WB: ₹200/mo for salary &gt; ₹10K</div>
                        </div>
                        <div class="col">
                            <label class="form-label">TDS (Income Tax)</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₹</span>
                                <input type="number" name="tds" class="form-control" step="0.01" min="0"
                                    value="<?= old('tds', $structure['tds'] ?? 0) ?>" oninput="recalc()">
                            </div>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col">
                            <label class="form-label">Loan Recovery</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₹</span>
                                <input type="number" name="loan_recovery" class="form-control" step="0.01" min="0"
                                    value="<?= old('loan_recovery', $structure['loan_recovery'] ?? 0) ?>"
                                    oninput="recalc()">
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Advance Recovery</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">₹</span>
                                <input type="number" name="advance_recovery" class="form-control" step="0.01" min="0"
                                    value="<?= old('advance_recovery', $structure['advance_recovery'] ?? 0) ?>"
                                    oninput="recalc()">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Other Deductions</label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" name="other_deductions" class="form-control" step="0.01" min="0"
                                value="<?= old('other_deductions', $structure['other_deductions'] ?? 0) ?>"
                                oninput="recalc()">
                        </div>
                    </div>

                    <!-- Deductions summary -->
                    <div class="alert alert-danger py-2 mb-0 d-flex justify-content-between align-items-center">
                        <span class="fw-semibold">Total Deductions</span>
                        <span class="fw-bold fs-5" id="totalDeductions">₹0.00</span>
                    </div>

                </div>
            </div>
        </div>

        <!-- ── SUMMARY + REVISION ─────────────────────────────────────── -->
        <div class="col-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="row g-3 align-items-end">

                        <!-- Net Pay -->
                        <div class="col-md-3">
                            <div class="p-3 bg-primary bg-opacity-10 rounded text-center">
                                <div class="text-muted small fw-semibold text-uppercase">Net Take-Home Pay</div>
                                <div class="fw-bold text-primary mt-1" id="netPay" style="font-size:1.5rem">₹0.00</div>
                            </div>
                        </div>

                        <!-- CTC -->
                        <div class="col-md-3">
                            <div class="p-3 bg-secondary bg-opacity-10 rounded text-center">
                                <div class="text-muted small fw-semibold text-uppercase">CTC (Monthly)</div>
                                <div class="fw-bold text-secondary mt-1" id="ctcMonthly" style="font-size:1.5rem">₹0.00
                                </div>
                                <div class="text-muted" style="font-size:.72rem">
                                    Annual: <span id="ctcAnnual">₹0</span>
                                </div>
                            </div>
                        </div>

                        <!-- Effective from -->
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Effective From <span
                                    class="text-danger">*</span></label>
                            <input type="date" name="effective_from" class="form-control" required
                                value="<?= old('effective_from', $structure['effective_from'] ?? date('Y-m-d')) ?>">
                            <div class="form-text">Salary revision / increment date</div>
                        </div>

                        <!-- Remarks -->
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Remarks</label>
                            <input type="text" name="remarks" class="form-control"
                                placeholder="e.g. Annual increment, Joining"
                                value="<?= old('remarks', $structure['remarks'] ?? '') ?>">
                        </div>

                    </div>

                    <div class="d-flex gap-2 justify-content-end mt-3 pt-3 border-top">
                        <a href="<?= base_url('staff/' . $staff['id']) ?>" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>Save Salary Structure
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>

<!-- Revision History Modal -->
<?php if (!empty($history)): ?>
    <div class="modal fade" id="historyModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Salary Revision History —
                        <?= esc($staff['name']) ?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-secondary">
                                <tr>
                                    <th class="ps-3">Effective From</th>
                                    <th>Basic Pay</th>
                                    <th>Gross</th>
                                    <th>Net Pay</th>
                                    <th>CTC</th>
                                    <th class="pe-3">Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($history as $h): ?>
                                    <?php
                                    $gross = $h['basic_pay'] + $h['hra'] + $h['da'] + $h['medical_allowance']
                                        + $h['travel_allowance'] + $h['special_allowance']
                                        + $h['night_shift_allowance'] + $h['overtime_allowance'] + $h['bonus_incentive'];
                                    $pf = $h['pf_applicable'] ? round($h['basic_pay'] * $h['pf_percent'] / 100, 2) : 0;
                                    $esi = ($h['esi_applicable'] && $gross <= 21000)
                                        ? round($gross * $h['esi_percent'] / 100, 2) : 0;
                                    $deductions = $pf + $esi + $h['professional_tax'] + $h['tds']
                                        + $h['loan_recovery'] + $h['advance_recovery'] + $h['other_deductions'];
                                    $net = $gross - $deductions;
                                    $ctc = $gross + ($h['pf_applicable'] ? round($h['basic_pay'] * $h['pf_percent'] / 100, 2) : 0)
                                        + ($h['esi_applicable'] && $gross <= 21000 ? round($gross * 3.25 / 100, 2) : 0);
                                    ?>
                                    <tr>
                                        <td class="ps-3 fw-semibold">
                                            <?= date('d M Y', strtotime($h['effective_from'])) ?>
                                        </td>
                                        <td>₹
                                            <?= number_format($h['basic_pay'], 2) ?>
                                        </td>
                                        <td>₹
                                            <?= number_format($gross, 2) ?>
                                        </td>
                                        <td class="text-success fw-semibold">₹
                                            <?= number_format($net, 2) ?>
                                        </td>
                                        <td class="text-secondary">₹
                                            <?= number_format($ctc, 2) ?>
                                        </td>
                                        <td class="pe-3 text-muted small">
                                            <?= esc($h['remarks'] ?? '—') ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    function val(id) { return parseFloat(document.getElementById(id)?.value) || 0; }
    function fmtInput(name) { return parseFloat(document.querySelector('[name="' + name + '"]')?.value) || 0; }
    function fmt(n) { return '₹' + n.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','); }

    function recalc() {
        const basic = val('basicPay');
        const hra = val('hra');
        const gross = basic + hra
            + fmtInput('da') + fmtInput('medical_allowance') + fmtInput('travel_allowance')
            + fmtInput('special_allowance') + fmtInput('night_shift_allowance')
            + fmtInput('overtime_allowance') + fmtInput('bonus_incentive');

        // HRA % badge
        if (basic > 0 && hra > 0) {
            document.getElementById('hraPct').textContent = Math.round(hra / basic * 100) + '% of basic';
        } else {
            document.getElementById('hraPct').textContent = '';
        }

        // PF
        const pfOn = document.getElementById('pfApplicable').checked;
        const pfPct = parseFloat(document.getElementById('pfPercent').value) || 12;
        const pf = pfOn ? Math.round(basic * pfPct / 100 * 100) / 100 : 0;
        document.getElementById('pfAmount').textContent = fmt(pf);

        // ESI (only if gross <= 21000)
        const esiOn = document.getElementById('esiApplicable').checked;
        const esiPct = parseFloat(document.getElementById('esiPercent').value) || 0.75;
        const esi = (esiOn && gross <= 21000) ? Math.round(gross * esiPct / 100 * 100) / 100 : 0;
        document.getElementById('esiAmount').textContent = fmt(esi);
        if (esiOn && gross > 21000) {
            document.getElementById('esiAmount').textContent = 'N/A (gross > ₹21K)';
        }

        // Total deductions
        const totalDed = pf + esi
            + fmtInput('professional_tax') + fmtInput('tds')
            + fmtInput('loan_recovery') + fmtInput('advance_recovery')
            + fmtInput('other_deductions');

        const net = gross - totalDed;

        // CTC = gross + employer PF (12%) + employer ESI (3.25%)
        const employerPF = pfOn ? Math.round(basic * pfPct / 100 * 100) / 100 : 0;
        const employerESI = (esiOn && gross <= 21000) ? Math.round(gross * 3.25 / 100 * 100) / 100 : 0;
        const ctc = gross + employerPF + employerESI;

        document.getElementById('grossEarnings').textContent = fmt(gross);
        document.getElementById('totalDeductions').textContent = fmt(totalDed);
        document.getElementById('netPay').textContent = fmt(net);
        document.getElementById('ctcMonthly').textContent = fmt(ctc);
        document.getElementById('ctcAnnual').textContent = fmt(ctc * 12);
    }

    function setHra(pct) {
        const basic = val('basicPay');
        document.getElementById('hra').value = (basic * pct / 100).toFixed(2);
        recalc();
    }

    // Init on load
    recalc();
</script>
<?= $this->endSection() ?>