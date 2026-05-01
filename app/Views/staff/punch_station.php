<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    /* ── Punch screen ───────────────────────────────────── */
    #punchScreen {
        min-height: 300px;
        border-radius: 12px;
        border: 1.5px dashed var(--border);
        background: var(--subtle);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        transition: background .3s, border-color .3s;
        padding: 24px;
    }

    #punchScreen.punch-in {
        background: #f0fdf4;
        border-color: #86efac;
    }

    #punchScreen.punch-out {
        background: #fef2f2;
        border-color: #fca5a5;
    }

    #punchScreen.punch-err {
        background: #fffbeb;
        border-color: #fcd34d;
    }

    /* ── Result avatar ──────────────────────────────────── */
    .punch-av {
        width: 72px;
        height: 72px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 14px;
        flex-shrink: 0;
    }

    /* ── Pill badge on result ───────────────────────────── */
    .punch-pill {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 6px 18px;
        border-radius: 99px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: .5px;
        color: #fff;
    }

    /* ── Clock ──────────────────────────────────────────── */
    #clock {
        font-size: 22px;
        font-weight: 700;
        letter-spacing: 2px;
        font-family: 'DM Mono', monospace;
        color: var(--text);
    }

    #clockDate {
        font-size: 11.5px;
        color: var(--muted);
        text-align: right;
        margin-top: 1px;
    }

    /* ── Pill tabs ──────────────────────────────────────── */
    .ptab-bar {
        display: flex;
        gap: 6px;
        padding: 14px 16px 0;
    }

    .ptab-link {
        padding: 6px 16px;
        border-radius: 99px;
        font-size: 13px;
        font-weight: 500;
        color: var(--muted);
        background: var(--subtle);
        border: 1px solid var(--border);
        text-decoration: none;
        cursor: pointer;
        transition: background .15s, color .15s;
    }

    .ptab-link.on {
        background: var(--indigo);
        color: #fff;
        border-color: var(--indigo);
    }

    /* ── QR input ───────────────────────────────────────── */
    .qr-wrap {
        display: flex;
        gap: 0;
    }

    .qr-prefix {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        background: var(--indigo);
        color: #fff;
        border-radius: 10px 0 0 10px;
        font-size: 18px;
        flex-shrink: 0;
        border: 1px solid var(--indigo);
    }

    .qr-input {
        flex: 1;
        padding: 11px 14px;
        border: 1px solid var(--border);
        border-left: none;
        border-right: none;
        font-size: 15px;
        font-weight: 600;
        color: var(--text);
        background: var(--surf);
        outline: none;
        font-family: 'DM Mono', monospace;
        letter-spacing: 1px;
    }

    .qr-input:focus {
        border-color: var(--indigo);
    }

    .qr-btn {
        padding: 11px 22px;
        background: var(--indigo);
        color: #fff;
        border: 1px solid var(--indigo);
        border-radius: 0 10px 10px 0;
        font-size: 13.5px;
        font-weight: 600;
        cursor: pointer;
        transition: opacity .15s;
    }

    .qr-btn:hover {
        opacity: .9;
    }

    /* ── Search dropdown ────────────────────────────────── */
    .search-wrap {
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 10px 14px 10px 36px;
        border: 1px solid var(--border);
        border-radius: 10px;
        font-size: 13.5px;
        color: var(--text);
        background: var(--surf);
        outline: none;
    }

    .search-input:focus {
        border-color: var(--indigo);
    }

    .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--muted);
        font-size: 14px;
        pointer-events: none;
    }

    #staffDropdown {
        position: absolute;
        top: calc(100% + 6px);
        left: 0;
        right: 0;
        z-index: 999;
        background: var(--surf);
        border: 1px solid var(--border);
        border-radius: 10px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, .1);
        overflow: hidden;
        display: none;
    }

    .staff-opt {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        cursor: pointer;
        transition: background .12s;
    }

    .staff-opt:hover {
        background: var(--subtle);
    }

    .staff-opt:not(:last-child) {
        border-bottom: 1px solid var(--border);
    }

    .opt-av {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: rgba(59, 79, 216, .12);
        color: var(--indigo);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
        flex-shrink: 0;
    }

    /* ── Selected staff chip ────────────────────────────── */
    .sel-chip {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        background: var(--subtle);
        border: 1px solid var(--border);
        border-radius: 10px;
        margin-bottom: 12px;
    }

    .sel-av {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: rgba(59, 79, 216, .12);
        color: var(--indigo);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .sel-clear {
        width: 28px;
        height: 28px;
        border-radius: 7px;
        background: transparent;
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--muted);
        margin-left: auto;
        transition: background .12s;
    }

    .sel-clear:hover {
        background: var(--border);
    }

    .punch-full-btn {
        width: 100%;
        padding: 12px;
        background: var(--indigo);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: opacity .15s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .punch-full-btn:hover {
        opacity: .9;
    }

    /* ── Log entries ────────────────────────────────────── */
    .log-entry {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px 16px;
        border-bottom: 1px solid var(--border);
        animation: slideIn .25s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-6px);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    .log-av {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .log-av-in {
        background: #dcfce7;
        color: #166534;
    }

    .log-av-out {
        background: #fef2f2;
        color: #dc2626;
    }

    .log-name {
        font-size: 13.5px;
        font-weight: 600;
    }

    .log-meta {
        font-size: 11.5px;
        color: var(--muted);
        margin-top: 1px;
    }

    .log-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 10px;
        border-radius: 99px;
        font-size: 11.5px;
        font-weight: 600;
    }

    .log-badge-in {
        background: #dcfce7;
        color: #166534;
    }

    .log-badge-out {
        background: #fef2f2;
        color: #dc2626;
    }

    .log-time {
        font-size: 11px;
        color: var(--muted);
        font-family: 'DM Mono', monospace;
        margin-top: 3px;
        text-align: right;
    }
</style>

<div style="display:grid;grid-template-columns:1fr 380px;gap:16px;align-items:start;">

    <!-- ══ LEFT: Punch Station ══════════════════════════════════════ -->
    <div class="card" style="border-radius:12px;overflow:hidden;">

        <!-- Header with clock -->
        <div style="padding:16px 20px;border-bottom:1px solid var(--border);
                display:flex;justify-content:space-between;align-items:center;">
            <div style="display:flex;align-items:center;gap:9px;">
                <i class="bi bi-fingerprint" style="font-size:18px;color:var(--indigo);"></i>
                <span style="font-size:15px;font-weight:600;">Punch Station</span>
            </div>
            <div style="text-align:right;">
                <div id="clock">00:00:00</div>
                <div id="clockDate"></div>
            </div>
        </div>

        <!-- Pill tab switcher -->
        <div class="ptab-bar">
            <span class="ptab-link on" onclick="switchTab('qr', this)">
                <i class="bi bi-qr-code-scan me-1"></i>QR / Staff ID
            </span>
            <span class="ptab-link" onclick="switchTab('search', this)">
                <i class="bi bi-search me-1"></i>Search Staff
            </span>
        </div>

        <!-- Tab content -->
        <div style="padding:16px 20px;">

            <!-- QR Tab -->
            <div id="tabQr">
                <div
                    style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:var(--muted);margin-bottom:8px;">
                    Scan QR or type Staff ID
                </div>
                <div class="qr-wrap">
                    <div class="qr-prefix"><i class="bi bi-qr-code"></i></div>
                    <input type="text" id="qrInput" class="qr-input" placeholder="BH-NU-0001" autocomplete="off"
                        autocapitalize="characters" spellcheck="false">
                    <button class="qr-btn" onclick="punchById()">
                        <i class="bi bi-arrow-right-circle me-1"></i>Punch
                    </button>
                </div>
                <div style="font-size:11.5px;color:var(--muted);margin-top:7px;">
                    Focus here and scan the staff ID card QR code, or type the ID manually and press Enter.
                </div>
            </div>

            <!-- Search Tab -->
            <div id="tabSearch" style="display:none;">
                <div
                    style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:var(--muted);margin-bottom:8px;">
                    Search by name or Staff ID
                </div>
                <div class="search-wrap">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" id="staffSearch" class="search-input" placeholder="Start typing name or ID…"
                        oninput="searchStaff(this.value)">
                    <div id="staffDropdown"></div>
                </div>
                <div id="selectedStaff" style="display:none;margin-top:12px;">
                    <div class="sel-chip">
                        <div class="sel-av" id="selAvatar"></div>
                        <div>
                            <div style="font-size:14px;font-weight:600;" id="selName"></div>
                            <div style="font-size:12px;color:var(--muted);" id="selMeta"></div>
                        </div>
                        <button class="sel-clear" onclick="clearSelection()" title="Clear">
                            <i class="bi bi-x" style="font-size:14px;"></i>
                        </button>
                    </div>
                    <button class="punch-full-btn" onclick="punchSelected()">
                        <i class="bi bi-arrow-right-circle" style="font-size:15px;"></i>
                        Record Punch
                    </button>
                </div>
            </div>

        </div>

        <!-- Result display -->
        <div id="punchScreen" style="margin:0 16px 16px;">
            <i class="bi bi-fingerprint" style="font-size:48px;color:var(--border);opacity:.6;"></i>
            <div style="font-size:13px;color:var(--muted);margin-top:10px;">Waiting for punch…</div>
        </div>

    </div>

    <!-- ══ RIGHT: Today's Punches ═══════════════════════════════════ -->
    <div class="card" style="border-radius:12px;overflow:hidden;">

        <div style="padding:14px 18px;border-bottom:1px solid var(--border);
                display:flex;justify-content:space-between;align-items:center;">
            <div style="display:flex;align-items:center;gap:8px;">
                <i class="bi bi-clock-history" style="font-size:15px;color:var(--indigo);"></i>
                <span style="font-size:14px;font-weight:600;">Today's Punches</span>
            </div>
            <span id="logCount" style="background:var(--subtle);border:1px solid var(--border);
            border-radius:99px;padding:2px 10px;font-size:12px;font-weight:600;color:var(--muted);">0</span>
        </div>

        <div id="punchLog" style="max-height:520px;overflow-y:auto;">
            <div id="logEmpty" style="padding:60px 20px;text-align:center;color:var(--muted);">
                <i class="bi bi-inbox" style="font-size:36px;opacity:.2;display:block;margin-bottom:10px;"></i>
                <div style="font-size:13px;">No punches yet today</div>
            </div>
        </div>

    </div>

</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    const PUNCH_URL = '<?= base_url('api/attendance/punch') ?>';
    const SEARCH_URL = '<?= base_url('attendance/staffSearch') ?>';
    const CSRF_NAME = '<?= csrf_token() ?>';
    let csrfHash = '<?= csrf_hash() ?>';
    let selectedStaffId = null;
    let logCount = 0;
    let searchTimer;

    // ── Clock ────────────────────────────────────────────────────────────
    function tick() {
        const now = new Date();
        document.getElementById('clock').textContent =
            now.toLocaleTimeString('en-IN', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });
        document.getElementById('clockDate').textContent =
            now.toLocaleDateString('en-IN', { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' });
    }
    setInterval(tick, 1000); tick();

    // ── Tab switching (no Bootstrap tabs needed) ─────────────────────────
    function switchTab(tab, el) {
        document.querySelectorAll('.ptab-link').forEach(l => l.classList.remove('on'));
        el.classList.add('on');
        document.getElementById('tabQr').style.display = tab === 'qr' ? '' : 'none';
        document.getElementById('tabSearch').style.display = tab === 'search' ? '' : 'none';
        if (tab === 'qr') setTimeout(() => document.getElementById('qrInput').focus(), 50);
    }

    // ── Auto-focus + Enter ───────────────────────────────────────────────
    document.getElementById('qrInput').addEventListener('keydown', e => {
        if (e.key === 'Enter') { e.preventDefault(); punchById(); }
    });
    setTimeout(() => document.getElementById('qrInput').focus(), 300);

    // ── Punch by Staff ID ────────────────────────────────────────────────
    function punchById() {
        const v = document.getElementById('qrInput').value.trim().toUpperCase();
        if (!v) return;
        doPunch(v);
        document.getElementById('qrInput').value = '';
        document.getElementById('qrInput').focus();
    }

    function punchSelected() {
        if (!selectedStaffId) return;
        doPunch(selectedStaffId);
        clearSelection();
    }

    // ── Core punch ───────────────────────────────────────────────────────
    function doPunch(staffCode) {
        const screen = document.getElementById('punchScreen');
        screen.className = '';
        screen.innerHTML = `<div style="display:flex;flex-direction:column;align-items:center;gap:12px;">
    <div style="width:36px;height:36px;border:3px solid var(--indigo);border-top-color:transparent;
                border-radius:50%;animation:spin .7s linear infinite;"></div>
    <div style="font-size:13px;color:var(--muted);">Processing…</div>
  </div>`;

        const body = { [CSRF_NAME]: csrfHash, staff_id: staffCode, source: 'web' };

        fetch(PUNCH_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            body: JSON.stringify(body),
        })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    csrfHash = data.csrf_hash ?? csrfHash;
                    showResult(data);
                    addToLog(data);
                } else {
                    showError(data.error ?? 'Unknown error');
                }
            })
            .catch(() => showError('Network error. Please try again.'));
    }

    // ── Result display ───────────────────────────────────────────────────
    function showResult(data) {
        const isIn = data.punch_type === 'in';
        const screen = document.getElementById('punchScreen');
        const col = isIn ? '#16a34a' : '#dc2626';
        const icon = isIn ? 'bi-box-arrow-in-right' : 'bi-box-arrow-right';
        const label = isIn ? 'PUNCH IN' : 'PUNCH OUT';
        const init = data.name.split(' ').map(w => w[0]).join('').substring(0, 2).toUpperCase();
        const ts = new Date(data.punched_at.replace(' ', 'T'))
            .toLocaleTimeString('en-IN', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });

        screen.className = isIn ? 'punch-in' : 'punch-out';
        screen.innerHTML = `
    <div class="punch-av" style="background:${col};box-shadow:0 8px 24px ${col}40;">${init}</div>
    <div style="font-size:17px;font-weight:700;color:var(--text);margin-bottom:3px;">${data.name}</div>
    <div style="font-size:12.5px;color:var(--muted);margin-bottom:14px;">${data.staff_id} · ${data.department}</div>
    <div class="punch-pill" style="background:${col};">
      <i class="bi ${icon}"></i>${label}
    </div>
    <div style="font-size:32px;font-weight:700;color:${col};margin-top:14px;
                font-family:'DM Mono',monospace;letter-spacing:2px;">${ts}</div>
  `;

        setTimeout(resetScreen, 5000);
    }

    function showError(msg) {
        const screen = document.getElementById('punchScreen');
        screen.className = 'punch-err';
        screen.innerHTML = `
    <i class="bi bi-exclamation-triangle" style="font-size:40px;color:#d97706;"></i>
    <div style="font-size:14px;font-weight:600;color:#92400e;margin-top:12px;">${msg}</div>
  `;
        setTimeout(resetScreen, 4000);
    }

    function resetScreen() {
        const screen = document.getElementById('punchScreen');
        screen.className = '';
        screen.innerHTML = `<i class="bi bi-fingerprint" style="font-size:48px;color:var(--border);opacity:.6;"></i>
    <div style="font-size:13px;color:var(--muted);margin-top:10px;">Waiting for punch…</div>`;
    }

    // ── Log ──────────────────────────────────────────────────────────────
    function addToLog(data) {
        const isIn = data.punch_type === 'in';
        const init = data.name.split(' ').map(w => w[0]).join('').substring(0, 2).toUpperCase();
        const ts = new Date(data.punched_at.replace(' ', 'T'))
            .toLocaleTimeString('en-IN', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });

        document.getElementById('logEmpty')?.remove();
        logCount++;
        document.getElementById('logCount').textContent = logCount;

        const row = document.createElement('div');
        row.className = 'log-entry';
        row.innerHTML = `
    <div class="log-av ${isIn ? 'log-av-in' : 'log-av-out'}">${init}</div>
    <div style="flex:1;min-width:0;">
      <div class="log-name">${data.name}</div>
      <div class="log-meta">${data.staff_id} · ${data.department}</div>
    </div>
    <div style="text-align:right;flex-shrink:0;">
      <div class="log-badge ${isIn ? 'log-badge-in' : 'log-badge-out'}">
        <i class="bi ${isIn ? 'bi-box-arrow-in-right' : 'bi-box-arrow-right'}"></i>
        ${isIn ? 'IN' : 'OUT'}
      </div>
      <div class="log-time">${ts}</div>
    </div>
  `;
        document.getElementById('punchLog').prepend(row);
    }

    // ── Staff search ─────────────────────────────────────────────────────
    function searchStaff(q) {
        clearTimeout(searchTimer);
        const dd = document.getElementById('staffDropdown');
        if (q.length < 2) { dd.style.display = 'none'; return; }
        searchTimer = setTimeout(() => {
            fetch(SEARCH_URL + '?q=' + encodeURIComponent(q))
                .then(r => r.json())
                .then(results => {
                    if (!results.length) {
                        dd.innerHTML = '<div style="padding:12px 16px;font-size:13px;color:var(--muted);">No staff found</div>';
                    } else {
                        dd.innerHTML = results.map(s => {
                            const av = s.name.split(' ').map(w => w[0]).join('').substring(0, 2).toUpperCase();
                            return `<div class="staff-opt"
                         onclick="selectStaff('${s.staff_id}','${s.name}','${s.designation}','${s.department}')">
              <div class="opt-av">${av}</div>
              <div>
                <div style="font-size:13.5px;font-weight:600;">${s.name}</div>
                <div style="font-size:12px;color:var(--muted);">${s.staff_id} · ${s.designation}</div>
              </div>
            </div>`;
                        }).join('');
                    }
                    dd.style.display = 'block';
                });
        }, 200);
    }

    function selectStaff(staffId, name, designation, department) {
        selectedStaffId = staffId;
        const av = name.split(' ').map(w => w[0]).join('').substring(0, 2).toUpperCase();
        document.getElementById('staffSearch').value = '';
        document.getElementById('staffDropdown').style.display = 'none';
        document.getElementById('selAvatar').textContent = av;
        document.getElementById('selName').textContent = name;
        document.getElementById('selMeta').textContent = staffId + ' · ' + designation + ' · ' + department;
        document.getElementById('selectedStaff').style.display = '';
    }

    function clearSelection() {
        selectedStaffId = null;
        document.getElementById('selectedStaff').style.display = 'none';
        document.getElementById('staffSearch').value = '';
    }

    document.addEventListener('click', e => {
        if (!e.target.closest('#tabSearch'))
            document.getElementById('staffDropdown').style.display = 'none';
    });

    // ── Spinner keyframe ──────────────────────────────────────────────────
    const st = document.createElement('style');
    st.textContent = '@keyframes spin { to { transform: rotate(360deg); } }';
    document.head.appendChild(st);
</script>
<?= $this->endSection() ?>