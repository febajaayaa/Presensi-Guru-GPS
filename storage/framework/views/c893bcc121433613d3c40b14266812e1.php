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

        
        <div style="margin-bottom:20px;">
             <h1 style="font-size:24px; font-weight:700; color:#0F172A; margin:0;">Pengaturan Akun</h1>
            <p class="text-xs text-gray-500 mt-0.5">Kelola profil, informasi sekolah, dan keamanan akun Anda.</p>
        </div>

        
        <?php if(session('success')): ?>
        <div style="background:#F0FDF4; border:1px solid #BBF7D0; border-left:4px solid #22C55E; border-radius:10px; padding:12px 16px; margin-bottom:16px; display:flex; gap:10px; align-items:center;">
            <i class="ti ti-circle-check" style="font-size:18px; color:#16A34A; flex-shrink:0;"></i>
            <div style="font-size:13px; font-weight:500; color:#166534;"><?php echo e(session('success')); ?></div>
        </div>
        <?php endif; ?>

        
        <?php if($errors->any()): ?>
        <div style="background:#FEF2F2; border:1px solid #FECACA; border-left:4px solid #EF4444; border-radius:10px; padding:12px 16px; margin-bottom:16px; display:flex; gap:10px; align-items:flex-start;">
            <i class="ti ti-alert-triangle" style="font-size:18px; color:#DC2626; flex-shrink:0; margin-top:1px;"></i>
            <div>
                <div style="font-size:13px; font-weight:600; color:#991B1B; margin-bottom:4px;">Terdapat kesalahan:</div>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="font-size:12px; color:#B91C1C; margin-top:2px;">• <?php echo e($error); ?></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>

        
        <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; overflow:hidden; margin-bottom:14px; box-shadow:0 1px 4px rgba(0,0,0,0.05);">

            <div style="padding:14px 20px; border-bottom:1px solid #F1F5F9; background:#FAFBFC; display:flex; align-items:center; gap:10px;">
                <div style="width:32px; height:32px; background:#EFF6FF; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="ti ti-user" style="font-size:16px; color:#2563EB;"></i>
                </div>
                <div>
                    <div style="font-size:14px; font-weight:600; color:#0F172A;">Profil Pengguna</div>
                    <div style="font-size:12px; color:#94A3B8;">Perbarui nama dan foto profil Anda</div>
                </div>
            </div>

            <form method="POST" action="<?php echo e(route('pengaturan.update')); ?>" enctype="multipart/form-data" style="padding:20px;">
                <?php echo csrf_field(); ?>

                
                <div style="display:flex; align-items:center; gap:16px; margin-bottom:18px; padding:14px 16px; background:#F8FAFC; border-radius:10px; border:1px solid #F1F5F9;">
                    <div style="position:relative; flex-shrink:0;">
                        <img src="<?php echo e(Auth::user()->photo ? asset('storage/'.Auth::user()->photo) : 'https://i.pravatar.cc/80'); ?>"
                             id="avatarPreview"
                             style="width:60px; height:60px; border-radius:50%; object-fit:cover; border:3px solid #E2E8F0;">
                        <label for="photoInput" style="position:absolute; bottom:0; right:0; width:20px; height:20px; background:#1D4ED8; border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; border:2px solid white;" title="Ganti foto">
                            <i class="ti ti-pencil" style="font-size:11px; color:white;"></i>
                        </label>
                        <input type="file" id="photoInput" name="photo" accept="image/*" style="display:none;" onchange="previewPhoto(this)">
                    </div>
                    <div>
                        <div style="font-size:14px; font-weight:600; color:#0F172A;"><?php echo e(Auth::user()->name); ?></div>
                        <div style="font-size:12px; color:#64748B; margin-top:2px;"><?php echo e(Auth::user()->email); ?></div>
                        <div style="font-size:11px; color:#94A3B8; margin-top:3px;">Klik ikon pensil untuk mengganti foto profil</div>
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:16px;">

                    
                    <div>
                        <label style="display:block; font-size:11px; font-weight:600; color:#374151; margin-bottom:5px; letter-spacing:0.04em; text-transform:uppercase;">Nama Lengkap</label>
                        <div style="position:relative;">
                            <i class="ti ti-user" style="position:absolute; left:11px; top:50%; transform:translateY(-50%); font-size:15px; color:#94A3B8;"></i>
                            <input type="text" name="name" value="<?php echo e(Auth::user()->name); ?>"
                                   style="width:100%; border:1.5px solid #E2E8F0; border-radius:8px; padding:9px 12px 9px 34px; font-size:13px; color:#1E293B; outline:none; box-sizing:border-box;"
                                   onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                   onblur="this.style.borderColor='#E2E8F0';this.style.boxShadow='none'">
                        </div>
                    </div>

                    
                    <div>
                        <label style="display:block; font-size:11px; font-weight:600; color:#374151; margin-bottom:5px; letter-spacing:0.04em; text-transform:uppercase;">
                            Email <span style="font-size:10px; color:#94A3B8; font-weight:400; text-transform:none;">(tidak dapat diubah)</span>
                        </label>
                        <div style="position:relative;">
                            <i class="ti ti-mail" style="position:absolute; left:11px; top:50%; transform:translateY(-50%); font-size:15px; color:#CBD5E1;"></i>
                            <input type="hidden" name="email" value="<?php echo e(Auth::user()->email); ?>">
                            <input type="email" value="<?php echo e(Auth::user()->email); ?>" disabled
                                   style="width:100%; border:1.5px solid #F1F5F9; border-radius:8px; padding:9px 12px 9px 34px; font-size:13px; color:#94A3B8; background:#F8FAFC; cursor:not-allowed; box-sizing:border-box;">
                        </div>
                    </div>
                </div>

                <div style="display:flex; justify-content:flex-end;">
                    <button type="submit"
                            style="background:#1D4ED8; color:white; border:none; border-radius:8px; padding:9px 22px; font-size:13px; font-weight:600; cursor:pointer; display:flex; align-items:center; gap:7px;"
                            onmouseover="this.style.background='#1E40AF'" onmouseout="this.style.background='#1D4ED8'">
                        <i class="ti ti-device-floppy" style="font-size:15px;"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        
        <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; overflow:hidden; margin-bottom:14px; box-shadow:0 1px 4px rgba(0,0,0,0.05);">

            <div style="padding:14px 20px; border-bottom:1px solid #F1F5F9; background:#FAFBFC; display:flex; align-items:center; gap:10px;">
                <div style="width:32px; height:32px; background:#F0FDF4; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="ti ti-building" style="font-size:16px; color:#16A34A;"></i>
                </div>
                <div>
                    <div style="font-size:14px; font-weight:600; color:#0F172A;">Informasi Sekolah</div>
                    <div style="font-size:12px; color:#94A3B8;">Data sekolah yang terhubung dengan akun ini</div>
                </div>
            </div>

            <div style="padding:16px 20px; display:grid; grid-template-columns:repeat(3,1fr); gap:12px;">
                <div style="background:#F8FAFC; border-radius:10px; padding:12px 14px; border:1px solid #F1F5F9;">
                    <div style="font-size:10px; color:#94A3B8; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:5px;">Nama Sekolah</div>
                    <div style="font-size:14px; font-weight:600; color:#0F172A;"><?php echo e($school->nama_sekolah ?? '-'); ?></div>
                </div>
                <div style="background:#F8FAFC; border-radius:10px; padding:12px 14px; border:1px solid #F1F5F9;">
                    <div style="font-size:10px; color:#94A3B8; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:5px;">Radius Presensi</div>
                    <div style="font-size:14px; font-weight:600; color:#0F172A;">
                        <?php echo e($school->radius ?? '-'); ?>

                        <?php if($school?->radius): ?><span style="font-size:12px; color:#64748B; font-weight:400;"> meter</span><?php endif; ?>
                    </div>
                </div>
                <div style="background:#F8FAFC; border-radius:10px; padding:12px 14px; border:1px solid #F1F5F9;">
                    <div style="font-size:10px; color:#94A3B8; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:5px;">Koordinat</div>
                    <div style="font-size:13px; font-weight:600; color:#0F172A; font-family:monospace;">
                        <?php echo e($school->latitude ?? '-'); ?>,<br><?php echo e($school->longitude ?? '-'); ?>

                    </div>
                </div>
            </div>
        </div>

        
        <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; overflow:hidden; box-shadow:0 1px 4px rgba(0,0,0,0.05);">

            <div style="padding:14px 20px; border-bottom:1px solid #F1F5F9; background:#FAFBFC; display:flex; align-items:center; gap:10px;">
                <div style="width:32px; height:32px; background:#FEF2F2; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="ti ti-lock" style="font-size:16px; color:#DC2626;"></i>
                </div>
                <div>
                    <div style="font-size:14px; font-weight:600; color:#0F172A;">Keamanan Akun</div>
                    <div style="font-size:12px; color:#94A3B8;">Perbarui password untuk menjaga keamanan akun</div>
                </div>
            </div>

            <form method="POST" action="<?php echo e(route('pengaturan.update')); ?>" style="padding:20px;">
                <?php echo csrf_field(); ?>

                <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:14px; align-items:end; margin-bottom:14px;">

                    
                    <div>
                        <label style="display:block; font-size:11px; font-weight:600; color:#374151; margin-bottom:5px; letter-spacing:0.04em; text-transform:uppercase;">Password Saat Ini</label>
                        <div style="position:relative;">
                            <i class="ti ti-lock" style="position:absolute; left:11px; top:50%; transform:translateY(-50%); font-size:15px; color:#94A3B8;"></i>
                            <input type="password" name="current_password" id="cur_pass" placeholder="••••••••"
                                   style="width:100%; border:1.5px solid #E2E8F0; border-radius:8px; padding:9px 34px 9px 34px; font-size:13px; color:#1E293B; outline:none; box-sizing:border-box;"
                                   onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                   onblur="this.style.borderColor='#E2E8F0';this.style.boxShadow='none'">
                            <button type="button" onclick="togglePass('cur_pass','eye_cur')" style="position:absolute; right:10px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#94A3B8;">
                                <i class="ti ti-eye" id="eye_cur" style="font-size:15px;"></i>
                            </button>
                        </div>
                    </div>

                    
                    <div>
                        <label style="display:block; font-size:11px; font-weight:600; color:#374151; margin-bottom:5px; letter-spacing:0.04em; text-transform:uppercase;">Password Baru</label>
                        <div style="position:relative;">
                            <i class="ti ti-key" style="position:absolute; left:11px; top:50%; transform:translateY(-50%); font-size:15px; color:#94A3B8;"></i>
                            <input type="password" name="password" id="new_pass" placeholder="Min. 8 karakter"
                                   style="width:100%; border:1.5px solid #E2E8F0; border-radius:8px; padding:9px 34px 9px 34px; font-size:13px; color:#1E293B; outline:none; box-sizing:border-box;"
                                   onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                   onblur="this.style.borderColor='#E2E8F0';this.style.boxShadow='none'"
                                   oninput="checkStrength(this.value)">
                            <button type="button" onclick="togglePass('new_pass','eye_new')" style="position:absolute; right:10px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#94A3B8;">
                                <i class="ti ti-eye" id="eye_new" style="font-size:15px;"></i>
                            </button>
                        </div>
                        <div style="margin-top:5px;">
                            <div style="height:3px; background:#F1F5F9; border-radius:4px; overflow:hidden;">
                                <div id="sBar" style="height:100%; width:0; border-radius:4px; transition:all 0.3s;"></div>
                            </div>
                            <div id="sText" style="font-size:10px; color:#94A3B8; margin-top:2px;"></div>
                        </div>
                    </div>

                    
                    <div>
                        <button type="submit"
                                style="width:100%; background:#DC2626; color:white; border:none; border-radius:8px; padding:9px 16px; font-size:13px; font-weight:600; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:7px;"
                                onmouseover="this.style.background='#B91C1C'" onmouseout="this.style.background='#DC2626'">
                            <i class="ti ti-shield-lock" style="font-size:15px;"></i> Update Password
                        </button>
                    </div>
                </div>

                
                <div style="background:#FFFBEB; border:1px solid #FDE68A; border-radius:8px; padding:10px 14px; display:flex; gap:8px; align-items:flex-start;">
                    <i class="ti ti-bulb" style="font-size:16px; color:#D97706; flex-shrink:0; margin-top:1px;"></i>
                    <div style="font-size:12px; color:#92400E; line-height:1.6;">
                        Gunakan password yang kuat: minimal <strong>8 karakter</strong>, kombinasi huruf besar, angka, dan simbol.
                    </div>
                </div>
            </form>
        </div>

    </div>
</main>
</div>

<script>
function togglePass(id, eyeId) {
    const f = document.getElementById(id);
    const e = document.getElementById(eyeId);
    const isHidden = f.type === 'password';
    f.type = isHidden ? 'text' : 'password';
    e.className = isHidden ? 'ti ti-eye-off' : 'ti ti-eye';
    e.style.fontSize = '15px';
}

function checkStrength(val) {
    const bar = document.getElementById('sBar');
    const txt = document.getElementById('sText');
    let s = 0;
    if (val.length >= 8)          s++;
    if (/[A-Z]/.test(val))        s++;
    if (/[0-9]/.test(val))        s++;
    if (/[^A-Za-z0-9]/.test(val)) s++;
    const lvl = [
        {w:'0',    c:'transparent', t:''},
        {w:'25%',  c:'#DC2626',     t:'Sangat lemah'},
        {w:'50%',  c:'#D97706',     t:'Lemah'},
        {w:'75%',  c:'#2563EB',     t:'Cukup kuat'},
        {w:'100%', c:'#16A34A',     t:'Kuat'},
    ];
    bar.style.width      = lvl[s].w;
    bar.style.background = lvl[s].c;
    txt.textContent      = lvl[s].t;
    txt.style.color      = lvl[s].c;
}

function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { document.getElementById('avatarPreview').src = e.target.result; };
        reader.readAsDataURL(input.files[0]);
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
<?php endif; ?><?php /**PATH D:\presensi-app\resources\views/pengaturan.blade.php ENDPATH**/ ?>