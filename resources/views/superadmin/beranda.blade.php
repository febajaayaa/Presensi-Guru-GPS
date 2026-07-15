<x-app-layout>

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
        .app-main { margin-left: 0 !important; min-width: 0; padding: 20px 16px !important; }
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 45;
        }
        .sidebar-overlay.show { display: block; }
        .stat-grid { grid-template-columns: 1fr !important; gap: 12px !important; margin-bottom: 18px !important; }
        .top-bar { flex-wrap: wrap; gap: 10px; margin-bottom: 20px !important; }
        .page-title { font-size: 18px !important; }
        .date-badge { font-size: 12px !important; padding: 7px 12px !important; }
        .stat-card { padding: 14px 16px !important; }
        .stat-value { font-size: 22px !important; }
        .stat-icon-box { width: 34px !important; height: 34px !important; }
        .stat-icon-box i { font-size: 17px !important; }
        .table-card { padding: 16px !important; }
        .data-table { font-size: 12px !important; min-width: 420px !important; }
        .data-table th, .data-table td { padding: 8px 10px !important; }
    }
</style>

<button class="hamburger-btn" onclick="toggleSidebar()" aria-label="Buka menu">
    <i class="ti ti-menu-2"></i>
</button>
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<div class="flex min-h-screen" style="background:#F0F4F8; font-family:'Inter',sans-serif;">

{{-- Tabler Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

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
            ['label' => 'Beranda',        'url' => route('superadmin.dashboard'), 'route' => 'superadmin.dashboard', 'icon' => 'ti-layout-dashboard'],
            ['label' => 'Kelola Akun',    'url' => route('admin.users'),          'route' => 'admin.users',          'icon' => 'ti-users'],
            ['label' => 'Data Sekolah',   'url' => route('superadmin.schools'),   'route' => 'superadmin.schools',   'icon' => 'ti-building'],
            ['label' => 'Tambah Sekolah', 'url' => route('superadmin.schools.create'), 'route' => 'superadmin.schools.create', 'icon' => 'ti-building-community'],
        ];
        @endphp

        @foreach($navItems as $item)
            @php
                $isActive = $item['route']
                    ? Route::currentRouteName() == $item['route']
                    : request()->is(ltrim($item['url'], '/'));
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
<main class="app-main" style="flex:1; margin-left:240px; padding:32px 36px;">
 
    {{-- Top Bar --}}
    <div class="top-bar" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:32px;">
        <div>
            <h1 class="page-title" style="font-size:24px; font-weight:700; color:#0F172A; margin:0;">Beranda Super Admin</h1>
        </div>
        <div class="date-badge" style="background:white; border-radius:10px; padding:10px 18px; box-shadow:0 1px 4px rgba(0,0,0,0.08); font-size:13px; color:#475569; display:flex; align-items:center; gap:8px;">
            <i class="ti ti-calendar" style="color:#3B82F6; font-size:16px;"></i>
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </div>
 
    {{-- Stat Cards --}}
    <div class="stat-grid" style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px; margin-bottom:28px;">
 
        <div class="stat-card" style="background:white; border-radius:14px; padding:22px 24px; box-shadow:0 1px 6px rgba(0,0,0,0.07); border-top:4px solid #3B82F6;">
            <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                <div>
                    <div style="font-size:12px; color:#64748B; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:8px;">Total Sekolah</div>
                    <div class="stat-value" style="font-size:32px; font-weight:700; color:#0F172A;">{{ \App\Models\School::count() }}</div>
                    <div style="font-size:12px; color:#3B82F6; margin-top:4px;">Sekolah terdaftar</div>
                </div>
                <div class="stat-icon-box" style="width:46px; height:46px; background:#EFF6FF; border-radius:12px; display:flex; align-items:center; justify-content:center;">
                    <i class="ti ti-building" style="font-size:22px; color:#3B82F6;"></i>
                </div>
            </div>
        </div>
 
        <div class="stat-card" style="background:white; border-radius:14px; padding:22px 24px; box-shadow:0 1px 6px rgba(0,0,0,0.07); border-top:4px solid #8B5CF6;">
            <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                <div>
                    <div style="font-size:12px; color:#64748B; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:8px;">Total Pengguna</div>
                    <div class="stat-value" style="font-size:32px; font-weight:700; color:#0F172A;">{{ \App\Models\User::count() }}</div>
                    <div style="font-size:12px; color:#8B5CF6; margin-top:4px;">Akun aktif</div>
                </div>
                <div class="stat-icon-box" style="width:46px; height:46px; background:#F5F3FF; border-radius:12px; display:flex; align-items:center; justify-content:center;">
                    <i class="ti ti-users" style="font-size:22px; color:#8B5CF6;"></i>
                </div>
            </div>
        </div>
 
        <div class="stat-card" style="background:white; border-radius:14px; padding:22px 24px; box-shadow:0 1px 6px rgba(0,0,0,0.07); border-top:4px solid #10B981;">
            <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                <div>
                    <div style="font-size:12px; color:#64748B; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:8px;">Total Admin</div>
                    <div class="stat-value" style="font-size:32px; font-weight:700; color:#0F172A;">{{ \App\Models\User::where('role', 'admin')->count() }}</div>
                    <div style="font-size:12px; color:#10B981; margin-top:4px;">Admin sekolah</div>
                </div>
                <div class="stat-icon-box" style="width:46px; height:46px; background:#F0FDF4; border-radius:12px; display:flex; align-items:center; justify-content:center;">
                    <i class="ti ti-shield-check" style="font-size:22px; color:#10B981;"></i>
                </div>
            </div>
        </div>
 
    </div>
 
    {{-- Tabel Pengguna Terdaftar --}}
    <div class="table-card" style="background:white; border-radius:14px; padding:24px 28px; box-shadow:0 1px 6px rgba(0,0,0,0.07); overflow-x:auto;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; flex-wrap:wrap; gap:8px;">
            <h2 style="font-size:16px; font-weight:700; color:#0F172A; margin:0; display:flex; align-items:center; gap:8px;">
                <i class="ti ti-users" style="font-size:18px; color:#3B82F6;"></i> Pengguna Terdaftar
            </h2>
            <a href="{{ route('admin.users') }}" style="font-size:12px; color:#3B82F6; text-decoration:none; display:flex; align-items:center; gap:4px;">
                Lihat semua <i class="ti ti-arrow-right" style="font-size:14px;"></i>
            </a>
        </div>
 
        <table class="data-table" style="width:100%; border-collapse:collapse; font-size:13px; min-width:480px;">
            <thead>
                <tr style="background:#3B82F6;">
                    <th style="text-align:left; padding:11px 14px; color:#fff; font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:0.05em; border-radius:8px 0 0 0;">#</th>
                    <th style="text-align:left; padding:11px 14px; color:#fff; font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:0.05em;">Nama</th>
                    <th style="text-align:left; padding:11px 14px; color:#fff; font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:0.05em;">Email</th>
                    <th style="text-align:left; padding:11px 14px; color:#fff; font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:0.05em; border-radius:0 8px 0 0;">Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach(\App\Models\User::latest()->take(5)->get() as $i => $user)
                <tr style="border-bottom:1px solid #F1F5F9;">
                    <td style="padding:12px 14px; color:#94A3B8;">{{ $i + 1 }}</td>
                    <td style="padding:12px 14px; color:#1E293B; font-weight:500;">{{ $user->name }}</td>
                    <td style="padding:12px 14px; color:#475569;">{{ $user->email }}</td>
                    <td style="padding:12px 14px;">
                        @if($user->role == 'super_admin')
                            <span style="display:inline-flex; align-items:center; gap:4px; background:#FEF3C7; color:#92400E; font-size:11px; padding:4px 10px; border-radius:20px; font-weight:600; border:1px solid #FDE68A;">
                                <i class="ti ti-shield-star" style="font-size:12px;"></i> Super Admin
                            </span>
                        @elseif($user->role == 'admin')
                            <span style="display:inline-flex; align-items:center; gap:4px; background:#D1FAE5; color:#065F46; font-size:11px; padding:4px 10px; border-radius:20px; font-weight:600; border:1px solid #A7F3D0;">
                                <i class="ti ti-shield" style="font-size:12px;"></i> Admin
                            </span>
                        @else
                            <span style="display:inline-flex; align-items:center; gap:4px; background:#FEF9C3; color:#713F12; font-size:11px; padding:4px 10px; border-radius:20px; font-weight:600; border:1px solid #FEF08A;">
                                <i class="ti ti-user" style="font-size:12px;"></i> Guru
                            </span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
 
</main>
</div>

<script>
function toggleSidebar() {
    document.querySelector('.app-sidebar').classList.toggle('open');
    document.getElementById('sidebarOverlay').classList.toggle('show');
}
</script>

</x-app-layout>