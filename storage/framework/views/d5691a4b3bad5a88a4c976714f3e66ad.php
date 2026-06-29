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
                <div style="font-size:10px; color:#475569; margin-top:1px; text-transform:uppercase;">Management System</div>
            </div>
        </div>
    </div>

    
    <div style="display:flex; align-items:center; gap:10px; margin:16px 14px 6px; padding:10px 12px; border-radius:10px; background:rgba(255,255,255,0.06);">
        <div style="width:38px; height:38px; border-radius:50%; background:#2563EB; display:flex; align-items:center; justify-content:center; border:2px solid #3B82F6; flex-shrink:0;">
            <i class="ti ti-shield-check" style="font-size:18px; color:#fff;"></i>
        </div>
        <div style="overflow:hidden;">
            <div style="font-size:13px; font-weight:600; color:#F1F5F9; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                <?php echo e(Auth::user()->name); ?>

            </div>
            <div style="font-size:11px; color:#60A5FA; display:flex; align-items:center; gap:4px; margin-top:2px;">
                <span style="width:5px; height:5px; background:#22C55E; border-radius:50%; display:inline-block; flex-shrink:0;"></span>
                Super Admin
            </div>
        </div>
    </div>

    
    <nav style="flex:1; padding:6px 14px; overflow-y:auto;">
        <div style="font-size:9px; color:#475569; letter-spacing:0.1em; text-transform:uppercase; padding:12px 8px 6px;">Menu Utama</div>

        <?php
        $navItems = [
            ['label' => 'Beranda',        'url' => route('superadmin.dashboard'),    'route' => 'superadmin.dashboard',    'icon' => 'ti-layout-dashboard'],
            ['label' => 'Kelola Akun',    'url' => '/superadmin/users',              'route' => null,                      'icon' => 'ti-users'],
            ['label' => 'Data Sekolah',   'url' => '/admin/schools',                 'route' => null,                      'icon' => 'ti-building'],
            ['label' => 'Tambah Sekolah', 'url' => '/admin/schools/create',          'route' => null,                      'icon' => 'ti-building-community'],
        ];
        ?>

        <?php $__currentLoopData = $navItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $isActive = $item['route']
                    ? Route::currentRouteName() == $item['route']
                    : request()->is(ltrim($item['url'], '/'));
            ?>
            <a href="<?php echo e($item['url']); ?>"
               style="display:flex; align-items:center; gap:9px; padding:9px 10px; border-radius:8px; font-size:13px; text-decoration:none; margin-bottom:2px;
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


<div style="flex:1; margin-left:240px; padding:24px 28px;">

    
    <nav style="display:flex; align-items:center; gap:6px; font-size:12px; color:#94A3B8; margin-bottom:20px;">
        <a href="<?php echo e(route('superadmin.dashboard')); ?>" style="color:#94A3B8; text-decoration:none;" onmouseover="this.style.color='#1E40AF'" onmouseout="this.style.color='#94A3B8'">Beranda</a>
        <span>›</span>
        <span style="color:#1E293B; font-weight:500;">Data Sekolah</span>
    </nav>

    
    <?php if(session('success')): ?>
    <div style="display:flex; align-items:center; gap:10px; background:#F0FDF4; border:1px solid #BBF7D0; color:#166534; padding:12px 16px; border-radius:10px; font-size:13px; margin-bottom:20px;">
        <i class="ti ti-circle-check" style="font-size:17px;"></i>
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    
    <div style="display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:20px;">
        <div>
            <div style="font-size:11px; color:#64748B; letter-spacing:0.08em; text-transform:uppercase; margin-bottom:4px;">Admin Panel</div>
            <h1 style="font-size:22px; font-weight:700; color:#0F172A; margin:0; display:flex; align-items:center; gap:9px;">
                <i class="ti ti-building" style="font-size:24px; color:#3B82F6;"></i> Data Sekolah
            </h1>
            <p style="font-size:13px; color:#64748B; margin:4px 0 0;">Kelola lokasi dan radius absensi sekolah</p>
        </div>
        <a href="<?php echo e(route('superadmin.schools.create')); ?>"
           style="display:inline-flex; align-items:center; gap:7px; background:#2563EB; color:white; padding:10px 18px; border-radius:8px; font-size:13px; font-weight:500; text-decoration:none;"
           onmouseover="this.style.background='#1D4ED8'"
           onmouseout="this.style.background='#2563EB'">
            <i class="ti ti-plus" style="font-size:15px;"></i>
            Tambah Sekolah
        </a>
    </div>

    
    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-bottom:20px;">
        <div style="background:white; border:1px solid #E2E8F0; border-top:3px solid #3B82F6; border-radius:12px; padding:16px 18px; box-shadow:0 1px 4px rgba(0,0,0,0.05);">
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <div>
                    <div style="font-size:11px; color:#94A3B8; text-transform:uppercase; letter-spacing:0.06em;">Total Sekolah</div>
                    <div style="font-size:26px; font-weight:700; color:#1E293B; margin-top:4px;"><?php echo e($schools->count()); ?></div>
                    <div style="font-size:12px; color:#3B82F6; margin-top:2px;">sekolah terdaftar</div>
                </div>
                <div style="width:42px; height:42px; background:#EFF6FF; border-radius:10px; display:flex; align-items:center; justify-content:center;">
                    <i class="ti ti-building" style="font-size:22px; color:#3B82F6;"></i>
                </div>
            </div>
        </div>
        <div style="background:white; border:1px solid #E2E8F0; border-top:3px solid #10B981; border-radius:12px; padding:16px 18px; box-shadow:0 1px 4px rgba(0,0,0,0.05);">
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <div>
                    <div style="font-size:11px; color:#94A3B8; text-transform:uppercase; letter-spacing:0.06em;">Radius Rata-rata</div>
                    <div style="font-size:26px; font-weight:700; color:#1E293B; margin-top:4px;">
                        <?php echo e($schools->count() ? round($schools->avg('radius')) : 0); ?> m
                    </div>
                    <div style="font-size:12px; color:#10B981; margin-top:2px;">rata-rata radius</div>
                </div>
                <div style="width:42px; height:42px; background:#F0FDF4; border-radius:10px; display:flex; align-items:center; justify-content:center;">
                    <i class="ti ti-circle-dashed" style="font-size:22px; color:#10B981;"></i>
                </div>
            </div>
        </div>
        <div style="background:white; border:1px solid #E2E8F0; border-top:3px solid #8B5CF6; border-radius:12px; padding:16px 18px; box-shadow:0 1px 4px rgba(0,0,0,0.05);">
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <div>
                    <div style="font-size:11px; color:#94A3B8; text-transform:uppercase; letter-spacing:0.06em;">Terakhir Diperbarui</div>
                    <div style="font-size:15px; font-weight:600; color:#1E293B; margin-top:6px;">
                        <?php echo e($schools->count() ? $schools->sortByDesc('updated_at')->first()->updated_at->diffForHumans() : '-'); ?>

                    </div>
                </div>
                <div style="width:42px; height:42px; background:#F5F3FF; border-radius:10px; display:flex; align-items:center; justify-content:center;">
                    <i class="ti ti-clock" style="font-size:22px; color:#8B5CF6;"></i>
                </div>
            </div>
        </div>
    </div>

    
    <div style="background:white; border:1px solid #E2E8F0; border-radius:14px; overflow:hidden; box-shadow:0 1px 6px rgba(0,0,0,0.06);">
        <table style="width:100%; border-collapse:collapse; font-size:13px;">
            <thead>
                <tr style="background:#3B82F6;">
                    <th style="padding:13px 16px; text-align:left; color:#fff; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; width:40px;"></th>
                    <th style="padding:13px 16px; text-align:left; color:#fff; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.06em;">Nama Sekolah</th>
                    <th style="padding:13px 16px; text-align:left; color:#fff; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.06em;">Koordinat</th>
                    <th style="padding:13px 16px; text-align:left; color:#fff; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.06em;">Radius</th>
                    <th style="padding:13px 16px; text-align:center; color:#fff; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.06em;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr style="border-bottom:1px solid #F1F5F9;" onmouseover="this.style.background='#F8FAFF'" onmouseout="this.style.background='white'">

                    
                    <td style="padding:14px 16px;">
                        <div style="width:40px; height:40px; border-radius:10px; background:#EFF6FF; display:flex; align-items:center; justify-content:center;">
                            <i class="ti ti-building" style="font-size:20px; color:#3B82F6;"></i>
                        </div>
                    </td>

                    
                    <td style="padding:14px 16px;">
                        <div style="font-size:14px; font-weight:600; color:#1E293B;"><?php echo e($s->nama_sekolah); ?></div>
                    </td>

                    
                    <td style="padding:14px 16px;">
                        <?php if($s->latitude && $s->longitude): ?>
                        <span style="display:inline-flex; align-items:center; gap:4px; font-size:12px; color:#64748B; background:#F8FAFC; border:1px solid #E2E8F0; padding:4px 10px; border-radius:20px;">
                            <i class="ti ti-map-pin" style="font-size:13px; color:#3B82F6;"></i>
                            <?php echo e($s->latitude); ?>, <?php echo e($s->longitude); ?>

                        </span>
                        <?php else: ?>
                        <span style="display:inline-flex; align-items:center; gap:4px; font-size:12px; color:#B45309; background:#FFFBEB; border:1px solid #FDE68A; padding:4px 10px; border-radius:20px;">
                            <i class="ti ti-alert-triangle" style="font-size:13px;"></i>
                            Belum diisi
                        </span>
                        <?php endif; ?>
                    </td>

                    
                    <td style="padding:14px 16px;">
                        <span style="display:inline-flex; align-items:center; gap:4px; font-size:12px; color:#065F46; background:#DCFCE7; border:1px solid #A7F3D0; padding:4px 10px; border-radius:20px;">
                            <i class="ti ti-circle-dashed" style="font-size:13px;"></i>
                            <?php echo e($s->radius); ?> m
                        </span>
                    </td>

                    
                    <td style="padding:14px 16px; text-align:center;">
                        <div style="display:flex; align-items:center; justify-content:center; gap:8px;">
                            <a href="<?php echo e(route('superadmin.schools.edit', $s->id)); ?>"
                               style="display:inline-flex; align-items:center; gap:5px; padding:6px 13px; border-radius:7px; font-size:12px; color:#1D4ED8; background:#EFF6FF; border:1px solid #BFDBFE; text-decoration:none;"
                               onmouseover="this.style.background='#DBEAFE'"
                               onmouseout="this.style.background='#EFF6FF'">
                                <i class="ti ti-edit" style="font-size:14px;"></i> Edit
                            </a>
                            <form action="<?php echo e(route('superadmin.schools.delete', $s->id)); ?>" method="POST" style="display:inline;"
                                  onsubmit="return confirm('Hapus <?php echo e($s->nama_sekolah); ?>? Tindakan ini tidak dapat dibatalkan.')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                    style="display:inline-flex; align-items:center; gap:5px; padding:6px 13px; border-radius:7px; font-size:12px; color:#DC2626; background:#FEF2F2; border:1px solid #FECACA; cursor:pointer;"
                                    onmouseover="this.style.background='#FEE2E2'"
                                    onmouseout="this.style.background='#FEF2F2'">
                                    <i class="ti ti-trash" style="font-size:14px;"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" style="padding:56px 24px; text-align:center;">
                        <div style="width:60px; height:60px; background:#F1F5F9; border-radius:14px; display:flex; align-items:center; justify-content:center; margin:0 auto 14px;">
                            <i class="ti ti-building-off" style="font-size:30px; color:#CBD5E1;"></i>
                        </div>
                        <p style="font-size:14px; font-weight:600; color:#64748B; margin:0 0 4px;">Belum ada data sekolah</p>
                        <p style="font-size:12px; color:#94A3B8; margin:0 0 16px;">Tambahkan sekolah pertama untuk mulai mengelola absensi</p>
                        <a href="<?php echo e(route('superadmin.schools.create')); ?>"
                           style="display:inline-flex; align-items:center; gap:6px; background:#2563EB; color:white; padding:9px 18px; border-radius:8px; font-size:13px; text-decoration:none;">
                            <i class="ti ti-plus" style="font-size:15px;"></i> Tambah Sekolah Pertama
                        </a>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
</div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH D:\presensi-app\resources\views/admin/schools.blade.php ENDPATH**/ ?>