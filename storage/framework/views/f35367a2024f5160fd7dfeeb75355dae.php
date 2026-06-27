<!DOCTYPE html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin'); ?> — Presensi App</title>

    
    <script src="https://cdn.tailwindcss.com"></script>

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

    
    <?php echo $__env->yieldPushContent('styles'); ?>

    <style>
        
        .sidebar-bg {
            background: linear-gradient(180deg, #1a2e6b 0%, #1e3a8a 30%, #1d4ed8 70%, #2563eb 100%);
        }
        .nav-active {
            background: rgba(255,255,255,0.15);
            border-radius: 10px;
        }
        .nav-item:hover {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .online-dot { animation: pulse-dot 2s infinite; }
    </style>
</head>
<body class="bg-gray-100 font-sans">

 

<aside style="width:240px; background:linear-gradient(160deg,#0F172A 0%,#1E3A5F 60%,#1D4ED8 100%); color:white; position:fixed; top:0; left:0; height:100vh; display:flex; flex-direction:column; box-shadow:4px 0 24px rgba(0,0,0,0.18); z-index:50;">
 
    
    <div style="padding:22px 20px 16px; border-bottom:1px solid rgba(255, 40, 40, 0.08);">
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
            
    <!-- MAIN CONTENT -->
    <main style="flex:1; margin-left:240px; display:flex; flex-direction:column; min-height:100vh;">

    
    <div style="background:white; border-bottom:1px solid #E2E8F0; padding:13px 28px; display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:40; box-shadow:0 1px 3px rgba(0,0,0,0.04);">
        <div style="display:flex; align-items:center; gap:10px;">
            <a href="<?php echo e(route('admin.dashboard')); ?>" style="color:#94A3B8; text-decoration:none; font-size:13px;" onmouseover="this.style.color='#1D4ED8'" onmouseout="this.style.color='#94A3B8'">⊞ Dashboard</a>
            <span style="color:#CBD5E1; font-size:12px;">›</span>
            <span style="font-size:13px; color:#1E293B; font-weight:450;">Approval Cuti & Izin</span>
        </div>
        <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:7px 14px; border-radius:8px; font-size:12px; color:#475569;">
            📅 <?php echo e(\Carbon\Carbon::now()->translatedFormat('l, d F Y')); ?>

        </div>
    </div>  

        <?php echo $__env->yieldContent('content'); ?>

    </main>

    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html><?php /**PATH D:\presensi-app\resources\views/layouts/admin.blade.php ENDPATH**/ ?>