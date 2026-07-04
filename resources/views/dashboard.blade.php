<x-app-layout>

<style>
    .app-sidebar { transition: transform 0.3s ease; }
    .hamburger-btn { display: none; }

    @media (max-width: 768px) {
        .hamburger-btn {
            display: flex;
            position: fixed;
            top: 14px;
            left: 14px;
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
        .app-sidebar {
            transform: translateX(-100%);
        }
        .app-sidebar.open {
            transform: translateX(0);
        }
        .app-main {
            margin-left: 0 !important;
        }
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 45;
        }
        .sidebar-overlay.show { display: block; }
    }
</style>

<button class="hamburger-btn" onclick="toggleSidebar()" aria-label="Buka menu">
    <i class="ti ti-menu-2"></i>
</button>
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

@php $user = auth()->user(); @endphp

<div style="display:flex; min-height:100vh; background:#F0F4F8; font-family:'Inter',sans-serif;">

{{-- ═══════════ SIDEBAR ═══════════ --}}
<aside class="app-sidebar" style="width:220px; min-width:220px; background:#1E3A8A; position:fixed; top:0; left:0; height:100vh; display:flex; flex-direction:column; z-index:50; box-shadow:4px 0 16px rgba(0,0,0,0.12);">

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
    <div style="background:white; border-bottom:1px solid #E2E8F0; padding:10px 24px; display:flex; align-items:center; justify-content:flex-end; position:sticky; top:0; z-index:40; box-shadow:0 1px 3px rgba(0,0,0,0.04);">
        <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:6px 14px; border-radius:8px; font-size:12px; color:#475569; display:flex; align-items:center; gap:6px;">
            <i class="ti ti-calendar" style="color:#3B82F6; font-size:14px;"></i>
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    {{-- Content --}}
    <div style="padding:24px; flex:1;">

        {{-- Topbar --}}
        <div class="flex justify-between items-center mb-5">
            <div>
               <h1 style="font-size:24px; font-weight:700; color:#0F172A; margin:0;">Beranda Presensi</h1>
                <p class="text-xs text-gray-500 mt-0.5">Sistem Informasi Kehadiran Guru</p>
            </div>
        </div>

        <div class="grid gap-4 grid-cols-1 lg:grid-cols-[1fr_220px]">

            {{-- Kolom Kiri --}}
            <div class="space-y-4">

                {{-- Card Absen --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">

                    <p class="text-[11px] font-medium uppercase tracking-wider text-gray-400 mb-2">Jadwal & Status Hari Ini</p>
                    <div class="flex gap-6 text-sm text-gray-600 mb-3">
                        <span class="flex items-center gap-1.5">
                            <i class="ti ti-clock-in text-base text-gray-400" aria-hidden="true"></i>
                            Masuk: <strong class="text-gray-800">07:00 WIB</strong>
                        </span>
                        <span class="flex items-center gap-1.5">
                            <i class="ti ti-clock-out text-base text-gray-400" aria-hidden="true"></i>
                            Pulang: <strong class="text-gray-800">12:30 WIB</strong>
                        </span>
                    </div>

                    <div class="flex items-center justify-between border-t border-gray-100 pt-3 mb-4">
                        <span class="text-sm text-gray-500">Status saat ini</span>

                        @php
                        $statusLabel = 'Belum Absen';
                        $statusClass = 'bg-gray-100 text-gray-500';

                        if ($todayCuti) {
                            if ($todayCuti->status == 'pending')       { $statusLabel = 'Cuti Pending';    $statusClass = 'bg-yellow-100 text-yellow-700'; }
                            elseif ($todayCuti->status == 'disetujui') { $statusLabel = 'Cuti Disetujui'; $statusClass = 'bg-green-100 text-green-700'; }
                            elseif ($todayCuti->status == 'ditolak')   { $statusLabel = 'Cuti Ditolak';   $statusClass = 'bg-red-100 text-red-700'; }
                        } elseif ($izinPending) {
                            if ($izinPending->status == 'pending')       { $statusLabel = ucfirst($izinPending->jenis).' Pending';    $statusClass = 'bg-yellow-100 text-yellow-700'; }
                            elseif ($izinPending->status == 'disetujui') { $statusLabel = ucfirst($izinPending->jenis).' Disetujui'; $statusClass = 'bg-blue-100 text-blue-700'; }
                            elseif ($izinPending->status == 'ditolak')   { $statusLabel = ucfirst($izinPending->jenis).' Ditolak';   $statusClass = 'bg-red-100 text-red-700'; }
                        } elseif ($today) {
                            if ($today->jam_masuk) { $statusLabel = 'Hadir'; $statusClass = 'bg-green-100 text-green-700'; }
                        }
                        @endphp

                        <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full {{ $statusClass }}">
                            <i class="ti ti-circle-check text-sm" aria-hidden="true"></i>
                            {{ $statusLabel }}
                        </span>
                    </div>

                    {{-- Tombol Aksi --}}
                    @php
                    $disabledMasuk =
                        ($today && $today->jam_masuk) ||
                        ($todayCuti && $todayCuti->status != 'ditolak') ||
                        ($izinPending && in_array($izinPending->status, ['pending','disetujui']));

                    $labelMasuk = 'Absen Masuk';
                    if ($izinPending && $izinPending->status == 'pending')    $labelMasuk = 'Menunggu Persetujuan';
                    if ($izinPending && $izinPending->status == 'disetujui') $labelMasuk = 'Izin Disetujui';
                    if ($today && $today->jam_masuk) $labelMasuk = 'Sudah Absen Masuk';

                    $disabledKeluar = !($today && $today->jam_masuk) || ($today && $today->jam_keluar);
                    $labelKeluar = $today && $today->jam_keluar ? 'Sudah Absen Keluar' : 'Absen Keluar';
                    @endphp

                    <div class="grid grid-cols-2 gap-3">

                        <form id="form-masuk" method="POST" action="/masuk">
                            @csrf
                            <input type="hidden" name="latitude"  id="lat">
                            <input type="hidden" name="longitude" id="lng">
                            <button type="button"
                                    onclick="handleMasuk()"
                                    {{ $disabledMasuk ? 'disabled' : '' }}
                                    title="{{ $disabledMasuk ? 'Absen masuk sudah tercatat' : 'Klik untuk absen masuk' }}"
                                    class="w-full flex items-center justify-center gap-2 rounded-xl py-3 text-sm font-medium transition
                                           {{ $disabledMasuk ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-green-600 hover:bg-green-700 text-white' }}">
                                <i class="ti ti-login text-base" aria-hidden="true"></i>
                                {{ $labelMasuk }}
                            </button>
                        </form>

                        <form method="POST" action="{{ route('presensi.keluar') }}">
                            @csrf
                            <button type="{{ $disabledKeluar ? 'button' : 'submit' }}"
                                    {{ $disabledKeluar ? 'disabled' : '' }}
                                    title="{{ $disabledKeluar ? 'Belum bisa absen keluar' : 'Klik untuk absen keluar' }}"
                                    class="w-full flex items-center justify-center gap-2 rounded-xl py-3 text-sm font-medium border transition
                                           {{ $disabledKeluar ? 'bg-gray-100 border-gray-100 text-gray-400 cursor-not-allowed' : 'border-red-200 bg-red-600 hover:bg-red-700 text-white' }}">
                                <i class="ti ti-logout text-base" aria-hidden="true"></i>
                                {{ $labelKeluar }}
                            </button>
                        </form>

                    </div>
                </div>

                {{-- Stat cards: 2 kolom di HP, 5 kolom di layar >= sm --}}
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                    @php
                    $stats = [
                        ['val' => $hadir     ?? 0, 'label' => 'Hadir',     'color' => 'text-green-600', 'bg' => 'bg-green-50'],
                        ['val' => $terlambat ?? 0, 'label' => 'Terlambat', 'color' => 'text-red-600',   'bg' => 'bg-red-50'],
                        ['val' => $sakit     ?? 0, 'label' => 'Sakit',     'color' => 'text-amber-600', 'bg' => 'bg-amber-50'],
                        ['val' => $izin      ?? 0, 'label' => 'Izin',      'color' => 'text-blue-600',  'bg' => 'bg-blue-50'],
                        ['val' => $cuti      ?? 0, 'label' => 'Cuti',      'color' => 'text-pink-600',  'bg' => 'bg-pink-50'],
                    ];
                    @endphp

                    @foreach($stats as $s)
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-3 text-center">
                        <p class="text-2xl font-semibold {{ $s['color'] }}">{{ $s['val'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $s['label'] }}</p>
                    </div>
                    @endforeach
                </div>

            </div>

            {{-- Kolom Kanan: Riwayat --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 overflow-y-auto" style="max-height:420px">
                <p class="text-[11px] font-medium uppercase tracking-wider text-gray-400 mb-3">Riwayat Presensi</p>

                @forelse($data as $d)
                <div class="flex justify-between items-center py-2.5 border-b border-gray-100 last:border-0">
                    <div>
                        <p class="text-sm font-medium text-gray-800">
                            {{ \Carbon\Carbon::parse($d->tanggal)->format('d M Y') }}
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5">
                            {{ $d->jam_masuk  ? \Carbon\Carbon::parse($d->jam_masuk)->format('H:i')  : '--:--' }}
                            –
                            {{ $d->jam_keluar ? \Carbon\Carbon::parse($d->jam_keluar)->format('H:i') : '--:--' }}
                        </p>
                    </div>

                    @if($d->status == 'hadir')
                        <span class="inline-flex items-center gap-1 text-[11px] font-medium px-2 py-0.5 rounded-full bg-green-100 text-green-700">
                            <i class="ti ti-check text-xs"></i> Hadir
                        </span>
                    @elseif($d->status == 'terlambat')
                        <span class="inline-flex items-center gap-1 text-[11px] font-medium px-2 py-0.5 rounded-full bg-red-100 text-red-700">
                            <i class="ti ti-clock text-xs"></i> Terlambat
                        </span>
                    @elseif(in_array($d->status, ['izin','sakit','cuti']))
                        @php
                        $badgeMap = [
                            'pending'   => 'bg-yellow-100 text-yellow-700',
                            'disetujui' => 'bg-blue-100 text-blue-700',
                            'ditolak'   => 'bg-red-100 text-red-700',
                        ];
                        $labelMap = [
                            'izin'  => 'Izin',
                            'sakit' => 'Sakit',
                            'cuti'  => 'Cuti',
                        ];
                        $bc = $badgeMap[$d->izin_status] ?? 'bg-gray-100 text-gray-600';
                        $bl = $labelMap[$d->status] ?? $d->status;
                        $bs = $d->izin_status ? ucfirst($d->izin_status) : '';
                        @endphp
                        <span class="inline-flex text-[11px] font-medium px-2 py-0.5 rounded-full {{ $bc }}">
                            {{ $bl }}{{ $bs ? ' ('.$bs.')' : '' }}
                        </span>
                    @endif
                </div>
                @empty
                <p class="text-sm text-gray-400 text-center mt-6">Belum ada riwayat presensi.</p>
                @endforelse
            </div>

        </div>
    </div>
    </main>
</div>


{{-- ============================================================
     POPUP / MODAL SISTEM
================================================================== --}}

{{-- Loading --}}
<div id="popup-loading" class="fixed inset-0 z-50 hidden items-center justify-center" style="background:rgba(0,0,0,0.45);" role="status" aria-label="Memproses lokasi">
    <div class="bg-white rounded-2xl p-7 max-w-xs w-full text-center shadow-xl border border-gray-100">
        <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center mx-auto mb-3">
            <i class="ti ti-location text-xl text-blue-600" aria-hidden="true"></i>
        </div>
        <p class="font-medium text-gray-800 text-sm">Mendeteksi lokasi…</p>
        <p class="text-xs text-gray-500 mt-1">Mohon tunggu, sistem memverifikasi posisi Anda.</p>
        <div class="mt-4 h-1 bg-gray-100 rounded-full overflow-hidden">
            <div class="h-full bg-blue-500 rounded-full animate-pulse" style="width:60%"></div>
        </div>
    </div>
</div>

{{-- GPS mati / izin ditolak --}}
<div id="popup-gps" class="fixed inset-0 z-50 hidden items-center justify-center" style="background:rgba(0,0,0,0.45);" role="dialog" aria-modal="true" aria-labelledby="gps-title">
    <div class="bg-white rounded-2xl p-7 max-w-xs w-full text-center shadow-xl border border-gray-100">
        <div class="w-12 h-12 rounded-full bg-yellow-50 flex items-center justify-center mx-auto mb-3">
            <i class="ti ti-map-pin-off text-xl text-yellow-600" aria-hidden="true"></i>
        </div>
        <p id="gps-title" class="font-medium text-gray-800 text-sm mb-2">GPS tidak aktif</p>
        <p class="text-xs text-gray-500 leading-relaxed mb-5">
            Izin lokasi ditolak atau GPS dimatikan. Aktifkan GPS di perangkat Anda, lalu izinkan akses lokasi di browser untuk melanjutkan absen.
        </p>
        <div class="flex gap-2 justify-center">
            <button onclick="closePopup('gps')" class="px-4 py-2 rounded-lg text-xs border border-gray-200 text-gray-600 hover:bg-gray-50 transition">Tutup</button>
            <button onclick="retryLocation()" class="px-4 py-2 rounded-lg text-xs bg-blue-600 text-white hover:bg-blue-700 transition">Coba lagi</button>
        </div>
    </div>
</div>

{{-- Di luar area sekolah --}}
<div id="popup-lokasi" class="fixed inset-0 z-50 hidden items-center justify-center" style="background:rgba(0,0,0,0.45);" role="dialog" aria-modal="true" aria-labelledby="lokasi-title">
    <div class="bg-white rounded-2xl p-7 max-w-xs w-full text-center shadow-xl border border-gray-100">
        <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-3">
            <i class="ti ti-map-pin-exclamation text-xl text-red-600" aria-hidden="true"></i>
        </div>
        <p id="lokasi-title" class="font-medium text-gray-800 text-sm mb-2">Di luar area sekolah</p>
        <p class="text-xs text-gray-500 leading-relaxed mb-5">
            Absen masuk hanya dapat dilakukan dalam radius <strong>{{ $user->school->radius ?? 100 }} meter</strong> dari lokasi sekolah. Pastikan Anda sudah berada di dalam area sekolah.
        </p>
        <button onclick="closePopup('lokasi')" class="px-5 py-2 rounded-lg text-xs bg-blue-600 text-white hover:bg-blue-700 transition">Mengerti</button>
    </div>
</div>

{{-- Tidak ada internet --}}
<div id="popup-internet" class="fixed inset-0 z-50 hidden items-center justify-center" style="background:rgba(0,0,0,0.45);" role="dialog" aria-modal="true" aria-labelledby="inet-title">
    <div class="bg-white rounded-2xl p-7 max-w-xs w-full text-center shadow-xl border border-gray-100">
        <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-3">
            <i class="ti ti-wifi-off text-xl text-red-600" aria-hidden="true"></i>
        </div>
        <p id="inet-title" class="font-medium text-gray-800 text-sm mb-2">Tidak ada koneksi internet</p>
        <p class="text-xs text-gray-500 leading-relaxed mb-5">
            Periksa koneksi Wi-Fi atau data seluler Anda, lalu coba lagi.
        </p>
        <div class="flex gap-2 justify-center">
            <button onclick="closePopup('internet')" class="px-4 py-2 rounded-lg text-xs border border-gray-200 text-gray-600 hover:bg-gray-50 transition">Tutup</button>
            <button onclick="retryInternet()" class="px-4 py-2 rounded-lg text-xs bg-blue-600 text-white hover:bg-blue-700 transition">Coba lagi</button>
        </div>
    </div>
</div>

{{-- Konfirmasi logout --}}
<div id="popup-logout" class="fixed inset-0 z-50 hidden items-center justify-center" style="background:rgba(0,0,0,0.45);" role="dialog" aria-modal="true" aria-labelledby="logout-title">
    <div class="bg-white rounded-2xl p-7 max-w-xs w-full text-center shadow-xl border border-gray-100">
        <div class="w-12 h-12 rounded-full bg-yellow-50 flex items-center justify-center mx-auto mb-3">
            <i class="ti ti-door-exit text-xl text-yellow-600" aria-hidden="true"></i>
        </div>
        <p id="logout-title" class="font-medium text-gray-800 text-sm mb-2">Keluar dari aplikasi?</p>
        <p class="text-xs text-gray-500 leading-relaxed mb-5">
            Anda akan keluar dari sesi ini. Pastikan absen sudah tercatat sebelum keluar.
        </p>
        <div class="flex gap-2 justify-center">
            <button onclick="closePopup('logout')" class="px-4 py-2 rounded-lg text-xs border border-gray-200 text-gray-600 hover:bg-gray-50 transition">Batal</button>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 rounded-lg text-xs bg-red-500 text-white hover:bg-red-600 transition">Ya, keluar</button>
            </form>
        </div>
    </div>
</div>


{{-- ============================================================
     JAVASCRIPT
================================================================== --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function toggleSidebar() {
    document.querySelector('.app-sidebar').classList.toggle('open');
    document.getElementById('sidebarOverlay').classList.toggle('show');
}

function showPopup(id)  { const el = document.getElementById('popup-'+id); if(el){ el.classList.remove('hidden'); el.classList.add('flex'); } }
function closePopup(id) { const el = document.getElementById('popup-'+id); if(el){ el.classList.add('hidden');    el.classList.remove('flex'); } }

function getDistance(lat1, lon1, lat2, lon2) {
    const R = 6371e3;
    const φ1 = lat1 * Math.PI/180, φ2 = lat2 * Math.PI/180;
    const Δφ = (lat2-lat1) * Math.PI/180;
    const Δλ = (lon2-lon1) * Math.PI/180;
    const a  = Math.sin(Δφ/2)**2 + Math.cos(φ1)*Math.cos(φ2)*Math.sin(Δλ/2)**2;
    return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
}

function handleMasuk() {
    if (!navigator.onLine) { showPopup('internet'); return; }
    if (!navigator.geolocation) { showPopup('gps'); return; }

    showPopup('loading');

    navigator.geolocation.getCurrentPosition(
        function(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            const schoolLat    = {{ $user->school->latitude  ?? 0 }};
            const schoolLng    = {{ $user->school->longitude ?? 0 }};
            const schoolRadius = {{ $user->school->radius    ?? 100 }};

            const distance = getDistance(lat, lng, schoolLat, schoolLng);

            closePopup('loading');

            if (distance > schoolRadius) { showPopup('lokasi'); return; }

            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;
            document.getElementById('form-masuk').submit();
        },
        function(error) {
            closePopup('loading');
            showPopup('gps');
        },
        { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
    );
}

function retryLocation() { closePopup('gps');      handleMasuk(); }
function retryInternet() { closePopup('internet'); handleMasuk(); }
</script>

</x-app-layout>