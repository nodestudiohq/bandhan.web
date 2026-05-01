<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

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
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-size: 13.5px;
        color: var(--text);
        background: var(--surf);
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
        padding-right: 40px;
    }

    .fi-wrap .eye {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--muted);
        cursor: pointer;
        font-size: 15px;
    }

    .fi-wrap .eye:hover {
        color: var(--text);
    }

    .fi-pre {
        display: flex;
    }

    .fi-pre span {
        padding: 9px 11px;
        background: var(--subtle);
        border: 1.5px solid var(--border);
        border-right: none;
        border-radius: 8px 0 0 8px;
        font-size: 13.5px;
        color: var(--muted);
        font-weight: 600;
    }

    .fi-pre .fi {
        border-radius: 0 8px 8px 0;
        border-left: none;
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

    .fg2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    @media(max-width:600px) {
        .fg2 {
            grid-template-columns: 1fr;
        }
    }

    .fgroup {
        margin-bottom: 16px;
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

    .err-list {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 8px;
        padding: 12px 14px;
        margin-bottom: 16px;
    }

    .err-list li {
        font-size: 13px;
        color: #dc2626;
        margin-bottom: 3px;
    }

    .err-list li:last-child {
        margin-bottom: 0;
    }

    .hint {
        font-size: 12px;
        color: var(--muted);
        margin-top: 5px;
    }
</style>

<div
    style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:20px;flex-wrap:wrap;gap:10px;">
    <div>
        <h5 style="font-size:17px;font-weight:700;margin-bottom:2px;">
            <?= $editing ? 'Edit User' : 'Add User' ?>
        </h5>
        <span style="font-size:13px;color:var(--muted);">
            <?= $editing ? 'Update account for ' . esc($user['name']) : 'Create a new system user' ?>
        </span>
    </div>
    <a href="<?= base_url('users') ?>" class="act-btn">
        <i class="bi bi-arrow-left"></i>Back
    </a>
</div>

<?php if ($errors = session()->getFlashdata('errors')): ?>
    <ul class="err-list">
        <?php foreach ($errors as $e): ?>
            <li><i class="bi bi-exclamation-circle me-1"></i>
                <?= esc($e) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="post" action="<?= $editing ? base_url('users/update/' . $user['id']) : base_url('users/store') ?>">
    <?= csrf_field() ?>

    <!-- Identity -->
    <div class="form-card">
        <div class="form-section"><i class="bi bi-person"></i>Identity</div>
        <div class="fg2">
            <div class="fgroup">
                <label class="fl">Full Name <span style="color:#dc2626;">*</span></label>
                <input type="text" name="name" class="fi" required value="<?= old('name', $user['name'] ?? '') ?>"
                    placeholder="e.g. Dr. Rahul Sharma">
            </div>
            <div class="fgroup">
                <label class="fl">Username <span style="color:#dc2626;">*</span></label>
                <div class="fi-pre">
                    <span>@</span>
                    <input type="text" name="username" class="fi" required
                        value="<?= old('username', $user['username'] ?? '') ?>" placeholder="e.g. rahul123"
                        autocomplete="username" pattern="[A-Za-z0-9._\-]+" title="Letters, numbers, dots, dashes only">
                </div>
                <div class="hint">Letters, numbers, dots and dashes only. Cannot be changed easily.</div>
            </div>
        </div>
    </div>

    <!-- Password -->
    <div class="form-card">
        <div class="form-section"><i class="bi bi-key"></i>Password
            <?= $editing ? '(leave blank to keep current)' : '' ?>
        </div>
        <div class="fg2">
            <div class="fgroup">
                <label class="fl">Password
                    <?= !$editing ? '<span style="color:#dc2626;">*</span>' : '' ?>
                </label>
                <div class="fi-wrap">
                    <input type="password" name="password" id="pw1" class="fi" <?= !$editing ? 'required' : '' ?>
                    placeholder="
                    <?= $editing ? 'Leave blank to keep current' : 'Min. 6 characters' ?>"
                    autocomplete="new-password">
                    <i class="bi bi-eye eye" onclick="togglePw('pw1', this)"></i>
                </div>
            </div>
            <div class="fgroup">
                <label class="fl">Confirm Password</label>
                <div class="fi-wrap">
                    <input type="password" name="password_confirm" id="pw2" class="fi" placeholder="Re-enter password"
                        autocomplete="new-password">
                    <i class="bi bi-eye eye" onclick="togglePw('pw2', this)"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Status -->
    <div class="form-card">
        <div class="form-section"><i class="bi bi-toggle-on"></i>Status</div>
        <div class="toggle-wrap">
            <label class="toggle">
                <input type="checkbox" name="is_active" value="1" <?= old('is_active', $user['is_active'] ?? 1) ? 'checked' : '' ?>>
                <span class="toggle-slider"></span>
            </label>
            <div>
                <div style="font-size:13.5px;font-weight:500;">Active</div>
                <div class="hint">Inactive users cannot log in.</div>
            </div>
        </div>
    </div>

    <div style="display:flex;gap:10px;justify-content:flex-end;">
        <a href="<?= base_url('users') ?>" class="act-btn">Cancel</a>
        <button type="submit" class="act-btn act-btn-primary">
            <i class="bi bi-check-lg"></i>
            <?= $editing ? 'Update User' : 'Create User' ?>
        </button>
    </div>

</form>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    function togglePw(id, icon) {
        const inp = document.getElementById(id);
        if (inp.type === 'password') {
            inp.type = 'text';
            icon.className = 'bi bi-eye-slash eye';
        } else {
            inp.type = 'password';
            icon.className = 'bi bi-eye eye';
        }
    }
</script>
<?= $this->endSection() ?>