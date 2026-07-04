<x-app-layout>
<div class="flex min-h-screen" style="background:#F0F4F8; font-family:'Inter',sans-serif;">

{{-- Tabler Icons --}}
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

        .content-area { padding: 16px !important; padding-top: 64px !important; }

        .stat-grid-4 { grid-template-columns: repeat(2,1fr) !important; gap: 10px !important; }

        .table-wrap { overflow-x: auto !important; }
        .data-table { min-width: 760px !important; }
    }
</style>

<button class="hamburger-btn" onclick="toggleSidebar()" aria-label="Buka menu">
    <i class="ti ti-menu-2"></i>
</button>
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

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
            ['label' => 'Kelola Akun',    'url' => '/superadmin/users',           'route' => null,                   'icon' => 'ti-users'],
            ['label' => 'Data Sekolah',   'url' => '/admin/schools',              'route' => null,                   'icon' => 'ti-building'],
            ['label' => 'Tambah Sekolah', 'url' => '/admin/schools/create',       'route' => null,                   'icon' => 'ti-building-community'],
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
{{-- MAIN --}}
<div class="app-main content-area" style="flex:1; margin-left:240px; padding:24px 28px;">

    {{-- BREADCRUMB --}}
    <nav style="display:flex; align-items:center; gap:6px; font-size:12px; color:#94A3B8; margin-bottom:20px;">
        <a href="{{ route('superadmin.dashboard') }}" style="color:#94A3B8; text-decoration:none;" onmouseover="this.style.color='#1E40AF'" onmouseout="this.style.color='#94A3B8'">Beranda</a>
        <span>›</span>
        <span style="color:#1E293B; font-weight:500;">Kelola Akun</span>
    </nav>

    {{-- FLASH SUCCESS --}}
    @if(session('success'))
    <div style="display:flex; align-items:center; gap:10px; background:#F0FDF4; border:1px solid #BBF7D0; color:#166534; padding:12px 16px; border-radius:10px; font-size:13px; margin-bottom:20px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div style="display:flex; align-items:center; gap:10px; background:#FEF2F2; border:1px solid #FECACA; color:#DC2626; padding:12px 16px; border-radius:10px; font-size:13px; margin-bottom:20px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        {{ $errors->first() }}
    </div>
    @endif

    {{-- HEADER --}}
    <div style="margin-bottom:20px;">
        <div style="font-size:11px; color:#64748B; letter-spacing:0.08em; text-transform:uppercase; margin-bottom:4px;">Admin Panel</div>
        <h1 style="font-size:20px; font-weight:700; color:#1E293B; margin:0 0 4px;">Kelola Akun Pengguna</h1>
        <p class="text-xs text-gray-500 mt-0.5">Total <strong>{{ $users->count() }}</strong> akun terdaftar di sistem</p>
    </div>

    {{-- STAT CARDS --}}
    <div class="stat-grid-4" style="display:grid; grid-template-columns:repeat(4,1fr); gap:12px; margin-bottom:20px;">
        <div style="background:white; border:1px solid #E2E8F0; border-top:3px solid #8B5CF6; border-radius:10px; padding:14px 16px;">
            <div style="font-size:11px; color:#94A3B8; text-transform:uppercase; letter-spacing:0.06em;">Total Sekolah</div>
            <div style="font-size:28px; font-weight:700; color:#8B5CF6; margin-top:4px;">{{ $schools->count() }}</div>
            <div style="font-size:11px; color:#94A3B8;">sekolah terdaftar</div>
        </div>
        <div style="background:white; border:1px solid #E2E8F0; border-top:3px solid #3B82F6; border-radius:10px; padding:14px 16px;">
            <div style="font-size:11px; color:#94A3B8; text-transform:uppercase; letter-spacing:0.06em;">Total Pengguna</div>
            <div style="font-size:28px; font-weight:700; color:#1E293B; margin-top:4px;">{{ $users->count() }}</div>
            <div style="font-size:11px; color:#94A3B8;">akun terdaftar</div>
        </div>
        <div style="background:white; border:1px solid #E2E8F0; border-top:3px solid #10B981; border-radius:10px; padding:14px 16px;">
            <div style="font-size:11px; color:#94A3B8; text-transform:uppercase; letter-spacing:0.06em;">Admin</div>
            <div style="font-size:28px; font-weight:700; color:#10B981; margin-top:4px;">{{ $users->where('role','admin')->count() }}</div>
            <div style="font-size:11px; color:#94A3B8;">akun admin</div>
        </div>
        <div style="background:white; border:1px solid #E2E8F0; border-top:3px solid #F59E0B; border-radius:10px; padding:14px 16px;">
            <div style="font-size:11px; color:#94A3B8; text-transform:uppercase; letter-spacing:0.06em;">Guru</div>
            <div style="font-size:28px; font-weight:700; color:#F59E0B; margin-top:4px;">{{ $users->where('role','guru')->count() }}</div>
            <div style="font-size:11px; color:#94A3B8;">akun guru</div>
        </div>
    </div>

    {{-- SEARCH --}}
    <div style="position:relative; margin-bottom:16px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2" style="position:absolute; left:14px; top:50%; transform:translateY(-50%);">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" id="searchInput" placeholder="Cari nama atau email pengguna..."
               style="width:100%; padding:10px 14px 10px 40px; border:1px solid #E2E8F0; border-radius:10px; font-size:13px; outline:none; background:white; box-sizing:border-box;"
               oninput="filterTable()"
               onfocus="this.style.borderColor='#3B82F6'" onblur="this.style.borderColor='#E2E8F0'">
    </div>

    {{-- TABEL --}}
    <div style="background:white; border:1px solid #E2E8F0; border-radius:12px; overflow:hidden;">
        <div class="table-wrap">
        <table class="data-table" style="width:100%; border-collapse:collapse; font-size:13px;" id="userTable">
            <thead>
                <tr style="background:#3B82F6; color:white;">
                    <th style="padding:12px 16px; text-align:left; font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:0.05em; width:40px;">No</th>
                    <th style="padding:12px 16px; text-align:left; font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:0.05em;">Pengguna</th>
                    <th style="padding:12px 16px; text-align:left; font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:0.05em;">Email</th>
                    <th style="padding:12px 16px; text-align:left; font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:0.05em;">Sekolah</th>
                    <th style="padding:12px 16px; text-align:left; font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:0.05em;">Role</th>
                    <th style="padding:12px 16px; text-align:center; font-weight:600; font-size:11px; text-transform:uppercase; letter-spacing:0.05em;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $i => $u)
                <tr style="border-bottom:1px solid #F1F5F9;" onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='white'">
                    <td style="padding:14px 16px; color:#94A3B8;">{{ $i + 1 }}</td>

                    {{-- Pengguna --}}
                    <td style="padding:14px 16px;">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="width:34px; height:34px; border-radius:50%; background:{{ ['#3B82F6','#10B981','#F59E0B','#8B5CF6','#EF4444'][($i % 5)] }}; display:flex; align-items:center; justify-content:center; color:white; font-size:12px; font-weight:600; flex-shrink:0;">
                                {{ strtoupper(substr($u->name,0,1)) }}
                            </div>
                            <div>
                                <div style="font-weight:500; color:#1E293B;">{{ $u->name }}</div>
                                <div style="font-size:11px; color:#94A3B8;">{{ ucfirst($u->role) }}</div>
                            </div>
                        </div>
                    </td>

                    {{-- Email --}}
                    <td style="padding:14px 16px; color:#64748B;">{{ $u->email }}</td>

                    {{-- Sekolah --}}
                    <td style="padding:14px 16px;">
                        @if($u->school)
                            <span style="display:inline-flex; align-items:center; gap:5px; font-size:12px; background:#EFF6FF; color:#1D4ED8; padding:4px 10px; border-radius:20px; border:1px solid #BFDBFE;">
                                <i class="ti ti-building" style="font-size:13px;"></i>
                                {{ $u->school->nama_sekolah }}
                            </span>
                        @else
                            @if($u->role === 'admin')
                                <span style="font-size:12px; color:#DC2626; background:#FEF2F2; padding:4px 10px; border-radius:20px; border:1px solid #FECACA;">
                                    Belum dikaitkan
                                </span>
                            @else
                                <span style="font-size:12px; color:#94A3B8; background:#F8FAFC; padding:4px 10px; border-radius:20px; border:1px solid #E2E8F0;">—</span>
                            @endif
                        @endif
                    </td>

                    {{-- Role --}}
                    <td style="padding:14px 16px;">
                        @if($u->role === 'super_admin')
                            <span style="display:inline-flex; align-items:center; gap:5px; font-size:12px; background:#FEF3C7; color:#92400E; padding:4px 10px; border-radius:20px; border:1px solid #FDE68A;">
                                <i class="ti ti-shield-star" style="font-size:13px;"></i> Super Admin
                            </span>
                        @elseif($u->role === 'admin')
                            <span style="display:inline-flex; align-items:center; gap:5px; font-size:12px; background:#D1FAE5; color:#065F46; padding:4px 10px; border-radius:20px; border:1px solid #A7F3D0;">
                                <i class="ti ti-shield" style="font-size:13px;"></i> Admin
                            </span>
                        @else
                            <span style="display:inline-flex; align-items:center; gap:5px; font-size:12px; background:#FEF9C3; color:#713F12; padding:4px 10px; border-radius:20px; border:1px solid #FEF08A;">
                                <i class="ti ti-user" style="font-size:13px;"></i> Guru
                            </span>
                        @endif
                    </td>

                    {{-- Aksi --}}
                    <td style="padding:14px 16px; text-align:center;">
                        @if($u->role === 'super_admin')
                            <span style="font-size:12px; color:#94A3B8;">— Akun Anda</span>
                        @else
                            <div style="display:flex; align-items:center; justify-content:center; gap:6px; flex-wrap:wrap;">

                                {{-- EDIT --}}
                                <button
                                    onclick="openEditModal({{ $u->id }}, '{{ addslashes($u->name) }}', '{{ $u->role }}', {{ $u->school_id ?? 'null' }})"
                                    style="display:inline-flex; align-items:center; gap:4px; padding:6px 11px; border-radius:7px; font-size:12px; color:#1D4ED8; background:#EFF6FF; border:1px solid #BFDBFE; cursor:pointer;"
                                    onmouseover="this.style.background='#DBEAFE'" onmouseout="this.style.background='#EFF6FF'">
                                    <i class="ti ti-edit" style="font-size:13px;"></i> Edit
                                </button>

                                {{-- Jadikan Admin --}}
                                @if($u->role === 'guru')
                                <form action="{{ route('admin.users.makeAdmin', $u->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit"
                                        style="display:inline-flex; align-items:center; gap:4px; padding:6px 11px; border-radius:7px; font-size:12px; color:#065F46; background:#D1FAE5; border:1px solid #A7F3D0; cursor:pointer;"
                                        onmouseover="this.style.background='#A7F3D0'" onmouseout="this.style.background='#D1FAE5'">
                                        <i class="ti ti-shield-check" style="font-size:13px;"></i> Jadikan Admin
                                    </button>
                                </form>
                                @endif

                                {{-- Hapus --}}
                                <form action="{{ route('admin.users.delete', $u->id) }}" method="POST" style="display:inline;"
                                      onsubmit="return confirm('Hapus akun {{ addslashes($u->name) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="display:inline-flex; align-items:center; gap:4px; padding:6px 11px; border-radius:7px; font-size:12px; color:#DC2626; background:#FEF2F2; border:1px solid #FECACA; cursor:pointer;"
                                        onmouseover="this.style.background='#FEE2E2'" onmouseout="this.style.background='#FEF2F2'">
                                        <i class="ti ti-trash" style="font-size:13px;"></i> Hapus
                                    </button>
                                </form>

                            </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>

        @if($users->count() === 0)
        <div style="padding:48px; text-align:center; color:#94A3B8; font-size:13px;">
            Belum ada pengguna terdaftar.
        </div>
        @endif
    </div>
</div>
</div>

{{-- MODAL EDIT --}}
<div id="editModal"
     style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); z-index:100; align-items:center; justify-content:center;">
    <div style="background:white; border-radius:14px; width:100%; max-width:440px; margin:0 16px; box-shadow:0 20px 60px rgba(0,0,0,0.2);">

        <div style="padding:20px 24px 16px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; justify-content:space-between;">
            <div>
                <h2 style="font-size:16px; font-weight:600; color:#1E293B; margin:0;">Edit Akun</h2>
                <p style="font-size:12px; color:#94A3B8; margin:4px 0 0;" id="modalSubtitle">Ubah role dan sekolah pengguna</p>
            </div>
            <button onclick="closeEditModal()"
                style="width:30px; height:30px; border-radius:8px; border:1px solid #E2E8F0; background:white; cursor:pointer; display:flex; align-items:center; justify-content:center; color:#64748B;">
                <i class="ti ti-x" style="font-size:15px;"></i>
            </button>
        </div>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <div style="padding:20px 24px;">

                <div style="display:flex; align-items:center; gap:12px; background:#F8FAFC; border:1px solid #E2E8F0; border-radius:10px; padding:12px; margin-bottom:20px;">
                    <div id="modalAvatar" style="width:38px; height:38px; border-radius:50%; background:#3B82F6; display:flex; align-items:center; justify-content:center; color:white; font-size:14px; font-weight:600; flex-shrink:0;"></div>
                    <div>
                        <div id="modalName" style="font-size:14px; font-weight:500; color:#1E293B;"></div>
                        <div style="font-size:12px; color:#94A3B8;">Pengguna aktif</div>
                    </div>
                </div>

                {{-- Role --}}
                <div style="margin-bottom:16px;">
                    <label style="display:block; font-size:12px; font-weight:500; color:#374151; margin-bottom:6px;">Role</label>
                    <select name="role" id="modalRole"
                        style="width:100%; padding:9px 12px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; background:white; outline:none; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#3B82F6'" onblur="this.style.borderColor='#D1D5DB'"
                        onchange="toggleSchoolRequired(this.value)">
                        <option value="guru">Guru</option>
                        <option value="admin">Admin</option>
                    </select>
                    <p style="font-size:11px; color:#94A3B8; margin:4px 0 0;">Admin dapat mengelola data absensi di sekolahnya sendiri</p>
                </div>

                {{-- Sekolah --}}
                <div style="margin-bottom:4px;">
                    <label style="display:block; font-size:12px; font-weight:500; color:#374151; margin-bottom:6px;">
                        Sekolah
                        <span id="schoolRequiredBadge" style="display:none; color:#EF4444; font-weight:600;">*</span>
                    </label>
                    <select name="school_id" id="modalSchool"
                        style="width:100%; padding:9px 12px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; background:white; outline:none; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#3B82F6'" onblur="this.style.borderColor='#D1D5DB'">
                        <option value="">— Tidak ada sekolah —</option>
                        @foreach($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->nama_sekolah }}</option>
                        @endforeach
                    </select>
                    <p id="schoolWarning" style="display:none; font-size:11px; color:#DC2626; margin:4px 0 0;">
                        Admin wajib dikaitkan ke sekolah agar bisa login ke dashboard.
                    </p>
                    <p id="schoolHint" style="font-size:11px; color:#94A3B8; margin:4px 0 0;">
                        Admin hanya bisa melihat dan mengelola data sekolah yang dipilih di sini.
                    </p>
                </div>

            </div>

            <div style="padding:16px 24px 20px; border-top:1px solid #F1F5F9; display:flex; gap:8px; justify-content:flex-end;">
                <button type="button" onclick="closeEditModal()"
                    style="padding:9px 18px; border-radius:8px; border:1px solid #D1D5DB; background:white; font-size:13px; cursor:pointer; color:#374151;"
                    onmouseover="this.style.background='#F9FAFB'" onmouseout="this.style.background='white'">
                    Batal
                </button>
                <button type="submit"
                    style="padding:9px 18px; border-radius:8px; border:none; background:#2563EB; color:white; font-size:13px; cursor:pointer; font-weight:500;"
                    onmouseover="this.style.background='#1D4ED8'" onmouseout="this.style.background='#2563EB'">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT --}}
<script>
function toggleSidebar() {
    document.querySelector('.app-sidebar').classList.toggle('open');
    document.getElementById('sidebarOverlay').classList.toggle('show');
}

function openEditModal(userId, name, role, schoolId) {
    document.getElementById('editForm').action = '/superadmin/users/' + userId + '/edit';
    document.getElementById('modalName').textContent = name;
    document.getElementById('modalSubtitle').textContent = 'Mengubah akun: ' + name;
    document.getElementById('modalAvatar').textContent = name.charAt(0).toUpperCase();
    document.getElementById('modalRole').value = role;
    document.getElementById('modalSchool').value = schoolId ?? '';
    toggleSchoolRequired(role);
    const modal = document.getElementById('editModal');
    modal.style.display = 'flex';
    setTimeout(() => document.getElementById('modalRole').focus(), 100);
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

function toggleSchoolRequired(role) {
    const isAdmin = role === 'admin';
    document.getElementById('schoolRequiredBadge').style.display = isAdmin ? 'inline' : 'none';
    document.getElementById('schoolWarning').style.display = isAdmin ? 'block' : 'none';
    document.getElementById('schoolHint').style.display = isAdmin ? 'none' : 'block';
}

document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) closeEditModal();
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeEditModal();
});

function filterTable() {
    const query = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#userTable tbody tr');
    rows.forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(query) ? '' : 'none';
    });
}
</script>

</x-app-layout>