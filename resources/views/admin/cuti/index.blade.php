<x-app-layout>
<div class="flex min-h-screen" style="background:#F0F4F8; font-family:'Inter',sans-serif;">
 
{{-- Link Tabler Icons (konsisten dengan halaman guru) --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
 
{{-- ═══════════════════════════════════════════
     SIDEBAR
═══════════════════════════════════════════ --}}
<aside style="width:240px; background:linear-gradient(160deg,#0F172A 0%,#1E3A5F 60%,#1D4ED8 100%); color:white; position:fixed; top:0; left:0; height:100vh; display:flex; flex-direction:column; box-shadow:4px 0 24px rgba(0,0,0,0.18); z-index:50;">
 
    {{-- Brand --}}
    <div style="padding:22px 20px 16px; border-bottom:1px solid rgba(255,255,255,0.08);">
        <div style="display:flex; align-items:center; gap:10px;">
            <div style="width:34px; height:34px; background:#2563EB; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                <i class="ti ti-school" style="font-size:18px; color:#fff;"></i>
            </div>
            <div>
                <div style="font-size:12px; font-weight:700; color:#93C5FD; letter-spacing:0.05em;">SMART PRESENSI</div>
                <div style="font-size:10px; color:#475569; margin-top:1px;">Management System</div>
            </div>
        </div>
    </div>
 
    {{-- Profil --}}
    <a href="{{ route('admin.pengaturan') }}"
       style="display:flex; align-items:center; gap:10px; margin:16px 14px 6px; padding:10px 12px; border-radius:10px; background:rgba(255,255,255,0.06); text-decoration:none;"
       onmouseover="this.style.background='rgba(255,255,255,0.12)'"
       onmouseout="this.style.background='rgba(255,255,255,0.06)'">
 
        <img src="{{ Auth::user()->photo ? asset('storage/'.Auth::user()->photo) : 'https://i.pravatar.cc/50' }}"
             alt="Foto {{ Auth::user()->name }}"
             style="width:38px; height:38px; border-radius:50%; object-fit:cover; border:2px solid #3B82F6; flex-shrink:0;">
 
        <div style="overflow:hidden;">
            <div style="font-size:13px; font-weight:600; color:#F1F5F9; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                {{ Auth::user()->name }}
            </div>
            <div style="font-size:11px; color:#60A5FA; display:flex; align-items:center; gap:4px; margin-top:2px;">
                <span style="width:5px; height:5px; background:#22C55E; border-radius:50%; display:inline-block; flex-shrink:0;"></span>
                {{ auth()->user()->role == 'super_admin' ? 'Super Admin' : 'Admin Sekolah' }}
            </div>
        </div>
    </a>
 
    {{-- Nav --}}
    <nav style="flex:1; padding:6px 14px; overflow-y:auto;">
        <div style="font-size:9px; color:#475569; letter-spacing:0.1em; text-transform:uppercase; padding:12px 8px 6px;">Menu Utama</div>
 
        @php
        $navItems = [
            ['label' => 'Beranda',        'route' => 'admin.dashboard',  'icon' => 'ti-layout-dashboard'],
            ['label' => 'Data Guru',       'route' => 'guru.index',       'icon' => 'ti-users'],
            ['label' => 'Rekap Presensi',  'route' => 'admin.rekap',      'icon' => 'ti-clipboard-list'],
            ['label' => 'Registrasi Guru', 'route' => 'admin.registrasi', 'icon' => 'ti-user-plus'],
            ['label' => 'Persetujuan',     'url'   => '/admin/izin',      'icon' => 'ti-checkbox'],
            ['label' => 'Pengaturan',      'route' => 'admin.pengaturan', 'icon' => 'ti-settings'],
        ];
        @endphp
 
        @foreach($navItems as $item)
            @php
                $isActive = isset($item['route'])
                    ? Route::currentRouteName() == $item['route']
                    : request()->is(ltrim($item['url'], '/'));
                $href = isset($item['route']) ? route($item['route']) : $item['url'];
            @endphp
 
            <a href="{{ $href }}"
               style="display:flex; align-items:center; gap:9px; padding:9px 10px; border-radius:8px; font-size:13px; text-decoration:none; margin-bottom:2px; transition:all 0.15s;
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
 

<!-- CONTENT -->
<div class="flex-1 p-6 ml-64">
    
           {{-- HEADER --}}
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Approval izin
                </h1>
                <p class="text-gray-500">
                    Kelola permohonan izin dari guru.
                </p>
            </div>
        </div>

        {{-- LIST DATA --}}
        <div class="space-y-4">

            @foreach($izins as $izin)
            <div class="bg-white rounded-xl shadow-sm p-5 flex justify-between items-center">

                {{-- KIRI --}}
                <div class="flex items-center gap-4">

                    {{-- AVATAR --}}
                    <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 font-bold">
                        {{ strtoupper(substr($izin->user->name, 0, 1)) }}
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-800">
                            {{ $izin->user->name }}
                        </h3>
                        <p class="text-sm text-gray-500">
                            {{ $izin->user->role ?? 'Guru' }}
                        </p>
                    </div>

                </div>

                {{-- TENGAH --}}
                <div class="flex gap-10 text-sm text-gray-600">

                    <div>
                        <p class="text-gray-400">Tanggal</p>
                        <p class="font-medium">
                            {{ $izin->tanggal 
                                ? \Carbon\Carbon::parse($izin->tanggal)->translatedFormat('d F Y') 
                                : '-' 
                            }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-400">Jenis</p>
                        <p class="font-medium capitalize">
                            {{ $izin->status }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-400">Status</p>

                        @if($izin->izin_status == 'disetujui')
                            <span class="px-3 py-1 text-xs bg-green-100 text-green-600 rounded-full">
                                Disetujui
                            </span>

                        @elseif($izin->izin_status == 'ditolak')
                            <span class="px-3 py-1 text-xs bg-red-100 text-red-600 rounded-full">
                                Ditolak
                            </span>

                        @else
                            <span class="px-3 py-1 text-xs bg-yellow-100 text-yellow-600 rounded-full">
                                Menunggu
                            </span>
                        @endif

                    </div>

                </div>

                <div>
                    <p class="text-gray-400">Keterangan</p>
                    <p class="font-medium text-gray-700">
                        {{ $izin->keterangan ?? '-' }}
                    </p>
                </div>

                {{-- ACTION --}}
                <div class="flex gap-2">

                    <form action="{{ route('izin.setujui', $izin->id) }}" method="POST">
                        @csrf
                        <button class="px-4 py-2 border border-green-500 text-green-600 rounded-lg hover:bg-green-50">
                            ✔ Setujui
                        </button>
                    </form>

                    <form action="{{ route('izin.tolak', $izin->id) }}" method="POST">
                        @csrf
                        <button class="px-4 py-2 border border-red-500 text-red-600 rounded-lg hover:bg-red-50">
                            ✖ Tolak
                        </button>
                    </form>

                </div>

            </div>
            @endforeach

        </div>

        {{-- PAGINATION --}}
        <div class="mt-6 flex justify-between items-center">
            <p class="text-sm text-gray-500">
                Menampilkan {{ $izins->count() }} data
            </p>

            <div>
                {{ $izins->links() }}
            </div>
        </div>

    </div>
</div>
</x-app-layout>