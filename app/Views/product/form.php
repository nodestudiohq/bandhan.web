<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
// Known hospital categories for the quick-pick grid
$knownCategories = [
    'Consultation',
    'General Medicine',
    'Emergency',
    'Surgery',
    'Maternity & OT',
    'Intensive Care Unit',
    'Diagnostics & Imaging',
    'Laboratory',
    'Pharmacy',
    'Physiotherapy',
    'Dental',
    'Ward & Room',
    'Nursing Charges',
    'Diet & Nutrition',
    'Administration',
    'Miscellaneous',
];
$currentCat = old('category', $product['category'] ?? '');
$isCustom = $currentCat !== '' && !in_array($currentCat, $knownCategories);
?>

<style>
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

    .fi[disabled],
    textarea.fi {
        resize: vertical;
    }

    .fg2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .fg3 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 16px;
    }

    @media(max-width:640px) {

        .fg2,
        .fg3 {
            grid-template-columns: 1fr;
        }
    }

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
        margin-bottom: 16px;
        border-bottom: 1.5px solid var(--border);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-section i {
        font-size: 13px;
        color: var(--indigo);
    }

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
        transition: background .12s;
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

    /* Category quick-pick grid */
    .cat-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        margin-bottom: 10px;
    }

    .cat-chip {
        padding: 5px 13px;
        border-radius: 8px;
        font-size: 12.5px;
        font-weight: 500;
        cursor: pointer;
        border: 1.5px solid var(--border);
        background: var(--surf);
        color: var(--muted);
        transition: all .12s;
        user-select: none;
    }

    .cat-chip:hover {
        border-color: var(--indigo);
        color: var(--indigo);
        background: #f0f4ff;
    }

    .cat-chip.sel {
        border-color: var(--indigo);
        background: var(--indigo);
        color: #fff;
    }

    /* Custom category input */
    #customCatWrap {
        margin-top: 8px;
        display: none;
    }

    #customCatWrap.show {
        display: block;
    }

    .custom-tag {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 11px;
        border-radius: 8px;
        background: rgba(59, 79, 216, .1);
        color: var(--indigo);
        font-size: 12.5px;
        font-weight: 600;
    }

    /* Price helper */
    .price-prefix {
        display: flex;
        align-items: center;
    }

    .price-prefix span {
        padding: 9px 11px;
        background: var(--subtle);
        border: 1px solid var(--border);
        border-right: none;
        border-radius: 8px 0 0 8px;
        font-size: 14px;
        color: var(--muted);
        font-weight: 600;
    }

    .price-prefix .fi {
        border-radius: 0 8px 8px 0;
    }

    /* Toggle switch */
    .toggle-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .toggle {
        position: relative;
        width: 44px;
        height: 24px;
        flex-shrink: 0;
    }

    .toggle input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        inset: 0;
        background: #d1d5db;
        border-radius: 99px;
        cursor: pointer;
        transition: .2s;
    }

    .toggle-slider::before {
        content: '';
        position: absolute;
        width: 18px;
        height: 18px;
        left: 3px;
        top: 3px;
        background: #fff;
        border-radius: 50%;
        transition: .2s;
    }

    .toggle input:checked+.toggle-slider {
        background: var(--indigo);
    }

    .toggle input:checked+.toggle-slider::before {
        transform: translateX(20px);
    }
</style>

<!-- Header -->
<div
    style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:20px;flex-wrap:wrap;gap:10px;">
    <div>
        <h5 style="font-size:17px;font-weight:700;margin-bottom:2px;">
            <?= $editing ? 'Edit Product' : 'Add Product / Service' ?>
        </h5>
        <span style="font-size:13px;color:var(--muted);">
            <?= $editing ? 'Update details for ' . esc($product['name']) : 'Add a new billing item to the system' ?>
        </span>
    </div>
    <a href="<?= base_url('products') ?>" class="act-btn">
        <i class="bi bi-arrow-left"></i>Back
    </a>
</div>

<form method="post"
    action="<?= $editing ? base_url('products/update/' . $product['id']) : base_url('products/store') ?>">
    <?= csrf_field() ?>

    <!-- Basic Info -->
    <div class="form-card">
        <div class="form-section"><i class="bi bi-box-seam"></i>Basic Information</div>

        <div style="margin-bottom:16px;">
            <label class="fl">Product / Service Name <span style="color:#dc2626;">*</span></label>
            <input type="text" name="name" class="fi" required value="<?= old('name', $product['name'] ?? '') ?>"
                placeholder="e.g. General Consultation, CBC Test, Ward Bed Charge">
        </div>

        <div class="fg2" style="margin-bottom:16px;">
            <div>
                <label class="fl">Product Code <span
                        style="color:var(--muted);font-weight:400;">(optional)</span></label>
                <input type="text" name="code" class="fi" value="<?= old('code', $product['code'] ?? '') ?>"
                    placeholder="e.g. CONS-001, LAB-CBC" style="font-family:'DM Mono',monospace;">
            </div>
            <div>
                <label class="fl">Unit</label>
                <select name="unit" class="fi">
                    <?php foreach (['Nos' => 'Nos (Each)', 'Day' => 'Per Day', 'Hour' => 'Per Hour', 'Test' => 'Per Test', 'Visit' => 'Per Visit', 'Strip' => 'Per Strip', 'Tablet' => 'Per Tablet', 'Vial' => 'Per Vial', 'Bottle' => 'Per Bottle', 'Sachet' => 'Per Sachet'] as $v => $l): ?>
                        <option value="<?= $v ?>" <?= old('unit', $product['unit'] ?? 'Nos') === $v ? 'selected' : '' ?>>
                            <?= $l ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div>
            <label class="fl">Description <span style="color:var(--muted);font-weight:400;">(optional)</span></label>
            <textarea name="description" class="fi" rows="2"
                placeholder="Brief description shown on autocomplete"><?= old('description', $product['description'] ?? '') ?></textarea>
        </div>
    </div>

    <!-- Category -->
    <div class="form-card">
        <div class="form-section"><i class="bi bi-tag"></i>Category</div>

        <div style="margin-bottom:8px;font-size:12.5px;color:var(--muted);">
            Pick from a standard hospital category, or type a custom one below.
        </div>

        <div class="cat-grid" id="catGrid">
            <?php foreach ($knownCategories as $cat): ?>
                <div class="cat-chip <?= $currentCat === $cat ? 'sel' : '' ?>" onclick="pickCat(this, '<?= esc($cat) ?>')">
                    <?= esc($cat) ?>
                </div>
            <?php endforeach; ?>
            <div class="cat-chip <?= $isCustom ? 'sel' : '' ?>" onclick="openCustom(this)" id="customChip">
                ✏ Custom…
            </div>
        </div>

        <!-- Hidden input holds actual value -->
        <input type="hidden" name="category" id="categoryInput" value="<?= esc($currentCat) ?>">

        <!-- Custom category input -->
        <div id="customCatWrap" class="<?= $isCustom ? 'show' : '' ?>">
            <label class="fl">Custom Category Name</label>
            <input type="text" name="category_custom" id="categoryCustom" class="fi"
                value="<?= $isCustom ? esc($currentCat) : '' ?>" placeholder="Type your category…"
                oninput="document.getElementById('categoryInput').value = this.value">
        </div>

        <?php if ($currentCat): ?>
            <div style="margin-top:10px;">
                <span class="custom-tag">
                    <i class="bi bi-check-circle" style="font-size:12px;"></i>
                    <?= esc($currentCat) ?>
                </span>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pricing -->
    <div class="form-card">
        <div class="form-section"><i class="bi bi-currency-rupee"></i>Pricing</div>

        <div class="fg3">
            <div>
                <label class="fl">Unit Price (₹) <span style="color:#dc2626;">*</span></label>
                <div class="price-prefix">
                    <span>₹</span>
                    <input type="number" name="unit_price" class="fi" required
                        value="<?= old('unit_price', $product['unit_price'] ?? '') ?>" min="0" step="0.01"
                        placeholder="0.00">
                </div>
            </div>
            <div>
                <label class="fl">Tax / GST (%)</label>
                <input type="number" name="tax_percent" class="fi"
                    value="<?= old('tax_percent', $product['tax_percent'] ?? 0) ?>" min="0" max="100" step="0.01"
                    placeholder="0">
            </div>
            <div style="display:flex;flex-direction:column;justify-content:center;">
                <label class="fl">Status</label>
                <div class="toggle-wrap">
                    <label class="toggle">
                        <input type="checkbox" name="is_active" value="1" <?= old('is_active', $product['is_active'] ?? 1) ? 'checked' : '' ?>>
                        <span class="toggle-slider"></span>
                    </label>
                    <span style="font-size:13.5px;font-weight:500;color:var(--text);">Active</span>
                    <span style="font-size:12px;color:var(--muted);">(appears in invoice autocomplete)</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit -->
    <div style="display:flex;gap:10px;justify-content:flex-end;">
        <a href="<?= base_url('products') ?>" class="act-btn">Cancel</a>
        <button type="submit" class="act-btn act-btn-primary">
            <i class="bi bi-check-lg"></i>
            <?= $editing ? 'Update Product' : 'Add Product' ?>
        </button>
    </div>

</form>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    function pickCat(el, cat) {
        // Deselect all
        document.querySelectorAll('.cat-chip').forEach(c => c.classList.remove('sel'));
        el.classList.add('sel');
        document.getElementById('categoryInput').value = cat;
        document.getElementById('customCatWrap').classList.remove('show');
        document.getElementById('categoryCustom').value = '';

        // Show current tag
        showTag(cat);
    }

    function openCustom(el) {
        document.querySelectorAll('.cat-chip').forEach(c => c.classList.remove('sel'));
        el.classList.add('sel');
        document.getElementById('categoryInput').value = '';
        document.getElementById('customCatWrap').classList.add('show');
        document.getElementById('categoryCustom').focus();
    }

    function showTag(cat) {
        let tag = document.getElementById('catTag');
        if (!tag) {
            tag = document.createElement('div');
            tag.id = 'catTag';
            tag.style.marginTop = '10px';
            document.getElementById('catGrid').after(tag);
        }
        tag.innerHTML = cat
            ? `<span class="custom-tag"><i class="bi bi-check-circle" style="font-size:12px;"></i>${cat}</span>`
            : '';
    }

    // Update tag live for custom input
    document.getElementById('categoryCustom').addEventListener('input', function () {
        document.getElementById('categoryInput').value = this.value;
        showTag(this.value);
    });
</script>
<?= $this->endSection() ?>