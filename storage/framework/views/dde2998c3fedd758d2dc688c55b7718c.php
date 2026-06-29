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
<div class="flex min-h-screen" style="background:#F0F4F8; font-family:'Inter',sans-serif;">
 

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
 

<aside style="width:240px; background:linear-gradient(160deg,#0F172A 0%,#1E3A5F 60%,#1D4ED8 100%); color:white; position:fixed; top:0; left:0; height:100vh; display:flex; flex-direction:column; box-shadow:4px 0 24px rgba(0,0,0,0.18); z-index:50;">
 
    
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
 
    
    <a href="<?php echo e(route('admin.pengaturan')); ?>"
       style="display:flex; align-items:center; gap:10px; margin:16px 14px 6px; padding:10px 12px; border-radius:10px; background:rgba(255,255,255,0.06); text-decoration:none;"
       onmouseover="this.style.background='rgba(255,255,255,0.12)'"
       onmouseout="this.style.background='rgba(255,255,255,0.06)'">
 
        <img src="<?php echo e(Auth::user()->photo ? asset('storage/'.Auth::user()->photo) : 'https://i.pravatar.cc/50'); ?>"
             alt="Foto <?php echo e(Auth::user()->name); ?>"
             style="width:38px; height:38px; border-radius:50%; object-fit:cover; border:2px solid #3B82F6; flex-shrink:0;">
 
        <div style="overflow:hidden;">
            <div style="font-size:13px; font-weight:600; color:#F1F5F9; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                <?php echo e(Auth::user()->name); ?>

            </div>
            <div style="font-size:11px; color:#60A5FA; display:flex; align-items:center; gap:4px; margin-top:2px;">
                <span style="width:5px; height:5px; background:#22C55E; border-radius:50%; display:inline-block; flex-shrink:0;"></span>
                <?php echo e(auth()->user()->role == 'super_admin' ? 'Super Admin' : 'Admin Sekolah'); ?>

            </div>
        </div>
    </a>
 
    
    <nav style="flex:1; padding:6px 14px; overflow-y:auto;">
        <div style="font-size:9px; color:#475569; letter-spacing:0.1em; text-transform:uppercase; padding:12px 8px 6px;">Menu Utama</div>
 
        <?php
        $navItems = [
            ['label' => 'Beranda',        'route' => 'admin.dashboard',  'icon' => 'ti-layout-dashboard'],
            ['label' => 'Data Guru',       'route' => 'guru.index',       'icon' => 'ti-users'],
            ['label' => 'Rekap Presensi',  'route' => 'admin.rekap',      'icon' => 'ti-clipboard-list'],
            ['label' => 'Registrasi Guru', 'route' => 'admin.registrasi', 'icon' => 'ti-user-plus'],
            ['label' => 'Persetujuan',     'url'   => '/admin/izin',      'icon' => 'ti-checkbox'],
            ['label' => 'Pengaturan',      'route' => 'admin.pengaturan', 'icon' => 'ti-settings'],
        ];
        ?>
 
        <?php $__currentLoopData = $navItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $isActive = isset($item['route'])
                    ? Route::currentRouteName() == $item['route']
                    : request()->is(ltrim($item['url'], '/'));
                $href = isset($item['route']) ? route($item['route']) : $item['url'];
            ?>
 
            <a href="<?php echo e($href); ?>"
               style="display:flex; align-items:center; gap:9px; padding:9px 10px; border-radius:8px; font-size:13px; text-decoration:none; margin-bottom:2px; transition:all 0.15s;
                      border-left:2px solid <?php echo e($isActive ? '#3B82F6' : 'transparent'); ?>;
                      background:<?php echo e($isActive ? 'rgba(59,130,246,0.18)' : 'transparent'); ?>;
                      color:<?php echo e($isActive ? '#F1F5F9' : '#94A3B8'); ?>;"
               onmouseover="this.style.background='<?php echo e($isActive ? 'rgba(59,130,246,0.18)' : 'rgba(255,255,255,0.07)'); ?>';this.style.color='#F1F5F9'"
               onmouseout="this.style.background='<?php echo e($isActive ? 'rgba(59,130,246,0.18)' : 'transparent'); ?>';this.style.color='<?php echo e($isActive ? '#F1F5F9' : '#94A3B8'); ?>'">
 
                <i class="ti <?php echo e($item['icon']); ?>" style="font-size:17px; flex-shrink:0; width:20px; text-align:center;"></i>
                <?php echo e($item['label']); ?>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>
 
    
    <div style="padding:14px;">
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit"
                    style="width:100%; background:rgba(239,68,68,0.13); color:#FCA5A5; border:1px solid rgba(239,68,68,0.25); padding:9px; border-radius:8px; font-size:13px; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:6px;"
                    onmouseover="this.style.background='rgba(239,68,68,0.28)'"
                    onmouseout="this.style.background='rgba(239,68,68,0.13)'">
                <i class="ti ti-logout" style="font-size:16px;"></i> Keluar
            </button>
        </form>
    </div>
</aside>
 


<main style="flex:1; margin-left:240px; display:flex; flex-direction:column; min-height:100vh;">

    
    <div style="background:white; border-bottom:1px solid #E2E8F0; padding:13px 28px; display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:40; box-shadow:0 1px 3px rgba(0,0,0,0.04);">
        <div style="display:flex; align-items:center; gap:8px; font-size:13px; color:#64748B;">
            <a href="<?php echo e(route('admin.dashboard')); ?>" style="color:#94A3B8; text-decoration:none;" onmouseover="this.style.color='#1D4ED8'" onmouseout="this.style.color='#94A3B8'">Dashboard</a>
            <span>›</span>
            <span style="color:#1E293B; font-weight:500;">Data Guru</span>
        </div>
        <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:7px 14px; border-radius:8px; font-size:12px; color:#475569;">
            📅 <?php echo e(\Carbon\Carbon::now()->translatedFormat('l, d F Y')); ?>

        </div>
    </div>

    <div style="padding:28px;">

        
        
        <div style="display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
            <div>
                <h1 style="font-size:20px; font-weight:700; color:#0F172A; margin:0 0 4px;">Data Guru</h1>
                <p class="text-xs text-gray-500 mt-0.5">
                    Total <strong style="color:#1D4ED8;"><?php echo e($guru->count()); ?> guru</strong> terdaftar di sistem
                </p>
            </div>

            
            <div style="display:flex; gap:10px; flex-wrap:wrap;">

                
                <form action="<?php echo e(route('guru.import')); ?>" method="POST" enctype="multipart/form-data" id="importForm">
                    <?php echo csrf_field(); ?>
                    <input type="file" id="importFile" name="file" accept=".xlsx,.xls" hidden onchange="submitImport()">
                    <button type="button" onclick="document.getElementById('importFile').click()"
                        style="background:white; color:#059669; border:1.5px solid #D1FAE5; padding:9px 18px; border-radius:8px; font-size:13px; font-weight:600; cursor:pointer; display:flex; align-items:center; gap:6px; box-shadow:0 1px 3px rgba(0,0,0,0.06);"
                        onmouseover="this.style.background='#F0FDF4'" onmouseout="this.style.background='white'">
                        📥 Import Excel
                    </button>
                </form>

                
                <a href="<?php echo e(route('admin.registrasi')); ?>"
                   style="background:#1D4ED8; color:white; padding:9px 18px; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; display:flex; align-items:center; gap:6px; box-shadow:0 2px 6px rgba(29,78,216,0.3);"
                   onmouseover="this.style.background='#1E40AF'" onmouseout="this.style.background='#1D4ED8'">
                    + Tambah Guru
                </a>
            </div>
        </div>

        
        
        <?php if(session('success')): ?>
        <div style="background:#F0FDF4; border:1px solid #BBF7D0; border-radius:10px; padding:12px 18px; margin-bottom:20px; display:flex; gap:10px; align-items:center;">
            <span>✅</span>
            <span style="font-size:13px; font-weight:500; color:#166534;"><?php echo e(session('success')); ?></span>
        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div style="background:#FEF2F2; border:1px solid #FECACA; border-radius:10px; padding:12px 18px; margin-bottom:20px; display:flex; gap:10px; align-items:center;">
            <span>⚠️</span>
            <span style="font-size:13px; font-weight:500; color:#991B1B;"><?php echo e(session('error')); ?></span>
        </div>
        <?php endif; ?>

        
        
        <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; padding:14px 18px; margin-bottom:16px; display:flex; align-items:center; gap:10px; box-shadow:0 1px 4px rgba(0,0,0,0.04);">
            <span style="font-size:16px; color:#94A3B8;">🔍</span>
            <input type="text" id="searchInput" placeholder="Cari nama atau email guru..."
                   oninput="filterTable()"
                   style="flex:1; border:none; outline:none; font-size:13px; color:#1E293B; background:transparent;"
                   autocomplete="off">
            <span id="searchCount" style="font-size:12px; color:#94A3B8;"></span>
        </div>

        
        <div style="background:white; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden; box-shadow:0 1px 6px rgba(0,0,0,0.05);">

            
            <table style="width:100%; border-collapse:collapse;" id="guruTable">
                <thead>
                    <tr style="background:linear-gradient(90deg,#1D4ED8,#2563EB); color:white;">
                        <th style="padding:14px 16px; text-align:left; font-size:12px; font-weight:600; letter-spacing:0.04em; width:50px;">No</th>
                        <th style="padding:14px 16px; text-align:left; font-size:12px; font-weight:600; letter-spacing:0.04em;">Nama Guru</th>
                        <th style="padding:14px 16px; text-align:left; font-size:12px; font-weight:600; letter-spacing:0.04em;">Email</th>
                        <th style="padding:14px 16px; text-align:left; font-size:12px; font-weight:600; letter-spacing:0.04em;">Sekolah</th>
                        <th style="padding:14px 16px; text-align:center; font-size:12px; font-weight:600; letter-spacing:0.04em; width:140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="guruTableBody">
                    <?php $__empty_1 = true; $__currentLoopData = $guru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="guru-row" style="border-bottom:1px solid #F1F5F9; transition:background 0.15s;"
                        onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='white'"
                        data-nama="<?php echo e(strtolower($item->name)); ?>" data-email="<?php echo e(strtolower($item->email)); ?>">

                        
                        <td style="padding:14px 16px; font-size:13px; color:#64748B; font-weight:500;">
                            <?php echo e($loop->iteration); ?>

                        </td>

                        
                        <td style="padding:14px 16px;">
                            <div style="display:flex; align-items:center; gap:12px;">
                                
                                <div style="width:38px; height:38px; border-radius:50%; background:linear-gradient(135deg,#DBEAFE,#BFDBFE); display:flex; align-items:center; justify-content:center; font-size:15px; font-weight:700; color:#1D4ED8; flex-shrink:0;">
                                    <?php echo e(strtoupper(substr($item->name, 0, 1))); ?>

                                </div>
                                <div>
                                    <div style="font-size:13px; font-weight:600; color:#0F172A;"><?php echo e($item->name); ?></div>
                                    
                                    <div style="font-size:11px; color:#94A3B8; margin-top:2px;">Guru</div>
                                </div>
                            </div>
                        </td>

                        
                        <td style="padding:14px 16px; font-size:13px; color:#475569;">
                            <?php echo e($item->email); ?>

                        </td>

                        
                        <td style="padding:14px 16px;">
                            <?php if($item->school): ?>
                            <span style="background:#EFF6FF; color:#1D4ED8; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:500;">
                                <?php echo e($item->school->nama_sekolah); ?>

                            </span>
                            <?php else: ?>
                            <span style="background:#F1F5F9; color:#94A3B8; padding:4px 12px; border-radius:20px; font-size:12px;">
                                Belum ditentukan
                            </span>
                            <?php endif; ?>
                        </td>

                        
                        
                        <td style="padding:14px 16px; text-align:center;">
                            <div style="display:flex; justify-content:center; gap:8px;">

                                <a href="<?php echo e(route('guru.edit', $item->id)); ?>"
                                   title="Edit data guru"
                                   style="background:#FEF9C3; color:#854D0E; border:1px solid #FDE68A; padding:6px 14px; border-radius:7px; font-size:12px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:4px;"
                                   onmouseover="this.style.background='#FEF08A'" onmouseout="this.style.background='#FEF9C3'">
                                    ✏️ Edit
                                </a>

                                <form action="<?php echo e(route('guru.destroy', $item->id)); ?>" method="POST"
                                      onsubmit="return confirmHapus('<?php echo e($item->name); ?>')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit"
                                            title="Hapus guru ini"
                                            style="background:#FEF2F2; color:#B91C1C; border:1px solid #FECACA; padding:6px 14px; border-radius:7px; font-size:12px; font-weight:600; cursor:pointer; display:inline-flex; align-items:center; gap:4px;"
                                            onmouseover="this.style.background='#FEE2E2'" onmouseout="this.style.background='#FEF2F2'">
                                        🗑️ Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    
                    <tr>
                        <td colspan="5" style="padding:48px 16px; text-align:center;">
                            <div style="font-size:36px; margin-bottom:12px;"></div>
                            <div style="font-size:14px; font-weight:600; color:#0F172A; margin-bottom:6px;">Belum ada data guru</div>
                            <div style="font-size:13px; color:#64748B; margin-bottom:16px;">Tambahkan guru pertama untuk memulai</div>
                            <a href="<?php echo e(route('guru.create')); ?>"
                               style="background:#1D4ED8; color:white; padding:9px 20px; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:6px;">
                                + Tambah Guru Pertama
                            </a>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            
            
            <?php if($guru->count() > 0): ?>
            <div style="padding:12px 16px; border-top:1px solid #F1F5F9; background:#FAFBFC; display:flex; align-items:center; justify-content:between;">
                <span style="font-size:12px; color:#94A3B8;">
                    Menampilkan <strong id="visibleCount" style="color:#1D4ED8;"><?php echo e($guru->count()); ?></strong> dari <?php echo e($guru->count()); ?> guru
                </span>
            </div>
            <?php endif; ?>
        </div>

    </div>
</main>
</div>

<script>
// Nielsen #5: Error prevention — konfirmasi hapus dengan nama guru
function confirmHapus(nama) {
    return confirm('Hapus guru "' + nama + '"?\n\nTindakan ini tidak dapat dibatalkan.');
}

// Nielsen #6: Recognition — filter real-time tanpa reload
function filterTable() {
    const q = document.getElementById('searchInput').value.toLowerCase().trim();
    const rows = document.querySelectorAll('.guru-row');
    let visible = 0;

    rows.forEach(row => {
        const nama = row.dataset.nama || '';
        const email = row.dataset.email || '';
        const match = nama.includes(q) || email.includes(q);
        row.style.display = match ? '' : 'none';
        if (match) visible++;
    });

    // Update counter — Nielsen #1: feedback real-time
    const countEl = document.getElementById('searchCount');
    const visibleEl = document.getElementById('visibleCount');
    if (q) {
        countEl.textContent = visible + ' hasil ditemukan';
        if (visibleEl) visibleEl.textContent = visible;
    } else {
        countEl.textContent = '';
        if (visibleEl) visibleEl.textContent = rows.length;
    }
}

// Submit form import otomatis saat file dipilih
function submitImport() {
    document.getElementById('importForm').submit();
}
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
<?php endif; ?><?php /**PATH D:\presensi-app\resources\views/admin/guru/index.blade.php ENDPATH**/ ?>