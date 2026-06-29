<x-app-layout>
<div class="flex min-h-screen" style="background:#F0F4F8; font-family:'Inter',sans-serif;">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

{{-- ═══════════════════════════════════════════
     SIDEBAR
═══════════════════════════════════════════ --}}
<aside style="width:240px; background:linear-gradient(160deg,#0F172A 0%,#1E3A5F 60%,#1D4ED8 100%); color:white; position:fixed; top:0; left:0; height:100vh; display:flex; flex-direction:column; box-shadow:4px 0 24px rgba(0,0,0,0.18); z-index:50;">

    {{-- Brand --}}
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

    {{-- Profil --}}
    <a href="{{ route('admin.pengaturan') }}"
       style="display:flex; align-items:center; gap:10px; margin:16px 14px 6px; padding:10px 12px; border-radius:10px; background:rgba(255,255,255,0.06); text-decoration:none;"
       onmouseover="this.style.background='rgba(255,255,255,0.12)'"
       onmouseout="this.style.background='rgba(255,255,255,0.06)'">

        <img src="{{ Auth::user()->photo ? asset('storage/'.Auth::user()->photo) : 'https://i.pravatar.cc/50' }}"
             alt="Foto {{ Auth::user()->name }}"
             style="width:38px; height:38px; border-radius:50%; object-fit:cover; border:2px solid #3B82F6; flex-shrink:0;">

        <div style="overflow:hidden;">
            <div style="font-size:13px; font-weight:600; color:#F1F5F9; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                {{ Auth::user()->name }}
            </div>
            <div style="font-size:11px; color:#60A5FA; display:flex; align-items:center; gap:4px; margin-top:2px;">
                <span style="width:5px; height:5px; background:#22C55E; border-radius:50%; display:inline-block; flex-shrink:0;"></span>
                {{ auth()->user()->role == 'super_admin' ? 'Super Admin' : 'Admin Sekolah' }}
            </div>
        </div>
    </a>

    {{-- Nav --}}
    <nav style="flex:1; padding:6px 14px; overflow-y:auto;">
        <div style="font-size:9px; color:#475569; letter-spacing:0.1em; text-transform:uppercase; padding:12px 8px 6px;">Menu Utama</div>

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
               style="display:flex; align-items:center; gap:9px; padding:9px 10px; border-radius:8px; font-size:13px; text-decoration:none; margin-bottom:2px; transition:all 0.15s;
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
    <div style="padding:14px;">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    style="width:100%; background:rgba(239,68,68,0.13); color:#FCA5A5; border:1px solid rgba(239,68,68,0.25); padding:9px; border-radius:8px; font-size:13px; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:6px;"
                    onmouseover="this.style.background='rgba(239,68,68,0.28)'"
                    onmouseout="this.style.background='rgba(239,68,68,0.13)'">
                <i class="ti ti-logout" style="font-size:16px;"></i> Keluar
            </button>
        </form>
    </div>
</aside>

{{-- ═══════════════════════════════════════════
     MAIN CONTENT
═══════════════════════════════════════════ --}}
<main style="flex:1; margin-left:240px; display:flex; flex-direction:column; min-height:100vh;">

    {{-- Top Bar --}}
    <div style="background:white; border-bottom:1px solid #E2E8F0; padding:13px 28px; display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:40; box-shadow:0 1px 3px rgba(0,0,0,0.04);">
        <div style="display:flex; align-items:center; gap:10px;">
            <a href="{{ route('admin.dashboard') }}" style="color:#94A3B8; text-decoration:none; font-size:13px; display:flex; align-items:center; gap:4px;"
               onmouseover="this.style.color='#1D4ED8'" onmouseout="this.style.color='#94A3B8'">
                <i class="ti ti-layout-dashboard" style="font-size:14px;"></i> Dashboard
            </a>
            <span style="color:#CBD5E1; font-size:12px;">›</span>
            <span style="font-size:13px; color:#1E293B; font-weight:500;">Registrasi Guru</span>
        </div>
        <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:7px 14px; border-radius:8px; font-size:12px; color:#475569; display:flex; align-items:center; gap:6px;">
            <i class="ti ti-calendar" style="color:#3B82F6; font-size:14px;"></i>
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <div style="padding:28px; max-width:860px; width:100%;">

        {{-- Page Header --}}
        <div style="margin-bottom:24px;">
            <h1 style="font-size:20px; font-weight:700; color:#0F172A; margin:0 0 4px;">Registrasi Guru Baru</h1>
            <p class="text-xs text-gray-500 mt-0.5">Buat akun guru baru untuk mengakses sistem presensi. Semua kolom bertanda * wajib diisi.</p>
        </div>

        {{-- Alert Error --}}
        @if($errors->any())
        <div style="background:#FEF2F2; border:1px solid #FECACA; border-radius:10px; padding:14px 18px; margin-bottom:20px; display:flex; gap:12px; align-items:flex-start;">
            <i class="ti ti-alert-triangle" style="font-size:18px; color:#DC2626; flex-shrink:0; margin-top:1px;"></i>
            <div>
                <div style="font-size:13px; font-weight:600; color:#991B1B; margin-bottom:4px;">Terdapat {{ $errors->count() }} kesalahan yang perlu diperbaiki:</div>
                @foreach($errors->all() as $error)
                <div style="font-size:12px; color:#B91C1C; margin-top:2px; display:flex; align-items:center; gap:6px;">
                    <i class="ti ti-point-filled" style="font-size:10px;"></i> {{ $error }}
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Alert Success --}}
        @if(session('success'))
        <div style="background:#F0FDF4; border:1px solid #BBF7D0; border-radius:10px; padding:14px 18px; margin-bottom:20px; display:flex; gap:12px; align-items:center;">
            <i class="ti ti-circle-check" style="font-size:18px; color:#16A34A; flex-shrink:0;"></i>
            <div style="font-size:13px; font-weight:500; color:#166534;">{{ session('success') }}</div>
        </div>
        @endif

        {{-- Form Card --}}
        <div style="background:white; border-radius:14px; border:1px solid #E2E8F0; overflow:hidden; box-shadow:0 1px 6px rgba(0,0,0,0.06);">

            {{-- Card Header --}}
            <div style="padding:18px 24px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; gap:12px; background:#FAFBFC;">
                <div style="width:36px; height:36px; background:#EFF6FF; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="ti ti-user-plus" style="font-size:18px; color:#2563EB;"></i>
                </div>
                <div>
                    <div style="font-size:14px; font-weight:600; color:#0F172A;">Formulir Data Guru</div>
                    <div style="font-size:12px; color:#94A3B8; margin-top:1px;">Lengkapi semua informasi di bawah ini</div>
                </div>
            </div>

            {{-- Form Body --}}
            <form action="{{ route('guru.store') }}" method="POST" style="padding:24px;" id="registrasiForm">
                @csrf

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">

                    {{-- NAMA --}}
                    <div style="grid-column:1/-1;">
                        <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:6px; letter-spacing:0.03em; text-transform:uppercase;">
                            Nama Lengkap Guru <span style="color:#DC2626;">*</span>
                        </label>
                        <div style="position:relative;">
                            <i class="ti ti-user" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); font-size:16px; color:#94A3B8;"></i>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   placeholder="Masukkan nama lengkap guru"
                                   required
                                   style="width:100%; border:1.5px solid {{ $errors->has('name') ? '#FCA5A5' : '#E2E8F0' }}; border-radius:8px; padding:11px 14px 11px 40px; font-size:13px; color:#1E293B; background:{{ $errors->has('name') ? '#FEF2F2' : 'white' }}; outline:none; box-sizing:border-box;"
                                   onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                   onblur="this.style.borderColor='{{ $errors->has('name') ? '#FCA5A5' : '#E2E8F0' }}';this.style.boxShadow='none'">
                        </div>
                        @error('name')
                        <div style="font-size:11px; color:#DC2626; margin-top:5px; display:flex; align-items:center; gap:4px;">
                            <i class="ti ti-alert-circle" style="font-size:12px;"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div>
                        <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:6px; letter-spacing:0.03em; text-transform:uppercase;">
                            Email <span style="color:#DC2626;">*</span>
                        </label>
                        <div style="position:relative;">
                            <i class="ti ti-mail" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); font-size:16px; color:#94A3B8;"></i>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   placeholder="contoh@email.com"
                                   required
                                   style="width:100%; border:1.5px solid {{ $errors->has('email') ? '#FCA5A5' : '#E2E8F0' }}; border-radius:8px; padding:11px 14px 11px 40px; font-size:13px; color:#1E293B; background:{{ $errors->has('email') ? '#FEF2F2' : 'white' }}; outline:none; box-sizing:border-box;"
                                   onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                   onblur="this.style.borderColor='{{ $errors->has('email') ? '#FCA5A5' : '#E2E8F0' }}';this.style.boxShadow='none'">
                        </div>
                        @error('email')
                        <div style="font-size:11px; color:#DC2626; margin-top:5px; display:flex; align-items:center; gap:4px;">
                            <i class="ti ti-alert-circle" style="font-size:12px;"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>

                    

                </div>

                {{-- Divider --}}
                <div style="border-top:1px solid #F1F5F9; margin:20px 0; display:flex; align-items:center; gap:12px;">
                    <span style="font-size:11px; color:#94A3B8; background:white; padding-right:10px; white-space:nowrap; text-transform:uppercase; letter-spacing:0.06em;">Keamanan Akun</span>
                    <div style="flex:1; height:1px; background:#F1F5F9;"></div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">

                    {{-- PASSWORD --}}
                    <div>
                        <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:6px; letter-spacing:0.03em; text-transform:uppercase;">
                            Password <span style="color:#DC2626;">*</span>
                        </label>
                        <div style="position:relative;">
                            <i class="ti ti-lock" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); font-size:16px; color:#94A3B8;"></i>
                            <input type="password" name="password" id="password"
                                   placeholder="Min. 8 karakter"
                                   required
                                   style="width:100%; border:1.5px solid {{ $errors->has('password') ? '#FCA5A5' : '#E2E8F0' }}; border-radius:8px; padding:11px 40px 11px 40px; font-size:13px; color:#1E293B; outline:none; box-sizing:border-box;"
                                   onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                   onblur="this.style.borderColor='{{ $errors->has('password') ? '#FCA5A5' : '#E2E8F0' }}';this.style.boxShadow='none'">
                            <button type="button" onclick="togglePass('password','eye1')" id="eye1"
                                    style="position:absolute; right:10px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#94A3B8; padding:0; display:flex; align-items:center;">
                                <i class="ti ti-eye" style="font-size:17px;"></i>
                            </button>
                        </div>
                        {{-- Password strength --}}
                        <div style="margin-top:6px;">
                            <div style="height:3px; background:#F1F5F9; border-radius:4px; overflow:hidden;">
                                <div id="strengthBar" style="height:100%; width:0%; border-radius:4px; transition:all 0.3s;"></div>
                            </div>
                            <div id="strengthText" style="font-size:10px; color:#94A3B8; margin-top:3px;"></div>
                        </div>
                        @error('password')
                        <div style="font-size:11px; color:#DC2626; margin-top:5px; display:flex; align-items:center; gap:4px;">
                            <i class="ti ti-alert-circle" style="font-size:12px;"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- KONFIRMASI PASSWORD --}}
                    <div>
                        <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:6px; letter-spacing:0.03em; text-transform:uppercase;">
                            Konfirmasi Password <span style="color:#DC2626;">*</span>
                        </label>
                        <div style="position:relative;">
                            <i class="ti ti-key" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); font-size:16px; color:#94A3B8;"></i>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   placeholder="Ulangi password"
                                   required
                                   style="width:100%; border:1.5px solid #E2E8F0; border-radius:8px; padding:11px 40px 11px 40px; font-size:13px; color:#1E293B; outline:none; box-sizing:border-box;"
                                   onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                   onblur="this.style.borderColor='#E2E8F0';this.style.boxShadow='none'"
                                   oninput="checkMatch()">
                            <button type="button" onclick="togglePass('password_confirmation','eye2')" id="eye2"
                                    style="position:absolute; right:10px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#94A3B8; padding:0; display:flex; align-items:center;">
                                <i class="ti ti-eye" style="font-size:17px;"></i>
                            </button>
                        </div>
                        <div id="matchMsg" style="font-size:11px; margin-top:5px; display:flex; align-items:center; gap:4px;"></div>
                    </div>

                </div>

                {{-- Info box --}}
                <div style="background:#F0F9FF; border:1px solid #BAE6FD; border-radius:8px; padding:12px 16px; margin-top:20px; display:flex; gap:10px; align-items:flex-start;">
                    <i class="ti ti-info-circle" style="font-size:17px; color:#0EA5E9; flex-shrink:0; margin-top:1px;"></i>
                    <div style="font-size:12px; color:#0369A1; line-height:1.6;">
                        Guru yang terdaftar dapat langsung login menggunakan email dan password yang diatur di sini.
                        Pastikan email aktif dan password minimal <strong>8 karakter</strong>.
                    </div>
                </div>

                {{-- Actions --}}
                <div style="display:flex; align-items:center; justify-content:flex-end; gap:10px; margin-top:24px; padding-top:20px; border-top:1px solid #F1F5F9;">
                    <a href="{{ route('guru.index') }}"
                       style="padding:10px 20px; border-radius:8px; font-size:13px; font-weight:500; color:#475569; background:#F1F5F9; text-decoration:none; border:1px solid #E2E8F0; display:flex; align-items:center; gap:6px;"
                       onmouseover="this.style.background='#E2E8F0'" onmouseout="this.style.background='#F1F5F9'">
                        Batal
                    </a>
                    <button type="submit" id="submitBtn"
                            style="padding:10px 28px; border-radius:8px; font-size:13px; font-weight:600; color:white; background:#1D4ED8; border:none; cursor:pointer; display:flex; align-items:center; gap:8px;"
                            onmouseover="this.style.background='#1E40AF'" onmouseout="this.style.background='#1D4ED8'">
                        <i class="ti ti-user-plus" style="font-size:15px;"></i> Tambahkan Guru
                    </button>
                </div>

            </form>
        </div>

    </div>
</main>

</div>

<script>
function togglePass(fieldId, btnId) {
    const field = document.getElementById(fieldId);
    const btn   = document.getElementById(btnId).querySelector('i');
    if (field.type === 'password') {
        field.type = 'text';
        btn.className = 'ti ti-eye-off';
    } else {
        field.type = 'password';
        btn.className = 'ti ti-eye';
    }
}

document.getElementById('password').addEventListener('input', function() {
    const val = this.value;
    const bar  = document.getElementById('strengthBar');
    const text = document.getElementById('strengthText');
    let strength = 0;
    if (val.length >= 8)          strength++;
    if (/[A-Z]/.test(val))        strength++;
    if (/[0-9]/.test(val))        strength++;
    if (/[^A-Za-z0-9]/.test(val)) strength++;

    const levels = [
        { w:'0%',   c:'transparent', t:'' },
        { w:'25%',  c:'#DC2626',     t:'Sangat lemah' },
        { w:'50%',  c:'#D97706',     t:'Lemah' },
        { w:'75%',  c:'#2563EB',     t:'Cukup kuat' },
        { w:'100%', c:'#16A34A',     t:'Kuat' },
    ];
    bar.style.width      = levels[strength].w;
    bar.style.background = levels[strength].c;
    text.textContent     = levels[strength].t;
    text.style.color     = levels[strength].c;
    checkMatch();
});

function checkMatch() {
    const p1   = document.getElementById('password').value;
    const p2   = document.getElementById('password_confirmation').value;
    const msg  = document.getElementById('matchMsg');
    const inp2 = document.getElementById('password_confirmation');
    if (!p2) { msg.innerHTML = ''; return; }
    if (p1 === p2) {
        msg.innerHTML = '<i class="ti ti-circle-check" style="font-size:12px; color:#16A34A;"></i><span style="color:#16A34A;">Password cocok</span>';
        inp2.style.borderColor = '#86EFAC';
    } else {
        msg.innerHTML = '<i class="ti ti-circle-x" style="font-size:12px; color:#DC2626;"></i><span style="color:#DC2626;">Password tidak cocok</span>';
        inp2.style.borderColor = '#FCA5A5';
    }
}

document.getElementById('registrasiForm').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="ti ti-loader-2" style="font-size:15px;"></i> Menyimpan...';
    btn.style.background = '#93C5FD';
    btn.style.cursor = 'not-allowed';
});
</script>

</x-app-layout>