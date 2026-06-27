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
                <div style="display:flex; align-items:center; gap:6px; margin-bottom:6px; font-size:12px; color:#94A3B8;">
                    <a href="{{ route('izin.form') }}" style="color:#3B82F6; text-decoration:none; display:flex; align-items:center; gap:4px;"
                       onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                        <i class="ti ti-file-text" style="font-size:13px;"></i> Riwayat Izin
                    </a>
                    <i class="ti ti-chevron-right" style="font-size:12px;"></i>
                    <span style="color:#64748B; font-weight:500;">Ajukan Izin</span>
                </div>
                <h1 style="font-size:20px; font-weight:700; color:#0F172A; margin:0; display:flex; align-items:center; gap:8px;">
                    <i class="ti ti-file-plus" style="font-size:22px; color:#3B82F6;"></i> Ajukan Izin
                </h1>
                <p style="font-size:13px; color:#64748B; margin:4px 0 0;">Isi form berikut dengan data yang akurat dan benar.</p>
            </div>

            <div style="background:#EFF6FF; border:1px solid #BFDBFE; border-radius:10px; padding:10px 16px; display:flex; align-items:center; gap:8px;">
                <i class="ti ti-shield-check" style="color:#2563EB; font-size:18px;"></i>
                <div>
                    <div style="font-size:11px; font-weight:600; color:#1D4ED8;">Perlu Persetujuan</div>
                    <div style="font-size:11px; color:#60A5FA;">Diproses oleh admin sekolah</div>
                </div>
            </div>
        </div>

        {{-- Alerts --}}
        @if(session('success'))
        <div style="display:flex; align-items:center; gap:10px; background:#F0FDF4; border:1px solid #BBF7D0; border-left:4px solid #22C55E; border-radius:10px; padding:12px 16px; margin-bottom:16px;">
            <i class="ti ti-circle-check" style="font-size:18px; color:#16A34A; flex-shrink:0;"></i>
            <span style="font-size:13px; font-weight:500; color:#166534;">{{ session('success') }}</span>
        </div>
        @endif
        @if(session('error'))
        <div style="display:flex; align-items:center; gap:10px; background:#FEF2F2; border:1px solid #FECACA; border-left:4px solid #EF4444; border-radius:10px; padding:12px 16px; margin-bottom:16px;">
            <i class="ti ti-alert-triangle" style="font-size:18px; color:#DC2626; flex-shrink:0;"></i>
            <span style="font-size:13px; font-weight:500; color:#B91C1C;">{{ session('error') }}</span>
        </div>
        @endif
        @if($errors->any())
        <div style="display:flex; align-items:flex-start; gap:10px; background:#FEF2F2; border:1px solid #FECACA; border-left:4px solid #EF4444; border-radius:10px; padding:12px 16px; margin-bottom:16px;">
            <i class="ti ti-alert-triangle" style="font-size:18px; color:#DC2626; flex-shrink:0; margin-top:1px;"></i>
            <ul style="font-size:13px; font-weight:500; color:#B91C1C; margin:0; padding-left:16px;">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
        @endif

        {{-- Two-column layout --}}
        <div style="display:grid; grid-template-columns:1fr 72px; gap:20px; align-items:start;">

            {{-- ── FORM CARD ── --}}
            <div style="background:white; border-radius:16px; border:1px solid #E2E8F0; overflow:hidden; box-shadow:0 1px 4px rgba(0,0,0,0.05);">

                <div style="background:linear-gradient(135deg,#2563EB,#3B82F6); padding:20px 24px; display:flex; align-items:center; gap:12px;">
                    <div style="width:40px; height:40px; background:rgba(255,255,255,0.15); border-radius:10px; display:flex; align-items:center; justify-content:center;">
                        <i class="ti ti-clipboard-text" style="font-size:20px; color:white;"></i>
                    </div>
                    <div>
                        <div style="font-size:15px; font-weight:700; color:white;">Form Pengajuan Izin</div>
                        <div style="font-size:12px; color:rgba(255,255,255,0.75); margin-top:2px;">Lengkapi semua field yang tersedia</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('izin.store') }}" style="padding:24px;">
                    @csrf

                    {{-- Jenis Izin --}}
                    <div style="margin-bottom:20px;">
                        <label style="display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:6px;">
                            <i class="ti ti-tag" style="font-size:13px; color:#6B7280; margin-right:4px;"></i>
                            Jenis Izin <span style="color:#DC2626;">*</span>
                        </label>
                        <div style="position:relative;">
                            <select name="status" required
                                    style="width:100%; padding:10px 36px 10px 12px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; color:#374151; background:white; outline:none; appearance:none; box-sizing:border-box; background-image:url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E\"); background-repeat:no-repeat; background-position:right 12px center;"
                                    onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                    onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none'">
                                <option value="" disabled selected>Pilih jenis izin...</option>
                                <option value="izin_sakit"    {{ old('status')=='izin_sakit'    ? 'selected':'' }}>Izin Sakit</option>
                                <option value="izin_keluarga" {{ old('status')=='izin_keluarga' ? 'selected':'' }}>Izin Keluarga</option>
                                <option value="izin_dinas"    {{ old('status')=='izin_dinas'    ? 'selected':'' }}>Izin Dinas / Tugas</option>
                                <option value="izin_pribadi"  {{ old('status')=='izin_pribadi'  ? 'selected':'' }}>Izin Keperluan Pribadi</option>
                                <option value="izin_lainnya"  {{ old('status')=='izin_lainnya'  ? 'selected':'' }}>Lainnya</option>
                            </select>
                        </div>
                        <p style="font-size:11px; color:#9CA3AF; margin-top:5px;">
                            <i class="ti ti-info-circle" style="font-size:11px;"></i>
                            Pilih jenis izin yang sesuai dengan kebutuhan Anda
                        </p>
                    </div>

                    {{-- Tanggal sejajar --}}
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:6px;">
                        <div>
                            <label style="display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:6px;">
                                <i class="ti ti-calendar-plus" style="font-size:13px; color:#6B7280; margin-right:4px;"></i>
                                Tanggal Mulai <span style="color:#DC2626;">*</span>
                            </label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" required
                                   value="{{ old('tanggal_mulai', now()->toDateString()) }}"
                                   min="{{ now()->toDateString() }}"
                                   style="width:100%; padding:10px 12px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; color:#374151; outline:none; box-sizing:border-box;"
                                   onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                   onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none'"
                                   onchange="hitungDurasi()">
                            <p style="font-size:11px; color:#9CA3AF; margin-top:5px;">
                                <i class="ti ti-info-circle" style="font-size:11px;"></i> Hari pertama izin
                            </p>
                        </div>
                        <div>
                            <label style="display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:6px;">
                                <i class="ti ti-calendar-minus" style="font-size:13px; color:#6B7280; margin-right:4px;"></i>
                                Tanggal Selesai
                            </label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                                   value="{{ old('tanggal_selesai', now()->toDateString()) }}"
                                   min="{{ now()->toDateString() }}"
                                   style="width:100%; padding:10px 12px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; color:#374151; outline:none; box-sizing:border-box;"
                                   onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                   onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none'"
                                   onchange="hitungDurasi()">
                            <p style="font-size:11px; color:#9CA3AF; margin-top:5px;">
                                <i class="ti ti-info-circle" style="font-size:11px;"></i> Kosongkan jika hanya 1 hari
                            </p>
                        </div>
                    </div>

                    {{-- Durasi otomatis --}}
                    <div id="info-durasi" style="display:none; align-items:center; gap:8px; background:#EFF6FF; border:1px solid #BFDBFE; border-radius:8px; padding:10px 14px; margin-bottom:20px;">
                        <i class="ti ti-clock" style="color:#2563EB; font-size:15px; flex-shrink:0;"></i>
                        <span id="teks-durasi" style="font-size:12px; color:#1D4ED8; font-weight:500;"></span>
                    </div>

                    {{-- Alasan --}}
                    <div style="margin-bottom:20px;">
                        <label style="display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:6px;">
                            <i class="ti ti-message" style="font-size:13px; color:#6B7280; margin-right:4px;"></i>
                            Alasan / Keterangan <span style="color:#DC2626;">*</span>
                        </label>
                        <textarea name="keterangan" rows="4" maxlength="1000" required
                                  placeholder="Jelaskan alasan izin Anda secara singkat dan jelas..."
                                  style="width:100%; padding:10px 12px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; color:#374151; resize:vertical; box-sizing:border-box; outline:none; font-family:inherit; line-height:1.5;"
                                  onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                  onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none'">{{ old('keterangan') }}</textarea>
                        <p style="font-size:11px; color:#9CA3AF; margin-top:5px;">
                            <i class="ti ti-info-circle" style="font-size:11px;"></i>
                            Alasan yang jelas akan mempercepat proses persetujuan
                        </p>
                    </div>

                    {{-- Keterangan Tambahan --}}
                    <div style="margin-bottom:24px;">
                        <label style="display:block; font-size:13px; font-weight:600; color:#374151; margin-bottom:6px;">
                            <i class="ti ti-notes" style="font-size:13px; color:#6B7280; margin-right:4px;"></i>
                            Keterangan Tambahan
                            <span style="color:#9CA3AF; font-size:11px; font-weight:400;">(opsional)</span>
                        </label>
                        <textarea name="catatan" rows="2"
                                  placeholder="Informasi tambahan untuk admin jika diperlukan..."
                                  style="width:100%; padding:10px 12px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; color:#374151; resize:vertical; box-sizing:border-box; outline:none; font-family:inherit; line-height:1.5;"
                                  onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                  onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none'">{{ old('catatan') }}</textarea>
                    </div>

                    {{-- Buttons --}}
                    <div style="display:flex; align-items:center; justify-content:flex-end; gap:10px; border-top:1px solid #F1F5F9; padding-top:20px;">
                        <a href="{{ route('izin.form') }}"
                           style="padding:10px 20px; border-radius:8px; font-size:13px; font-weight:500; color:#64748B; border:1px solid #E2E8F0; text-decoration:none; background:white; display:flex; align-items:center; gap:6px;"
                           onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='white'">
                            <i class="ti ti-arrow-left" style="font-size:14px;"></i> Batal
                        </a>
                        <button type="submit"
                                style="padding:10px 24px; border-radius:8px; font-size:13px; font-weight:600; color:white; background:#2563EB; border:none; cursor:pointer; display:flex; align-items:center; gap:6px;"
                                onmouseover="this.style.background='#1D4ED8'" onmouseout="this.style.background='#2563EB'">
                            <i class="ti ti-send" style="font-size:14px;"></i> Kirim Pengajuan
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
                                ['icon'=>'ti-clock',       'color'=>'#16A34A','bg'=>'#F0FDF4','text'=>'Ajukan izin sebelum atau di hari yang sama'],
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

                {{-- Jenis Izin --}}
                <div style="position:relative;">
                    <button onclick="togglePanel('jenis')"
                            title="Jenis Izin"
                            style="width:52px; height:52px; border-radius:14px; background:white; border:1px solid #E2E8F0; box-shadow:0 1px 4px rgba(0,0,0,0.06); display:flex; align-items:center; justify-content:center; cursor:pointer; transition:all 0.2s;"
                            onmouseover="this.style.background='#F5F3FF';this.style.borderColor='#DDD6FE'"
                            onmouseout="this.style.background='white';this.style.borderColor='#E2E8F0'">
                        <i class="ti ti-tag" style="font-size:22px; color:#7C3AED;"></i>
                    </button>

                    <div id="panel-jenis"
                         style="display:none; position:absolute; right:62px; top:0; width:280px; background:white; border-radius:14px; border:1px solid #E2E8F0; box-shadow:0 8px 24px rgba(0,0,0,0.1); z-index:100; overflow:hidden;">
                        <div style="background:linear-gradient(135deg,#6D28D9,#7C3AED); padding:14px 16px; display:flex; align-items:center; gap:8px;">
                            <i class="ti ti-tag" style="font-size:18px; color:white;"></i>
                            <span style="font-size:13px; font-weight:700; color:white;">Jenis Izin</span>
                        </div>
                        <div style="padding:12px 14px; display:flex; flex-direction:column; gap:7px;">
                            @foreach([
                                ['label'=>'Izin Sakit',         'desc'=>'Kondisi kesehatan terganggu',     'icon'=>'ti-heart-rate-monitor','color'=>'#DC2626','bg'=>'#FEF2F2'],
                                ['label'=>'Izin Keluarga',      'desc'=>'Keperluan anggota keluarga',      'icon'=>'ti-home-heart',        'color'=>'#D97706','bg'=>'#FFFBEB'],
                                ['label'=>'Izin Dinas / Tugas', 'desc'=>'Tugas luar atau kegiatan resmi',  'icon'=>'ti-briefcase',         'color'=>'#2563EB','bg'=>'#EFF6FF'],
                                ['label'=>'Keperluan Pribadi',  'desc'=>'Urusan mendesak pribadi',         'icon'=>'ti-user',              'color'=>'#16A34A','bg'=>'#F0FDF4'],
                                ['label'=>'Lainnya',            'desc'=>'Keperluan di luar kategori',      'icon'=>'ti-dots-circle-horizontal','color'=>'#64748B','bg'=>'#F8FAFC'],
                            ] as $jenis)
                            <div style="display:flex; align-items:center; gap:10px; padding:8px 10px; background:#F8FAFC; border-radius:8px;">
                                <div style="width:30px; height:30px; background:{{ $jenis['bg'] }}; border-radius:7px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                    <i class="ti {{ $jenis['icon'] }}" style="font-size:14px; color:{{ $jenis['color'] }};"></i>
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

            </div>{{-- end panel kanan --}}
        </div>

    </div>
</main>
</div>

<script>
// Toggle panel & tutup yang lain
function togglePanel(id) {
    const panels = ['panduan', 'jenis', 'status'];
    panels.forEach(p => {
        const el = document.getElementById('panel-' + p);
        if (p === id) {
            const isOpen = el.style.display === 'block';
            el.style.display = isOpen ? 'none' : 'block';
        } else {
            el.style.display = 'none';
        }
    });
}

// Klik di luar → tutup semua
document.addEventListener('click', function(e) {
    if (!e.target.closest('[onclick^="togglePanel"]') && !e.target.closest('[id^="panel-"]')) {
        ['panduan','jenis','status'].forEach(p => {
            const el = document.getElementById('panel-' + p);
            if (el) el.style.display = 'none';
        });
    }
});

// Hitung durasi
function hitungDurasi() {
    const mulai   = document.getElementById('tanggal_mulai').value;
    const selesai = document.getElementById('tanggal_selesai').value;
    const box     = document.getElementById('info-durasi');
    const teks    = document.getElementById('teks-durasi');

    if (mulai && selesai) {
        const a    = new Date(mulai);
        const b    = new Date(selesai);
        const diff = Math.round((b - a) / (1000 * 60 * 60 * 24)) + 1;
        box.style.display = 'flex';
        if (diff > 0) {
            box.style.background  = '#EFF6FF';
            box.style.borderColor = '#BFDBFE';
            teks.style.color      = '#1D4ED8';
            teks.textContent      = 'Durasi izin: ' + diff + ' hari (' + formatTgl(a) + ' – ' + formatTgl(b) + ')';
        } else {
            box.style.background  = '#FEF2F2';
            box.style.borderColor = '#FCA5A5';
            teks.style.color      = '#991B1B';
            teks.textContent      = 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.';
        }
    } else if (mulai) {
        box.style.display     = 'flex';
        box.style.background  = '#EFF6FF';
        box.style.borderColor = '#BFDBFE';
        teks.style.color      = '#1D4ED8';
        teks.textContent      = 'Izin 1 hari: ' + formatTgl(new Date(mulai));
    } else {
        box.style.display = 'none';
    }
}

function formatTgl(d) {
    const bulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    return d.getDate() + ' ' + bulan[d.getMonth()] + ' ' + d.getFullYear();
}

document.addEventListener('DOMContentLoaded', hitungDurasi);
</script>

</x-app-layout>