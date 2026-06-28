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
                <div style="font-size:11px; color:rgba(255,255,255,0.5); margin-top:1px;">Mahasiswa PTI</div>
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
    <div style="padding:24px; flex:1;">

       
        {{-- Topbar --}}
        <div class="flex justify-between items-center mb-4">
            <div>
                 <h1 style="font-size:24px; font-weight:700; color:#0F172A; margin:0;">Riwayat Presensi</h1>
                <p class="text-xs text-gray-500 mt-0.5">Kalender kehadiran bulanan</p>
            </div>
        </div>

        {{-- Nielsen #6: Legenda selalu terlihat, tidak perlu diingat --}}
        <div class="flex flex-wrap gap-4 mb-4">
            @php
            $legends = [
                ['color' => '#0da445', 'label' => 'Hadir'],
                ['color' => '#e08d34', 'label' => 'Terlambat'],
                ['color' => '#2563eb', 'label' => 'Izin'],
                ['color' => '#9333ea', 'label' => 'Sakit'],
                ['color' => '#fbcfe8', 'label' => 'Cuti'],
                ['color' => '#6b7280', 'label' => 'Belum absen'],
                ['color' => '#da1a1a', 'label' => 'Libur'],
            ];
            @endphp
            @foreach($legends as $leg)
            <div class="flex items-center gap-1.5 text-xs text-gray-500">
                <div class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background:{{ $leg['color'] }}"></div>
                {{ $leg['label'] }}
            </div>
            @endforeach
        </div>

        {{-- Kalender --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

            {{-- Nielsen #3: Navigasi bulan pakai ikon panah yang familiar --}}
            <div class="flex justify-between items-center mb-5">
                <button onclick="prevMonth()"
                        aria-label="Bulan sebelumnya"
                        class="w-8 h-8 rounded-lg border border-gray-200 bg-gray-50 hover:bg-gray-100 transition flex items-center justify-center text-gray-500">
                    <i class="ti ti-chevron-left text-sm" aria-hidden="true"></i>
                </button>
                <h2 id="monthYear" class="text-sm font-semibold text-gray-800"></h2>
                <button onclick="nextMonth()"
                        aria-label="Bulan berikutnya"
                        class="w-8 h-8 rounded-lg border border-gray-200 bg-gray-50 hover:bg-gray-100 transition flex items-center justify-center text-gray-500">
                    <i class="ti ti-chevron-right text-sm" aria-hidden="true"></i>
                </button>
            </div>

            {{-- Nielsen #2: Nama hari Bahasa Indonesia --}}
            <div class="grid grid-cols-7 text-center mb-2">
                @foreach(['Min','Sen','Sel','Rab','Kam','Jum','Sab'] as $i => $day)
                <div class="text-[11px] font-medium py-1 {{ $i === 0 ? 'text-red-500' : 'text-gray-400' }}">
                    {{ $day }}
                </div>
                @endforeach
            </div>

            <div id="calendar" class="grid grid-cols-7 gap-1.5"></div>
        </div>

    </main>
</div>


{{-- ============================================================
     POPUP DETAIL TANGGAL
     Nielsen #8: Informasi ringkas dan relevan saja
     Nielsen #9: Klik tanggal → detail muncul jelas + bisa ditutup
================================================================== --}}
<div id="popup-detail"
     class="fixed inset-0 z-50 hidden items-center justify-center"
     style="background:rgba(0, 0, 0, 0.57);"
     role="dialog" aria-modal="true" aria-labelledby="popup-title">

    <div class="bg-white rounded-2xl p-6 max-w-xs w-full shadow-xl border border-gray-100 mx-4">

        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2">
                <i class="ti ti-calendar-event text-base text-gray-400" aria-hidden="true"></i>
                <h3 id="popup-title" class="text-sm font-semibold text-gray-800"></h3>
            </div>
            <button onclick="closeDetail()"
                    aria-label="Tutup detail"
                    class="w-7 h-7 rounded-lg bg-gray-100 hover:bg-gray-200 transition flex items-center justify-center text-gray-500">
                <i class="ti ti-x text-sm" aria-hidden="true"></i>
            </button>
        </div>

        <div id="popup-body" class="space-y-0"></div>

        <button onclick="closeDetail()"
                class="w-full mt-4 py-2 rounded-lg border border-gray-200 bg-gray-50 hover:bg-gray-100 text-sm text-gray-600 transition">
            Tutup
        </button>
    </div>
</div>


{{-- ============================================================
     JAVASCRIPT
================================================================== --}}
<script>
const presensiData = @json($presensis);
let currentDate = new Date();

const BULAN = ['Januari','Februari','Maret','April','Mei','Juni',
               'Juli','Agustus','September','Oktober','November','Desember'];

const STATUS_LABEL = {
    hadir: 'Hadir', terlambat: 'Terlambat',
    izin: 'Izin', sakit: 'Sakit', cuti: 'Cuti'
};

const STATUS_STYLE = {
    hadir:     { cell: 'background:#dcfce7;color:#166534;',  badge: 'background:#bbf7d0;color:#14532d;' },
    terlambat: { cell: 'background:#faa97a;color:#de5810;',  badge: 'background:#fcb38b;color:#de5810;' },
    izin:      { cell: 'background:#dbeafe;color:#1e40af;',  badge: 'background:#bfdbfe;color:#1e3a8a;' },
    sakit:     { cell: 'background:#f3e8ff;color:#6b21a8;',  badge: 'background:#e9d5ff;color:#581c87;' },
    cuti:      { cell: 'background:#fce7f3;color:#9d174d;',  badge: 'background:#fbcfe8;color:#831843;' },
    libur:     { cell: 'background:#fee2e2;color:#991b1b;',  badge: 'background:#fecaca;color:#7f1d1d;' },
    belum:     { cell: 'background:#f3f4f6;color:#6b7280;',  badge: 'background:#e5e7eb;color:#6b7280;' },
};

function pad(n){ return String(n).padStart(2,'0'); }

function renderCalendar() {
    const cal = document.getElementById('calendar');
    cal.innerHTML = '';

    const year  = currentDate.getFullYear();
    const month = currentDate.getMonth();
    const today = new Date();

    const firstDay = new Date(year, month, 1).getDay();
    const lastDate = new Date(year, month+1, 0).getDate();

    document.getElementById('monthYear').textContent = BULAN[month] + ' ' + year;

    // Sel kosong sebelum tanggal 1
    for (let i = 0; i < firstDay; i++) {
        cal.innerHTML += '<div></div>';
    }

    for (let d = 1; d <= lastDate; d++) {
        const dateStr = `${year}-${pad(month+1)}-${pad(d)}`;
        const data    = presensiData[dateStr];
        const dow     = new Date(year, month, d).getDay();
        const isSun   = dow === 0;
        const isToday = d === today.getDate() && month === today.getMonth() && year === today.getFullYear();

        let key, badge, timeHtml = '';

        if (!data && isSun)       { key = 'libur'; badge = 'Libur'; }
        else if (data)            { key = data.status; badge = STATUS_LABEL[data.status] || data.status; }
        else                      { key = 'belum'; badge = 'Belum absen'; }

        const s = STATUS_STYLE[key] || STATUS_STYLE.belum;

        if (data && (data.jam_masuk || data.jam_keluar)) {
            timeHtml = `
                <div style="font-size:9px;margin-top:2px;padding:2px 4px;border-radius:3px;${s.badge}display:flex;align-items:center;gap:2px;">
                    <i class="ti ti-login" style="font-size:9px"></i>${data.jam_masuk ?? '--'}
                </div>
                <div style="font-size:9px;margin-top:2px;padding:2px 4px;border-radius:3px;${s.badge}display:flex;align-items:center;gap:2px;">
                    <i class="ti ti-logout" style="font-size:9px"></i>${data.jam_keluar ?? '--'}
                </div>`;
        }

        const todayStyle = isToday ? 'outline:2px solid #2563eb;outline-offset:1px;' : '';

        cal.innerHTML += `
<div onclick="showDetail('${dateStr}')"
     role="button" tabindex="0"
     aria-label="${dateStr}: ${badge}"
     onkeydown="if(event.key==='Enter')showDetail('${dateStr}')"
     style="border-radius:8px;padding:6px;min-height:78px;cursor:pointer;
            display:flex;flex-direction:column;transition:opacity .15s;
            ${s.cell}${todayStyle}"
     onmouseover="this.style.opacity='.8'" onmouseout="this.style.opacity='1'">
    <div style="font-size:12px;font-weight:500;margin-bottom:auto;">${d}</div>
    <div style="font-size:9px;font-weight:500;padding:2px 4px;border-radius:4px;text-align:center;margin-top:4px;letter-spacing:.03em;${s.badge}">
        ${badge.toUpperCase()}
    </div>
    ${timeHtml}
</div>`;
    }
}

function showDetail(dateStr) {
    const data  = presensiData[dateStr];
    const dow   = new Date(dateStr).getDay();
    const isSun = dow === 0;
    const parts = dateStr.split('-');
    const label = `${parseInt(parts[2])} ${BULAN[parseInt(parts[1])-1]} ${parts[0]}`;

    document.getElementById('popup-title').textContent = label;

    const PILL = {
        hadir:     'background:#dcfce7;color:#166534;',
        terlambat: 'background:#fee2e2;color:#991b1b;',
        izin:      'background:#dbeafe;color:#1e40af;',
        sakit:     'background:#f3e8ff;color:#6b21a8;',
        cuti:      'background:#fce7f3;color:#9d174d;',
    };

    const row = (label, val) =>
        `<div style="display:flex;justify-content:space-between;align-items:center;padding:7px 0;border-bottom:0.5px solid #e5e7eb;font-size:13px;">
            <span style="color:#6b7280;">${label}</span><span style="font-weight:500;">${val}</span>
        </div>`;

    const pill = (txt, style) =>
        `<span style="display:inline-flex;align-items:center;padding:2px 8px;border-radius:20px;font-size:11px;font-weight:500;${style}">${txt}</span>`;

    let body = '';
    if (!data && isSun) {
        body = row('Keterangan', pill('Hari libur (Minggu)', 'background:#fee2e2;color:#991b1b;'));
    } else if (!data) {
        body = row('Status', pill('Belum absen', 'background:#f3f4f6;color:#6b7280;'));
    } else {
        const statusTampil = data.status === 'terlambat' ? 'Terlambat (Hadir)' : (STATUS_LABEL[data.status] || data.status);
        body  = row('Status',     pill(statusTampil, PILL[data.status] || ''));
        body += row('Jam masuk',  `<span style="font-weight:500;">${data.jam_masuk  ? data.jam_masuk+' WIB'  : '&mdash;'}</span>`);
        body += row('Jam keluar', `<span style="font-weight:500;">${data.jam_keluar ? data.jam_keluar+' WIB' : '&mdash;'}</span>`);
    }

    document.getElementById('popup-body').innerHTML = body;

    const popup = document.getElementById('popup-detail');
    popup.classList.remove('hidden');
    popup.classList.add('flex');
}

function closeDetail() {
    const popup = document.getElementById('popup-detail');
    popup.classList.add('hidden');
    popup.classList.remove('flex');
}

function prevMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
}

// Tutup popup saat klik backdrop
document.getElementById('popup-detail').addEventListener('click', function(e){
    if(e.target === this) closeDetail();
});

renderCalendar();
</script>

</x-app-layout>