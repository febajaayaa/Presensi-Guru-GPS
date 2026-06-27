<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

<?php $user = auth()->user(); ?>

<div style="display:flex; min-height:100vh; background:#F0F4F8; font-family:'Inter',sans-serif;">


<aside style="width:220px; min-width:220px; background:#1E3A8A; position:fixed; top:0; left:0; height:100vh; display:flex; flex-direction:column; z-index:50; box-shadow:4px 0 16px rgba(0,0,0,0.12);">

    <div style="padding:20px 14px 12px; border-bottom:1px solid rgba(255,255,255,0.08);">
        <a href="<?php echo e(route('pengaturan')); ?>" style="display:flex; align-items:center; gap:10px; padding:10px; border-radius:10px; text-decoration:none; background:rgba(255,255,255,0.06);"
           onmouseover="this.style.background='rgba(255,255,255,0.12)'" onmouseout="this.style.background='rgba(255,255,255,0.06)'">
            <img src="<?php echo e($user->photo ? asset('storage/'.$user->photo) : 'https://i.pravatar.cc/50'); ?>"
                 style="width:38px; height:38px; border-radius:50%; object-fit:cover; border:2px solid rgba(255,255,255,0.3); flex-shrink:0;" alt="Foto profil">
            <div style="overflow:hidden;">
                <div style="font-size:13px; font-weight:600; color:#F1F5F9; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?php echo e($user->name); ?></div>
                <div style="font-size:11px; color:rgba(255,255,255,0.5); margin-top:1px;">Mahasiswa PTI</div>
            </div>
        </a>
    </div>

    <nav style="flex:1; padding:10px 12px; overflow-y:auto;">
        <div style="font-size:9px; color:rgba(255,255,255,0.35); letter-spacing:0.1em; text-transform:uppercase; padding:8px 8px 6px;">Menu</div>

        <?php
        $navItems = [
            ['route' => 'dashboard',  'icon' => 'ti-layout-dashboard', 'label' => 'Beranda'],
            ['route' => 'izin.form',  'icon' => 'ti-file-text',        'label' => 'Izin'],
            ['route' => 'cuti.index', 'icon' => 'ti-calendar-off',     'label' => 'Cuti'],
            ['route' => 'history',    'icon' => 'ti-history',          'label' => 'Riwayat'],
            ['route' => 'pengaturan', 'icon' => 'ti-settings',         'label' => 'Pengaturan'],
        ];
        ?>

        <?php $__currentLoopData = $navItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $active = request()->routeIs($item['route']); ?>
        <a href="<?php echo e(route($item['route'])); ?>"
           style="display:flex; align-items:center; gap:9px; padding:9px 10px; border-radius:8px; font-size:13px; text-decoration:none; margin-bottom:2px;
                  border-left:2px solid <?php echo e($active ? '#60A5FA' : 'transparent'); ?>;
                  background:<?php echo e($active ? 'rgba(255,255,255,0.15)' : 'transparent'); ?>;
                  color:<?php echo e($active ? '#fff' : 'rgba(255,255,255,0.65)'); ?>; font-weight:<?php echo e($active ? '600' : '400'); ?>;"
           onmouseover="this.style.background='rgba(255,255,255,0.1)';this.style.color='#fff'"
           onmouseout="this.style.background='<?php echo e($active ? 'rgba(255,255,255,0.15)' : 'transparent'); ?>';this.style.color='<?php echo e($active ? '#fff' : 'rgba(255,255,255,0.65)'); ?>'">
            <i class="ti <?php echo e($item['icon']); ?>" style="font-size:16px; width:18px; text-align:center; flex-shrink:0;"></i>
            <?php echo e($item['label']); ?>

        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>

    <div style="padding:12px 14px; border-top:1px solid rgba(255,255,255,0.08);">
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit"
                    style="width:100%; background:rgba(239,68,68,0.15); color:#FCA5A5; border:1px solid rgba(239,68,68,0.3); padding:9px; border-radius:8px; font-size:13px; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:6px;"
                    onmouseover="this.style.background='rgba(239,68,68,0.28)'" onmouseout="this.style.background='rgba(239,68,68,0.15)'">
                <i class="ti ti-logout" style="font-size:15px;"></i> Keluar
            </button>
        </form>
    </div>
</aside>


<main style="flex:1; margin-left:220px; min-height:100vh; display:flex; flex-direction:column;">

    
    <div style="background:white; border-bottom:1px solid #E2E8F0; padding:10px 24px; display:flex; align-items:center; justify-content:flex-end; position:sticky; top:0; z-index:40; box-shadow:0 1px 3px rgba(0,0,0,0.04);">
        <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:6px 14px; border-radius:8px; font-size:12px; color:#475569; display:flex; align-items:center; gap:6px;">
            <i class="ti ti-calendar" style="color:#3B82F6; font-size:14px;"></i>
            <?php echo e(\Carbon\Carbon::now()->translatedFormat('l, d F Y')); ?>

        </div>
    </div>

    
    <div style="padding:24px; flex:1;">

        
        <div class="flex justify-between items-center mb-5">
            <div>
               <h1 style="font-size:24px; font-weight:700; color:#0F172A; margin:0;">Beranda Presensi</h1>
                <p class="text-xs text-gray-500 mt-0.5">Sistem Informasi Kehadiran Guru</p>
            </div>
        </div>

        <div class="grid gap-4" style="grid-template-columns: 1fr 220px;">

            
            <div class="space-y-4">

                
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

                        <?php
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
                        ?>

                        <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full <?php echo e($statusClass); ?>">
                            <i class="ti ti-circle-check text-sm" aria-hidden="true"></i>
                            <?php echo e($statusLabel); ?>

                        </span>
                    </div>

                    
                    <?php
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
                    ?>

                    <div class="grid grid-cols-2 gap-3">

                        <form id="form-masuk" method="POST" action="/masuk">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="latitude"  id="lat">
                            <input type="hidden" name="longitude" id="lng">
                            <button type="button"
                                    onclick="handleMasuk()"
                                    <?php echo e($disabledMasuk ? 'disabled' : ''); ?>

                                    title="<?php echo e($disabledMasuk ? 'Absen masuk sudah tercatat' : 'Klik untuk absen masuk'); ?>"
                                    class="w-full flex items-center justify-center gap-2 rounded-xl py-3 text-sm font-medium transition
                                           <?php echo e($disabledMasuk ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-green-600 hover:bg-green-700 text-white'); ?>">
                                <i class="ti ti-login text-base" aria-hidden="true"></i>
                                <?php echo e($labelMasuk); ?>

                            </button>
                        </form>

                        <form method="POST" action="<?php echo e(route('presensi.keluar')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="<?php echo e($disabledKeluar ? 'button' : 'submit'); ?>"
                                    <?php echo e($disabledKeluar ? 'disabled' : ''); ?>

                                    title="<?php echo e($disabledKeluar ? 'Belum bisa absen keluar' : 'Klik untuk absen keluar'); ?>"
                                    class="w-full flex items-center justify-center gap-2 rounded-xl py-3 text-sm font-medium border transition
                                           <?php echo e($disabledKeluar ? 'bg-gray-100 border-gray-100 text-gray-400 cursor-not-allowed' : 'border-red-200 bg-red-600 hover:bg-red-700 text-white'); ?>">
                                <i class="ti ti-logout text-base" aria-hidden="true"></i>
                                <?php echo e($labelKeluar); ?>

                            </button>
                        </form>

                    </div>
                </div>

                
                <div class="grid grid-cols-5 gap-3">
                    <?php
                    $stats = [
                        ['val' => $hadir     ?? 0, 'label' => 'Hadir',     'color' => 'text-green-600', 'bg' => 'bg-green-50'],
                        ['val' => $terlambat ?? 0, 'label' => 'Terlambat', 'color' => 'text-red-600',   'bg' => 'bg-red-50'],
                        ['val' => $sakit     ?? 0, 'label' => 'Sakit',     'color' => 'text-amber-600', 'bg' => 'bg-amber-50'],
                        ['val' => $izin      ?? 0, 'label' => 'Izin',      'color' => 'text-blue-600',  'bg' => 'bg-blue-50'],
                        ['val' => $cuti      ?? 0, 'label' => 'Cuti',      'color' => 'text-pink-600',  'bg' => 'bg-pink-50'],
                    ];
                    ?>

                    <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-3 text-center">
                        <p class="text-2xl font-semibold <?php echo e($s['color']); ?>"><?php echo e($s['val']); ?></p>
                        <p class="text-xs text-gray-500 mt-1"><?php echo e($s['label']); ?></p>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>

            
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 overflow-y-auto" style="max-height:420px">
                <p class="text-[11px] font-medium uppercase tracking-wider text-gray-400 mb-3">Riwayat Presensi</p>

                <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="flex justify-between items-center py-2.5 border-b border-gray-100 last:border-0">
                    <div>
                        <p class="text-sm font-medium text-gray-800">
                            <?php echo e(\Carbon\Carbon::parse($d->tanggal)->format('d M Y')); ?>

                        </p>
                        <p class="text-xs text-gray-400 mt-0.5">
                            <?php echo e($d->jam_masuk  ? \Carbon\Carbon::parse($d->jam_masuk)->format('H:i')  : '--:--'); ?>

                            –
                            <?php echo e($d->jam_keluar ? \Carbon\Carbon::parse($d->jam_keluar)->format('H:i') : '--:--'); ?>

                        </p>
                    </div>

                    <?php if($d->status == 'hadir'): ?>
                        <span class="inline-flex items-center gap-1 text-[11px] font-medium px-2 py-0.5 rounded-full bg-green-100 text-green-700">
                            <i class="ti ti-check text-xs"></i> Hadir
                        </span>
                    <?php elseif($d->status == 'terlambat'): ?>
                        <span class="inline-flex items-center gap-1 text-[11px] font-medium px-2 py-0.5 rounded-full bg-red-100 text-red-700">
                            <i class="ti ti-clock text-xs"></i> Terlambat
                        </span>
                    <?php elseif(in_array($d->status, ['izin','sakit','cuti'])): ?>
                        <?php
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
                        ?>
                        <span class="inline-flex text-[11px] font-medium px-2 py-0.5 rounded-full <?php echo e($bc); ?>">
                            <?php echo e($bl); ?><?php echo e($bs ? ' ('.$bs.')' : ''); ?>

                        </span>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-sm text-gray-400 text-center mt-6">Belum ada riwayat presensi.</p>
                <?php endif; ?>
            </div>

        </div>
    </div>
    </main>
</div>





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


<div id="popup-lokasi" class="fixed inset-0 z-50 hidden items-center justify-center" style="background:rgba(0,0,0,0.45);" role="dialog" aria-modal="true" aria-labelledby="lokasi-title">
    <div class="bg-white rounded-2xl p-7 max-w-xs w-full text-center shadow-xl border border-gray-100">
        <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-3">
            <i class="ti ti-map-pin-exclamation text-xl text-red-600" aria-hidden="true"></i>
        </div>
        <p id="lokasi-title" class="font-medium text-gray-800 text-sm mb-2">Di luar area sekolah</p>
        <p class="text-xs text-gray-500 leading-relaxed mb-5">
            Absen masuk hanya dapat dilakukan dalam radius <strong><?php echo e($user->school->radius ?? 100); ?> meter</strong> dari lokasi sekolah. Pastikan Anda sudah berada di dalam area sekolah.
        </p>
        <button onclick="closePopup('lokasi')" class="px-5 py-2 rounded-lg text-xs bg-blue-600 text-white hover:bg-blue-700 transition">Mengerti</button>
    </div>
</div>


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
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="px-4 py-2 rounded-lg text-xs bg-red-500 text-white hover:bg-red-600 transition">Ya, keluar</button>
            </form>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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

            const schoolLat    = <?php echo e($user->school->latitude  ?? 0); ?>;
            const schoolLng    = <?php echo e($user->school->longitude ?? 0); ?>;
            const schoolRadius = <?php echo e($user->school->radius    ?? 100); ?>;

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

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH D:\presensi-app\resources\views/dashboard.blade.php ENDPATH**/ ?>