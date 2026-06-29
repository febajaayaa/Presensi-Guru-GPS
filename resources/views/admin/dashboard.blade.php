<x-app-layout>
<div class="flex min-h-screen" style="background:#F0F4F8; font-family:'Inter',sans-serif;">
 
{{-- Link Tabler Icons --}}
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
        <div>
            <h1 style="font-size:17px; font-weight:700; color:#0F172A; margin:0;">Dashboard Presensi</h1>
        </div>
        <div style="display:flex; align-items:center; gap:12px;">
            {{-- Tanggal --}}
            <div style="background:#F8FAFC; border:1px solid #E2E8F0; padding:8px 14px; border-radius:8px; font-size:12px; color:#475569; display:flex; align-items:center; gap:6px;">
                <i class="ti ti-calendar" style="font-size:14px; color:#64748B;"></i>
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>
            {{-- User badge --}}
            <div style="display:flex; align-items:center; gap:8px; background:#F8FAFC; border:1px solid #E2E8F0; padding:7px 12px; border-radius:8px;">
                <img src="{{ Auth::user()->photo ? asset('storage/'.Auth::user()->photo) : 'https://i.pravatar.cc/50' }}"
                     style="width:28px; height:28px; border-radius:50%; object-fit:cover;">
                <div>
                    <div style="font-size:12px; font-weight:600; color:#1E293B;">{{ Auth::user()->name }}</div>
                    <div style="font-size:10px; color:#94A3B8;">{{ auth()->user()->role == 'super_admin' ? 'Super Admin' : 'Admin Sekolah' }}</div>
                </div>
            </div>
        </div>
    </div>

    <div style="padding:24px 28px; display:flex; flex-direction:column; gap:20px;">

        {{-- ── INFO SEKOLAH ── --}}
        <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; padding:20px 24px; display:flex; align-items:center; gap:20px;">
    
            {{-- Logo --}}
            <div style="width:72px; height:72px; border-radius:10px; border:1px solid #E2E8F0; background:#F8FAFC; display:flex; align-items:center; justify-content:center; overflow:hidden; flex-shrink:0;">
                @if($school && $school->logo)
                    <img src="{{ asset('storage/'.$school->logo) }}" alt="Logo" style="width:100%; height:100%; object-fit:contain; padding:6px;">
                @else
                    <i class="ti ti-school" style="font-size:32px; color:#94A3B8;"></i>
                @endif
            </div>

            {{-- Info --}}
            <div style="flex:1;">
                <div style="font-size:16px; font-weight:700; color:#1D4ED8; margin-bottom:4px;">
                    {{ $school ? strtoupper($school->nama_sekolah) : 'Nama Sekolah' }}
                </div>
                <div style="display:flex; gap:16px; font-size:12px; color:#64748B; margin-bottom:6px;">
                    @if($school)
                        <span>NPSN: {{ $school->npsn ?? '-' }}</span>
                        <span style="color:#E2E8F0;">|</span>
                        <span>Akreditasi: {{ $school->akreditasi ?? '-' }}</span>
                        <span style="color:#E2E8F0;">|</span>
                        <span>{{ $school->kota ?? '-' }}</span>
                    @endif
                </div>
                <div style="font-size:12px; color:#94A3B8;">{{ $school->deskripsi ?? '' }}</div>
            </div>

            {{-- Status --}}
            <div style="flex-shrink:0; text-align:right;">
                <div style="font-size:11px; color:#94A3B8; margin-bottom:4px;">Status Sistem</div>
                <div style="display:flex; align-items:center; gap:6px; background:#F0FDF4; border:1px solid #BBF7D0; padding:6px 12px; border-radius:20px;">
                    <span style="width:7px; height:7px; background:#22C55E; border-radius:50%; display:inline-block;"></span>
                    <span style="font-size:12px; color:#166534; font-weight:500;">Sistem Aktif</span>
                </div>
            </div>
        </div>

        {{-- ── STAT CARDS ── --}}
        <div style="display:grid; grid-template-columns:repeat(5,1fr); gap:14px;">

            <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; border-top:3px solid #2563EB; padding:18px 16px;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px;">
                    <div style="font-size:11px; color:#64748B; letter-spacing:0.04em; text-transform:uppercase;">Total Guru</div>
                    <div style="background:#EFF6FF; padding:7px; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                        <i class="ti ti-users" style="font-size:18px; color:#2563EB;"></i>
                    </div>
                </div>
                <div style="font-size:32px; font-weight:700; color:#2563EB; line-height:1; margin-bottom:4px;">{{ $totalUser }}</div>
                <div style="font-size:11px; color:#94A3B8;">guru terdaftar</div>
            </div>

            <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; border-top:3px solid #16A34A; padding:18px 16px;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px;">
                    <div style="font-size:11px; color:#64748B; letter-spacing:0.04em; text-transform:uppercase;">Hadir</div>
                    <div style="background:#F0FDF4; padding:7px; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                        <i class="ti ti-circle-check" style="font-size:18px; color:#16A34A;"></i>
                    </div>
                </div>
                <div style="font-size:32px; font-weight:700; color:#16A34A; line-height:1; margin-bottom:4px;">{{ $hadir }}</div>
                <div style="font-size:11px; color:#94A3B8;">total kehadiran</div>
            </div>

            <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; border-top:3px solid #DC2626; padding:18px 16px;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px;">
                    <div style="font-size:11px; color:#64748B; letter-spacing:0.04em; text-transform:uppercase;">Terlambat</div>
                    <div style="background:#FEF2F2; padding:7px; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                        <i class="ti ti-alarm" style="font-size:18px; color:#DC2626;"></i>
                    </div>
                </div>
                <div style="font-size:32px; font-weight:700; color:#DC2626; line-height:1; margin-bottom:4px;">{{ $terlambat }}</div>
                <div style="font-size:11px; color:#94A3B8;">hari terlambat</div>
            </div>

            <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; border-top:3px solid #D97706; padding:18px 16px;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px;">
                    <div style="font-size:11px; color:#64748B; letter-spacing:0.04em; text-transform:uppercase;">Tidak Hadir</div>
                    <div style="background:#FFFBEB; padding:7px; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                        <i class="ti ti-user-off" style="font-size:18px; color:#D97706;"></i>
                    </div>
                </div>
                <div style="font-size:32px; font-weight:700; color:#D97706; line-height:1; margin-bottom:4px;">{{ $izin + $sakit }}</div>
                <div style="font-size:11px; color:#94A3B8;">izin + sakit</div>
            </div>

            <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; border-top:3px solid #7C3AED; padding:18px 16px;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px;">
                    <div style="font-size:11px; color:#64748B; letter-spacing:0.04em; text-transform:uppercase;">Total Presensi</div>
                    <div style="background:#F5F3FF; padding:7px; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                        <i class="ti ti-chart-bar" style="font-size:18px; color:#7C3AED;"></i>
                    </div>
                </div>
                <div style="font-size:32px; font-weight:700; color:#7C3AED; line-height:1; margin-bottom:4px;">{{ $totalPresensi }}</div>
                <div style="font-size:11px; color:#94A3B8;">total tercatat</div>
            </div>

        </div>
        
        {{-- ── CHARTS ── --}}
        <div style="display:grid; grid-template-columns:1fr 1.8fr; gap:18px;">

            {{-- Donut --}}
            <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; padding:20px 24px;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
                    <div>
                        <div style="font-size:14px; font-weight:600; color:#0F172A;">Rekap Bulan Ini</div>
                        <div style="font-size:12px; color:#94A3B8; margin-top:2px;">Statistik kehadiran bulan ini</div>
                    </div>
                    <span style="background:#EFF6FF; color:#1D4ED8; font-size:11px; font-weight:600; padding:4px 10px; border-radius:20px;">Bulanan</span>
                </div>
                <div style="height:220px; display:flex; align-items:center; justify-content:center;">
                    <canvas id="donutChart"></canvas>
                </div>
                {{-- Legend --}}
                <div style="display:flex; justify-content:center; gap:16px; margin-top:14px;">
                    @foreach(['Hadir'=>'#16A34A','Terlambat'=>'#DC2626'] as $lbl=>$clr)
                    <div style="display:flex; align-items:center; gap:5px; font-size:12px; color:#64748B;">
                        <span style="width:10px;height:10px;background:{{$clr}};border-radius:2px;display:inline-block;"></span> {{$lbl}}
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Bar --}}
            <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; padding:20px 24px;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
                    <div>
                        <div style="font-size:14px; font-weight:600; color:#0F172A;">Rekap Tahunan</div>
                        <div style="font-size:12px; color:#94A3B8; margin-top:2px;">Grafik kehadiran selama 1 tahun</div>
                    </div>
                    <div style="display:flex; align-items:center; gap:12px;">
                        <div style="display:flex; align-items:center; gap:5px; font-size:11px; color:#64748B;">
                            <span style="width:10px;height:10px;background:#16A34A;border-radius:2px;display:inline-block;"></span> Hadir
                        </div>
                        <div style="display:flex; align-items:center; gap:5px; font-size:11px; color:#64748B;">
                            <span style="width:10px;height:10px;background:#DC2626;border-radius:2px;display:inline-block;"></span> Terlambat
                        </div>
                        <span style="background:#F0FDF4; color:#166534; font-size:11px; font-weight:600; padding:4px 10px; border-radius:20px;">Tahunan</span>
                    </div>
                </div>
                <div style="height:240px;">
                    <canvas id="barChart"></canvas>
                </div>
            </div>

        </div>

        {{-- ── TABEL RIWAYAT ── --}}
        <div style="background:white; border-radius:12px; border:1px solid #E2E8F0; overflow:hidden;">
            <div style="padding:16px 20px; border-bottom:1px solid #F1F5F9; display:flex; align-items:center; justify-content:space-between;">
                <div>
                    <div style="font-size:14px; font-weight:600; color:#0F172A;">Riwayat Kehadiran Guru</div>
                    <div style="font-size:12px; color:#94A3B8; margin-top:2px;">Data presensi terbaru</div>
                </div>
                <a href="{{ route('admin.rekap') }}" style="font-size:12px; color:#2563EB; text-decoration:none; background:#EFF6FF; padding:6px 14px; border-radius:8px; font-weight:500;">
                    Lihat semua →
                </a>
            </div>
            <div style="overflow-x:auto;">
                <table style="width:100%; border-collapse:collapse; font-size:13px;">
                    <thead>
                        <tr style="background:#F8FAFC;">
                            <th style="text-align:left; padding:11px 18px; font-size:11px; font-weight:600; color:#64748B; letter-spacing:0.04em; text-transform:uppercase;">Nama Guru</th>
                            <th style="text-align:left; padding:11px 14px; font-size:11px; font-weight:600; color:#64748B; letter-spacing:0.04em; text-transform:uppercase;">Tanggal</th>
                            <th style="text-align:center; padding:11px 14px; font-size:11px; font-weight:600; color:#64748B; letter-spacing:0.04em; text-transform:uppercase;">Status</th>
                            <th style="text-align:center; padding:11px 14px; font-size:11px; font-weight:600; color:#64748B; letter-spacing:0.04em; text-transform:uppercase;">Jam Masuk–Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data ?? [] as $d)
                        <tr style="border-top:1px solid #F1F5F9;" onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='white'">
                            <td style="padding:12px 18px;">
                                <div style="display:flex; align-items:center; gap:10px;">
                                    <div style="width:30px; height:30px; border-radius:50%; background:#EFF6FF; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:600; color:#1D4ED8; flex-shrink:0;">
                                        {{ strtoupper(substr($d->user->name ?? '?', 0, 1)) }}
                                    </div>
                                    <span style="font-weight:500; color:#1E293B;">{{ $d->user->name ?? '-' }}</span>
                                </div>
                            </td>
                            <td style="padding:12px 14px; color:#475569;">
                                {{ \Carbon\Carbon::parse($d->tanggal)->format('d M Y') }}
                            </td>
                            <td style="padding:12px 14px; text-align:center;">
                                @if($d->status == 'hadir')
                                    <span style="background:#F0FDF4; color:#166534; font-size:11px; font-weight:600; padding:4px 12px; border-radius:20px; display:inline-flex; align-items:center; gap:4px;">
                                        <i class="ti ti-circle-check" style="font-size:13px;"></i> Hadir
                                    </span>
                                @elseif($d->status == 'terlambat')
                                    <span style="background:#FEF2F2; color:#991B1B; font-size:11px; font-weight:600; padding:4px 12px; border-radius:20px; display:inline-flex; align-items:center; gap:4px;">
                                        <i class="ti ti-alarm" style="font-size:13px;"></i> Terlambat
                                    </span>
                                @elseif($d->status == 'izin')
                                    <span style="background:#FFFBEB; color:#92400E; font-size:11px; font-weight:600; padding:4px 12px; border-radius:20px; display:inline-flex; align-items:center; gap:4px;">
                                        <i class="ti ti-file-description" style="font-size:13px;"></i> Izin
                                    </span>
                                @elseif($d->status == 'sakit')
                                    <span style="background:#EFF6FF; color:#1E40AF; font-size:11px; font-weight:600; padding:4px 12px; border-radius:20px; display:inline-flex; align-items:center; gap:4px;">
                                        <i class="ti ti-stethoscope" style="font-size:13px;"></i> Sakit
                                    </span>
                                @endif
                            </td>
                            <td style="padding:12px 14px; text-align:center; color:#64748B; font-size:13px;">
                                <span style="font-family:monospace;">
                                    {{ $d->jam_masuk ? \Carbon\Carbon::parse($d->jam_masuk)->format('H:i') : '--:--' }}
                                    –
                                    {{ $d->jam_keluar ? \Carbon\Carbon::parse($d->jam_keluar)->format('H:i') : '--:--' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center; padding:48px; color:#94A3B8;">
                                <i class="ti ti-clipboard-list" style="font-size:36px; color:#CBD5E1; display:block; margin-bottom:10px;"></i>
                                <div style="font-size:14px; font-weight:500; color:#475569; margin-bottom:4px;">Belum ada data presensi</div>
                                <div style="font-size:12px;">Data kehadiran guru akan muncul di sini.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>{{-- end padding --}}
</main>

</div>{{-- end flex --}}

{{-- ═══════════════ SCRIPTS ═══════════════ --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// DONUT
new Chart(document.getElementById('donutChart'), {
    type: 'doughnut',
    data: {
        labels: ['Hadir', 'Terlambat'],
        datasets: [{
            data: [{{ $hadirBulanIni }}, {{ $terlambatBulanIni }}],
            backgroundColor: ['#16A34A', '#DC2626'],
            borderWidth: 0,
            hoverOffset: 6
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '70%',
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: '#0F172A',
                padding: 10,
                cornerRadius: 8,
                titleFont: { size: 12 },
                bodyFont: { size: 12 },
            }
        }
    }
});

// BAR
new Chart(document.getElementById('barChart'), {
    type: 'bar',
    data: {
        labels: @json($bulan),
        datasets: [
            {
                label: 'Hadir',
                data: @json($dataHadir),
                backgroundColor: '#16A34A',
                borderRadius: 4,
                borderSkipped: false
            },
            {
                label: 'Terlambat',
                data: @json($dataTerlambat),
                backgroundColor: '#DC2626',
                borderRadius: 4,
                borderSkipped: false
            }
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
                bodyFont: { size: 12 },
            }
        },
        scales: {
            x: {
                grid: { display: false },
                ticks: { color: '#64748B', font: { size: 11 } }
            },
            y: {
                beginAtZero: true,
                grid: { color: '#F1F5F9' },
                ticks: { color: '#64748B', font: { size: 11 }, stepSize: 1 }
            }
        }
    }
});
</script>

</x-app-layout>