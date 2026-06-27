<x-app-layout>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

<div class="flex min-h-screen" style="background:#F0F4F8; font-family:'Inter',sans-serif;">

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
                    <div style="font-size:12px; font-weight:700; color:#93C5FD; letter-spacing:0.05em;">PRESENSI APP</div>
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
                   style="display:flex; align-items:center; gap:9px; padding:9px 10px; border-radius:8px; font-size:13px; text-decoration:none; margin-bottom:2px;
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
    <main style="margin-left:240px; flex:1; padding:28px 32px; min-height:100vh;">

        {{-- Breadcrumb (Nielsen #6: Recognition rather than recall) --}}
        <nav style="display:flex; align-items:center; gap:6px; font-size:12px; color:#64748B; margin-bottom:20px;">
            <a href="{{ route('admin.dashboard') }}" style="color:#3B82F6; text-decoration:none;">Beranda</a>
            <i class="ti ti-chevron-right" style="font-size:12px;"></i>
            <a href="{{ route('guru.index') }}" style="color:#3B82F6; text-decoration:none;">Data Guru</a>
            <i class="ti ti-chevron-right" style="font-size:12px;"></i>
            <span style="color:#1E293B;">Edit Guru</span>
        </nav>

        {{-- Page Header --}}
        <div style="margin-bottom:22px;">
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:4px;">
                <h1 style="font-size:20px; font-weight:600; color:#0F172A; margin:0;">Edit Data Guru</h1>
                <span style="font-size:11px; background:#EFF6FF; color:#3B82F6; padding:3px 10px; border-radius:99px;">
                    ID #{{ $user->id }}
                </span>
                {{-- Badge perubahan belum disimpan (Nielsen #1: Visibility of system status) --}}
                <span id="changedBadge" style="display:none; font-size:10px; background:#FEF9C3; color:#A16207; padding:2px 8px; border-radius:99px;">
                    Ada perubahan belum disimpan
                </span>
            </div>
            <p style="font-size:13px; color:#64748B; margin:0;">
                Perbarui informasi akun guru. Kolom bertanda <span style="color:#EF4444;">*</span> wajib diisi.
            </p>
        </div>

        {{-- Alert sukses (Nielsen #1: Visibility of system status) --}}
        @if(session('success'))
        <div style="background:#F0FDF4; border:1px solid #86EFAC; border-radius:10px; padding:12px 16px; font-size:13px; color:#166534; display:flex; align-items:center; gap:8px; margin-bottom:18px;">
            <i class="ti ti-circle-check" style="font-size:17px; flex-shrink:0;"></i>
            {{ session('success') }}
        </div>
        @endif

        {{-- Alert error validasi (Nielsen #9: Help users recognize & recover from errors) --}}
        @if($errors->any())
        <div style="background:#FEF2F2; border:1px solid #FECACA; border-radius:10px; padding:12px 16px; font-size:13px; color:#991B1B; display:flex; align-items:flex-start; gap:8px; margin-bottom:18px;">
            <i class="ti ti-alert-circle" style="font-size:17px; flex-shrink:0; margin-top:1px;"></i>
            <div>
                <strong>Ada {{ $errors->count() }} kesalahan yang perlu diperbaiki:</strong>
                <ul style="margin:6px 0 0 16px; padding:0;">
                    @foreach($errors->all() as $error)
                        <li style="margin-bottom:2px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{-- FORM CARD --}}
        <div style="background:#fff; border:1px solid #E2E8F0; border-radius:14px; overflow:hidden; box-shadow:0 1px 4px rgba(0,0,0,0.06);">

            {{-- Card Header --}}
            <div style="padding:16px 24px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; gap:12px;">
                <div style="width:38px; height:38px; background:#EFF6FF; border-radius:9px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="ti ti-user-edit" style="font-size:19px; color:#3B82F6;"></i>
                </div>
                <div>
                    <div style="font-size:14px; font-weight:600; color:#0F172A;">Informasi akun</div>
                    <div style="font-size:12px; color:#64748B; margin-top:2px;">Data login dan penugasan sekolah guru</div>
                </div>
            </div>

            {{-- FORM — FIX UTAMA: tambah @method('PUT') --}}
            <form method="POST"
                  action="{{ route('guru.update', $user->id) }}"
                  id="editForm"
                  onsubmit="return validateForm()">
                @csrf
                @method('PUT')  {{-- ✅ FIX: ini yang menyebabkan error "PUT method not supported" --}}

                <div style="padding:26px 24px;">
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">

                        {{-- Nama --}}
                        <div style="display:flex; flex-direction:column; gap:6px;">
                            <label for="name" style="font-size:12px; font-weight:600; color:#374151;">
                                Nama lengkap <span style="color:#EF4444;">*</span>
                            </label>
                            <div style="position:relative;">
                                <i class="ti ti-user" style="position:absolute; left:11px; top:50%; transform:translateY(-50%); font-size:16px; color:#94A3B8; pointer-events:none;"></i>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $user->name) }}"
                                       placeholder="Masukkan nama lengkap"
                                       oninput="markChanged()"
                                       style="width:100%; height:40px; border:1px solid {{ $errors->has('name') ? '#EF4444' : '#CBD5E1' }}; border-radius:8px; padding:0 12px 0 36px; font-size:13px; color:#0F172A; background:#fff; outline:none; box-sizing:border-box;"
                                       onfocus="this.style.borderColor='#3B82F6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.12)'"
                                       onblur="this.style.borderColor='{{ $errors->has('name') ? '#EF4444' : '#CBD5E1' }}'; this.style.boxShadow='none'">
                            </div>
                            @error('name')
                                <span style="font-size:11px; color:#EF4444; display:flex; align-items:center; gap:4px;">
                                    <i class="ti ti-alert-circle" style="font-size:12px;"></i>{{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div style="display:flex; flex-direction:column; gap:6px;">
                            <label for="email" style="font-size:12px; font-weight:600; color:#374151;">
                                Email <span style="color:#EF4444;">*</span>
                            </label>
                            <div style="position:relative;">
                                <i class="ti ti-mail" style="position:absolute; left:11px; top:50%; transform:translateY(-50%); font-size:16px; color:#94A3B8; pointer-events:none;"></i>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       value="{{ old('email', $user->email) }}"
                                       placeholder="nama@sekolah.sch.id"
                                       oninput="markChanged()"
                                       style="width:100%; height:40px; border:1px solid {{ $errors->has('email') ? '#EF4444' : '#CBD5E1' }}; border-radius:8px; padding:0 12px 0 36px; font-size:13px; color:#0F172A; background:#fff; outline:none; box-sizing:border-box;"
                                       onfocus="this.style.borderColor='#3B82F6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.12)'"
                                       onblur="this.style.borderColor='{{ $errors->has('email') ? '#EF4444' : '#CBD5E1' }}'; this.style.boxShadow='none'">
                            </div>
                            @error('email')
                                <span style="font-size:11px; color:#EF4444; display:flex; align-items:center; gap:4px;">
                                    <i class="ti ti-alert-circle" style="font-size:12px;"></i>{{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Sekolah (full width) --}}
                        <div style="display:flex; flex-direction:column; gap:6px; grid-column:1/-1;">
                            <label for="school_id" style="font-size:12px; font-weight:600; color:#374151;">
                                Sekolah <span style="color:#EF4444;">*</span>
                            </label>
                            <div style="position:relative;">
                                <i class="ti ti-building-school" style="position:absolute; left:11px; top:50%; transform:translateY(-50%); font-size:16px; color:#94A3B8; pointer-events:none; z-index:1;"></i>
                                <select id="school_id"
                                        name="school_id"
                                        onchange="markChanged()"
                                        style="width:100%; height:40px; border:1px solid {{ $errors->has('school_id') ? '#EF4444' : '#CBD5E1' }}; border-radius:8px; padding:0 12px 0 36px; font-size:13px; color:#0F172A; background:#fff; outline:none; box-sizing:border-box; appearance:none; cursor:pointer;"
                                        onfocus="this.style.borderColor='#3B82F6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.12)'"
                                        onblur="this.style.borderColor='{{ $errors->has('school_id') ? '#EF4444' : '#CBD5E1' }}'; this.style.boxShadow='none'">
                                    <option value="">Pilih sekolah...</option>
                                    @foreach($schools as $s)
                                        <option value="{{ $s->id }}" {{ old('school_id', $user->school_id) == $s->id ? 'selected' : '' }}>
                                            {{ $s->nama_sekolah }}
                                        </option>
                                    @endforeach
                                </select>
                                <i class="ti ti-chevron-down" style="position:absolute; right:11px; top:50%; transform:translateY(-50%); font-size:15px; color:#94A3B8; pointer-events:none;"></i>
                            </div>
                            @error('school_id')
                                <span style="font-size:11px; color:#EF4444; display:flex; align-items:center; gap:4px;">
                                    <i class="ti ti-alert-circle" style="font-size:12px;"></i>{{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Password (full width, opsional) --}}
                        <div style="display:flex; flex-direction:column; gap:6px; grid-column:1/-1;">
                            <label for="password" style="font-size:12px; font-weight:600; color:#374151;">
                                Password baru
                                <span style="font-weight:400; color:#94A3B8; margin-left:4px;">(opsional)</span>
                            </label>
                            <div style="position:relative;">
                                <i class="ti ti-lock" style="position:absolute; left:11px; top:50%; transform:translateY(-50%); font-size:16px; color:#94A3B8; pointer-events:none;"></i>
                                <input type="password"
                                       id="password"
                                       name="password"
                                       placeholder="Kosongkan jika tidak ingin mengganti"
                                       oninput="markChanged()"
                                       style="width:100%; height:40px; border:1px solid {{ $errors->has('password') ? '#EF4444' : '#CBD5E1' }}; border-radius:8px; padding:0 40px 0 36px; font-size:13px; color:#0F172A; background:#fff; outline:none; box-sizing:border-box;"
                                       onfocus="this.style.borderColor='#3B82F6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.12)'"
                                       onblur="this.style.borderColor='{{ $errors->has('password') ? '#EF4444' : '#CBD5E1' }}'; this.style.boxShadow='none'">
                                {{-- Toggle show/hide password (Nielsen #3: User control) --}}
                                <button type="button"
                                        onclick="togglePassword()"
                                        style="position:absolute; right:10px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#94A3B8; padding:0; font-size:16px; line-height:1;"
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

                    </div>{{-- end grid --}}
                </div>{{-- end padding --}}

                {{-- Divider --}}
                <div style="height:1px; background:#F1F5F9;"></div>

                {{-- Form Actions (Nielsen #3: User control and freedom) --}}
                <div style="padding:16px 24px; display:flex; align-items:center; justify-content:space-between;">

                    {{-- Hapus guru — dengan konfirmasi modal (Nielsen #5: Error prevention) --}}
                    <button type="button"
                            onclick="confirmDelete()"
                            style="display:flex; align-items:center; gap:6px; height:38px; padding:0 16px; background:transparent; border:1px solid #FECACA; color:#EF4444; border-radius:8px; font-size:13px; cursor:pointer;"
                            onmouseover="this.style.background='#FEF2F2'"
                            onmouseout="this.style.background='transparent'">
                        <i class="ti ti-trash" style="font-size:15px;"></i> Hapus guru
                    </button>

                    <div style="display:flex; gap:10px;">
                        {{-- Batal --}}
                        <a href="{{ route('guru.index') }}"
                           id="cancelBtn"
                           onclick="return checkUnsaved(event)"
                           style="display:flex; align-items:center; gap:6px; height:38px; padding:0 16px; background:transparent; border:1px solid #CBD5E1; color:#64748B; border-radius:8px; font-size:13px; text-decoration:none;">
                            <i class="ti ti-arrow-left" style="font-size:15px;"></i> Batal
                        </a>
                        {{-- Simpan --}}
                        <button type="submit"
                                id="saveBtn"
                                style="display:flex; align-items:center; gap:6px; height:38px; padding:0 18px; background:#3B82F6; border:none; color:#fff; border-radius:8px; font-size:13px; cursor:pointer; font-weight:600;"
                                onmouseover="this.style.background='#2563EB'"
                                onmouseout="this.style.background='#3B82F6'">
                            <i class="ti ti-device-floppy" style="font-size:15px;"></i> Simpan perubahan
                        </button>
                    </div>
                </div>

            </form>
        </div>{{-- end card --}}

        {{-- ═══════════════════════════════════════════
             MODAL KONFIRMASI HAPUS
             (Nielsen #5: Error prevention — double confirm destruktif)
        ═══════════════════════════════════════════ --}}
        <div id="deleteModal"
             style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); z-index:100; align-items:center; justify-content:center;">
            <div style="background:#fff; border-radius:14px; padding:26px 28px; max-width:420px; width:90%; box-shadow:0 20px 40px rgba(0,0,0,0.18);">
                <div style="display:flex; align-items:center; gap:10px; margin-bottom:12px;">
                    <div style="width:40px; height:40px; background:#FEF2F2; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        <i class="ti ti-alert-triangle" style="font-size:20px; color:#EF4444;"></i>
                    </div>
                    <div>
                        <div style="font-size:15px; font-weight:600; color:#0F172A;">Hapus guru ini?</div>
                        <div style="font-size:12px; color:#64748B; margin-top:2px;">Tindakan ini tidak dapat dibatalkan</div>
                    </div>
                </div>
                <p style="font-size:13px; color:#475569; margin-bottom:20px; line-height:1.6;">
                    Akun guru <strong>{{ $user->name }}</strong> akan dihapus secara permanen.
                    Data presensi yang sudah tercatat tetap tersimpan di sistem.
                </p>
                <div style="display:flex; gap:10px; justify-content:flex-end;">
                    <button type="button"
                            onclick="closeDeleteModal()"
                            style="height:38px; padding:0 16px; background:transparent; border:1px solid #CBD5E1; color:#64748B; border-radius:8px; font-size:13px; cursor:pointer;">
                        Batal
                    </button>
                    <form method="POST" action="{{ route('guru.destroy', $user->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                style="height:38px; padding:0 16px; background:#EF4444; border:none; color:#fff; border-radius:8px; font-size:13px; cursor:pointer; font-weight:600;">
                            <i class="ti ti-trash" style="font-size:14px; vertical-align:-1px;"></i> Ya, hapus guru ini
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </main>
</div>

{{-- ═══════════════════════════════════════════
     JAVASCRIPT
═══════════════════════════════════════════ --}}
<script>
    /* Nielsen #1: Visibility of system status — tandai ada perubahan */
    let isChanged = false;
    function markChanged() {
        if (!isChanged) {
            isChanged = true;
            document.getElementById('changedBadge').style.display = 'inline-flex';
        }
    }

    /* Nielsen #3: User control — konfirmasi tinggalkan halaman jika ada perubahan */
    function checkUnsaved(e) {
        if (isChanged) {
            if (!confirm('Ada perubahan yang belum disimpan. Yakin ingin keluar?')) {
                e.preventDefault();
                return false;
            }
        }
        return true;
    }

    /* Nielsen #5: Error prevention — toggle lihat password */
    function togglePassword() {
        const inp = document.getElementById('password');
        const icon = document.getElementById('eyeIcon');
        if (inp.type === 'password') {
            inp.type = 'text';
            icon.className = 'ti ti-eye-off';
        } else {
            inp.type = 'password';
            icon.className = 'ti ti-eye';
        }
    }

    /* Nielsen #5: Error prevention — loading state saat submit */
    function validateForm() {
        const btn = document.getElementById('saveBtn');
        btn.innerHTML = '<i class="ti ti-loader-2" style="font-size:15px; animation:spin .8s linear infinite;"></i> Menyimpan...';
        btn.disabled = true;
        return true; // biarkan form submit berjalan normal ke Laravel
    }

    /* Delete modal */
    function confirmDelete() {
        const modal = document.getElementById('deleteModal');
        modal.style.display = 'flex';
    }
    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }
    // Tutup modal jika klik di luar
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });
</script>

<style>
    @keyframes spin { to { transform: rotate(360deg); } }
    select option { color: #0F172A; }
</style>

</x-app-layout>