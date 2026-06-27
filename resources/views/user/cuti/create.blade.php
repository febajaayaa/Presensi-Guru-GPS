<x-app-layout>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

@php $user = auth()->user(); @endphp

<div style="display:flex; min-height:100vh; background:#F0F4F8; font-family:'Inter',sans-serif;">

{{-- ═══════════ SIDEBAR ═══════════ --}}
<aside style="width:220px; min-width:220px; background:#1E3A8A; position:fixed; top:0; left:0; height:100vh; display:flex; flex-direction:column; z-index:50; box-shadow:4px 0 16px rgba(0,0,0,0.12);">

    <div style="padding:20px 14px 12px; border-bottom:1px solid rgba(255,255,255,0.08);">
        <a href="{{ route('pengaturan') }}" style="display:flex; align-items:center; gap:10px; padding:10px; border-radius:10px; text-decoration:none; background:rgba(255,255,255,0.06);"
           onmouseover="this.style.background='rgba(255,255,255,0.12)'" onmouseout="this.style.background='rgba(255,255,255,0.06)'">
            <img src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://i.pravatar.cc/50' }}"
                 style="width:38px; height:38px; border-radius:50%; object-fit:cover; border:2px solid rgba(255,255,255,0.3); flex-shrink:0;" alt="Foto profil">
            <div style="overflow:hidden;">
                <div style="font-size:13px; font-weight:600; color:#F1F5F9; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $user->name }}</div>
                <div style="font-size:11px; color:rgba(255,255,255,0.5); margin-top:1px;">{{ ucfirst($user->role ?? 'Guru') }}</div>
            </div>
        </a>
    </div>

    <nav style="flex:1; padding:10px 12px; overflow-y:auto;">
        <div style="font-size:9px; color:rgba(255,255,255,0.35); letter-spacing:0.1em; text-transform:uppercase; padding:8px 8px 6px;">Menu</div>
        @php
        $navItems = [
            ['route' => 'dashboard',  'icon' => 'ti-layout-dashboard', 'label' => 'Beranda'],
            ['route' => 'izin.form',  'icon' => 'ti-file-text',        'label' => 'Izin'],
            ['route' => 'cuti.index', 'icon' => 'ti-calendar-off',     'label' => 'Cuti'],
            ['route' => 'history',    'icon' => 'ti-history',          'label' => 'Riwayat'],
            ['route' => 'pengaturan', 'icon' => 'ti-settings',         'label' => 'Pengaturan'],
        ];
        @endphp
        @foreach($navItems as $item)
        @php $active = request()->routeIs($item['route']); @endphp
        <a href="{{ route($item['route']) }}"
           style="display:flex; align-items:center; gap:9px; padding:9px 10px; border-radius:8px; font-size:13px; text-decoration:none; margin-bottom:2px;
                  border-left:2px solid {{ $active ? '#60A5FA' : 'transparent' }};
                  background:{{ $active ? 'rgba(255,255,255,0.15)' : 'transparent' }};
                  color:{{ $active ? '#fff' : 'rgba(255,255,255,0.65)' }}; font-weight:{{ $active ? '600' : '400' }};"
           onmouseover="this.style.background='rgba(255,255,255,0.1)';this.style.color='#fff'"
           onmouseout="this.style.background='{{ $active ? 'rgba(255,255,255,0.15)' : 'transparent' }}';this.style.color='{{ $active ? '#fff' : 'rgba(255,255,255,0.65)' }}'">
            <i class="ti {{ $item['icon'] }}" style="font-size:16px; width:18px; text-align:center; flex-shrink:0;"></i>
            {{ $item['label'] }}
        </a>
        @endforeach
    </nav>

    <div style="padding:12px 14px; border-top:1px solid rgba(255,255,255,0.08);">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    style="width:100%; background:rgba(239,68,68,0.15); color:#FCA5A5; border:1px solid rgba(239,68,68,0.3); padding:9px; border-radius:8px; font-size:13px; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:6px;"
                    onmouseover="this.style.background='rgba(239,68,68,0.28)'" onmouseout="this.style.background='rgba(239,68,68,0.15)'">
                <i class="ti ti-logout" style="font-size:15px;"></i> Keluar
            </button>
        </form>
    </div>
</aside>

{{-- ═══════════ MAIN ═══════════ --}}
<main style="flex:1; margin-left:220px; min-height:100vh; display:flex; flex-direction:column;">

    {{-- Top Bar --}}
    <div style="background:white; border-bottom:1px solid #E2E8F0; padding:10px 24px; display:flex; align-items:center; justify-content:flex-end; position:sticky; top:0; z-index:40; box-shadow:0 1px 3px rgba(0,0,0,0.04);">
        <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:6px 14px; border-radius:8px; font-size:12px; color:#475569; display:flex; align-items:center; gap:6px;">
            <i class="ti ti-calendar" style="color:#3B82F6; font-size:14px;"></i>
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    {{-- Content --}}
    <div style="padding:28px 32px; flex:1;">

        {{-- Page Header --}}
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px;">
            <div>
                <div style="display:flex; align-items:center; gap:8px; margin-bottom:4px;">
                    <a href="{{ route('cuti.index') }}" style="color:#64748B; font-size:13px; text-decoration:none; display:flex; align-items:center; gap:4px;"
                       onmouseover="this.style.color='#1D4ED8'" onmouseout="this.style.color='#64748B'">
                        <i class="ti ti-arrow-left" style="font-size:14px;"></i> Kembali
                    </a>
                    <span style="color:#CBD5E1; font-size:13px;">/</span>
                    <span style="color:#1D4ED8; font-size:13px; font-weight:500;">Form Cuti</span>
                </div>
                <h1 style="font-size:20px; font-weight:700; color:#0F172A; margin:0;">Ajukan Cuti</h1>
                <p style="font-size:13px; color:#64748B; margin:4px 0 0;">Isi data pengajuan cuti dengan lengkap dan benar.</p>
            </div>

            {{-- Info badge --}}
            <div style="background:#EFF6FF; border:1px solid #BFDBFE; border-radius:10px; padding:10px 16px; display:flex; align-items:center; gap:8px;">
                <i class="ti ti-info-circle" style="color:#2563EB; font-size:18px;"></i>
                <div>
                    <div style="font-size:11px; font-weight:600; color:#1D4ED8;">Perlu Persetujuan</div>
                    <div style="font-size:11px; color:#60A5FA;">Diproses oleh admin sekolah</div>
                </div>
            </div>
        </div>

        {{-- Alert --}}
        @if(session('success'))
        <div style="background:#F0FDF4; border:1px solid #86EFAC; border-radius:10px; padding:12px 16px; margin-bottom:20px; display:flex; align-items:center; gap:10px;">
            <i class="ti ti-circle-check" style="color:#16A34A; font-size:18px; flex-shrink:0;"></i>
            <span style="font-size:13px; color:#166534;">{{ session('success') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div style="background:#FEF2F2; border:1px solid #FCA5A5; border-radius:10px; padding:12px 16px; margin-bottom:20px; display:flex; align-items:flex-start; gap:10px;">
            <i class="ti ti-alert-circle" style="color:#DC2626; font-size:18px; flex-shrink:0; margin-top:1px;"></i>
            <ul style="margin:0; padding-left:16px; font-size:13px; color:#991B1B;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div style="display:grid; grid-template-columns:1fr 300px; gap:20px; align-items:start;">

            {{-- ── FORM CARD ── --}}
            <div style="background:white; border-radius:16px; border:1px solid #E2E8F0; overflow:hidden; box-shadow:0 1px 4px rgba(0,0,0,0.05);">

                {{-- Card Header --}}
                <div style="background:linear-gradient(135deg,#1D4ED8,#0EA5E9); padding:20px 24px; display:flex; align-items:center; gap:12px;">
                    <div style="width:40px; height:40px; background:rgba(255,255,255,0.15); border-radius:10px; display:flex; align-items:center; justify-content:center;">
                        <i class="ti ti-calendar-off" style="font-size:20px; color:white;"></i>
                    </div>
                    <div>
                        <div style="font-size:15px; font-weight:700; color:white;">Form Pengajuan Cuti</div>
                        <div style="font-size:12px; color:rgba(255,255,255,0.75); margin-top:2px;">Lengkapi semua field yang tersedia</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('cuti.store') }}" style="padding:24px;">
                    @csrf

                    {{-- Jenis Cuti --}}
                    <div style="margin-bottom:20px;">
                        <label style="display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:6px;">
                            <i class="ti ti-tag" style="font-size:13px; color:#6B7280; margin-right:4px;"></i>
                            Jenis Cuti <span style="color:#DC2626;">*</span>
                        </label>
                        <select name="jenis_cuti"
                                style="width:100%; border:1px solid #D1D5DB; border-radius:8px; padding:10px 12px; font-size:13px; color:#374151; background:white; outline:none; appearance:none; background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E\"); background-repeat:no-repeat; background-position:right 12px center;"
                                onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none'"
                                required>
                            <option value="" disabled selected>Pilih jenis cuti...</option>
                            <option value="cuti_umum">Cuti Umum</option>
                            <option value="cuti_khusus">Cuti Khusus</option>
                            <option value="cuti_tambahan">Cuti Tambahan</option>
                            <option value="cuti_melahirkan">Cuti Melahirkan</option>
                            <option value="cuti_sakit">Cuti Sakit</option>
                        </select>
                        <p style="font-size:11px; color:#9CA3AF; margin-top:5px;">
                            <i class="ti ti-info-circle" style="font-size:11px;"></i>
                            Pilih jenis cuti sesuai kebutuhan Anda
                        </p>
                    </div>

                    {{-- Tanggal Mulai & Selesai (sejajar) --}}
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:20px;">
                        <div>
                            <label style="display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:6px;">
                                <i class="ti ti-calendar-plus" style="font-size:13px; color:#6B7280; margin-right:4px;"></i>
                                Tanggal Mulai <span style="color:#DC2626;">*</span>
                            </label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                                   value="{{ old('tanggal_mulai') }}"
                                   style="width:100%; border:1px solid #D1D5DB; border-radius:8px; padding:10px 12px; font-size:13px; color:#374151; outline:none; box-sizing:border-box;"
                                   onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                   onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none'"
                                   onchange="hitungDurasi()"
                                   required>
                            <p style="font-size:11px; color:#9CA3AF; margin-top:5px;">
                                <i class="ti ti-info-circle" style="font-size:11px;"></i>
                                Hari pertama cuti
                            </p>
                        </div>
                        <div>
                            <label style="display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:6px;">
                                <i class="ti ti-calendar-minus" style="font-size:13px; color:#6B7280; margin-right:4px;"></i>
                                Tanggal Selesai <span style="color:#DC2626;">*</span>
                            </label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                                   value="{{ old('tanggal_selesai') }}"
                                   style="width:100%; border:1px solid #D1D5DB; border-radius:8px; padding:10px 12px; font-size:13px; color:#374151; outline:none; box-sizing:border-box;"
                                   onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                   onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none'"
                                   onchange="hitungDurasi()"
                                   required>
                            <p style="font-size:11px; color:#9CA3AF; margin-top:5px;">
                                <i class="ti ti-info-circle" style="font-size:11px;"></i>
                                Hari terakhir cuti
                            </p>
                        </div>
                    </div>

                    {{-- Info Durasi (muncul otomatis) --}}
                    <div id="info-durasi" style="display:none; background:#EFF6FF; border:1px solid #BFDBFE; border-radius:8px; padding:10px 14px; margin-bottom:20px; display:none; align-items:center; gap:8px;">
                        <i class="ti ti-clock" style="color:#2563EB; font-size:16px; flex-shrink:0;"></i>
                        <span id="teks-durasi" style="font-size:13px; color:#1D4ED8; font-weight:500;"></span>
                    </div>

                    {{-- Alasan --}}
                    <div style="margin-bottom:20px;">
                        <label style="display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:6px;">
                            <i class="ti ti-message" style="font-size:13px; color:#6B7280; margin-right:4px;"></i>
                            Alasan Pengajuan <span style="color:#DC2626;">*</span>
                        </label>
                        <textarea name="alasan"
                                  style="width:100%; border:1px solid #D1D5DB; border-radius:8px; padding:10px 12px; font-size:13px; color:#374151; outline:none; resize:vertical; min-height:110px; box-sizing:border-box;"
                                  onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                  onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none'"
                                  placeholder="Tuliskan alasan pengajuan cuti secara jelas dan lengkap..."
                                  required>{{ old('alasan') }}</textarea>
                        <p style="font-size:11px; color:#9CA3AF; margin-top:5px;">
                            <i class="ti ti-info-circle" style="font-size:11px;"></i>
                            Alasan yang jelas akan mempercepat proses persetujuan
                        </p>
                    </div>

                    {{-- Keterangan Tambahan --}}
                    <div style="margin-bottom:24px;">
                        <label style="display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:6px;">
                            <i class="ti ti-notes" style="font-size:13px; color:#6B7280; margin-right:4px;"></i>
                            Keterangan Tambahan <span style="color:#9CA3AF; font-size:11px; font-weight:400;">(opsional)</span>
                        </label>
                        <textarea name="keterangan"
                                  style="width:100%; border:1px solid #D1D5DB; border-radius:8px; padding:10px 12px; font-size:13px; color:#374151; outline:none; resize:vertical; min-height:70px; box-sizing:border-box;"
                                  onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                  onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none'"
                                  placeholder="Informasi tambahan yang perlu diketahui admin (jika ada)...">{{ old('keterangan') }}</textarea>
                    </div>

                    {{-- Buttons --}}
                    <div style="display:flex; align-items:center; justify-content:flex-end; gap:10px; border-top:1px solid #F1F5F9; padding-top:20px;">
                        <a href="{{ route('cuti.index') }}"
                           style="padding:10px 20px; border-radius:8px; font-size:13px; font-weight:500; color:#64748B; border:1px solid #E2E8F0; text-decoration:none; background:white;"
                           onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='white'">
                            Batal
                        </a>
                        <button type="submit"
                                style="padding:10px 24px; border-radius:8px; font-size:13px; font-weight:600; color:white; background:#2563EB; border:none; cursor:pointer; display:flex; align-items:center; gap:6px;"
                                onmouseover="this.style.background='#1D4ED8'" onmouseout="this.style.background='#2563EB'">
                            <i class="ti ti-send" style="font-size:14px;"></i>
                            Kirim Pengajuan
                        </button>
                    </div>
                </form>
            </div>

            {{-- ── PANEL KANAN: Icon Buttons ── --}}
<div style="display:flex; flex-direction:column; gap:12px; position:sticky; top:72px;">


    {{-- Panduan --}}
                <div style="position:relative;">
                    <button onclick="togglePanel('panduan')"
                            title="Panduan Pengajuan"
                            style="width:52px; height:52px; border-radius:14px; background:white; border:1px solid #E2E8F0; box-shadow:0 1px 4px rgba(0,0,0,0.06); display:flex; align-items:center; justify-content:center; cursor:pointer; transition:all 0.2s;"
                            onmouseover="this.style.background='#EFF6FF';this.style.borderColor='#BFDBFE'"
                            onmouseout="this.style.background='white';this.style.borderColor='#E2E8F0'">
                        <i class="ti ti-list-check" style="font-size:22px; color:#2563EB;"></i>
                    </button>

                    {{-- Flyout --}}
                    <div id="panel-panduan"
                         style="display:none; position:absolute; right:62px; top:0; width:280px; background:white; border-radius:14px; border:1px solid #E2E8F0; box-shadow:0 8px 24px rgba(0,0,0,0.1); z-index:100; overflow:hidden;">
                        <div style="background:linear-gradient(135deg,#2563EB,#3B82F6); padding:14px 16px; display:flex; align-items:center; gap:8px;">
                            <i class="ti ti-list-check" style="font-size:18px; color:white;"></i>
                            <span style="font-size:13px; font-weight:700; color:white;">Panduan Pengajuan</span>
                        </div>
                        <div style="padding:14px 16px; display:flex; flex-direction:column; gap:10px;">
                            @foreach([
                                ['icon'=>'ti-clock',       'color'=>'#16A34A','bg'=>'#F0FDF4','text'=>'Ajukan cuti sebelum atau di hari yang sama'],
                                ['icon'=>'ti-user-check',  'color'=>'#2563EB','bg'=>'#EFF6FF','text'=>'Persetujuan dilakukan oleh admin sekolah'],
                                ['icon'=>'ti-bell',        'color'=>'#D97706','bg'=>'#FFFBEB','text'=>'Cek status pengajuan di menu Riwayat'],
                                ['icon'=>'ti-file-check',  'color'=>'#7C3AED','bg'=>'#F5F3FF','text'=>'Isi alasan dengan jelas agar cepat diproses'],
                            ] as $tip)
                            <div style="display:flex; align-items:flex-start; gap:10px;">
                                <div style="width:30px; height:30px; background:{{ $tip['bg'] }}; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                    <i class="ti {{ $tip['icon'] }}" style="font-size:14px; color:{{ $tip['color'] }};"></i>
                                </div>
                                <p style="font-size:12px; color:#475569; margin:0; line-height:1.6; padding-top:5px;">{{ $tip['text'] }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Jenis Cuti --}}
                <div style="position:relative;">
                    <button onclick="togglePanel('jenis')"
                            title="Jenis Cuti"
                            style="width:52px; height:52px; border-radius:14px; background:white; border:1px solid #E2E8F0; box-shadow:0 1px 4px rgba(0,0,0,0.06); display:flex; align-items:center; justify-content:center; cursor:pointer; transition:all 0.2s;"
                            onmouseover="this.style.background='#F5F3FF';this.style.borderColor='#DDD6FE'"
                            onmouseout="this.style.background='white';this.style.borderColor='#E2E8F0'">
                        <i class="ti ti-tag" style="font-size:22px; color:#7C3AED;"></i>
                    </button>

                    <div id="panel-jenis"
                         style="display:none; position:absolute; right:62px; top:0; width:280px; background:white; border-radius:14px; border:1px solid #E2E8F0; box-shadow:0 8px 24px rgba(0,0,0,0.1); z-index:100; overflow:hidden;">
                        <div style="background:linear-gradient(135deg,#6D28D9,#7C3AED); padding:14px 16px; display:flex; align-items:center; gap:8px;">
                            <i class="ti ti-tag" style="font-size:18px; color:white;"></i>
                            <span style="font-size:13px; font-weight:700; color:white;">Jenis Cuti</span>
                        </div>
                        <div style="padding:12px 14px; display:flex; flex-direction:column; gap:7px;">
                            @foreach([
                            ['label'=>'Cuti Umum',      'desc'=>'Keperluan pribadi & keluarga'],
                            ['label'=>'Cuti Khusus',    'desc'=>'Kegiatan resmi/tugas dinas'],
                            ['label'=>'Cuti Tambahan',  'desc'=>'Perpanjangan cuti yang ada'],
                            ['label'=>'Cuti Melahirkan','desc'=>'Hak cuti bagi ibu melahirkan'],
                            ['label'=>'Cuti Sakit',     'desc'=>'Pemulihan kondisi kesehatan'],
                        ] as $jenis)
                            <div style="display:flex; align-items:center; gap:10px; padding:8px 10px; background:#F8FAFC; border-radius:8px;">
                                <div style="width:30px; height:30px; }}; border-radius:7px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                    
                                </div>
                                <div>
                                    <div style="font-size:12px; font-weight:600; color:#374151;">{{ $jenis['label'] }}</div>
                                    <div style="font-size:11px; color:#94A3B8; margin-top:1px;">{{ $jenis['desc'] }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

    {{-- Status Pengajuan --}}
                <div style="position:relative;">
                    <button onclick="togglePanel('status')"
                            title="Status Pengajuan"
                            style="width:52px; height:52px; border-radius:14px; background:white; border:1px solid #E2E8F0; box-shadow:0 1px 4px rgba(0,0,0,0.06); display:flex; align-items:center; justify-content:center; cursor:pointer; transition:all 0.2s;"
                            onmouseover="this.style.background='#FFFBEB';this.style.borderColor='#FDE68A'"
                            onmouseout="this.style.background='white';this.style.borderColor='#E2E8F0'">
                        <i class="ti ti-radar" style="font-size:22px; color:#D97706;"></i>
                    </button>

                    <div id="panel-status"
                         style="display:none; position:absolute; right:62px; top:0; width:280px; background:white; border-radius:14px; border:1px solid #E2E8F0; box-shadow:0 8px 24px rgba(0,0,0,0.1); z-index:100; overflow:hidden;">
                        <div style="background:linear-gradient(135deg,#B45309,#D97706); padding:14px 16px; display:flex; align-items:center; gap:8px;">
                            <i class="ti ti-radar" style="font-size:18px; color:white;"></i>
                            <span style="font-size:13px; font-weight:700; color:white;">Status Pengajuan</span>
                        </div>
                        <div style="padding:12px 14px; display:flex; flex-direction:column; gap:8px;">
                            @foreach([
                                ['dot'=>'#F59E0B','bg'=>'#FFFBEB','label'=>'Pending',   'tc'=>'#92400E','desc'=>'Pengajuan sedang menunggu review dari admin sekolah.'],
                                ['dot'=>'#16A34A','bg'=>'#F0FDF4','label'=>'Disetujui', 'tc'=>'#166534','desc'=>'Izin disetujui, Anda dapat tidak hadir pada tanggal tersebut.'],
                                ['dot'=>'#DC2626','bg'=>'#FEF2F2','label'=>'Ditolak',   'tc'=>'#991B1B','desc'=>'Izin tidak disetujui. Silakan hubungi admin untuk informasi lebih lanjut.'],
                            ] as $st)
                            <div style="background:{{ $st['bg'] }}; border-radius:9px; padding:10px 12px;">
                                <div style="display:flex; align-items:center; gap:7px; margin-bottom:5px;">
                                    <span style="width:9px; height:9px; background:{{ $st['dot'] }}; border-radius:50%; flex-shrink:0;"></span>
                                    <span style="font-size:13px; font-weight:600; color:{{ $st['tc'] }};">{{ $st['label'] }}</span>
                                </div>
                                <p style="font-size:11px; color:#64748B; margin:0; line-height:1.6; padding-left:16px;">{{ $st['desc'] }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
    


<script>
function togglePanel(id) {
    const panels = ['panduan','jenis','status'];

    panels.forEach(panel => {
        const el = document.getElementById('panel-' + panel);

        if (!el) return;

        if(panel === id){
            el.style.display =
                el.style.display === 'block'
                ? 'none'
                : 'block';
        } else {
            el.style.display = 'none';
        }
    });
}

document.addEventListener('click', function(e){

    if(
        !e.target.closest('[onclick*="togglePanel"]')
        &&
        !e.target.closest('[id^="panel-"]')
    ){
        ['panduan','jenis','status'].forEach(panel=>{
            let el=document.getElementById('panel-'+panel);
            if(el) el.style.display='none';
        });
    }

});

</script>
</div>
</x-app-layout>