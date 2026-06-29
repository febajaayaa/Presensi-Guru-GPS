<x-app-layout>
<div class="flex min-h-screen" style="background:#F0F4F8; font-family:'Inter',sans-serif;">

{{-- Tabler Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

{{-- SIDEBAR --}}
<aside style="width:240px; flex-shrink:0; background:linear-gradient(160deg,#0F172A 0%,#1E3A5F 60%,#1D4ED8 100%); color:white; position:fixed; top:0; left:0; height:100vh; display:flex; flex-direction:column; box-shadow:4px 0 24px rgba(0,0,0,0.18); z-index:50;">

    {{-- Brand --}}
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

    {{-- Profil Super Admin --}}
    <div style="display:flex; align-items:center; gap:10px; margin:16px 14px 6px; padding:10px 12px; border-radius:10px; background:rgba(255,255,255,0.06);">
        <div style="width:38px; height:38px; border-radius:50%; background:#2563EB; display:flex; align-items:center; justify-content:center; border:2px solid #3B82F6; flex-shrink:0;">
            <i class="ti ti-shield-check" style="font-size:18px; color:#fff;"></i>
        </div>
        <div style="overflow:hidden;">
            <div style="font-size:13px; font-weight:600; color:#F1F5F9; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                {{ Auth::user()->name }}
            </div>
            <div style="font-size:11px; color:#60A5FA; display:flex; align-items:center; gap:4px; margin-top:2px;">
                <span style="width:5px; height:5px; background:#22C55E; border-radius:50%; display:inline-block; flex-shrink:0;"></span>
                Super Admin
            </div>
        </div>
    </div>

    {{-- Nav --}}
    <nav style="flex:1; padding:6px 14px; overflow-y:auto;">
        <div style="font-size:9px; color:#475569; letter-spacing:0.1em; text-transform:uppercase; padding:12px 8px 6px;">Menu Utama</div>

        @php
        $navItems = [
            ['label' => 'Beranda',        'url' => route('superadmin.dashboard'), 'route' => 'superadmin.dashboard', 'icon' => 'ti-layout-dashboard'],
            ['label' => 'Kelola Akun',    'url' => '/superadmin/users',           'route' => null,                   'icon' => 'ti-users'],
            ['label' => 'Data Sekolah',   'url' => '/admin/schools',              'route' => null,                   'icon' => 'ti-building'],
            ['label' => 'Tambah Sekolah', 'url' => '/admin/schools/create',       'route' => null,                   'icon' => 'ti-building-community'],
        ];
        @endphp

        @foreach($navItems as $item)
            @php
                $isActive = $item['route']
                    ? Route::currentRouteName() == $item['route']
                    : request()->is(ltrim($item['url'], '/'));
            @endphp
            <a href="{{ $item['url'] }}"
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

{{-- CONTENT --}}
<div style="flex:1; margin-left:240px; padding:24px 28px;">

    {{-- BREADCRUMB --}}
    <nav style="display:flex; align-items:center; gap:6px; font-size:12px; color:#94A3B8; margin-bottom:20px;">
        <a href="{{ route('superadmin.dashboard') }}" style="color:#94A3B8; text-decoration:none;" onmouseover="this.style.color='#1E40AF'" onmouseout="this.style.color='#94A3B8'">Beranda</a>
        <span>›</span>
        <span style="color:#1E293B; font-weight:500;">Tambah Sekolah</span>
    </nav>

    {{-- FLASH & ERROR --}}
    @if(session('success'))
    <div role="alert" style="display:flex; align-items:center; gap:10px; background:#F0FDF4; border:1px solid #86EFAC; border-left:4px solid #22C55E; border-radius:10px; padding:12px 16px; margin-bottom:20px;">
        <span style="font-size:18px;">✅</span>
        <div>
            <div style="font-size:13px; font-weight:600; color:#15803D;">Berhasil Disimpan</div>
            <div style="font-size:12px; color:#166534;">{{ session('success') }}</div>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div role="alert" style="display:flex; align-items:flex-start; gap:10px; background:#FFF7F7; border:1px solid #FECACA; border-left:4px solid #EF4444; border-radius:10px; padding:12px 16px; margin-bottom:20px;">
        <span style="font-size:18px; margin-top:1px;">⚠️</span>
        <div>
            <div style="font-size:13px; font-weight:600; color:#B91C1C; margin-bottom:4px;">Ada {{ $errors->count() }} kesalahan yang perlu diperbaiki:</div>
            <ul style="margin:0; padding-left:16px; font-size:12px; color:#991B1B;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <!-- HEADER -->
    <div style="margin-bottom:24px;">
        <h1 style="font-size:22px; font-weight:700; color:#0F172A; margin:0 0 4px;">Tambah Sekolah Baru</h1>
        <p style="font-size:12px; color:#94A3B8; margin:0;">Isi semua kolom yang ditandai wajib (<span style="color:#EF4444; font-weight:600;">*</span>) sebelum menyimpan.</p>
    </div>

    <!-- FORM CARD -->
    <div style="background:white; border-radius:16px; box-shadow:0 1px 4px rgba(0,0,0,0.07), 0 4px 16px rgba(0,0,0,0.05); overflow:hidden; max-width:760px;">

        {{-- Progress Indicator --}}
        <div style="background:#F8FAFC; border-bottom:1px solid #E2E8F0; padding:14px 24px; display:flex; align-items:center; gap:8px;">
            <div style="display:flex; align-items:center; gap:6px;">
                <div style="width:24px; height:24px; border-radius:50%; background:#2563EB; color:white; font-size:11px; font-weight:700; display:flex; align-items:center; justify-content:center;">1</div>
                <span style="font-size:12px; font-weight:600; color:#1E293B;">Identitas Sekolah</span>
            </div>
            <div style="flex:1; height:1px; background:#CBD5E1;"></div>
            <div style="display:flex; align-items:center; gap:6px;">
                <div style="width:24px; height:24px; border-radius:50%; background:#E2E8F0; color:#94A3B8; font-size:11px; font-weight:700; display:flex; align-items:center; justify-content:center;">2</div>
                <span style="font-size:12px; color:#94A3B8;">Lokasi</span>
            </div>
            <div style="flex:1; height:1px; background:#CBD5E1;"></div>
            <div style="display:flex; align-items:center; gap:6px;">
                <div style="width:24px; height:24px; border-radius:50%; background:#E2E8F0; color:#94A3B8; font-size:11px; font-weight:700; display:flex; align-items:center; justify-content:center;">3</div>
                <span style="font-size:12px; color:#94A3B8;">Kontak</span>
            </div>
        </div>

        <form method="POST" action="/admin/schools" id="schoolForm" enctype="multipart/form-data" novalidate>
        @csrf
        <div style="padding:24px;">

            {{-- ── SEKSI 1: IDENTITAS ── --}}
            <div style="margin-bottom:28px;">
                <div style="display:flex; align-items:center; gap:8px; margin-bottom:16px; padding-bottom:10px; border-bottom:1px solid #F1F5F9;">
                    <span style="width:28px; height:28px; border-radius:8px; background:#EFF6FF; color:#2563EB; font-size:13px; font-weight:700; display:flex; align-items:center; justify-content:center;">1</span>
                    <h2 style="font-size:14px; font-weight:700; color:#0F172A; margin:0;">Identitas Sekolah</h2>
                </div>

                {{-- Nama Sekolah --}}
                <div style="margin-bottom:16px;">
                    <label for="nama_sekolah" style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:6px;">
                        Nama Sekolah <span style="color:#EF4444;">*</span>
                    </label>
                    <input type="text" id="nama_sekolah" name="nama_sekolah"
                        value="{{ old('nama_sekolah') }}"
                        placeholder="Contoh: SDN Kartasura 01"
                        maxlength="150"
                        autocomplete="organization"
                        style="width:100%; padding:10px 12px; border:1.5px solid {{ $errors->has('nama_sekolah') ? '#EF4444' : '#D1D5DB' }}; border-radius:8px; font-size:13px; color:#1E293B; outline:none; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#3B82F6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.12)'"
                        onblur="this.style.borderColor='{{ $errors->has('nama_sekolah') ? '#EF4444' : '#D1D5DB' }}'; this.style.boxShadow='none'">
                    @error('nama_sekolah')
                        <p style="margin:5px 0 0; font-size:11px; color:#EF4444;">⚠ {{ $message }}</p>
                    @enderror
                </div>

                {{-- NPSN --}}
                <div style="margin-bottom:16px;">
                    <label for="npsn" style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:6px;">
                        NPSN <span style="font-size:11px; font-weight:400; color:#94A3B8;">Nomor Pokok Sekolah Nasional</span>
                    </label>
                    <input type="text" id="npsn" name="npsn"
                        value="{{ old('npsn') }}"
                        placeholder="Contoh: 20307355"
                        maxlength="8"
                        inputmode="numeric"
                        style="width:100%; padding:10px 12px; border:1.5px solid {{ $errors->has('npsn') ? '#EF4444' : '#D1D5DB' }}; border-radius:8px; font-size:13px; color:#1E293B; outline:none; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#3B82F6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.12)'"
                        onblur="this.style.borderColor='{{ $errors->has('npsn') ? '#EF4444' : '#D1D5DB' }}'; this.style.boxShadow='none'">
                    <p style="margin:5px 0 0; font-size:11px; color:#94A3B8;">8 digit angka. Kosongkan jika belum diketahui.</p>
                    @error('npsn')
                        <p style="margin:3px 0 0; font-size:11px; color:#EF4444;">⚠ {{ $message }}</p>
                    @enderror
                </div>

                {{-- Kepala Sekolah --}}
                <div style="margin-bottom:16px;">
                    <label for="kepala_sekolah" style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:6px;">Nama Kepala Sekolah</label>
                    <input type="text" id="kepala_sekolah" name="kepala_sekolah"
                        value="{{ old('kepala_sekolah') }}"
                        placeholder="Contoh: Budi Santoso, S.Pd."
                        autocomplete="name"
                        style="width:100%; padding:10px 12px; border:1.5px solid #D1D5DB; border-radius:8px; font-size:13px; color:#1E293B; outline:none; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#3B82F6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.12)'"
                        onblur="this.style.borderColor='#D1D5DB'; this.style.boxShadow='none'">
                </div>

                {{-- Logo Sekolah --}}
                <div>
                    <label style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:6px;">
                        Logo Sekolah
                        <span style="font-size:11px; font-weight:400; color:#94A3B8; margin-left:4px;">JPG/PNG/SVG, maks. 1 MB</span>
                    </label>
                    <div style="display:flex; align-items:center; gap:16px; padding:14px 16px; background:#F8FAFC; border:1.5px dashed #CBD5E1; border-radius:10px;">
                        <div id="logoPreviewWrap" style="width:72px; height:72px; border-radius:10px; border:2px solid #E2E8F0; background:#fff; display:flex; align-items:center; justify-content:center; overflow:hidden; flex-shrink:0;">
                            <i class="ti ti-photo" id="logoIcon" style="font-size:26px; color:#CBD5E1;"></i>
                            <img id="logoPreviewImg" src="" alt="Preview Logo" style="display:none; width:100%; height:100%; object-fit:contain;">
                        </div>
                        <div style="flex:1;">
                            <label for="logoInput"
                                style="display:inline-flex; align-items:center; gap:6px; background:#2563EB; color:white; padding:8px 16px; border-radius:8px; font-size:12px; font-weight:600; cursor:pointer;"
                                onmouseover="this.style.background='#1D4ED8'" onmouseout="this.style.background='#2563EB'">
                                <i class="ti ti-upload" style="font-size:14px;"></i> Pilih File Logo
                            </label>
                            <input type="file" id="logoInput" name="logo" accept="image/*" style="display:none;" onchange="previewLogo(this)">
                            <div id="logoFileName" style="font-size:11px; color:#94A3B8; margin-top:6px;">Belum ada file dipilih</div>
                        </div>
                    </div>
                    @error('logo')
                        <p style="margin:5px 0 0; font-size:11px; color:#EF4444;">⚠ {{ $message }}</p>
                    @enderror
                </div>

            </div>{{-- end seksi 1 --}}

            {{-- ── SEKSI 2: LOKASI ── --}}
            <div style="margin-bottom:28px;">
                <div style="display:flex; align-items:center; gap:8px; margin-bottom:16px; padding-bottom:10px; border-bottom:1px solid #F1F5F9;">
                    <span style="width:28px; height:28px; border-radius:8px; background:#F0FDF4; color:#16A34A; font-size:13px; font-weight:700; display:flex; align-items:center; justify-content:center;">2</span>
                    <h2 style="font-size:14px; font-weight:700; color:#0F172A; margin:0;">Lokasi & Koordinat</h2>
                </div>

                {{-- Alamat --}}
                <div style="margin-bottom:16px;">
                    <label for="alamat" style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:6px;">
                        Alamat Lengkap <span style="color:#EF4444;">*</span>
                    </label>
                    <textarea id="alamat" name="alamat" rows="2"
                        placeholder="Jl. Contoh No. 1, Desa, Kecamatan, Kabupaten"
                        style="width:100%; padding:10px 12px; border:1.5px solid {{ $errors->has('alamat') ? '#EF4444' : '#D1D5DB' }}; border-radius:8px; font-size:13px; color:#1E293B; outline:none; box-sizing:border-box; resize:vertical; line-height:1.5;"
                        onfocus="this.style.borderColor='#3B82F6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.12)'"
                        onblur="this.style.borderColor='{{ $errors->has('alamat') ? '#EF4444' : '#D1D5DB' }}'; this.style.boxShadow='none'">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <p style="margin:5px 0 0; font-size:11px; color:#EF4444;">⚠ {{ $message }}</p>
                    @enderror
                </div>

                {{-- Latitude & Longitude --}}
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:16px;">
                    <div>
                        <label for="latitude" style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:6px;">
                            Latitude <span style="color:#EF4444;">*</span>
                        </label>
                        <input type="text" id="latitude" name="latitude"
                            value="{{ old('latitude') }}"
                            placeholder="Contoh: -7.556"
                            inputmode="decimal"
                            style="width:100%; padding:10px 12px; border:1.5px solid {{ $errors->has('latitude') ? '#EF4444' : '#D1D5DB' }}; border-radius:8px; font-size:13px; color:#1E293B; outline:none; box-sizing:border-box;"
                            onfocus="this.style.borderColor='#3B82F6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.12)'"
                            onblur="this.style.borderColor='{{ $errors->has('latitude') ? '#EF4444' : '#D1D5DB' }}'; this.style.boxShadow='none'">
                        @error('latitude')
                            <p style="margin:5px 0 0; font-size:11px; color:#EF4444;">⚠ {{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="longitude" style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:6px;">
                            Longitude <span style="color:#EF4444;">*</span>
                        </label>
                        <input type="text" id="longitude" name="longitude"
                            value="{{ old('longitude') }}"
                            placeholder="Contoh: 110.823"
                            inputmode="decimal"
                            style="width:100%; padding:10px 12px; border:1.5px solid {{ $errors->has('longitude') ? '#EF4444' : '#D1D5DB' }}; border-radius:8px; font-size:13px; color:#1E293B; outline:none; box-sizing:border-box;"
                            onfocus="this.style.borderColor='#3B82F6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.12)'"
                            onblur="this.style.borderColor='{{ $errors->has('longitude') ? '#EF4444' : '#D1D5DB' }}'; this.style.boxShadow='none'">
                        @error('longitude')
                            <p style="margin:5px 0 0; font-size:11px; color:#EF4444;">⚠ {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Radius --}}
                <div>
                    <label for="radius" style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:6px;">
                        Radius Absensi <span style="color:#EF4444;">*</span>
                        <span style="font-size:11px; font-weight:400; color:#94A3B8;">(meter)</span>
                    </label>
                    <div style="position:relative; max-width:200px;">
                        <input type="number" id="radius" name="radius"
                            value="{{ old('radius') }}"
                            placeholder="Contoh: 100"
                            min="10" max="5000" step="10"
                            style="width:100%; padding:10px 40px 10px 12px; border:1.5px solid {{ $errors->has('radius') ? '#EF4444' : '#D1D5DB' }}; border-radius:8px; font-size:13px; color:#1E293B; outline:none; box-sizing:border-box;"
                            onfocus="this.style.borderColor='#3B82F6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.12)'"
                            onblur="this.style.borderColor='{{ $errors->has('radius') ? '#EF4444' : '#D1D5DB' }}'; this.style.boxShadow='none'">
                        <span style="position:absolute; right:10px; top:50%; transform:translateY(-50%); font-size:11px; color:#94A3B8; pointer-events:none;">m</span>
                    </div>
                    <p style="margin:5px 0 0; font-size:11px; color:#94A3B8;">Jarak maksimum (10–5000 m) untuk validasi kehadiran.</p>
                    @error('radius')
                        <p style="margin:3px 0 0; font-size:11px; color:#EF4444;">⚠ {{ $message }}</p>
                    @enderror
                </div>

            </div>{{-- end seksi 2 --}}

            {{-- ── SEKSI 3: KONTAK ── --}}
            <div style="margin-bottom:28px;">
                <div style="display:flex; align-items:center; gap:8px; margin-bottom:16px; padding-bottom:10px; border-bottom:1px solid #F1F5F9;">
                    <span style="width:28px; height:28px; border-radius:8px; background:#FFF7ED; color:#EA580C; font-size:13px; font-weight:700; display:flex; align-items:center; justify-content:center;">3</span>
                    <h2 style="font-size:14px; font-weight:700; color:#0F172A; margin:0;">Kontak</h2>
                </div>

                <div>
                    <label for="no_telepon" style="display:block; font-size:12px; font-weight:600; color:#374151; margin-bottom:6px;">Nomor Telepon</label>
                    <div style="display:flex; align-items:stretch; max-width:320px;">
                        <span style="display:flex; align-items:center; padding:0 10px; background:#F8FAFC; border:1.5px solid #D1D5DB; border-right:none; border-radius:8px 0 0 8px; font-size:13px; color:#64748B;">📞</span>
                        <input type="tel" id="no_telepon" name="no_telepon"
                            value="{{ old('no_telepon') }}"
                            placeholder="0857-6452-0024"
                            autocomplete="tel"
                            style="flex:1; padding:10px 12px; border:1.5px solid #D1D5DB; border-left:none; border-radius:0 8px 8px 0; font-size:13px; color:#1E293B; outline:none; box-sizing:border-box;"
                            onfocus="this.style.borderColor='#3B82F6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.12)'"
                            onblur="this.style.borderColor='#D1D5DB'; this.style.boxShadow='none'">
                    </div>
                    @error('no_telepon')
                        <p style="margin:5px 0 0; font-size:11px; color:#EF4444;">⚠ {{ $message }}</p>
                    @enderror
                </div>
            </div>{{-- end seksi 3 --}}

            {{-- TOMBOL AKSI --}}
            <div style="display:flex; align-items:center; gap:12px; padding-top:20px; border-top:1px solid #F1F5F9;">
                <button type="submit" id="submitBtn"
                    style="display:flex; align-items:center; gap:8px; background:#2563EB; color:white; border:none; padding:11px 24px; border-radius:9px; font-size:13px; font-weight:600; cursor:pointer; box-shadow:0 1px 3px rgba(37,99,235,0.3);"
                    onmouseover="this.style.background='#1D4ED8'; this.style.boxShadow='0 4px 12px rgba(37,99,235,0.4)'"
                    onmouseout="this.style.background='#2563EB'; this.style.boxShadow='0 1px 3px rgba(37,99,235,0.3)'">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none"><path d="M13.5 4.5L6 12 2.5 8.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Simpan Sekolah
                </button>
                <span id="savingIndicator" style="display:none; font-size:12px; color:#64748B; align-items:center; gap:6px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" style="animation:spin 1s linear infinite;"><circle cx="12" cy="12" r="10" stroke="#CBD5E1" stroke-width="3" fill="none"/><path d="M12 2a10 10 0 0 1 10 10" stroke="#2563EB" stroke-width="3" fill="none" stroke-linecap="round"/></svg>
                    Menyimpan…
                </span>
            </div>

        </div>
        </form>
    </div>

    {{-- TIPS --}}
    <div style="margin-top:16px; max-width:760px; display:flex; align-items:flex-start; gap:10px; background:#F8FAFC; border:1px solid #E2E8F0; border-radius:10px; padding:12px 16px;">
        <span style="font-size:16px; flex-shrink:0;">💡</span>
        <div style="font-size:12px; color:#475569; line-height:1.6;">
            <strong style="color:#1E293B;">Tips:</strong>
            Untuk mendapatkan koordinat sekolah, buka
            <a href="https://maps.google.com" target="_blank" rel="noopener" style="color:#2563EB; font-weight:500;">Google Maps</a>,
            klik kanan pada lokasi sekolah, lalu salin angka koordinat yang muncul (Latitude, Longitude).
        </div>
    </div>

</div>
</div>

<style>
@keyframes spin { to { transform: rotate(360deg); } }
</style>

<script>
document.getElementById('schoolForm').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    const indicator = document.getElementById('savingIndicator');
    btn.disabled = true;
    btn.style.opacity = '0.6';
    btn.style.cursor = 'not-allowed';
    indicator.style.display = 'flex';
});

document.getElementById('npsn').addEventListener('input', function() {
    this.value = this.value.replace(/\D/g, '').slice(0, 8);
});

['latitude','longitude'].forEach(function(id) {
    document.getElementById(id).addEventListener('blur', function() {
        const val = parseFloat(this.value);
        if (this.value && isNaN(val)) {
            this.style.borderColor = '#EF4444';
            let hint = this.parentElement.querySelector('.coord-hint');
            if (!hint) {
                hint = document.createElement('p');
                hint.className = 'coord-hint';
                hint.style = 'margin:5px 0 0; font-size:11px; color:#EF4444;';
                this.parentElement.appendChild(hint);
            }
            hint.textContent = '⚠ Format tidak valid. Gunakan angka desimal, contoh: -7.556';
        } else {
            this.style.borderColor = '#D1D5DB';
            const hint = this.parentElement.querySelector('.coord-hint');
            if (hint) hint.remove();
        }
    });
});

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

</x-app-layout>