<?= $this->extend('layouts/id') ?>
<?= $this->section('head') ?>
<style>
  body {
    background: #e8edf4;
  }

  @media print {
    .no-print {
      display: none !important;
    }

    body {
      background: white !important;
    }
  }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<?php
/*
 * Strategy — no CSS transform tricks:
 *   • #idCard is natively 612×969px on screen (looks great).
 *   • On download, a hidden #idCardPrint div at exactly 408×646px
 *     (CR80 @ 96dpi ×2) is captured by html2canvas at scale 1.5637
 *     → output 638×1012px = CR80 @ 300dpi. Zero cropping.
 */
?>

<div style="display:flex;flex-direction:column;align-items:center;gap:24px;padding:32px 16px;">

  <!-- ═══════════════════════════════════════════════════════════
       SCREEN PREVIEW — 612×969px (native, no transform)
  ════════════════════════════════════════════════════════════════ -->
  <div id="idCard" style="
    width:612px; height:969px;
    background:#fff;
    border-radius:0;
    overflow:hidden;
    box-shadow:0 24px 64px rgba(10,30,80,0.32);
    font-family:'Segoe UI',Arial,sans-serif;
    display:flex; flex-direction:column;
    flex-shrink:0;
  ">

    <!-- HEADER -->
    <div style="background:#0d2a6e;position:relative;height:150px;overflow:hidden;flex-shrink:0;">
      <svg style="position:absolute;top:0;left:0;width:100%;height:100%" viewBox="0 0 612 150"
        preserveAspectRatio="none">
        <polygon points="0,0 442,0 357,150 0,150" fill="#142f7a" />
        <polygon points="375,0 612,0 612,150 477,150" fill="#0a2060" />
        <line x1="0" y1="144" x2="612" y2="144" stroke="#f5c300" stroke-width="6.5" />
      </svg>
      <div style="position:absolute;top:17px;left:24px;z-index:2;">
        <div style="font-size:1.75rem;font-weight:900;color:#f5c300;letter-spacing:2px;line-height:1.1;">
          <?= strtoupper(esc($hospital_name ?? 'BANDHAN HOSPITAL')) ?>
        </div>
        <div style="font-size:.87rem;color:#8eb8e8;font-weight:600;margin-top:5px;letter-spacing:.5px;">
          <?= esc($hospital_address ?? '30/1 P.L.K. Maitra Road, Krishnagar, Nadia') ?>
        </div>
        <div style="font-size:.87rem;color:#8eb8e8;font-weight:600;margin-top:2px;letter-spacing:.5px;">
          <?= esc($hospital_address2 ?? 'PIN-741101 • West Bengal') ?>
        </div>
        <div
          style="font-size:.93rem;color:#f5c300;font-weight:700;margin-top:8px;display:flex;align-items:center;gap:6px;">
          <?= esc($hospital_phone ?? '8172007073 / 7318770083') ?>
        </div>
      </div>
      <div style="position:absolute;top:14px;right:20px;z-index:2;text-align:center;">
        <div
          style="width:70px;height:70px;background:rgba(255,255,255,0.12);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto;">
          <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
            <rect x="10" y="2" width="4" height="20" rx="2" fill="#f5c300" />
            <rect x="2" y="10" width="20" height="4" rx="2" fill="#f5c300" />
            <circle cx="12" cy="12" r="3" fill="#fff" />
          </svg>
        </div>
        <div style="font-size:.68rem;color:#8eb8e8;font-weight:700;margin-top:5px;line-height:1.4;">Committed<br>To Care
        </div>
      </div>
    </div>

    <!-- WAVE DIVIDER -->
    <div style="position:relative;height:96px;overflow:hidden;flex-shrink:0;">
      <svg style="position:absolute;top:0;left:0;width:100%;height:100%" viewBox="0 0 612 96"
        preserveAspectRatio="none">
        <polygon points="0,0 375,0 264,96 0,96" fill="#0d2a6e" />
        <polygon points="188,0 477,0 375,96 86,96" fill="#1565c0" opacity=".65" />
        <polygon points="341,0 612,0 612,72 510,96 306,96" fill="#42a5f5" opacity=".45" />
      </svg>
    </div>

    <!-- PHOTO -->
    <div style="display:flex;justify-content:center;margin-top:-75px;position:relative;z-index:4;flex-shrink:0;">
      <div
        style="width:204px;height:204px;border:6px solid #1565c0;border-radius:20px;overflow:hidden;background:#c5d5e8;box-shadow:0 10px 42px rgba(13,42,110,.32);">
        <?php if (!empty($staff['photo'])): ?>
          <img src="<?= base_url('uploads/' . esc($staff['photo'])) ?>"
            style="width:100%;height:100%;object-fit:cover;display:block;">
        <?php else: ?>
          <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#b8cce0;">
            <svg width="90" height="90" viewBox="0 0 24 24" fill="#7090b8">
              <path
                d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
            </svg>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- NAME & ROLE -->
    <div style="text-align:center;padding:18px 27px 6px;flex-shrink:0;">
      <div
        style="font-size:2.55rem;font-weight:800;color:#0d1b3e;letter-spacing:3.5px;text-transform:uppercase;line-height:1.15;">
        <?= esc($staff['name']) ?>
      </div>
      <div style="display:inline-block;background:#e8f0fe;border-radius:30px;padding:7px 30px;margin-top:13px;">
        <span style="font-size:1.32rem;font-weight:800;color:#1565c0;text-transform:uppercase;letter-spacing:2.5px;">
          <?= esc($staff['designation']) ?>
        </span>
      </div>
    </div>

    <!-- DIVIDER -->
    <div style="margin:15px 40px 0;height:1.5px;background:#e0eaf5;flex-shrink:0;"></div>

    <!-- INFO ROWS + QR -->
    <div style="padding:15px 40px 15px;display:flex;gap:20px;align-items:flex-start;flex-shrink:0;">
      <div style="flex:1;">

        <!-- Staff ID -->
        <div style="display:flex;align-items:center;gap:14px;padding:8px 0;border-bottom:1px solid #edf2fa;">
          <div
            style="width:48px;height:48px;background:#e8f0fe;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="#1565c0">
              <path
                d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V6h16v12zM6 10h2v2H6zm0 4h8v2H6zm4-4h8v2h-8z" />
            </svg>
          </div>
          <div>
            <div style="font-size:.96rem;color:#7090b0;font-weight:600;text-transform:uppercase;letter-spacing:1px;">
              Staff ID</div>
            <div style="font-size:1.38rem;font-weight:700;color:#0d1b3e;margin-top:2px;"><?= esc($staff['staff_id']) ?>
            </div>
          </div>
        </div>

        <!-- Phone -->
        <div style="display:flex;align-items:center;gap:14px;padding:8px 0;border-bottom:1px solid #edf2fa;">
          <div
            style="width:48px;height:48px;background:#e8f0fe;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="#1565c0">
              <path
                d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
            </svg>
          </div>
          <div>
            <div style="font-size:.96rem;color:#7090b0;font-weight:600;text-transform:uppercase;letter-spacing:1px;">
              Phone</div>
            <div style="font-size:1.38rem;font-weight:700;color:#0d1b3e;margin-top:2px;"><?= esc($staff['phone']) ?>
            </div>
          </div>
        </div>

        <!-- Blood Group -->
        <div style="display:flex;align-items:center;gap:14px;padding:8px 0;border-bottom:1px solid #edf2fa;">
          <div
            style="width:48px;height:48px;background:#fdeaea;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="#c62828">
              <path d="M12 2c-5.33 4.55-8 8.48-8 11.8 0 4.98 3.8 8.2 8 8.2s8-3.22 8-8.2c0-3.32-2.67-7.25-8-11.8z" />
            </svg>
          </div>
          <div>
            <div style="font-size:.96rem;color:#7090b0;font-weight:600;text-transform:uppercase;letter-spacing:1px;">
              Blood Group</div>
            <div style="font-size:1.5rem;font-weight:800;color:#c62828;margin-top:2px;">
              <?= esc($staff['blood_group'] ?? '—') ?>
            </div>
          </div>
        </div>

        <!-- Joined -->
        <div style="display:flex;align-items:center;gap:14px;padding:8px 0;">
          <div
            style="width:48px;height:48px;background:#e8f0fe;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="#1565c0">
              <path
                d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z" />
            </svg>
          </div>
          <div>
            <div style="font-size:.96rem;color:#7090b0;font-weight:600;text-transform:uppercase;letter-spacing:1px;">
              Joined</div>
            <div style="font-size:1.38rem;font-weight:700;color:#0d1b3e;margin-top:2px;">
              <?= !empty($staff['joining_date']) ? date('d M Y', strtotime($staff['joining_date'])) : '—' ?>
            </div>
          </div>
        </div>

      </div>

      <!-- QR Code -->
      <div style="flex-shrink:0;display:flex;flex-direction:column;align-items:center;gap:8px;padding-top:6px;">
        <div id="qrWrap"
          style="width:145px;height:145px;border:3px solid #b8d0ee;border-radius:12px;overflow:hidden;background:#fff;padding:6px;display:flex;align-items:center;justify-content:center;">
        </div>
        <div style="font-size:.87rem;color:#7090b0;font-weight:600;text-align:center;letter-spacing:.8px;">SCAN TO
          VERIFY</div>
      </div>
    </div>

    <!-- FOOTER — waves left, email+web right, stripe bottom -->
    <div style="position:relative;height:99px;overflow:hidden;flex-shrink:0;margin-top:auto;">
      <svg style="position:absolute;top:0;left:0;width:100%;height:100%" viewBox="0 0 612 99"
        preserveAspectRatio="none">
        <rect width="612" height="99" fill="#f5f7fb" />
        <polygon points="0,99 0,54 300,99" fill="#0d2a6e" />
        <polygon points="0,99 0,27 465,99" fill="#1565c0" opacity=".7" />
        <polygon points="0,99 0,9  330,99" fill="#64b5f6" opacity=".5" />
        <polygon points="0,99 105,57 555,99" fill="#b3d4f5" opacity=".4" />
      </svg>
      <!-- Email + web right side -->
      <div
        style="position:absolute;top:8px;right:16px;display:flex;flex-direction:column;align-items:flex-end;gap:5px;z-index:2;">
        <div
          style="display:flex;align-items:center;gap:6px;font-size:.83rem;color:#1565c0;font-weight:700;background:rgba(240,245,255,0.93);border-radius:6px;padding:4px 10px;line-height:1.4;">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="#1565c0">
            <path
              d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
          </svg>
          bandhanhospital@gmail.com
        </div>
        <div
          style="display:flex;align-items:center;gap:6px;font-size:.83rem;color:#1565c0;font-weight:700;background:rgba(240,245,255,0.93);border-radius:6px;padding:4px 10px;line-height:1.4;">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="#1565c0">
            <path
              d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
          </svg>
          www.bandhanhospital.com
        </div>
      </div>
      <!-- Stripe bottom -->
      <div style="position:absolute;bottom:0;left:0;right:0;display:flex;height:24px;">
        <div style="flex:1;background:#0d2a6e;"></div>
        <div style="width:119px;background:#f5c300;"></div>
        <div style="width:38px;background:#e65100;"></div>
      </div>
    </div>

  </div><!-- end #idCard preview -->

  <!-- ═══════════════════════════════════════════════════════════
       HIDDEN PRINT-SIZE CARD — 408×646px for html2canvas capture
  ════════════════════════════════════════════════════════════════ -->
  <div id="idCardPrint" style="
    width:408px; height:646px;
    background:#fff;
    position:fixed; left:-9999px; top:0;
    font-family:'Segoe UI',Arial,sans-serif;
    display:flex; flex-direction:column;
    overflow:hidden;
  ">
    <!-- HEADER -->
    <div style="background:#0d2a6e;position:relative;height:100px;overflow:hidden;flex-shrink:0;">
      <svg style="position:absolute;top:0;left:0;width:100%;height:100%" viewBox="0 0 408 100"
        preserveAspectRatio="none">
        <polygon points="0,0 295,0 238,100 0,100" fill="#142f7a" />
        <polygon points="250,0 408,0 408,100 318,100" fill="#0a2060" />
        <line x1="0" y1="96" x2="408" y2="96" stroke="#f5c300" stroke-width="4.5" />
      </svg>
      <div style="position:absolute;top:11px;left:16px;z-index:2;">
        <div style="font-size:1.18rem;font-weight:900;color:#f5c300;letter-spacing:1.5px;line-height:1.1;">
          <?= strtoupper(esc($hospital_name ?? 'BANDHAN HOSPITAL')) ?>
        </div>
        <div style="font-size:.58rem;color:#8eb8e8;font-weight:600;margin-top:3px;letter-spacing:.4px;">
          <?= esc($hospital_address ?? '30/1 P.L.K. Maitra Road, Krishnagar, Nadia') ?>
        </div>
        <div style="font-size:.58rem;color:#8eb8e8;font-weight:600;margin-top:1px;letter-spacing:.4px;">
          <?= esc($hospital_address2 ?? 'PIN-741101 • West Bengal') ?>
        </div>
        <div
          style="font-size:.62rem;color:#f5c300;font-weight:700;margin-top:5px;display:flex;align-items:center;gap:4px;">
          <?= esc($hospital_phone ?? '8172007073 / 7318770083') ?>
        </div>
      </div>
      <div style="position:absolute;top:9px;right:13px;z-index:2;text-align:center;">
        <div
          style="width:47px;height:47px;background:rgba(255,255,255,0.12);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto;">
          <svg width="27" height="27" viewBox="0 0 24 24" fill="none">
            <rect x="10" y="2" width="4" height="20" rx="2" fill="#f5c300" />
            <rect x="2" y="10" width="20" height="4" rx="2" fill="#f5c300" />
            <circle cx="12" cy="12" r="3" fill="#fff" />
          </svg>
        </div>
        <div style="font-size:.46rem;color:#8eb8e8;font-weight:700;margin-top:3px;line-height:1.3;text-align:center;">
          Committed<br>To Care</div>
      </div>
    </div>
    <!-- WAVE -->
    <div style="position:relative;height:64px;overflow:hidden;flex-shrink:0;">
      <svg style="position:absolute;top:0;left:0;width:100%;height:100%" viewBox="0 0 408 64"
        preserveAspectRatio="none">
        <polygon points="0,0 250,0 176,64 0,64" fill="#0d2a6e" />
        <polygon points="125,0 318,0 250,64 57,64" fill="#1565c0" opacity=".65" />
        <polygon points="227,0 408,0 408,48 340,64 204,64" fill="#42a5f5" opacity=".45" />
      </svg>
    </div>
    <!-- PHOTO -->
    <div style="display:flex;justify-content:center;margin-top:-50px;position:relative;z-index:4;flex-shrink:0;">
      <div
        style="width:136px;height:136px;border:4px solid #1565c0;border-radius:13px;overflow:hidden;background:#c5d5e8;box-shadow:0 7px 28px rgba(13,42,110,.32);">
        <?php if (!empty($staff['photo'])): ?>
          <img src="<?= base_url('uploads/' . esc($staff['photo'])) ?>"
            style="width:100%;height:100%;object-fit:cover;display:block;">
        <?php else: ?>
          <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#b8cce0;">
            <svg width="60" height="60" viewBox="0 0 24 24" fill="#7090b8">
              <path
                d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z" />
            </svg>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <!-- NAME & ROLE -->
    <div style="text-align:center;padding:12px 18px 4px;flex-shrink:0;">
      <div
        style="font-size:1.7rem;font-weight:800;color:#0d1b3e;letter-spacing:2.5px;text-transform:uppercase;line-height:1.15;">
        <?= esc($staff['name']) ?>
      </div>
      <div style="display:inline-block;background:#e8f0fe;border-radius:20px;padding:5px 20px;margin-top:9px;">
        <span
          style="font-size:.88rem;font-weight:800;color:#1565c0;text-transform:uppercase;letter-spacing:1.8px;"><?= esc($staff['designation']) ?></span>
      </div>
    </div>
    <!-- DIVIDER -->
    <div style="margin:10px 27px 0;height:1px;background:#e0eaf5;flex-shrink:0;"></div>
    <!-- INFO + QR -->
    <div style="padding:10px 27px 10px;display:flex;gap:14px;align-items:flex-start;flex-shrink:0;">
      <div style="flex:1;">
        <div style="display:flex;align-items:center;gap:9px;padding:5px 0;border-bottom:1px solid #edf2fa;">
          <div
            style="width:32px;height:32px;background:#e8f0fe;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="#1565c0">
              <path
                d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V6h16v12zM6 10h2v2H6zm0 4h8v2H6zm4-4h8v2h-8z" />
            </svg>
          </div>
          <div>
            <div style="font-size:.64rem;color:#7090b0;font-weight:600;text-transform:uppercase;letter-spacing:.8px;">
              Staff ID</div>
            <div style="font-size:.92rem;font-weight:700;color:#0d1b3e;margin-top:1px;"><?= esc($staff['staff_id']) ?>
            </div>
          </div>
        </div>
        <div style="display:flex;align-items:center;gap:9px;padding:5px 0;border-bottom:1px solid #edf2fa;">
          <div
            style="width:32px;height:32px;background:#e8f0fe;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="#1565c0">
              <path
                d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
            </svg>
          </div>
          <div>
            <div style="font-size:.64rem;color:#7090b0;font-weight:600;text-transform:uppercase;letter-spacing:.8px;">
              Phone</div>
            <div style="font-size:.92rem;font-weight:700;color:#0d1b3e;margin-top:1px;"><?= esc($staff['phone']) ?>
            </div>
          </div>
        </div>
        <div style="display:flex;align-items:center;gap:9px;padding:5px 0;border-bottom:1px solid #edf2fa;">
          <div
            style="width:32px;height:32px;background:#fdeaea;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="#c62828">
              <path d="M12 2c-5.33 4.55-8 8.48-8 11.8 0 4.98 3.8 8.2 8 8.2s8-3.22 8-8.2c0-3.32-2.67-7.25-8-11.8z" />
            </svg>
          </div>
          <div>
            <div style="font-size:.64rem;color:#7090b0;font-weight:600;text-transform:uppercase;letter-spacing:.8px;">
              Blood Group</div>
            <div style="font-size:1rem;font-weight:800;color:#c62828;margin-top:1px;">
              <?= esc($staff['blood_group'] ?? '—') ?>
            </div>
          </div>
        </div>
        <div style="display:flex;align-items:center;gap:9px;padding:5px 0;">
          <div
            style="width:32px;height:32px;background:#e8f0fe;border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="#1565c0">
              <path
                d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z" />
            </svg>
          </div>
          <div>
            <div style="font-size:.64rem;color:#7090b0;font-weight:600;text-transform:uppercase;letter-spacing:.8px;">
              Joined</div>
            <div style="font-size:.92rem;font-weight:700;color:#0d1b3e;margin-top:1px;">
              <?= !empty($staff['joining_date']) ? date('d M Y', strtotime($staff['joining_date'])) : '—' ?>
            </div>
          </div>
        </div>
      </div>
      <!-- QR print -->
      <div style="flex-shrink:0;display:flex;flex-direction:column;align-items:center;gap:6px;padding-top:4px;">
        <div id="qrWrapPrint"
          style="width:97px;height:97px;border:2px solid #b8d0ee;border-radius:8px;overflow:hidden;background:#fff;padding:4px;display:flex;align-items:center;justify-content:center;">
        </div>
        <div style="font-size:.58rem;color:#7090b0;font-weight:600;text-align:center;letter-spacing:.5px;">SCAN
          TO<br>VERIFY</div>
      </div>
    </div>
    <!-- FOOTER print -->
    <div style="position:relative;height:66px;overflow:hidden;flex-shrink:0;margin-top:auto;">
      <svg style="position:absolute;top:0;left:0;width:100%;height:100%" viewBox="0 0 408 66"
        preserveAspectRatio="none">
        <rect width="408" height="66" fill="#f5f7fb" />
        <polygon points="0,66 0,36 200,66" fill="#0d2a6e" />
        <polygon points="0,66 0,18 310,66" fill="#1565c0" opacity=".7" />
        <polygon points="0,66 0,6  220,66" fill="#64b5f6" opacity=".5" />
        <polygon points="0,66 70,38 370,66" fill="#b3d4f5" opacity=".4" />
      </svg>
      <div
        style="position:absolute;top:4px;right:10px;display:flex;flex-direction:column;align-items:flex-end;gap:3px;z-index:2;">
        <div
          style="display:flex;align-items:center;gap:4px;font-size:.55rem;color:#1565c0;font-weight:700;background:rgba(240,245,255,0.92);border-radius:4px;padding:2px 6px;line-height:1.3;">
          <svg width="9" height="9" viewBox="0 0 24 24" fill="#1565c0">
            <path
              d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
          </svg>
          bandhanhospital@gmail.com
        </div>
        <div
          style="display:flex;align-items:center;gap:4px;font-size:.55rem;color:#1565c0;font-weight:700;background:rgba(240,245,255,0.92);border-radius:4px;padding:2px 6px;line-height:1.3;">
          <svg width="9" height="9" viewBox="0 0 24 24" fill="#1565c0">
            <path
              d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
          </svg>
          www.bandhanhospital.com
        </div>
      </div>
      <div style="position:absolute;bottom:0;left:0;right:0;display:flex;height:16px;">
        <div style="flex:1;background:#0d2a6e;"></div>
        <div style="width:79px;background:#f5c300;"></div>
        <div style="width:25px;background:#e65100;"></div>
      </div>
    </div>
  </div><!-- end #idCardPrint -->

  <!-- Download buttons -->
  <div class="no-print" style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;">
    <button onclick="downloadCard('png')"
      style="display:flex;align-items:center;gap:8px;padding:12px 26px;font-size:14px;font-weight:600;border-radius:9px;cursor:pointer;border:none;background:#0d2a6e;color:#fff;letter-spacing:.3px;">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
        <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z" />
      </svg>
      Download PNG · CR80 300 DPI
    </button>
    <button onclick="downloadCard('jpeg')"
      style="display:flex;align-items:center;gap:8px;padding:12px 26px;font-size:14px;font-weight:600;border-radius:9px;cursor:pointer;border:none;background:#f5c300;color:#0d2a6e;letter-spacing:.3px;">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
        <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z" />
      </svg>
      Download JPG · CR80 300 DPI
    </button>
  </div>
  <div id="dlStatus" style="font-size:12px;color:#7090b0;min-height:18px;text-align:center;"></div>

</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
  var qrData = '<?= esc($staff['staff_id']) ?>';

  // QR for screen preview
  new QRCode(document.getElementById('qrWrap'), {
    text: qrData, width: 133, height: 133,
    colorDark: '#0d2a6e', colorLight: '#ffffff',
    correctLevel: QRCode.CorrectLevel.M
  });

  // QR for print-size hidden card
  new QRCode(document.getElementById('qrWrapPrint'), {
    text: qrData, width: 89, height: 89,
    colorDark: '#0d2a6e', colorLight: '#ffffff',
    correctLevel: QRCode.CorrectLevel.M
  });

  function downloadCard(fmt) {
    var card = document.getElementById('idCardPrint'); // capture the exact-size card
    var status = document.getElementById('dlStatus');
    status.textContent = 'Rendering CR80 at 300 DPI…';
    /*
     * idCardPrint = 408×646px
     * CR80 @ 300dpi portrait = 638×1012px
     * scale = 638 / 408 = 1.5637
     */
    html2canvas(card, {
      scale: 10,
      useCORS: true,
      allowTaint: true,
      backgroundColor: '#ffffff',
      logging: false,
      width: 408,
      height: 646,
      windowWidth: 1200,
      windowHeight: 900
    }).then(function (canvas) {
      var mime = fmt === 'png' ? 'image/png' : 'image/jpeg';
      var url = canvas.toDataURL(mime, fmt === 'png' ? 1 : 0.96);
      var a = document.createElement('a');
      a.href = url;
      a.download = 'id-card-<?= esc($staff['staff_id']) ?>.' + fmt;
      a.click();
      status.textContent = 'Downloaded — ' + canvas.width + ' × ' + canvas.height + 'px (CR80 @ 300 DPI)';
    }).catch(function (e) {
      status.textContent = 'Error: ' + e.message;
    });
  }
</script>
<?= $this->endSection() ?>