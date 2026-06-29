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
            ['label' => 'Beranda',        'url' => route('superadmin.dashboard'), 'route' => 'superadmin.dashboard', 'icon' => 'ti-layout-dashboard'],
            ['label' => 'Kelola Akun',    'url' => '/superadmin/users',           'route' => null,                   'icon' => 'ti-users'],
            ['label' => 'Data Sekolah',   'url' => '/admin/schools',              'route' => null,                   'icon' => 'ti-building'],
            ['label' => 'Tambah Sekolah', 'url' => '/admin/schools/create',       'route' => null,                   'icon' => 'ti-building-community'],
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
        <a href="/admin/schools" style="color:#94A3B8; text-decoration:none;" onmouseover="this.style.color='#1E40AF'" onmouseout="this.style.color='#94A3B8'">Data Sekolah</a>
        <span>›</span>
        <span style="color:#1E293B; font-weight:500;">Edit Sekolah</span>
    </nav>

    
    <?php if(session('success')): ?>
    <div style="display:flex; align-items:center; gap:10px; background:#F0FDF4; border:1px solid #BBF7D0; color:#166534; padding:12px 16px; border-radius:10px; font-size:13px; margin-bottom:20px;">
        <i class="ti ti-circle-check" style="font-size:17px;"></i>
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
    <div style="display:flex; align-items:flex-start; gap:10px; background:#FFF7F7; border:1px solid #FECACA; border-left:4px solid #EF4444; border-radius:10px; padding:12px 16px; margin-bottom:20px;">
        <span style="font-size:18px; margin-top:1px;">⚠️</span>
        <div>
            <div style="font-size:13px; font-weight:600; color:#B91C1C; margin-bottom:4px;">Ada <?php echo e($errors->count()); ?> kesalahan:</div>
            <ul style="margin:0; padding-left:16px; font-size:12px; color:#991B1B;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>

    
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px;">
        <div>
            <h1 style="font-size:20px; font-weight:600; color:#1E293B; margin:0;">Edit Sekolah</h1>
            <p style="font-size:13px; color:#64748B; margin:4px 0 0;"><?php echo e($school->nama_sekolah); ?></p>
        </div>
    </div>

    <form method="POST" action="/admin/schools/<?php echo e($school->id); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <div style="background:white; border:1px solid #E2E8F0; border-radius:12px; overflow:hidden; margin-bottom:16px;">
            <div style="padding:14px 20px; border-bottom:1px solid #F1F5F9; background:#F8FAFC;">
                <div style="font-size:13px; font-weight:600; color:#1E293B;">Identitas Sekolah</div>
                <div style="font-size:12px; color:#94A3B8; margin-top:2px;">Informasi dasar yang ditampilkan di dashboard admin</div>
            </div>
            <div style="padding:20px; display:grid; grid-template-columns:1fr 1fr; gap:16px;">

                
                <div style="grid-column:span 2;">
                    <label style="display:block; font-size:12px; font-weight:500; color:#374151; margin-bottom:6px;">Nama Sekolah <span style="color:#EF4444;">*</span></label>
                    <input type="text" name="nama_sekolah" value="<?php echo e($school->nama_sekolah); ?>" required
                        style="width:100%; padding:9px 12px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; outline:none; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#3B82F6'" onblur="this.style.borderColor='#D1D5DB'">
                </div>

                
                <div>
                    <label style="display:block; font-size:12px; font-weight:500; color:#374151; margin-bottom:6px;">NPSN</label>
                    <input type="text" name="npsn" value="<?php echo e($school->npsn); ?>"
                        placeholder="Contoh: 20307355"
                        style="width:100%; padding:9px 12px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; outline:none; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#3B82F6'" onblur="this.style.borderColor='#D1D5DB'">
                </div>

                
                <div>
                    <label style="display:block; font-size:12px; font-weight:500; color:#374151; margin-bottom:6px;">Akreditasi</label>
                    <select name="akreditasi"
                        style="width:100%; padding:9px 12px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; outline:none; background:white; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#3B82F6'" onblur="this.style.borderColor='#D1D5DB'">
                        <option value="">— Pilih Akreditasi —</option>
                        <?php $__currentLoopData = ['A','B','C','Belum Terakreditasi']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $akr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($akr); ?>" <?php echo e($school->akreditasi == $akr ? 'selected' : ''); ?>><?php echo e($akr); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div>
                    <label style="display:block; font-size:12px; font-weight:500; color:#374151; margin-bottom:6px;">Nama Kepala Sekolah</label>
                    <input type="text" name="kepala_sekolah" value="<?php echo e($school->kepala_sekolah); ?>"
                        placeholder="Contoh: Budi Santoso, S.Pd."
                        style="width:100%; padding:9px 12px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; outline:none; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#3B82F6'" onblur="this.style.borderColor='#D1D5DB'">
                </div>

                
                <div>
                    <label style="display:block; font-size:12px; font-weight:500; color:#374151; margin-bottom:6px;">Nomor Telepon</label>
                    <input type="text" name="no_telepon" value="<?php echo e($school->no_telepon); ?>"
                        placeholder="Contoh: 0271-123456"
                        style="width:100%; padding:9px 12px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; outline:none; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#3B82F6'" onblur="this.style.borderColor='#D1D5DB'">
                </div>

                
                <div>
                    <label style="display:block; font-size:12px; font-weight:500; color:#374151; margin-bottom:6px;">Kota</label>
                    <input type="text" name="kota" value="<?php echo e($school->kota); ?>"
                        placeholder="Contoh: Sragen"
                        style="width:100%; padding:9px 12px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; outline:none; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#3B82F6'" onblur="this.style.borderColor='#D1D5DB'">
                </div>

                
                <div style="grid-column:span 2;">
                    <label style="display:block; font-size:12px; font-weight:500; color:#374151; margin-bottom:6px;">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3"
                        placeholder="Jl. Contoh No. 1, Desa, Kecamatan, Kabupaten"
                        style="width:100%; padding:9px 12px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; outline:none; box-sizing:border-box; resize:vertical;"
                        onfocus="this.style.borderColor='#3B82F6'" onblur="this.style.borderColor='#D1D5DB'"><?php echo e($school->alamat); ?></textarea>
                </div>

                
                <div style="grid-column:span 2;">
                    <label style="display:block; font-size:12px; font-weight:500; color:#374151; margin-bottom:6px;">Deskripsi Sekolah</label>
                    <textarea name="deskripsi" rows="2"
                        placeholder="Deskripsi singkat tentang sekolah..."
                        style="width:100%; padding:9px 12px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; outline:none; box-sizing:border-box; resize:vertical;"
                        onfocus="this.style.borderColor='#3B82F6'" onblur="this.style.borderColor='#D1D5DB'"><?php echo e($school->deskripsi); ?></textarea>
                </div>

                
                <div style="grid-column:span 2;">
                    <label style="display:block; font-size:12px; font-weight:500; color:#374151; margin-bottom:6px;">
                        Logo Sekolah
                        <span style="font-size:11px; font-weight:400; color:#94A3B8; margin-left:4px;">JPG/PNG/SVG, maks. 1 MB</span>
                    </label>
                    <div style="display:flex; align-items:center; gap:16px; padding:14px 16px; background:#F8FAFC; border:1.5px dashed #CBD5E1; border-radius:10px;">

                        
                        <div style="width:72px; height:72px; border-radius:10px; border:2px solid #E2E8F0; background:#fff; display:flex; align-items:center; justify-content:center; overflow:hidden; flex-shrink:0;">
                            <?php if($school->logo): ?>
                                <img id="logoPreviewImg"
                                     src="<?php echo e(asset('storage/'.$school->logo)); ?>"
                                     alt="Logo <?php echo e($school->nama_sekolah); ?>"
                                     style="width:100%; height:100%; object-fit:contain;">
                                <i class="ti ti-photo" id="logoIcon" style="font-size:26px; color:#CBD5E1; display:none;"></i>
                            <?php else: ?>
                                <i class="ti ti-photo" id="logoIcon" style="font-size:26px; color:#CBD5E1;"></i>
                                <img id="logoPreviewImg" src="" alt="Preview Logo" style="display:none; width:100%; height:100%; object-fit:contain;">
                            <?php endif; ?>
                        </div>

                        <div style="flex:1;">
                            <label for="logoInput"
                                style="display:inline-flex; align-items:center; gap:6px; background:#2563EB; color:white; padding:8px 16px; border-radius:8px; font-size:12px; font-weight:600; cursor:pointer;"
                                onmouseover="this.style.background='#1D4ED8'" onmouseout="this.style.background='#2563EB'">
                                <i class="ti ti-upload" style="font-size:14px;"></i>
                                <?php echo e($school->logo ? 'Ganti Logo' : 'Pilih File Logo'); ?>

                            </label>
                            <input type="file" id="logoInput" name="logo" accept="image/*" style="display:none;" onchange="previewLogo(this)">
                            <div id="logoFileName" style="font-size:11px; color:#94A3B8; margin-top:6px;">
                                <?php echo e($school->logo ? 'Logo sudah ada — pilih file baru untuk mengganti' : 'Belum ada file dipilih'); ?>

                            </div>
                        </div>
                    </div>
                    <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p style="margin:5px 0 0; font-size:11px; color:#EF4444;">⚠ <?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

            </div>
        </div>

        
        <div style="background:white; border:1px solid #E2E8F0; border-radius:12px; overflow:hidden; margin-bottom:16px;">
            <div style="padding:14px 20px; border-bottom:1px solid #F1F5F9; background:#F8FAFC;">
                <div style="font-size:13px; font-weight:600; color:#1E293B;">Lokasi & Radius Absensi</div>
                <div style="font-size:12px; color:#94A3B8; margin-top:2px;">Digunakan untuk validasi lokasi absensi guru</div>
            </div>
            <div style="padding:20px; display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px;">

                <div>
                    <label style="display:block; font-size:12px; font-weight:500; color:#374151; margin-bottom:6px;">Latitude <span style="color:#EF4444;">*</span></label>
                    <input type="text" name="latitude" value="<?php echo e($school->latitude); ?>" required
                        placeholder="-7.496384"
                        style="width:100%; padding:9px 12px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; outline:none; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#3B82F6'" onblur="this.style.borderColor='#D1D5DB'">
                </div>

                <div>
                    <label style="display:block; font-size:12px; font-weight:500; color:#374151; margin-bottom:6px;">Longitude <span style="color:#EF4444;">*</span></label>
                    <input type="text" name="longitude" value="<?php echo e($school->longitude); ?>" required
                        placeholder="110.996380"
                        style="width:100%; padding:9px 12px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; outline:none; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#3B82F6'" onblur="this.style.borderColor='#D1D5DB'">
                </div>

                <div>
                    <label style="display:block; font-size:12px; font-weight:500; color:#374151; margin-bottom:6px;">Radius (meter) <span style="color:#EF4444;">*</span></label>
                    <input type="number" name="radius" value="<?php echo e($school->radius); ?>" required
                        placeholder="200"
                        style="width:100%; padding:9px 12px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; outline:none; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#3B82F6'" onblur="this.style.borderColor='#D1D5DB'">
                </div>

            </div>
        </div>

        
        <div style="display:flex; gap:10px; justify-content:flex-end;">
            <a href="<?php echo e(route('superadmin.schools')); ?>"
               style="padding:10px 20px; border-radius:8px; border:1px solid #D1D5DB; background:white; font-size:13px; color:#374151; text-decoration:none;"
               onmouseover="this.style.background='#F9FAFB'" onmouseout="this.style.background='white'">
                Batal
            </a>
            <button type="submit"
                style="padding:10px 24px; border-radius:8px; border:none; background:#2563EB; color:white; font-size:13px; font-weight:500; cursor:pointer;"
                onmouseover="this.style.background='#1D4ED8'" onmouseout="this.style.background='#2563EB'">
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>
</div>

<script>
function previewLogo(input) {
    const img   = document.getElementById('logoPreviewImg');
    const icon  = document.getElementById('logoIcon');
    const label = document.getElementById('logoFileName');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            img.style.display = 'block';
            icon.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
        label.textContent = input.files[0].name;
        label.style.color = '#374151';
    }
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
<?php endif; ?><?php /**PATH D:\presensi-app\resources\views/admin/edit-school.blade.php ENDPATH**/ ?>