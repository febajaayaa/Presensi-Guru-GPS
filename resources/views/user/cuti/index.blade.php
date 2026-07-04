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
        .app-main { margin-left: 0 !important; min-width: 0; }
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 45;
        }
        .sidebar-overlay.show { display: block; }

        .topbar-sticky { padding-left: 56px !important; }
        .content-area { padding: 16px !important; }
        .page-header { flex-wrap: wrap; gap: 10px !important; }
        .page-title { font-size: 17px !important; }

        .stat-grid { grid-template-columns: 1fr !important; gap: 10px !important; }
        .stat-card { padding: 12px 14px !important; }
        .stat-value { font-size: 22px !important; }
        .stat-icon-box { width: 36px !important; height: 36px !important; }

        .table-wrap { overflow-x: auto !important; }
        .data-table { min-width: 720px !important; }
    }
</style>

<button class="hamburger-btn" onclick="toggleSidebar()" aria-label="Buka menu">
    <i class="ti ti-menu-2"></i>
</button>
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

@php $user = auth()->user(); @endphp

<div style="display:flex; min-height:100vh; background:#F0F4F8; font-family:'Inter',sans-serif;">

{{-- ═══════════ SIDEBAR ═══════════ --}}
<aside class="app-sidebar" style="width:220px; min-width:220px; background:#1E3A8A; position:fixed; top:0; left:0; height:100vh; display:flex; flex-direction:column; z-index:50; box-shadow:4px 0 16px rgba(0,0,0,0.12);">

    {{-- Profil --}}
    <div style="padding:20px 14px 12px; border-bottom:1px solid rgba(255,255,255,0.08);">
        <a href="{{ route('pengaturan') }}" style="display:flex; align-items:center; gap:10px; padding:10px; border-radius:10px; text-decoration:none; background:rgba(255,255,255,0.06);"
           onmouseover="this.style.background='rgba(255,255,255,0.12)'" onmouseout="this.style.background='rgba(255,255,255,0.06)'">
            <img src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://i.pravatar.cc/50' }}"
                 style="width:38px; height:38px; border-radius:50%; object-fit:cover; border:2px solid rgba(255,255,255,0.3); flex-shrink:0;" alt="Foto profil">
            <div style="overflow:hidden;">
                <div style="font-size:13px; font-weight:600; color:#F1F5F9; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $user->name }}</div>
                <div style="font-size:11px; color:rgba(255,255,255,0.5); margin-top:1px;">Guru</div>
            </div>
        </a>
    </div>

    {{-- Nav --}}
    <nav style="flex:1; padding:10px 12px; overflow-y:auto;">
        <div style="font-size:9px; color:rgba(255,255,255,0.35); letter-spacing:0.1em; text-transform:uppercase; padding:8px 8px 6px;">Menu</div>

        @php
        $navItems = [
            ['route' => 'dashboard',  'icon' => 'ti-layout-dashboard', 'label' => 'Beranda'],
            ['route' => 'izin.form',  'icon' => 'ti-file-text',        'label' => 'Izin'],
            ['route' => 'cuti.index', 'icon' => 'ti-calendar-off',     'label' => 'Cuti'],
            ['route' => 'history',    'icon' => 'ti-history',          'label' => 'Riwayat'],
            ['route' => 'pengaturan', 'icon' => 'ti-settings',         'label' => 'Pengaturan'],
        ];
        @endphp

        @foreach($navItems as $item)
        @php $active = request()->routeIs($item['route']); @endphp
        <a href="{{ route($item['route']) }}"
           style="display:flex; align-items:center; gap:9px; padding:9px 10px; border-radius:8px; font-size:13px; text-decoration:none; margin-bottom:2px;
                  border-left:2px solid {{ $active ? '#60A5FA' : 'transparent' }};
                  background:{{ $active ? 'rgba(255,255,255,0.15)' : 'transparent' }};
                  color:{{ $active ? '#fff' : 'rgba(255,255,255,0.65)' }}; font-weight:{{ $active ? '600' : '400' }};"
           onmouseover="this.style.background='rgba(255,255,255,0.1)';this.style.color='#fff'"
           onmouseout="this.style.background='{{ $active ? 'rgba(255,255,255,0.15)' : 'transparent' }}';this.style.color='{{ $active ? '#fff' : 'rgba(255,255,255,0.65)' }}'">
            <i class="ti {{ $item['icon'] }}" style="font-size:16px; width:18px; text-align:center; flex-shrink:0;"></i>
            {{ $item['label'] }}
        </a>
        @endforeach
    </nav>

    {{-- Logout --}}
    <div style="padding:12px 14px; border-top:1px solid rgba(255,255,255,0.08);">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    style="width:100%; background:rgba(239,68,68,0.15); color:#FCA5A5; border:1px solid rgba(239,68,68,0.3); padding:9px; border-radius:8px; font-size:13px; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:6px;"
                    onmouseover="this.style.background='rgba(239,68,68,0.28)'" onmouseout="this.style.background='rgba(239,68,68,0.15)'">
                <i class="ti ti-logout" style="font-size:15px;"></i> Keluar
            </button>
        </form>
    </div>
</aside>

{{-- ═══════════ MAIN ═══════════ --}}
<main class="app-main" style="flex:1; margin-left:220px; min-height:100vh; display:flex; flex-direction:column;">

    {{-- Top Bar --}}
    <div class="topbar-sticky" style="background:white; border-bottom:1px solid #E2E8F0; padding:10px 24px; display:flex; align-items:center; justify-content:flex-end; position:sticky; top:0; z-index:40; box-shadow:0 1px 3px rgba(0,0,0,0.04);">
        <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:6px 14px; border-radius:8px; font-size:12px; color:#475569; display:flex; align-items:center; gap:6px;">
            <i class="ti ti-calendar" style="color:#3B82F6; font-size:14px;"></i>
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    {{-- Content --}}
    <div class="content-area" style="padding:24px; flex:1;">

        {{-- Flash --}}
        @if(session('success'))
        <div style="display:flex; align-items:center; gap:10px; background:#F0FDF4; border:1px solid #BBF7D0; border-left:4px solid #22C55E; border-radius:10px; padding:12px 16px; margin-bottom:16px;">
            <i class="ti ti-circle-check" style="font-size:18px; color:#16A34A; flex-shrink:0;"></i>
            <div style="font-size:13px; font-weight:500; color:#166534;">{{ session('success') }}</div>
        </div>
        @endif
        @if(session('error'))
        <div style="display:flex; align-items:center; gap:10px; background:#FEF2F2; border:1px solid #FECACA; border-left:4px solid #EF4444; border-radius:10px; padding:12px 16px; margin-bottom:16px;">
            <i class="ti ti-alert-triangle" style="font-size:18px; color:#DC2626; flex-shrink:0;"></i>
            <div style="font-size:13px; font-weight:500; color:#B91C1C;">{{ session('error') }}</div>
        </div>
        @endif

        {{-- Page Header --}}
        <div class="page-header" style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:20px;">
            <div>
                <h1 class="page-title" style="font-size:20px; font-weight:700; color:#0F172A; margin:0 0 3px; display:flex; align-items:center; gap:8px;">
                    <i class="ti ti-calendar-off" style="font-size:20px; color:#3B82F6;"></i> Riwayat Cuti
                </h1>
                <p class="text-xs text-gray-500 mt-0.5">Pantau status pengajuan cuti kamu.</p>
            </div>
            <a href="{{ route('cuti.create') }}"
               style="display:inline-flex; align-items:center; gap:7px; background:#2563EB; color:white; padding:10px 18px; border-radius:9px; font-size:13px; font-weight:600; text-decoration:none; box-shadow:0 1px 3px rgba(37,99,235,0.3);"
               onmouseover="this.style.background='#1D4ED8'" onmouseout="this.style.background='#2563EB'">
                <i class="ti ti-plus" style="font-size:15px;"></i> Ajukan Cuti
            </a>
        </div>

        {{-- Stat Cards --}}
        <div class="stat-grid" style="display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-bottom:20px;">
            <div class="stat-card" style="background:white; border-radius:12px; border:1px solid #E2E8F0; border-top:3px solid #3B82F6; padding:16px 18px; box-shadow:0 1px 4px rgba(0,0,0,0.05);">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <div style="font-size:11px; color:#94A3B8; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:6px;">Total Cuti</div>
                        <div class="stat-value" style="font-size:28px; font-weight:700; color:#2563EB;">{{ $cutis->count() }}</div>
                    </div>
                    <div class="stat-icon-box" style="width:42px; height:42px; background:#EFF6FF; border-radius:10px; display:flex; align-items:center; justify-content:center;">
                        <i class="ti ti-calendar" style="font-size:20px; color:#3B82F6;"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card" style="background:white; border-radius:12px; border:1px solid #E2E8F0; border-top:3px solid #10B981; padding:16px 18px; box-shadow:0 1px 4px rgba(0,0,0,0.05);">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <div style="font-size:11px; color:#94A3B8; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:6px;">Disetujui</div>
                        <div class="stat-value" style="font-size:28px; font-weight:700; color:#10B981;">{{ $cutis->where('status','disetujui')->count() }}</div>
                    </div>
                    <div class="stat-icon-box" style="width:42px; height:42px; background:#F0FDF4; border-radius:10px; display:flex; align-items:center; justify-content:center;">
                        <i class="ti ti-circle-check" style="font-size:20px; color:#10B981;"></i>
                    </div>
                </div>
            </div>
            <div class="stat-card" style="background:white; border-radius:12px; border:1px solid #E2E8F0; border-top:3px solid #F59E0B; padding:16px 18px; box-shadow:0 1px 4px rgba(0,0,0,0.05);">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <div style="font-size:11px; color:#94A3B8; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:6px;">Menunggu</div>
                        <div class="stat-value" style="font-size:28px; font-weight:700; color:#F59E0B;">{{ $cutis->where('status','pending')->count() }}</div>
                    </div>
                    <div class="stat-icon-box" style="width:42px; height:42px; background:#FFFBEB; border-radius:10px; display:flex; align-items:center; justify-content:center;">
                        <i class="ti ti-clock" style="font-size:20px; color:#F59E0B;"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel --}}
        <div class="table-wrap" style="background:white; border-radius:12px; border:1px solid #E2E8F0; overflow:hidden; box-shadow:0 1px 4px rgba(0,0,0,0.05);">

            {{-- Header Tabel --}}
            <table class="data-table" style="width:100%; border-collapse:collapse; font-size:13px;">
                <thead>
                    <tr style="background:#3B82F6;">
                        <th style="padding:12px 16px; text-align:left; color:#fff; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.06em;">Jenis Cuti</th>
                        <th style="padding:12px 16px; text-align:left; color:#fff; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.06em;">Tanggal Mulai</th>
                        <th style="padding:12px 16px; text-align:left; color:#fff; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.06em;">Tanggal Selesai</th>
                        <th style="padding:12px 16px; text-align:left; color:#fff; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.06em;">Durasi</th>
                        <th style="padding:12px 16px; text-align:left; color:#fff; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.06em;">Alasan</th>
                        <th style="padding:12px 16px; text-align:left; color:#fff; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.06em;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cutis as $cuti)
                    @php
                        $durasi = \Carbon\Carbon::parse($cuti->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($cuti->tanggal_selesai)) + 1;
                    @endphp
                    <tr style="border-bottom:1px solid #F1F5F9;" onmouseover="this.style.background='#F8FAFF'" onmouseout="this.style.background='white'">

                        {{-- Jenis --}}
                        <td style="padding:13px 16px;">
                            <span style="display:inline-flex; align-items:center; padding:4px 10px; border-radius:6px; font-size:12px; font-weight:600; background:#EFF6FF; color:#1D4ED8; border:1px solid #BFDBFE;">
                                {{ $cuti->jenis_cuti ?? 'Tahunan' }}
                            </span>
                        </td>

                        {{-- Tgl Mulai --}}
                        <td style="padding:13px 16px; font-size:13px; font-weight:500; color:#1E293B;">
                            {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->translatedFormat('d M Y') }}
                        </td>

                        {{-- Tgl Selesai --}}
                        <td style="padding:13px 16px; font-size:13px; font-weight:500; color:#1E293B;">
                            {{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->translatedFormat('d M Y') }}
                        </td>

                        {{-- Durasi --}}
                        <td style="padding:13px 16px;">
                            <span style="font-size:12px; color:#64748B; background:#F1F5F9; padding:3px 9px; border-radius:20px;">{{ $durasi }} hari</span>
                        </td>

                        {{-- Alasan --}}
                        <td style="padding:13px 16px; font-size:13px; color:#64748B; max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="{{ $cuti->alasan }}">
                            {{ $cuti->alasan ?? '-' }}
                        </td>

                        {{-- Status --}}
                        <td style="padding:13px 16px;">
                            @if($cuti->status == 'pending')
                                <span style="display:inline-flex; align-items:center; gap:5px; padding:4px 11px; border-radius:20px; font-size:12px; font-weight:600; background:#FEF3C7; color:#92400E; border:1px solid #FDE68A;">
                                    <span style="width:6px; height:6px; border-radius:50%; background:#F59E0B; display:inline-block;"></span> Menunggu
                                </span>
                            @elseif($cuti->status == 'disetujui')
                                <span style="display:inline-flex; align-items:center; gap:5px; padding:4px 11px; border-radius:20px; font-size:12px; font-weight:600; background:#DCFCE7; color:#15803D; border:1px solid #A7F3D0;">
                                    <span style="width:6px; height:6px; border-radius:50%; background:#22C55E; display:inline-block;"></span> Disetujui
                                </span>
                            @else
                                <span style="display:inline-flex; align-items:center; gap:5px; padding:4px 11px; border-radius:20px; font-size:12px; font-weight:600; background:#FEE2E2; color:#B91C1C; border:1px solid #FCA5A5;">
                                    <span style="width:6px; height:6px; border-radius:50%; background:#EF4444; display:inline-block;"></span> Ditolak
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding:56px 24px; text-align:center;">
                            <div style="width:56px; height:56px; background:#F1F5F9; border-radius:14px; display:flex; align-items:center; justify-content:center; margin:0 auto 14px;">
                                <i class="ti ti-calendar-off" style="font-size:28px; color:#CBD5E1;"></i>
                            </div>
                            <p style="font-size:14px; font-weight:600; color:#64748B; margin:0 0 4px;">Belum ada data cuti</p>
                            <p style="font-size:12px; color:#94A3B8; margin:0 0 16px;">Klik tombol "Ajukan Cuti" untuk membuat pengajuan baru.</p>
                            <a href="{{ route('cuti.create') }}"
                               style="display:inline-flex; align-items:center; gap:6px; background:#2563EB; color:white; padding:9px 18px; border-radius:8px; font-size:13px; text-decoration:none; font-weight:600;">
                                <i class="ti ti-plus" style="font-size:15px;"></i> Ajukan Cuti
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div style="padding:12px 16px; border-top:1px solid #F1F5F9; background:#FAFBFF;">
                @if(method_exists($cutis, 'hasPages') && $cutis->hasPages())
                <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:8px;">
                    <p style="font-size:12px; color:#94A3B8; margin:0;">
                        Menampilkan {{ $cutis->firstItem() }}–{{ $cutis->lastItem() }} dari {{ $cutis->total() }} data
                    </p>
                    {{ $cutis->links() }}
                </div>
                @else
                <p style="font-size:12px; color:#94A3B8; margin:0;">Menampilkan {{ $cutis->count() }} data</p>
                @endif
            </div>

        </div>
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