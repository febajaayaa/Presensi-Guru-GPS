<x-app-layout>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Inter', 'Figtree', sans-serif; background: #0F172A; }

/* ══ SIDEBAR ══ */
.sidebar {
    width: 240px; position: fixed; top: 0; left: 0; height: 100vh;
    background: linear-gradient(160deg, #0F172A 0%, #1E3A5F 55%, #1D4ED8 100%);
    display: flex; flex-direction: column;
    box-shadow: 4px 0 24px rgba(0,0,0,0.3); z-index: 50;
    transition: transform 0.3s;
}
.sb-brand {
    padding: 20px 18px 16px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
    display: flex; align-items: center; gap: 10px;
}
.sb-brand-icon {
    width: 36px; height: 36px; background: #2563EB; border-radius: 9px;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.sb-brand-name { font-size: 11px; font-weight: 700; color: #93C5FD; letter-spacing: 0.06em; }
.sb-brand-sub  { font-size: 9px; color: #475569; margin-top: 2px; text-transform: uppercase; }

.sb-profile {
    margin: 14px 12px 4px; padding: 10px 12px;
    background: rgba(255,255,255,0.06); border-radius: 10px;
    display: flex; align-items: center; gap: 10px;
    text-decoration: none; transition: background 0.15s;
}
.sb-profile:hover { background: rgba(255,255,255,0.12); }
.sb-profile img {
    width: 38px; height: 38px; border-radius: 50%;
    object-fit: cover; border: 2px solid #3B82F6; flex-shrink: 0;
}
.sb-profile-name { font-size: 13px; font-weight: 600; color: #F1F5F9; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.sb-profile-role { font-size: 11px; color: #60A5FA; display: flex; align-items: center; gap: 4px; margin-top: 2px; }
.sb-online { width: 6px; height: 6px; background: #22C55E; border-radius: 50%; animation: pulse 2s infinite; flex-shrink: 0; }
@keyframes pulse { 0%,100%{opacity:1}50%{opacity:.5} }

.sb-nav-label {
    font-size: 9px; color: #475569; letter-spacing: 0.12em;
    text-transform: uppercase; padding: 14px 18px 6px;
}
.sb-nav-link {
    display: flex; align-items: center; gap: 9px;
    padding: 9px 12px; border-radius: 8px; margin: 1px 6px;
    font-size: 13px; color: #94A3B8; text-decoration: none;
    border-left: 2px solid transparent; transition: all 0.15s;
}
.sb-nav-link:hover { background: rgba(255,255,255,0.07); color: #F1F5F9; }
.sb-nav-link.active { background: rgba(59,130,246,0.18); color: #F1F5F9; border-left-color: #3B82F6; }
.sb-nav-link i { font-size: 17px; width: 20px; text-align: center; flex-shrink: 0; }

.sb-footer { padding: 12px 14px; border-top: 1px solid rgba(255,255,255,0.07); margin-top: auto; }
.sb-logout-btn {
    width: 100%; background: rgba(239,68,68,0.12); color: #FCA5A5;
    border: 1px solid rgba(239,68,68,0.25); padding: 9px; border-radius: 8px;
    font-size: 13px; cursor: pointer; font-family: inherit;
    display: flex; align-items: center; justify-content: center; gap: 6px;
    transition: background 0.15s;
}
.sb-logout-btn:hover { background: rgba(239,68,68,0.28); }

/* ══ MAIN ══ */
.main-wrap {
    margin-left: 240px; min-height: 100vh;
    width: calc(100% - 240px);
    background: #F1F5F9; padding: 36px 40px;
    display: flex; flex-direction: column; align-items: stretch;
}

/* ══ Breadcrumb ══ */
.breadcrumb {
    display: flex; align-items: center; gap: 6px;
    font-size: 12px; color: #64748B; margin-bottom: 22px;
}
.breadcrumb a { color: #3B82F6; text-decoration: none; }
.breadcrumb a:hover { text-decoration: underline; }

/* ══ Page header ══ */
.page-title { font-size: 22px; font-weight: 700; color: #0F172A; margin-bottom: 4px; }
.page-sub   { font-size: 13px; color: #64748B; margin-bottom: 28px; }

/* ══ Alert ══ */
.alert-err {
    display: flex; align-items: flex-start; gap: 10px;
    padding: 13px 16px; border-radius: 10px; margin-bottom: 20px;
    background: #FEF2F2; border: 1px solid #FECACA; color: #991B1B; font-size: 13px;
    width: 100%;
}

/* ══ Form Card ══ */
.form-card {
    width: 100%;
    background: #fff; border: 1px solid #E2E8F0;
    border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    overflow: hidden;
}

.card-head {
    padding: 20px 28px;
    border-bottom: 1px solid #F1F5F9;
    background: linear-gradient(135deg, #EFF6FF 0%, #F8FAFF 100%);
    display: flex; align-items: center; gap: 14px;
}
.card-head-icon {
    width: 46px; height: 46px; background: #DBEAFE;
    border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.card-head-icon i { font-size: 22px; color: #2563EB; }
.card-head-title { font-size: 15px; font-weight: 700; color: #0F172A; }
.card-head-sub   { font-size: 12px; color: #64748B; margin-top: 2px; }

.card-body { padding: 28px; }

.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.col-full  { grid-column: 1 / -1; }

.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-label { font-size: 12px; font-weight: 600; color: #374151; }
.form-label .req { color: #EF4444; }
.form-label .opt { color: #94A3B8; font-weight: 500; }

.inp-wrap { position: relative; }
.inp-wrap .ico {
    position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
    font-size: 16px; color: #94A3B8; pointer-events: none; z-index: 1;
}
.inp {
    width: 100%; height: 44px;
    border: 1.5px solid #E2E8F0; border-radius: 10px;
    padding: 0 14px 0 40px; font-size: 13px; color: #0F172A;
    background: #FAFBFC; outline: none; font-family: inherit;
    transition: border-color 0.15s, box-shadow 0.15s;
}
.inp:focus { border-color: #3B82F6; box-shadow: 0 0 0 3px rgba(59,130,246,0.12); background: #fff; }
.inp::placeholder { color: #C1C9D4; }
.inp.is-err { border-color: #EF4444; }
.btn-eye {
    position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
    background: none; border: none; cursor: pointer; color: #94A3B8;
    font-size: 16px; padding: 0; line-height: 1; transition: color 0.15s;
}
.btn-eye:hover { color: #3B82F6; }
.field-hint  { font-size: 11px; color: #94A3B8; }
.field-err   { font-size: 11px; color: #EF4444; display: flex; align-items: center; gap: 4px; }

.card-divider { height: 1px; background: #F1F5F9; margin: 0; }

.card-foot {
    padding: 18px 28px; background: #FAFBFC;
    display: flex; align-items: center; justify-content: flex-end; gap: 10px;
}
.btn {
    display: inline-flex; align-items: center; gap: 6px;
    height: 42px; padding: 0 20px; border-radius: 10px;
    font-size: 13px; font-weight: 600; cursor: pointer;
    border: none; text-decoration: none;
    transition: all 0.15s; font-family: inherit;
}
.btn i { font-size: 16px; }
.btn-primary { background: #2563EB; color: #fff; }
.btn-primary:hover { background: #1D4ED8; transform: translateY(-1px); box-shadow: 0 4px 14px rgba(37,99,235,0.3); }
.btn-secondary { background: #fff; color: #475569; border: 1.5px solid #E2E8F0; }
.btn-secondary:hover { background: #F8FAFC; }

/* ══ Mobile ══ */
.hamburger {
    display: none; position: fixed; top: 14px; left: 14px; z-index: 60;
    width: 38px; height: 38px; background: #1E3A8A; color: #fff;
    border: none; border-radius: 8px;
    align-items: center; justify-content: center; font-size: 18px; cursor: pointer;
}
.sb-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,0.4); z-index: 45;
}
.sb-overlay.show { display: block; }

@media (max-width: 768px) {
    .hamburger { display: flex; }
    .sidebar { transform: translateX(-100%); }
    .sidebar.open { transform: translateX(0); }
    .main-wrap { margin-left: 0; width: 100%; padding: 70px 16px 24px; }
    .form-grid { grid-template-columns: 1fr; }
    .col-full { grid-column: 1; }
}

@keyframes spin { to { transform: rotate(360deg); } }
</style>

<!-- Mobile hamburger -->
<button class="hamburger" onclick="toggleSidebar()"><i class="ti ti-menu-2"></i></button>
<div class="sb-overlay" id="sbOverlay" onclick="toggleSidebar()"></div>

<div style="display:flex; min-height:100vh; width:100%;">

{{-- ══════════ SIDEBAR ══════════ --}}
<aside class="sidebar" id="sidebar">

    <div class="sb-brand">
        <div class="sb-brand-icon">
            <i class="ti ti-school" style="font-size:18px; color:#fff;"></i>
        </div>
        <div>
            <div class="sb-brand-name">SMART PRESENSI</div>
            <div class="sb-brand-sub">Management System</div>
        </div>
    </div>

    <a href="{{ route('admin.pengaturan') }}" class="sb-profile">
        <img src="{{ Auth::user()->photo ? asset('storage/'.Auth::user()->photo) : 'https://i.pravatar.cc/50?u='.Auth::id() }}"
             alt="{{ Auth::user()->name }}">
        <div style="overflow:hidden;">
            <div class="sb-profile-name">{{ Auth::user()->name }}</div>
            <div class="sb-profile-role">
                <span class="sb-online"></span>
                {{ auth()->user()->role == 'super_admin' ? 'Super Admin' : 'Admin Sekolah' }}
            </div>
        </div>
    </a>

    <nav style="flex:1; overflow-y:auto; padding:4px 0;">
        <div class="sb-nav-label">Menu Utama</div>

        @php
        $navItems = [
            ['label'=>'Beranda',        'route'=>'admin.dashboard',  'url'=>null, 'icon'=>'ti-layout-dashboard'],
            ['label'=>'Data Guru',       'route'=>'guru.index',       'url'=>null, 'icon'=>'ti-users'],
            ['label'=>'Rekap Presensi',  'route'=>'admin.rekap',      'url'=>null, 'icon'=>'ti-clipboard-list'],
            ['label'=>'Registrasi Guru', 'route'=>'admin.registrasi', 'url'=>null, 'icon'=>'ti-user-plus'],
            ['label'=>'Persetujuan',     'route'=>null, 'url'=>'/admin/izin',      'icon'=>'ti-checkbox'],
            ['label'=>'Pengaturan',      'route'=>'admin.pengaturan', 'url'=>null, 'icon'=>'ti-settings'],
        ];
        @endphp

        @foreach($navItems as $item)
            @php
                $active = $item['route']
                    ? Route::currentRouteName() == $item['route']
                    : request()->is(ltrim($item['url'],'/'));
                $href = $item['route'] ? route($item['route']) : $item['url'];
            @endphp
            <a href="{{ $href }}" class="sb-nav-link {{ $active ? 'active' : '' }}">
                <i class="ti {{ $item['icon'] }}"></i>
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>

    <div class="sb-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sb-logout-btn">
                <i class="ti ti-logout" style="font-size:16px;"></i> Keluar
            </button>
        </form>
    </div>
</aside>

{{-- ══════════ MAIN ══════════ --}}
<main class="main-wrap">

    {{-- Breadcrumb --}}
    <nav class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Beranda</a>
        <i class="ti ti-chevron-right" style="font-size:12px;"></i>
        <a href="{{ route('guru.index') }}">Data Guru</a>
        <i class="ti ti-chevron-right" style="font-size:12px;"></i>
        <span>Edit Guru</span>
    </nav>

    {{-- Page Header --}}
    <h1 class="page-title">Edit Guru</h1>
    <p class="page-sub">Perbarui data akun guru yang terdaftar di sistem.</p>

    {{-- Error --}}
    @if($errors->any())
    <div class="alert-err">
        <i class="ti ti-alert-circle" style="font-size:17px; flex-shrink:0; margin-top:1px;"></i>
        <div>
            <strong>Ada {{ $errors->count() }} kesalahan:</strong>
            <ul style="margin:5px 0 0 14px; padding:0;">
                @foreach($errors->all() as $err)
                    <li style="margin-bottom:2px;">{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    {{-- Form Card --}}
    <div class="form-card">

        {{-- Card Header --}}
        <div class="card-head">
            <div class="card-head-icon">
                <i class="ti ti-user-edit"></i>
            </div>
            <div>
                <div class="card-head-title">Data Akun Guru</div>
                <div class="card-head-sub">Informasi login guru</div>
            </div>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('guru.update', $guru->id) }}" id="editForm" onsubmit="return onSubmit()">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-grid">

                    {{-- Nama --}}
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap <span class="req">*</span></label>
                        <div class="inp-wrap">
                            <i class="ti ti-user ico"></i>
                            <input type="text" name="name"
                                   value="{{ old('name', $guru->name) }}"
                                   placeholder="Contoh: Budi Santoso"
                                   class="inp {{ $errors->has('name') ? 'is-err' : '' }}"
                                   required>
                        </div>
                        @error('name')
                            <span class="field-err"><i class="ti ti-alert-circle"></i>{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label class="form-label">Email <span class="req">*</span></label>
                        <div class="inp-wrap">
                            <i class="ti ti-mail ico"></i>
                            <input type="email" name="email"
                                   value="{{ old('email', $guru->email) }}"
                                   placeholder="guru@sekolah.sch.id"
                                   class="inp {{ $errors->has('email') ? 'is-err' : '' }}"
                                   required>
                        </div>
                        @error('email')
                            <span class="field-err"><i class="ti ti-alert-circle"></i>{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="form-group col-full">
                        <label class="form-label">Password <span class="opt">(opsional)</span></label>
                        <div class="inp-wrap">
                            <i class="ti ti-lock ico"></i>
                            <input type="password" id="pwInput" name="password"
                                   placeholder="Kosongkan jika tidak ingin mengubah"
                                   class="inp {{ $errors->has('password') ? 'is-err' : '' }}"
                                   style="padding-right:44px;">
                            <button type="button" class="btn-eye" onclick="togglePw()">
                                <i class="ti ti-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                        <span class="field-hint">Isi hanya jika ingin mengganti password guru. Minimal 8 karakter.</span>
                        @error('password')
                            <span class="field-err"><i class="ti ti-alert-circle"></i>{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-divider"></div>

            <div class="card-foot">
                <a href="{{ route('guru.index') }}" class="btn btn-secondary">
                    <i class="ti ti-arrow-left"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="ti ti-device-floppy"></i> Simpan Perubahan
                </button>
            </div>

        </form>
    </div>

</main>
</div>

<script>
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('sbOverlay').classList.toggle('show');
}
function togglePw() {
    const inp = document.getElementById('pwInput');
    const ico = document.getElementById('eyeIcon');
    inp.type = inp.type === 'password' ? 'text' : 'password';
    ico.className = inp.type === 'password' ? 'ti ti-eye' : 'ti ti-eye-off';
}
function onSubmit() {
    const btn = document.getElementById('submitBtn');
    btn.innerHTML = '<i class="ti ti-loader-2" style="animation:spin .8s linear infinite; font-size:16px;"></i> Menyimpan...';
    btn.disabled = true;
    return true;
}
</script>

</x-app-layout>