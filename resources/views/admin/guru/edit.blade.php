<x-app-layout>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

<style>
    .app-sidebar { transition: transform 0.3s ease; }
    .hamburger-btn { display: none; }

    @media (max-width: 768px) {
        .hamburger-btn {
            display: flex;
            position: fixed;
            top: 14px; left: 14px;
            z-index: 60;
            width: 38px; height: 38px;
            background: #1E3A8A;
            color: #fff;
            border: none;
            border-radius: 8px;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
        }
        .app-sidebar { transform: translateX(-100%); }
        .app-sidebar.open { transform: translateX(0); }
        .app-main { margin-left: 0 !important; min-width: 0; padding: 60px 16px 16px !important; }
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 45;
        }
        .sidebar-overlay.show { display: block; }
        .form-card { margin: 0 !important; }
    }
</style>

<button class="hamburger-btn" onclick="toggleSidebar()" aria-label="Buka menu">
    <i class="ti ti-menu-2"></i>
</button>
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<div class="flex min-h-screen" style="background:#F0F4F8; font-family:'Inter',sans-serif;">

{{-- ═══════════════════════════════════════════
     SIDEBAR
═══════════════════════════════════════════ --}}
<aside class="app-sidebar" style="width:240px; background:linear-gradient(160deg,#0F172A 0%,#1E3A5F 60%,#1D4ED8 100%); color:white; position:fixed; top:0; left:0; height:100vh; display:flex; flex-direction:column; box-shadow:4px 0 24px rgba(0,0,0,0.18); z-index:50;">

    {{-- Brand --}}
    <div style="padding:22px 20px 16px; border-bottom:1px solid rgba(255,255,255,0.08);">
        <div style="display:flex; align-items:center; gap:10px;">
            <div style="width:34px; height:34px; background:#2563EB; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                <i class="ti ti-school" style="font-size:18px; color:#fff;"></i>
            </div>
            <div>
                <div style="font-size:12px; font-weight:700; color:#93C5FD; letter-spacing:0.05em;">SMART PRESENSI</div>
                <div style="font-size:10px; color:#475569; margin-top:1px; text-transform:uppercase;">Management System</div>
            </div>
        </div>
    </div>

    {{-- Profil Super Admin --}}
    <div style="display:flex; align-items:center; gap:10px; margin:16px 14px 6px; padding:10px 12px; border-radius:10px; background:rgba(255,255,255,0.06);">
        <div style="width:38px; height:38px; border-radius:50%; background:#2563EB; display:flex; align-items:center; justify-content:center; border:2px solid #3B82F6; flex-shrink:0;">
            <i class="ti ti-shield-check" style="font-size:18px; color:#fff;"></i>
        </div>
        <div style="overflow:hidden;">
            <div style="font-size:13px; font-weight:600; color:#F1F5F9; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                {{ Auth::user()->name }}
            </div>
            <div style="font-size:11px; color:#60A5FA; display:flex; align-items:center; gap:4px; margin-top:2px;">
                <span style="width:5px; height:5px; background:#22C55E; border-radius:50%; display:inline-block; flex-shrink:0;"></span>
                Super Admin
            </div>
        </div>
    </div>

    {{-- Nav --}}
    <nav style="flex:1; padding:6px 14px; overflow-y:auto;">
        <div style="font-size:9px; color:#475569; letter-spacing:0.1em; text-transform:uppercase; padding:12px 8px 6px;">Menu Utama</div>

        @php
        $navItems = [
            ['label' => 'Beranda',        'url' => route('superadmin.dashboard'),    'route' => 'superadmin.dashboard',    'icon' => 'ti-layout-dashboard'],
            ['label' => 'Kelola Akun',    'url' => '/superadmin/users',              'route' => null,                      'icon' => 'ti-users'],
            ['label' => 'Data Sekolah',   'url' => '/admin/schools',                 'route' => null,                      'icon' => 'ti-building'],
            ['label' => 'Tambah Sekolah', 'url' => '/admin/schools/create',          'route' => null,                      'icon' => 'ti-building-community'],
        ];
        @endphp

        @foreach($navItems as $item)
            @php
                $isActive = $item['route']
                    ? Route::currentRouteName() == $item['route']
                    : request()->is(ltrim($item['url'], '/')) || request()->is('guru*') && $item['label'] === 'Kelola Akun';
            @endphp
            <a href="{{ $item['url'] }}"
               style="display:flex; align-items:center; gap:9px; padding:9px 10px; border-radius:8px; font-size:13px; text-decoration:none; margin-bottom:2px;
                      border-left:2px solid {{ $isActive ? '#3B82F6' : 'transparent' }};
                      background:{{ $isActive ? 'rgba(59,130,246,0.18)' : 'transparent' }};
                      color:{{ $isActive ? '#F1F5F9' : '#94A3B8' }};"
               onmouseover="this.style.background='{{ $isActive ? 'rgba(59,130,246,0.18)' : 'rgba(255,255,255,0.07)' }}';this.style.color='#F1F5F9'"
               onmouseout="this.style.background='{{ $isActive ? 'rgba(59,130,246,0.18)' : 'transparent' }}';this.style.color='{{ $isActive ? '#F1F5F9' : '#94A3B8' }}'">
                <i class="ti {{ $item['icon'] }}" style="font-size:17px; flex-shrink:0; width:20px; text-align:center;"></i>
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>

    {{-- Logout --}}
    <div style="padding:14px;">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    style="width:100%; background:rgba(239,68,68,0.13); color:#FCA5A5; border:1px solid rgba(239,68,68,0.25); padding:9px; border-radius:8px; font-size:13px; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:6px;"
                    onmouseover="this.style.background='rgba(239,68,68,0.28)'"
                    onmouseout="this.style.background='rgba(239,68,68,0.13)'">
                <i class="ti ti-logout" style="font-size:16px;"></i> Keluar
            </button>
        </form>
    </div>
</aside>

{{-- ═══════════════════════════════════════════
     MAIN CONTENT
═══════════════════════════════════════════ --}}
<div class="app-main" style="flex:1; margin-left:240px; padding:32px; display:flex; align-items:flex-start; justify-content:center;">

    <div class="form-card p-6 max-w-lg w-full bg-white rounded-xl shadow" style="margin-top:12px;">

        <h1 class="text-xl font-bold mb-4">Tambah Guru</h1>

        <form method="POST" action="{{ route('guru.store') }}">
            @csrf

            <!-- Nama -->
            <div class="mb-3">
                <label class="font-semibold">Nama</label>
                <input type="text" name="name"
                    class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="font-semibold">Email</label>
                <input type="email" name="email"
                    class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            <!-- Sekolah -->
            <div class="mb-3">
                <label class="font-semibold">Sekolah</label>

                <select name="school_id"
                    class="w-full border rounded px-3 py-2 mt-1" required>

                    <option value="">-- Pilih Sekolah --</option>

                    @foreach ($schools as $school)
                        <option value="{{ $school->id }}">
                            {{ $school->nama_sekolah }}
                        </option>
                    @endforeach

                </select>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="font-semibold">Password</label>
                <input type="password" name="password"
                    class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Simpan
            </button>

        </form>

    </div>

</div>
</div>

<script>
function toggleSidebar() {
    document.querySelector('.app-sidebar').classList.toggle('open');
    document.getElementById('sidebarOverlay').classList.toggle('show');
}
</script>

</x-app-layout>