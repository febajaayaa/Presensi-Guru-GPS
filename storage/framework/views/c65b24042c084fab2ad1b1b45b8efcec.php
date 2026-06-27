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

        
        <?php if(session('success')): ?>
        <div style="display:flex; align-items:center; gap:10px; background:#F0FDF4; border:1px solid #BBF7D0; border-left:4px solid #22C55E; border-radius:10px; padding:12px 16px; margin-bottom:16px;">
            <i class="ti ti-circle-check" style="font-size:18px; color:#16A34A; flex-shrink:0;"></i>
            <div style="font-size:13px; font-weight:500; color:#166534;"><?php echo e(session('success')); ?></div>
        </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
        <div style="display:flex; align-items:center; gap:10px; background:#FEF2F2; border:1px solid #FECACA; border-left:4px solid #EF4444; border-radius:10px; padding:12px 16px; margin-bottom:16px;">
            <i class="ti ti-alert-triangle" style="font-size:18px; color:#DC2626; flex-shrink:0;"></i>
            <div style="font-size:13px; font-weight:500; color:#B91C1C;"><?php echo e(session('error')); ?></div>
        </div>
        <?php endif; ?>

        
        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:20px;">
            <div>
                <h1 style="font-size:20px; font-weight:700; color:#0F172A; margin:0 0 3px; display:flex; align-items:center; gap:8px;">
                    <h1 style="font-size:24px; font-weight:700; color:#0F172A; margin:0;"></i> Riwayat Cuti
                </h1>
                <p class="text-xs text-gray-500 mt-0.5">Pantau status pengajuan cuti kamu.</p>
            </div>
            <a href="<?php echo e(route('cuti.create')); ?>"
               style="display:inline-flex; align-items:center; gap:7px; background:#2563EB; color:white; padding:10px 18px; border-radius:9px; font-size:13px; font-weight:600; text-decoration:none; box-shadow:0 1px 3px rgba(37,99,235,0.3);"
               onmouseover="this.style.background='#1D4ED8'" onmouseout="this.style.background='#2563EB'">
                <i class="ti ti-plus" style="font-size:15px;"></i> Ajukan Cuti
            </a>
        </div>

        
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin-bottom:20px;">
            <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; border-top:3px solid #3B82F6; padding:16px 18px; box-shadow:0 1px 4px rgba(0,0,0,0.05);">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <div style="font-size:11px; color:#94A3B8; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:6px;">Total Cuti</div>
                        <div style="font-size:28px; font-weight:700; color:#2563EB;"><?php echo e($cutis->count()); ?></div>
                    </div>
                    <div style="width:42px; height:42px; background:#EFF6FF; border-radius:10px; display:flex; align-items:center; justify-content:center;">
                        <i class="ti ti-calendar" style="font-size:20px; color:#3B82F6;"></i>
                    </div>
                </div>
            </div>
            <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; border-top:3px solid #10B981; padding:16px 18px; box-shadow:0 1px 4px rgba(0,0,0,0.05);">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <div style="font-size:11px; color:#94A3B8; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:6px;">Disetujui</div>
                        <div style="font-size:28px; font-weight:700; color:#10B981;"><?php echo e($cutis->where('status','disetujui')->count()); ?></div>
                    </div>
                    <div style="width:42px; height:42px; background:#F0FDF4; border-radius:10px; display:flex; align-items:center; justify-content:center;">
                        <i class="ti ti-circle-check" style="font-size:20px; color:#10B981;"></i>
                    </div>
                </div>
            </div>
            <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; border-top:3px solid #F59E0B; padding:16px 18px; box-shadow:0 1px 4px rgba(0,0,0,0.05);">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <div style="font-size:11px; color:#94A3B8; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:6px;">Menunggu</div>
                        <div style="font-size:28px; font-weight:700; color:#F59E0B;"><?php echo e($cutis->where('status','pending')->count()); ?></div>
                    </div>
                    <div style="width:42px; height:42px; background:#FFFBEB; border-radius:10px; display:flex; align-items:center; justify-content:center;">
                        <i class="ti ti-clock" style="font-size:20px; color:#F59E0B;"></i>
                    </div>
                </div>
            </div>
        </div>

        
        <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; overflow:hidden; box-shadow:0 1px 4px rgba(0,0,0,0.05);">

            
            <table style="width:100%; border-collapse:collapse; font-size:13px;">
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
                    <?php $__empty_1 = true; $__currentLoopData = $cutis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cuti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $durasi = \Carbon\Carbon::parse($cuti->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($cuti->tanggal_selesai)) + 1;
                    ?>
                    <tr style="border-bottom:1px solid #F1F5F9;" onmouseover="this.style.background='#F8FAFF'" onmouseout="this.style.background='white'">

                        
                        <td style="padding:13px 16px;">
                            <span style="display:inline-flex; align-items:center; padding:4px 10px; border-radius:6px; font-size:12px; font-weight:600; background:#EFF6FF; color:#1D4ED8; border:1px solid #BFDBFE;">
                                <?php echo e($cuti->jenis_cuti ?? 'Tahunan'); ?>

                            </span>
                        </td>

                        
                        <td style="padding:13px 16px; font-size:13px; font-weight:500; color:#1E293B;">
                            <?php echo e(\Carbon\Carbon::parse($cuti->tanggal_mulai)->translatedFormat('d M Y')); ?>

                        </td>

                        
                        <td style="padding:13px 16px; font-size:13px; font-weight:500; color:#1E293B;">
                            <?php echo e(\Carbon\Carbon::parse($cuti->tanggal_selesai)->translatedFormat('d M Y')); ?>

                        </td>

                        
                        <td style="padding:13px 16px;">
                            <span style="font-size:12px; color:#64748B; background:#F1F5F9; padding:3px 9px; border-radius:20px;"><?php echo e($durasi); ?> hari</span>
                        </td>

                        
                        <td style="padding:13px 16px; font-size:13px; color:#64748B; max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="<?php echo e($cuti->alasan); ?>">
                            <?php echo e($cuti->alasan ?? '-'); ?>

                        </td>

                        
                        <td style="padding:13px 16px;">
                            <?php if($cuti->status == 'pending'): ?>
                                <span style="display:inline-flex; align-items:center; gap:5px; padding:4px 11px; border-radius:20px; font-size:12px; font-weight:600; background:#FEF3C7; color:#92400E; border:1px solid #FDE68A;">
                                    <span style="width:6px; height:6px; border-radius:50%; background:#F59E0B; display:inline-block;"></span> Menunggu
                                </span>
                            <?php elseif($cuti->status == 'disetujui'): ?>
                                <span style="display:inline-flex; align-items:center; gap:5px; padding:4px 11px; border-radius:20px; font-size:12px; font-weight:600; background:#DCFCE7; color:#15803D; border:1px solid #A7F3D0;">
                                    <span style="width:6px; height:6px; border-radius:50%; background:#22C55E; display:inline-block;"></span> Disetujui
                                </span>
                            <?php else: ?>
                                <span style="display:inline-flex; align-items:center; gap:5px; padding:4px 11px; border-radius:20px; font-size:12px; font-weight:600; background:#FEE2E2; color:#B91C1C; border:1px solid #FCA5A5;">
                                    <span style="width:6px; height:6px; border-radius:50%; background:#EF4444; display:inline-block;"></span> Ditolak
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" style="padding:56px 24px; text-align:center;">
                            <div style="width:56px; height:56px; background:#F1F5F9; border-radius:14px; display:flex; align-items:center; justify-content:center; margin:0 auto 14px;">
                                <i class="ti ti-calendar-off" style="font-size:28px; color:#CBD5E1;"></i>
                            </div>
                            <p style="font-size:14px; font-weight:600; color:#64748B; margin:0 0 4px;">Belum ada data cuti</p>
                            <p style="font-size:12px; color:#94A3B8; margin:0 0 16px;">Klik tombol "Ajukan Cuti" untuk membuat pengajuan baru.</p>
                            <a href="<?php echo e(route('cuti.create')); ?>"
                               style="display:inline-flex; align-items:center; gap:6px; background:#2563EB; color:white; padding:9px 18px; border-radius:8px; font-size:13px; text-decoration:none; font-weight:600;">
                                <i class="ti ti-plus" style="font-size:15px;"></i> Ajukan Cuti
                            </a>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            
            <div style="padding:12px 16px; border-top:1px solid #F1F5F9; background:#FAFBFF;">
                <?php if(method_exists($cutis, 'hasPages') && $cutis->hasPages()): ?>
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <p style="font-size:12px; color:#94A3B8; margin:0;">
                        Menampilkan <?php echo e($cutis->firstItem()); ?>–<?php echo e($cutis->lastItem()); ?> dari <?php echo e($cutis->total()); ?> data
                    </p>
                    <?php echo e($cutis->links()); ?>

                </div>
                <?php else: ?>
                <p style="font-size:12px; color:#94A3B8; margin:0;">Menampilkan <?php echo e($cutis->count()); ?> data</p>
                <?php endif; ?>
            </div>

        </div>
    </div>
</main>
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
<?php endif; ?><?php /**PATH D:\presensi-app\resources\views/user/cuti/index.blade.php ENDPATH**/ ?>