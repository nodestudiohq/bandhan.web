<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
  .usr-tbl th { font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.6px;color:var(--muted);padding:10px 14px;border-bottom:1.5px solid var(--border);background:var(--subtle); }
  .usr-tbl td { padding:13px 14px;border-bottom:1px solid var(--border);font-size:13.5px;vertical-align:middle; }
  .usr-tbl tbody tr:last-child td { border-bottom:none; }
  .usr-tbl tbody tr:hover td { background:var(--subtle); }
  .uav { width:38px;height:38px;border-radius:10px;background:rgba(59,79,216,.1);color:var(--indigo);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;flex-shrink:0; }
  .pill-on  { background:#dcfce7;color:#166534;padding:3px 10px;border-radius:99px;font-size:12px;font-weight:600;display:inline-flex;align-items:center;gap:5px; }
  .pill-off { background:#f1f5f9;color:#64748b;padding:3px 10px;border-radius:99px;font-size:12px;font-weight:600;display:inline-flex;align-items:center;gap:5px; }
  .pill-dot { width:6px;height:6px;border-radius:50%;background:currentColor;flex-shrink:0; }
  .act-btn  { display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:8px;font-size:13px;font-weight:500;border:1px solid var(--border);background:var(--surf);color:var(--muted);text-decoration:none;cursor:pointer;transition:background .12s; }
  .act-btn:hover { background:var(--subtle);color:var(--text); }
  .act-btn-primary { background:var(--indigo);color:#fff;border-color:var(--indigo); }
  .act-btn-primary:hover { opacity:.9;color:#fff; }
  .icon-btn { width:30px;height:30px;border-radius:7px;border:1px solid var(--border);background:transparent;color:var(--muted);cursor:pointer;display:inline-flex;align-items:center;justify-content:center;font-size:13px;text-decoration:none;transition:background .12s,color .12s; }
  .icon-btn:hover { background:var(--subtle);color:var(--text); }
  .icon-btn-danger:hover { background:#fef2f2;color:#dc2626;border-color:#fca5a5; }
  .you-badge { background:rgba(59,79,216,.1);color:var(--indigo);border-radius:5px;padding:1px 7px;font-size:11px;font-weight:600;margin-left:6px; }
  .mono { font-family:'DM Mono',monospace;font-size:12.5px; }
</style>

<div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:20px;flex-wrap:wrap;gap:10px;">
  <div>
    <h5 style="font-size:17px;font-weight:700;margin-bottom:2px;">Users</h5>
    <span style="font-size:13px;color:var(--muted);"><?= count($users) ?> system user<?= count($users) !== 1 ? 's' : '' ?></span>
  </div>
  <a href="<?= base_url('users/create') ?>" class="act-btn act-btn-primary">
    <i class="bi bi-person-plus"></i>Add User
  </a>
</div>

<div class="card" style="border-radius:12px;overflow:hidden;">
  <?php if (empty($users)): ?>
    <div style="padding:60px 24px;text-align:center;color:var(--muted);">
      <i class="bi bi-people" style="font-size:40px;opacity:.2;display:block;margin-bottom:12px;"></i>
      No users found.
    </div>
  <?php else: ?>
    <table class="usr-tbl" style="width:100%;border-collapse:collapse;">
      <thead>
        <tr>
          <th style="padding-left:18px;">User</th>
          <th>Username</th>
          <th>Created</th>
          <th>Status</th>
          <th style="text-align:right;padding-right:16px;">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $u):
          $parts    = explode(' ', trim($u['name']));
          $initials = strtoupper(substr($parts[0],0,1) . (isset($parts[1]) ? substr($parts[1],0,1) : substr($parts[0],1,1)));
          $isMe     = $u['id'] == session()->get('user_id');
        ?>
          <tr>
            <td style="padding-left:18px;">
              <div style="display:flex;align-items:center;gap:12px;">
                <div class="uav"><?= esc($initials) ?></div>
                <div>
                  <span style="font-size:14px;font-weight:600;"><?= esc($u['name']) ?></span>
                  <?php if ($isMe): ?><span class="you-badge">You</span><?php endif; ?>
                </div>
              </div>
            </td>
            <td><span class="mono" style="color:var(--indigo);">@<?= esc($u['username']) ?></span></td>
            <td style="color:var(--muted);font-size:13px;">
              <?= date('d M Y', strtotime($u['created_at'])) ?>
            </td>
            <td>
              <form method="post" action="<?= base_url('users/toggle/' . $u['id']) ?>" style="display:inline;">
                <?= csrf_field() ?>
                <button type="submit"
                        class="<?= $u['is_active'] ? 'pill-on' : 'pill-off' ?>"
                        style="border:none;cursor:pointer;font-family:'DM Sans',sans-serif;"
                        <?= $isMe ? 'disabled title="Cannot deactivate yourself"' : '' ?>>
                  <span class="pill-dot"></span>
                  <?= $u['is_active'] ? 'Active' : 'Inactive' ?>
                </button>
              </form>
            </td>
            <td style="text-align:right;padding-right:16px;">
              <div style="display:flex;justify-content:flex-end;gap:5px;">
                <a href="<?= base_url('users/edit/' . $u['id']) ?>" class="icon-btn" title="Edit">
                  <i class="bi bi-pencil"></i>
                </a>
                <?php if (!$isMe): ?>
                  <form method="post" action="<?= base_url('users/delete/' . $u['id']) ?>"
                        onsubmit="return confirm('Delete user &quot;<?= esc(addslashes($u['name'])) ?>&quot;?')">
                    <?= csrf_field() ?>
                    <button type="submit" class="icon-btn icon-btn-danger" title="Delete">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                <?php endif; ?>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>