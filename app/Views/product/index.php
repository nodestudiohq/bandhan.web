<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .prod-tbl th {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .6px;
        color: var(--muted);
        padding: 10px 14px;
        border-bottom: 1.5px solid var(--border);
        background: var(--subtle);
        white-space: nowrap;
    }

    .prod-tbl td {
        padding: 12px 14px;
        border-bottom: 1px solid var(--border);
        font-size: 13.5px;
        vertical-align: middle;
    }

    .prod-tbl tbody tr:last-child td {
        border-bottom: none;
    }

    .prod-tbl tbody tr:hover td {
        background: var(--subtle);
    }

    .cat-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 6px;
        font-size: 11.5px;
        font-weight: 600;
        background: rgba(59, 79, 216, .08);
        color: var(--indigo);
    }

    .pill-on {
        background: #dcfce7;
        color: #166534;
        padding: 3px 10px;
        border-radius: 99px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .pill-off {
        background: #f1f5f9;
        color: #64748b;
        padding: 3px 10px;
        border-radius: 99px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .act-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        border-radius: 8px;
        font-size: 13px;
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

    .act-btn-sm {
        padding: 5px 11px;
        font-size: 12.5px;
    }

    .icon-btn {
        width: 30px;
        height: 30px;
        border-radius: 7px;
        border: 1px solid var(--border);
        background: transparent;
        color: var(--muted);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: background .12s, color .12s;
        text-decoration: none;
        font-size: 13px;
    }

    .icon-btn:hover {
        background: var(--subtle);
        color: var(--text);
    }

    .icon-btn-danger:hover {
        background: #fef2f2;
        color: #dc2626;
        border-color: #fca5a5;
    }

    .search-wrap {
        position: relative;
    }

    .search-wrap .si {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--muted);
        font-size: 13px;
        pointer-events: none;
    }

    .search-wrap input {
        padding-left: 32px !important;
    }

    .mon-sel {
        padding: 7px 10px;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 13px;
        background: var(--surf);
        color: var(--text);
        outline: none;
    }

    .dept-sep td {
        background: linear-gradient(90deg, #eef1ff, var(--subtle));
        border-top: 1.5px solid var(--border);
        border-bottom: 1px solid var(--border);
        padding: 7px 14px !important;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--indigo);
    }

    .dept-count {
        background: rgba(59, 79, 216, .12);
        color: var(--indigo);
        border-radius: 99px;
        padding: 1px 8px;
        font-size: 10px;
        font-weight: 700;
        margin-left: 7px;
    }

    .price {
        font-family: 'DM Mono', monospace;
        font-weight: 500;
        font-size: 13.5px;
    }
</style>

<!-- Header -->
<div
    style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:16px;flex-wrap:wrap;gap:10px;">
    <div>
        <h5 style="font-size:17px;font-weight:700;margin-bottom:2px;">Products &amp; Services</h5>
        <span style="font-size:13px;color:var(--muted);">
            <?= count($products) ?> items across
            <?= count($categories) ?> categories
        </span>
    </div>
    <a href="<?= base_url('products/create') ?>" class="act-btn act-btn-primary">
        <i class="bi bi-plus-lg"></i>Add Product
    </a>
</div>

<!-- Filter bar -->
<div class="card mb-3" style="border-radius:12px;">
    <div class="card-body" style="padding:10px 16px;">
        <form method="get" style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
            <div class="search-wrap" style="flex:1;min-width:180px;max-width:260px;">
                <i class="bi bi-search si"></i>
                <input type="search" name="q" class="mon-sel" style="width:100%;padding:7px 10px 7px 32px;"
                    placeholder="Search name, code…" value="<?= esc($filters['q'] ?? '') ?>">
            </div>
            <select name="category" class="mon-sel">
                <option value="">All Categories</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= esc($cat) ?>" <?= ($filters['category'] ?? '') === $cat ? 'selected' : '' ?>>
                        <?= esc($cat) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <select name="status" class="mon-sel" style="width:130px;">
                <option value="">All Status</option>
                <option value="active" <?= ($filters['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                <option value="inactive" <?= ($filters['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive
                </option>
            </select>
            <button type="submit" class="act-btn act-btn-primary act-btn-sm">Filter</button>
            <?php if (!empty($filters['q']) || !empty($filters['category']) || !empty($filters['status'])): ?>
                <a href="<?= base_url('products') ?>" class="act-btn act-btn-sm">
                    <i class="bi bi-x"></i>Clear
                </a>
            <?php endif; ?>
            <span style="margin-left:auto;font-size:12.5px;color:var(--muted);">
                <?= count($products) ?> results
            </span>
        </form>
    </div>
</div>

<!-- Table -->
<div class="card" style="border-radius:12px;overflow:hidden;">
    <?php if (empty($products)): ?>
        <div style="padding:60px 24px;text-align:center;color:var(--muted);">
            <i class="bi bi-box-seam" style="font-size:40px;opacity:.2;display:block;margin-bottom:12px;"></i>
            <div style="font-size:14px;">No products found.
                <a href="<?= base_url('products/create') ?>" style="color:var(--indigo);">Add one →</a>
            </div>
        </div>
    <?php else: ?>
        <?php
        // Group by category
        $grouped = [];
        foreach ($products as $p)
            $grouped[$p['category']][] = $p;
        ksort($grouped);
        ?>
        <div style="overflow-x:auto;">
            <table class="prod-tbl" style="width:100%;border-collapse:collapse;min-width:640px;">
                <thead>
                    <tr>
                        <th style="padding-left:18px;width:35%;">Name</th>
                        <th style="width:90px;">Code</th>
                        <th style="width:70px;text-align:center;">Unit</th>
                        <th style="width:110px;text-align:right;">Price (₹)</th>
                        <th style="width:70px;text-align:center;">Tax %</th>
                        <th style="width:90px;">Status</th>
                        <th style="text-align:right;padding-right:16px;width:110px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($grouped as $cat => $items): ?>
                        <!-- Category header -->
                        <tr>
                            <td colspan="7" style="padding:0;">
                                <div
                                    style="display:flex;align-items:center;gap:8px;padding:7px 14px;
                            background:linear-gradient(90deg,#eef1ff,var(--subtle));
                            border-top:1.5px solid var(--border);border-bottom:1px solid var(--border);
                            font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:var(--indigo);">
                                    <i class="bi bi-tag" style="font-size:11px;opacity:.7;"></i>
                                    <?= esc($cat) ?>
                                    <span class="dept-count">
                                        <?= count($items) ?>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <?php foreach ($items as $p): ?>
                            <tr>
                                <td style="padding-left:18px;">
                                    <div style="font-size:14px;font-weight:600;">
                                        <?= esc($p['name']) ?>
                                    </div>
                                    <?php if (!empty($p['description'])): ?>
                                        <div style="font-size:11.5px;color:var(--muted);margin-top:1px;">
                                            <?= esc($p['description']) ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($p['code'])): ?>
                                        <span
                                            style="font-family:'DM Mono',monospace;font-size:12px;color:var(--indigo);font-weight:500;">
                                            <?= esc($p['code']) ?>
                                        </span>
                                    <?php else: ?>
                                        <span style="color:var(--border);">—</span>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align:center;font-size:12.5px;color:var(--muted);">
                                    <?= esc($p['unit'] ?? 'Nos') ?>
                                </td>
                                <td style="text-align:right;">
                                    <span class="price">₹
                                        <?= number_format((float) $p['unit_price'], 2) ?>
                                    </span>
                                </td>
                                <td style="text-align:center;font-size:13px;color:var(--muted);">
                                    <?= (float) $p['tax_percent'] > 0 ? number_format((float) $p['tax_percent'], 1) . '%' : '—' ?>
                                </td>
                                <td>
                                    <form method="post" action="<?= base_url('products/toggle/' . $p['id']) ?>"
                                        style="display:inline;">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="<?= $p['is_active'] ? 'pill-on' : 'pill-off' ?>"
                                            style="border:none;cursor:pointer;font-family:'DM Sans',sans-serif;"
                                            title="Click to <?= $p['is_active'] ? 'deactivate' : 'activate' ?>">
                                            <span
                                                style="width:6px;height:6px;border-radius:50%;background:currentColor;flex-shrink:0;"></span>
                                            <?= $p['is_active'] ? 'Active' : 'Inactive' ?>
                                        </button>
                                    </form>
                                </td>
                                <td style="text-align:right;padding-right:16px;">
                                    <div style="display:flex;justify-content:flex-end;gap:5px;">
                                        <a href="<?= base_url('products/edit/' . $p['id']) ?>" class="icon-btn" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form method="post" action="<?= base_url('products/delete/' . $p['id']) ?>"
                                            onsubmit="return confirm('Delete \" <?= esc(addslashes($p['name'])) ?>\"?')">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="icon-btn icon-btn-danger" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>