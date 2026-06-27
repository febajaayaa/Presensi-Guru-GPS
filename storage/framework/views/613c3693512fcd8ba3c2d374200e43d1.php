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
                <div style="font-size:12px; font-weight:700; color:#93C5FD; letter-spacing:0.05em;">PRESENSI APP</div>
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
            <span style="color:#1E293B; font-weight:500;">Rekap Presensi</span>
        </div>

        
        <div style="display:flex; align-items:center; gap:10px;">
            <?php
            $namaBulan = [
                1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',
                5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',
                9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
            ];
            ?>

            
            
            <form method="GET" style="display:flex; gap:8px;">
                <div style="position:relative;">
                    <select name="bulan" onchange="this.form.submit()"
                        style="appearance:none; background:#F8FAFC; border:1.5px solid #E2E8F0; border-radius:8px; padding:8px 32px 8px 14px; font-size:13px; color:#1E293B; cursor:pointer; outline:none;">
                        <?php $__currentLoopData = $namaBulan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $nama): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?php echo e($bulan == $key ? 'selected' : ''); ?>><?php echo e($nama); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <span style="position:absolute; right:10px; top:50%; transform:translateY(-50%); font-size:11px; color:#64748B; pointer-events:none;">▼</span>
                </div>
                <div style="position:relative;">
                    <select name="tahun" onchange="this.form.submit()"
                        style="appearance:none; background:#F8FAFC; border:1.5px solid #E2E8F0; border-radius:8px; padding:8px 32px 8px 14px; font-size:13px; color:#1E293B; cursor:pointer; outline:none;">
                        <?php for($y = now()->year; $y >= now()->year - 3; $y--): ?>
                            <option value="<?php echo e($y); ?>" <?php echo e($tahun == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                        <?php endfor; ?>
                    </select>
                    <span style="position:absolute; right:10px; top:50%; transform:translateY(-50%); font-size:11px; color:#64748B; pointer-events:none;">▼</span>
                </div>
            </form>

            
            <a href="<?php echo e(route('admin.rekap.export', ['bulan' => $bulan, 'tahun' => $tahun])); ?>"
               style="background:#1D4ED8; color:white; padding:9px 18px; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; display:flex; align-items:center; gap:6px; box-shadow:0 2px 6px rgba(29,78,216,0.25);"
               onmouseover="this.style.background='#1E40AF'" onmouseout="this.style.background='#1D4ED8'">
                📥 Download PDF
            </a>
        </div>
    </div>

    <div style="padding:24px 28px; display:flex; flex-direction:column; gap:20px;">

        
        <div>
            <h1 style="font-size:20px; font-weight:700; color:#0F172A; margin:0 0 4px;">Rekap Presensi Guru</h1>
            <p class="text-xs text-gray-500 mt-0.5">
                Periode <strong style="color:#1D4ED8;"><?php echo e($namaBulan[$bulan]); ?> <?php echo e($tahun); ?></strong>
            </p>
        </div>

        
        
        <div style="display:grid; grid-template-columns:repeat(5,1fr); gap:12px;">

            <div style="background:white; border-radius:12px; padding:16px 18px; border:1px solid #E2E8F0; border-top:3px solid #16A34A; box-shadow:0 1px 4px rgba(0,0,0,0.04);">
                <div style="font-size:10px; color:#64748B; font-weight:600; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:8px; display:flex; align-items:center; gap:5px;">
                    <span style="width:7px;height:7px;background:#16A34A;border-radius:50%;display:inline-block;"></span> Hadir
                </div>
                <div style="font-size:28px; font-weight:700; color:#16A34A; line-height:1;"><?php echo e($totalHadir); ?></div>
                <div style="font-size:11px; color:#94A3B8; margin-top:4px;">total hari</div>
            </div>

            <div style="background:white; border-radius:12px; padding:16px 18px; border:1px solid #E2E8F0; border-top:3px solid #D97706; box-shadow:0 1px 4px rgba(0,0,0,0.04);">
                <div style="font-size:10px; color:#64748B; font-weight:600; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:8px; display:flex; align-items:center; gap:5px;">
                    <span style="width:7px;height:7px;background:#D97706;border-radius:50%;display:inline-block;"></span> Terlambat
                </div>
                <div style="font-size:28px; font-weight:700; color:#D97706; line-height:1;"><?php echo e($totalTerlambat); ?></div>
                <div style="font-size:11px; color:#94A3B8; margin-top:4px;">total hari</div>
            </div>

            <div style="background:white; border-radius:12px; padding:16px 18px; border:1px solid #E2E8F0; border-top:3px solid #2563EB; box-shadow:0 1px 4px rgba(0,0,0,0.04);">
                <div style="font-size:10px; color:#64748B; font-weight:600; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:8px; display:flex; align-items:center; gap:5px;">
                    <span style="width:7px;height:7px;background:#2563EB;border-radius:50%;display:inline-block;"></span> Sakit
                </div>
                <div style="font-size:28px; font-weight:700; color:#2563EB; line-height:1;"><?php echo e($totalSakit); ?></div>
                <div style="font-size:11px; color:#94A3B8; margin-top:4px;">total hari</div>
            </div>

            <div style="background:white; border-radius:12px; padding:16px 18px; border:1px solid #E2E8F0; border-top:3px solid #7C3AED; box-shadow:0 1px 4px rgba(0,0,0,0.04);">
                <div style="font-size:10px; color:#64748B; font-weight:600; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:8px; display:flex; align-items:center; gap:5px;">
                    <span style="width:7px;height:7px;background:#7C3AED;border-radius:50%;display:inline-block;"></span> Izin
                </div>
                <div style="font-size:28px; font-weight:700; color:#7C3AED; line-height:1;"><?php echo e($totalIzin); ?></div>
                <div style="font-size:11px; color:#94A3B8; margin-top:4px;">total hari</div>
            </div>

            
            <div style="background:white; border-radius:12px; padding:16px 18px; border:1px solid #E2E8F0; border-top:3px solid #0891B2; box-shadow:0 1px 4px rgba(0,0,0,0.04);">
                <div style="font-size:10px; color:#64748B; font-weight:600; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:8px; display:flex; align-items:center; gap:5px;">
                    <span style="width:7px;height:7px;background:#0891B2;border-radius:50%;display:inline-block;"></span> Cuti
                </div>
                <div style="font-size:28px; font-weight:700; color:#0891B2; line-height:1;"><?php echo e($totalCuti); ?></div>
                <div style="font-size:11px; color:#94A3B8; margin-top:4px;">total hari</div>
            </div>

        </div>

        
        
        <div style="background:white; border-radius:14px; border:1px solid #E2E8F0; padding:20px 24px; box-shadow:0 1px 6px rgba(0,0,0,0.05);">
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; flex-wrap:wrap; gap:10px;">
                <div>
                    <div style="font-size:14px; font-weight:600; color:#0F172A;">Tren kehadiran per guru</div>
                    <div style="font-size:12px; color:#94A3B8; margin-top:2px;"><?php echo e($namaBulan[$bulan]); ?> <?php echo e($tahun); ?></div>
                </div>
                <div style="display:flex; gap:14px; flex-wrap:wrap;">
                    <?php $__currentLoopData = ['Hadir'=>'#16A34A','Terlambat'=>'#D97706','Sakit'=>'#2563EB','Izin'=>'#7C3AED','Cuti'=>'#0891B2']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lbl => $clr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="display:flex; align-items:center; gap:5px; font-size:11px; color:#64748B;">
                        <span style="width:10px;height:10px;background:<?php echo e($clr); ?>;border-radius:2px;display:inline-block;"></span> <?php echo e($lbl); ?>

                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div style="height:260px;">
                <canvas id="chartRekap"></canvas>
            </div>
        </div>

        
        <div style="background:white; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden; box-shadow:0 1px 6px rgba(0,0,0,0.05);">

            
            <div style="padding:16px 20px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; justify-content:space-between;">
                <div>
                    <div style="font-size:14px; font-weight:600; color:#0F172A;">Detail kehadiran guru</div>
                    <div style="font-size:12px; color:#94A3B8; margin-top:2px;"><?php echo e($namaBulan[$bulan]); ?> <?php echo e($tahun); ?></div>
                </div>
                <span style="font-size:12px; background:#F1F5F9; color:#64748B; padding:4px 14px; border-radius:20px; border:1px solid #E2E8F0;">
                    <?php echo e(count($rekap)); ?> guru
                </span>
            </div>

            <div style="overflow-x:auto;">
                <table style="width:100%; border-collapse:collapse; font-size:13px;">
                    <thead>
                        <tr style="background:#F8FAFC; border-bottom:1px solid #E2E8F0;">
                            <th style="text-align:left; padding:12px 18px; font-size:11px; font-weight:600; color:#64748B; letter-spacing:0.04em; white-space:nowrap;">NAMA GURU</th>
                            <th style="text-align:center; padding:12px 12px; font-size:11px; font-weight:600; color:#16A34A; letter-spacing:0.04em;">HADIR</th>
                            <th style="text-align:center; padding:12px 12px; font-size:11px; font-weight:600; color:#D97706; letter-spacing:0.04em;">TERLAMBAT</th>
                            <th style="text-align:center; padding:12px 12px; font-size:11px; font-weight:600; color:#2563EB; letter-spacing:0.04em;">SAKIT</th>
                            <th style="text-align:center; padding:12px 12px; font-size:11px; font-weight:600; color:#7C3AED; letter-spacing:0.04em;">IZIN</th>
                            
                            <th style="text-align:center; padding:12px 12px; font-size:11px; font-weight:600; color:#0891B2; letter-spacing:0.04em;">CUTI</th>
                            <th style="text-align:center; padding:12px 12px; font-size:11px; font-weight:600; color:#475569; letter-spacing:0.04em;">TOTAL</th>
                            <th style="text-align:left; padding:12px 18px; font-size:11px; font-weight:600; color:#64748B; letter-spacing:0.04em; min-width:150px;">% KEHADIRAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $rekap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr style="border-bottom:1px solid #F1F5F9;"
                            onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='white'">

                            
                            <td style="padding:13px 18px; font-weight:500; color:#1E293B;">
                                <div style="display:flex; align-items:center; gap:10px;">
                                    <div style="width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,#DBEAFE,#BFDBFE); display:flex; align-items:center; justify-content:center; font-size:13px; font-weight:700; color:#1D4ED8; flex-shrink:0;">
                                        <?php echo e(strtoupper(substr($r['nama'], 0, 1))); ?>

                                    </div>
                                    <?php echo e($r['nama']); ?>

                                </div>
                            </td>

                            
                            <td style="padding:13px 12px; text-align:center;">
                                <span style="background:#F0FDF4; color:#166534; font-size:12px; font-weight:600; padding:3px 12px; border-radius:20px;"><?php echo e($r['hadir']); ?></span>
                            </td>

                            
                            <td style="padding:13px 12px; text-align:center;">
                                <span style="background:#FFFBEB; color:#92400E; font-size:12px; font-weight:600; padding:3px 12px; border-radius:20px;"><?php echo e($r['terlambat']); ?></span>
                            </td>

                            
                            <td style="padding:13px 12px; text-align:center;">
                                <span style="background:#EFF6FF; color:#1E40AF; font-size:12px; font-weight:600; padding:3px 12px; border-radius:20px;"><?php echo e($r['sakit']); ?></span>
                            </td>

                            
                            <td style="padding:13px 12px; text-align:center;">
                                <span style="background:#F5F3FF; color:#5B21B6; font-size:12px; font-weight:600; padding:3px 12px; border-radius:20px;"><?php echo e($r['izin']); ?></span>
                            </td>

                            
                            <td style="padding:13px 12px; text-align:center;">
                                <span style="background:#ECFEFF; color:#0E7490; font-size:12px; font-weight:600; padding:3px 12px; border-radius:20px;"><?php echo e($r['cuti']); ?></span>
                            </td>

                            
                            <td style="padding:13px 12px; text-align:center; color:#475569; font-weight:600; font-size:13px;">
                                <?php echo e($r['total']); ?>

                            </td>

                            
                            
                            <td style="padding:13px 18px;">
                                <?php
                                    $warna = $r['persen'] >= 80 ? '#16A34A' : ($r['persen'] >= 60 ? '#D97706' : '#DC2626');
                                    $label = $r['persen'] >= 80 ? 'Baik' : ($r['persen'] >= 60 ? 'Cukup' : 'Kurang');
                                ?>
                                <div style="display:flex; align-items:center; gap:8px;">
                                    <div style="flex:1; height:6px; background:#F1F5F9; border-radius:4px; overflow:hidden; min-width:80px;">
                                        <div style="height:100%; width:<?php echo e($r['persen']); ?>%; background:<?php echo e($warna); ?>; border-radius:4px; transition:width 0.5s;"></div>
                                    </div>
                                    <span style="font-size:12px; font-weight:700; color:<?php echo e($warna); ?>; min-width:36px; text-align:right;"><?php echo e($r['persen']); ?>%</span>
                                    <span style="font-size:10px; color:<?php echo e($warna); ?>; background:<?php echo e($r['persen'] >= 80 ? '#F0FDF4' : ($r['persen'] >= 60 ? '#FFFBEB' : '#FEF2F2')); ?>; padding:2px 7px; border-radius:10px; font-weight:600;"><?php echo e($label); ?></span>
                                </div>
                            </td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" style="text-align:center; padding:56px 20px;">
                                <div style="font-size:36px; margin-bottom:12px;">📋</div>
                                <div style="font-size:14px; font-weight:600; color:#0F172A; margin-bottom:6px;">Belum ada data presensi</div>
                                <div style="font-size:13px; color:#64748B;">Data untuk <?php echo e($namaBulan[$bulan]); ?> <?php echo e($tahun); ?> belum tersedia</div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <?php if(count($rekap) > 0): ?>
            <div style="padding:12px 18px; border-top:1px solid #F1F5F9; background:#FAFBFC; display:flex; gap:20px; flex-wrap:wrap;">
                <span style="font-size:12px; color:#94A3B8;">Total hadir: <strong style="color:#16A34A;"><?php echo e($totalHadir); ?></strong></span>
                <span style="font-size:12px; color:#94A3B8;">Terlambat: <strong style="color:#D97706;"><?php echo e($totalTerlambat); ?></strong></span>
                <span style="font-size:12px; color:#94A3B8;">Sakit: <strong style="color:#2563EB;"><?php echo e($totalSakit); ?></strong></span>
                <span style="font-size:12px; color:#94A3B8;">Izin: <strong style="color:#7C3AED;"><?php echo e($totalIzin); ?></strong></span>
                <span style="font-size:12px; color:#94A3B8;">Cuti: <strong style="color:#0891B2;"><?php echo e($totalCuti); ?></strong></span>
            </div>
            <?php endif; ?>
        </div>

    </div>
</main>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartRekap').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($namaGuru, 15, 512) ?>,
        datasets: [
            { label:'Hadir',     data:<?php echo json_encode($dataHadir, 15, 512) ?>,     backgroundColor:'#16A34A', borderRadius:4, borderSkipped:false },
            { label:'Terlambat', data:<?php echo json_encode($dataTerlambat, 15, 512) ?>, backgroundColor:'#D97706', borderRadius:4, borderSkipped:false },
            { label:'Sakit',     data:<?php echo json_encode($dataSakit, 15, 512) ?>,     backgroundColor:'#2563EB', borderRadius:4, borderSkipped:false },
            { label:'Izin',      data:<?php echo json_encode($dataIzin, 15, 512) ?>,      backgroundColor:'#7C3AED', borderRadius:4, borderSkipped:false },
            { label:'Cuti',      data:<?php echo json_encode($dataCuti, 15, 512) ?>,      backgroundColor:'#0891B2', borderRadius:4, borderSkipped:false },
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: '#0F172A',
                padding: 10,
                cornerRadius: 8,
                titleFont: { size: 12 },
                bodyFont:  { size: 12 },
            }
        },
        scales: {
            x: { grid: { display:false }, ticks: { color:'#64748B', font:{ size:12 } } },
            y: { beginAtZero:true, grid: { color:'#F1F5F9' }, ticks: { color:'#64748B', font:{ size:12 }, stepSize:1 } }
        }
    }
});
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
<?php endif; ?><?php /**PATH D:\presensi-app\resources\views/admin/rekap/index.blade.php ENDPATH**/ ?>