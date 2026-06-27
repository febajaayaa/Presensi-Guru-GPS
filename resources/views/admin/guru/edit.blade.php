<x-app-layout>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

<div style="display:flex; min-height:100vh; background:#F0F4F8; font-family:'Inter',sans-serif;">

    {{-- ═══════════════════════════════════════════
         SIDEBAR
    ═══════════════════════════════════════════ --}}
    <aside style="width:240px; background:linear-gradient(160deg,#0F172A 0%,#1E3A5F 60%,#1D4ED8 100%); color:white; position:fixed; top:0; left:0; height:100vh; display:flex; flex-direction:column; box-shadow:4px 0 24px rgba(0,0,0,0.18); z-index:50;">

        {{-- Brand --}}
        <div style="padding:22px 20px 16px; border-bottom:1px solid rgba(255,255,255,0.08);">
            <div style="display:flex; align-items:center; gap:10px;">
                <div style="width:36px; height:36px; background:#2563EB; border-radius:9px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="ti ti-school" style="font-size:18px; color:#fff;"></i>
                </div>
                <div>
                    <div style="font-size:12px; font-weight:700; color:#93C5FD; letter-spacing:0.06em;">PRESENSI APP</div>
                    <div style="font-size:10px; color:#475569; margin-top:2px;">Management System</div>
                </div>
            </div>
        </div>

        {{-- Profil --}}
        <a href="{{ route('admin.pengaturan') }}"
           style="display:flex; align-items:center; gap:11px; margin:14px 12px 4px; padding:11px 12px; border-radius:10px; background:rgba(255,255,255,0.07); text-decoration:none; transition:background .15s;"
           onmouseover="this.style.background='rgba(255,255,255,0.13)'"
           onmouseout="this.style.background='rgba(255,255,255,0.07)'">
            <img src="{{ Auth::user()->photo ? asset('storage/'.Auth::user()->photo) : 'https://i.pravatar.cc/50' }}"
                 alt="Foto {{ Auth::user()->name }}"
                 style="width:40px; height:40px; border-radius:50%; object-fit:cover; border:2px solid #3B82F6; flex-shrink:0;">
            <div style="overflow:hidden; flex:1;">
                <div style="font-size:13px; font-weight:600; color:#F1F5F9; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                    {{ Auth::user()->name }}
                </div>
                <div style="font-size:11px; color:#60A5FA; display:flex; align-items:center; gap:5px; margin-top:3px;">
                    <span style="width:6px; height:6px; background:#22C55E; border-radius:50%; display:inline-block; flex-shrink:0;"></span>
                    {{ auth()->user()->role == 'super_admin' ? 'Super Admin' : 'Admin Sekolah' }}
                </div>
            </div>
        </a>

        {{-- Nav --}}
        <nav style="flex:1; padding:4px 12px 8px; overflow-y:auto;">
            <div style="font-size:9px; color:#475569; letter-spacing:0.12em; text-transform:uppercase; padding:14px 8px 6px;">Menu Utama</div>

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
                   style="display:flex; align-items:center; gap:10px; padding:9px 10px; border-radius:8px; font-size:13px; text-decoration:none; margin-bottom:2px;
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
        <div style="padding:14px 12px;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        style="width:100%; background:rgba(239,68,68,0.12); color:#FCA5A5; border:1px solid rgba(239,68,68,0.22); padding:10px; border-radius:8px; font-size:13px; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:7px;"
                        onmouseover="this.style.background='rgba(239,68,68,0.26)'"
                        onmouseout="this.style.background='rgba(239,68,68,0.12)'">
                    <i class="ti ti-logout" style="font-size:16px;"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- ═══════════════════════════════════════════
         MAIN CONTENT
    ═══════════════════════════════════════════ --}}
    <main style="margin-left:240px; flex:1; padding:32px 36px; min-height:100vh; max-width:900px;">

        {{-- Breadcrumb --}}
        <nav style="display:flex; align-items:center; gap:6px; font-size:12px; color:#64748B; margin-bottom:24px;">
            <a href="{{ route('admin.dashboard') }}" style="color:#3B82F6; text-decoration:none; font-weight:500;">Beranda</a>
            <i class="ti ti-chevron-right" style="font-size:12px; color:#CBD5E1;"></i>
            <a href="{{ route('guru.index') }}" style="color:#3B82F6; text-decoration:none; font-weight:500;">Data Guru</a>
            <i class="ti ti-chevron-right" style="font-size:12px; color:#CBD5E1;"></i>
            <span style="color:#64748B;">Edit Guru</span>
        </nav>

        {{-- Page Header --}}
        <div style="margin-bottom:24px;">
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:5px;">
                <h1 style="font-size:22px; font-weight:700; color:#0F172A; margin:0;">Edit Data Guru</h1>
                <span id="changedBadge" style="display:none; font-size:11px; background:#FEF9C3; color:#92400E; padding:3px 10px; border-radius:99px; font-weight:500;">
                    Belum disimpan
                </span>
            </div>
            <p style="font-size:13px; color:#64748B; margin:0; line-height:1.5;">
                Perbarui informasi akun guru. Kolom bertanda <span style="color:#EF4444; font-weight:600;">*</span> wajib diisi.
            </p>
        </div>

        {{-- Alert sukses --}}
        @if(session('success'))
        <div style="background:#F0FDF4; border:1px solid #86EFAC; border-radius:10px; padding:13px 16px; font-size:13px; color:#166534; display:flex; align-items:center; gap:9px; margin-bottom:20px;">
            <i class="ti ti-circle-check" style="font-size:18px; flex-shrink:0;"></i>
            {{ session('success') }}
        </div>
        @endif

        {{-- Alert error validasi --}}
        @if($errors->any())
        <div style="background:#FEF2F2; border:1px solid #FECACA; border-radius:10px; padding:13px 16px; font-size:13px; color:#991B1B; display:flex; align-items:flex-start; gap:9px; margin-bottom:20px;">
            <i class="ti ti-alert-circle" style="font-size:18px; flex-shrink:0; margin-top:1px;"></i>
            <div>
                <div style="font-weight:600; margin-bottom:5px;">Ada {{ $errors->count() }} kesalahan yang perlu diperbaiki:</div>
                <ul style="margin:0; padding-left:16px;">
                    @foreach($errors->all() as $error)
                        <li style="margin-bottom:2px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{-- FORM CARD --}}
        <div style="background:#ffffff; border:1px solid #E2E8F0; border-radius:16px; overflow:hidden;">

            {{-- Card Header --}}
            <div style="padding:18px 28px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; gap:14px;">
                <div style="width:42px; height:42px; background:#EFF6FF; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="ti ti-user-edit" style="font-size:20px; color:#3B82F6;"></i>
                </div>
                <div>
                    <div style="font-size:15px; font-weight:600; color:#0F172A;">Informasi akun</div>
                    <div style="font-size:12px; color:#64748B; margin-top:3px;">Data login dan penugasan sekolah guru</div>
                </div>
            </div>

            {{-- FORM --}}
            <form method="POST"
                  action="{{ route('guru.update', $guru->id) }}"
                  id="editForm"
                  onsubmit="return validateForm()">
                @csrf
                @method('PUT')

                <div style="padding:28px;">
                    <div style="display:grid; grid-template-columns:1fr; gap:22px;">

                        {{-- Nama --}}
                        <div style="display:flex; flex-direction:column; gap:7px;">
                            <label for="name" style="font-size:12px; font-weight:600; color:#374151; letter-spacing:0.01em;">
                                Nama lengkap <span style="color:#EF4444;">*</span>
                            </label>
                            <div style="position:relative;">
                                <i class="ti ti-user" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); font-size:15px; color:#94A3B8; pointer-events:none;"></i>
                                <input type="text"
                                       id="name" name="name"
                                       value="{{ old('name', $guru->name) }}"
                                       placeholder="Masukkan nama lengkap"
                                       oninput="markChanged()"
                                       style="width:100%; height:42px; border:1.5px solid {{ $errors->has('name') ? '#EF4444' : '#E2E8F0' }}; border-radius:9px; padding:0 14px 0 38px; font-size:13px; color:#0F172A; background:#FAFAFA; outline:none; box-sizing:border-box; transition:border-color .15s;"
                                       onfocus="this.style.borderColor='#3B82F6'; this.style.background='#fff'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                       onblur="this.style.borderColor='{{ $errors->has('name') ? '#EF4444' : '#E2E8F0' }}'; this.style.background='#FAFAFA'; this.style.boxShadow='none'">
                            </div>
                            @error('name')
                                <span style="font-size:11px; color:#EF4444; display:flex; align-items:center; gap:4px;">
                                    <i class="ti ti-alert-circle" style="font-size:12px;"></i>{{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div style="display:flex; flex-direction:column; gap:7px;">
                            <label for="email" style="font-size:12px; font-weight:600; color:#374151; letter-spacing:0.01em;">
                                Email <span style="color:#EF4444;">*</span>
                            </label>
                            <div style="position:relative;">
                                <i class="ti ti-mail" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); font-size:15px; color:#94A3B8; pointer-events:none;"></i>
                                <input type="email"
                                       id="email" name="email"
                                       value="{{ old('email', $guru->email) }}"
                                       placeholder="nama@sekolah.sch.id"
                                       oninput="markChanged()"
                                       style="width:100%; height:42px; border:1.5px solid {{ $errors->has('email') ? '#EF4444' : '#E2E8F0' }}; border-radius:9px; padding:0 14px 0 38px; font-size:13px; color:#0F172A; background:#FAFAFA; outline:none; box-sizing:border-box; transition:border-color .15s;"
                                       onfocus="this.style.borderColor='#3B82F6'; this.style.background='#fff'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                       onblur="this.style.borderColor='{{ $errors->has('email') ? '#EF4444' : '#E2E8F0' }}'; this.style.background='#FAFAFA'; this.style.boxShadow='none'">
                            </div>
                            @error('email')
                                <span style="font-size:11px; color:#EF4444; display:flex; align-items:center; gap:4px;">
                                    <i class="ti ti-alert-circle" style="font-size:12px;"></i>{{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Sekolah — read only, tidak bisa diubah --}}
                        <div style="display:flex; flex-direction:column; gap:7px;">
                            <label style="font-size:12px; font-weight:600; color:#374151; letter-spacing:0.01em;">Sekolah</label>
                            <div style="display:flex; align-items:center; gap:10px; height:42px; border:1.5px solid #E2E8F0; border-radius:9px; padding:0 14px 0 38px; background:#F1F5F9; position:relative;">
                                <i class="ti ti-building-school" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); font-size:15px; color:#94A3B8;"></i>
                                <span style="font-size:13px; color:#475569;">{{ $guru->school->nama_sekolah ?? '-' }}</span>
                                <span style="margin-left:auto; font-size:10px; background:#E2E8F0; color:#64748B; padding:2px 8px; border-radius:99px; white-space:nowrap;">Tidak dapat diubah</span>
                            </div>
                            {{-- hidden input agar school_id tetap terkirim jika dibutuhkan --}}
                            <input type="hidden" name="school_id" value="{{ $guru->school_id }}">
                        </div>

                        {{-- Password (full width, opsional) --}}
                        <div style="display:flex; flex-direction:column; gap:7px;">
                            <label for="password" style="font-size:12px; font-weight:600; color:#374151; letter-spacing:0.01em;">
                                Password baru
                                <span style="font-weight:400; color:#94A3B8; margin-left:4px;">(opsional)</span>
                            </label>
                            <div style="position:relative;">
                                <i class="ti ti-lock" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); font-size:15px; color:#94A3B8; pointer-events:none;"></i>
                                <input type="password"
                                       id="password" name="password"
                                       placeholder="Kosongkan jika tidak ingin mengganti"
                                       oninput="markChanged()"
                                       style="width:100%; height:42px; border:1.5px solid {{ $errors->has('password') ? '#EF4444' : '#E2E8F0' }}; border-radius:9px; padding:0 44px 0 38px; font-size:13px; color:#0F172A; background:#FAFAFA; outline:none; box-sizing:border-box; transition:border-color .15s;"
                                       onfocus="this.style.borderColor='#3B82F6'; this.style.background='#fff'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                       onblur="this.style.borderColor='{{ $errors->has('password') ? '#EF4444' : '#E2E8F0' }}'; this.style.background='#FAFAFA'; this.style.boxShadow='none'">
                                <button type="button" onclick="togglePassword()"
                                        style="position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#94A3B8; padding:0; font-size:17px; line-height:1; display:flex; align-items:center;"
                                        aria-label="Tampilkan atau sembunyikan password">
                                    <i class="ti ti-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                            <span style="font-size:11px; color:#94A3B8;">Minimal 8 karakter. Kosongkan jika tidak ingin mengganti password.</span>
                            @error('password')
                                <span style="font-size:11px; color:#EF4444; display:flex; align-items:center; gap:4px;">
                                    <i class="ti ti-alert-circle" style="font-size:12px;"></i>{{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Divider --}}
                <div style="height:1px; background:#F1F5F9; margin:0 28px;"></div>

                {{-- Form Actions --}}
                <div style="padding:20px 28px; display:flex; align-items:center; justify-content:flex-end; gap:10px;">                    
                    <button type="submit" id="saveBtn"
                            style="display:flex; align-items:center; gap:7px; height:40px; padding:0 22px; background:#3B82F6; border:none; color:#fff; border-radius:9px; font-size:13px; cursor:pointer; font-weight:600;"
                            onmouseover="this.style.background='#2563EB'"
                            onmouseout="this.style.background='#3B82F6'">
                        <i class="ti ti-device-floppy" style="font-size:15px;"></i> Simpan perubahan
                    </button>
                </div>

            </form>
        </div>

    </main>
</div>

<script>
    let isChanged = false;

    function markChanged() {
        if (!isChanged) {
            isChanged = true;
            document.getElementById('changedBadge').style.display = 'inline-flex';
        }
    }

    function checkUnsaved(e) {
        if (isChanged && !confirm('Ada perubahan yang belum disimpan. Yakin ingin keluar?')) {
            e.preventDefault();
            return false;
        }
        return true;
    }

    function togglePassword() {
        const inp  = document.getElementById('password');
        const icon = document.getElementById('eyeIcon');
        if (inp.type === 'password') {
            inp.type = 'text';
            icon.className = 'ti ti-eye-off';
        } else {
            inp.type = 'password';
            icon.className = 'ti ti-eye';
        }
    }

    function validateForm() {
        const btn = document.getElementById('saveBtn');
        btn.innerHTML = '<i class="ti ti-loader-2" style="font-size:15px; animation:spin .8s linear infinite;"></i> Menyimpan...';
        btn.disabled = true;
        btn.style.opacity = '0.8';
        return true;
    }
</script>

<style>
    @keyframes spin { to { transform: rotate(360deg); } }
</style>

</x-app-layout>