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
    <div style="padding:24px; flex:1; max-width:640px;">

        {{-- Flash --}}
        @if(session('success'))
        <div style="display:flex; align-items:center; gap:10px; background:#F0FDF4; border:1px solid #BBF7D0; border-left:4px solid #22C55E; border-radius:10px; padding:12px 16px; margin-bottom:16px;">
            <i class="ti ti-circle-check" style="font-size:18px; color:#16A34A; flex-shrink:0;"></i>
            <div style="font-size:13px; font-weight:500; color:#166534;">{{ session('success') }}</div>
        </div>
        @endif
        @if(session('error'))
        <div style="display:flex; align-items:center; gap:10px; background:#FEF2F2; border:1px solid #FECACA; border-left:4px solid #EF4444; border-radius:10px; padding:12px 16px; margin-bottom:16px;">
            <i class="ti ti-alert-triangle" style="font-size:18px; color:#DC2626; flex-shrink:0;"></i>
            <div style="font-size:13px; font-weight:500; color:#B91C1C;">{{ session('error') }}</div>
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

        {{-- Breadcrumb --}}
        <div style="display:flex; align-items:center; gap:6px; margin-bottom:16px; font-size:12px; color:#94A3B8;">
            <a href="{{ route('izin.form') }}" style="color:#3B82F6; text-decoration:none; display:flex; align-items:center; gap:4px;"
               onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                <i class="ti ti-file-text" style="font-size:13px;"></i> Riwayat Izin
            </a>
            <i class="ti ti-chevron-right" style="font-size:12px;"></i>
            <span style="color:#64748B; font-weight:500;">Ajukan Izin</span>
        </div>

        {{-- Page Header --}}
        <div style="margin-bottom:20px;">
            <h1 style="font-size:20px; font-weight:700; color:#0F172A; margin:0 0 4px; display:flex; align-items:center; gap:8px;">
                <i class="ti ti-file-plus" style="font-size:22px; color:#3B82F6;"></i> Ajukan Izin
            </h1>
            <p class="text-xs text-gray-500 mt-0.5">>Isi form berikut dengan data yang akurat dan benar.</p>
        </div>

        {{-- Form Card --}}
        <div style="background:white; border-radius:14px; border:1px solid #E2E8F0; box-shadow:0 1px 6px rgba(0,0,0,0.06); overflow:hidden;">

            {{-- Card Header --}}
            <div style="display:flex; align-items:center; gap:10px; padding:16px 20px; border-bottom:1px solid #F1F5F9; background:#FAFBFF;">
                <div style="width:36px; height:36px; background:#EFF6FF; border-radius:9px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i class="ti ti-clipboard-text" style="font-size:18px; color:#3B82F6;"></i>
                </div>
                <div>
                    <div style="font-size:14px; font-weight:700; color:#0F172A;">Form Pengajuan Izin</div>
                    <div style="font-size:12px; color:#94A3B8;">Lengkapi semua field yang diperlukan</div>
                </div>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('izin.store') }}" style="padding:22px 24px;">
                @csrf

                {{-- Jenis Izin --}}
                <div style="margin-bottom:20px;">
                    <label style="display:block; font-size:12px; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:7px;">
                        Jenis Izin <span style="color:#EF4444;">*</span>
                    </label>
                    <div style="position:relative;">
                        <i class="ti ti-tag" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); font-size:16px; color:#94A3B8; pointer-events:none;"></i>
                        <input type="text" name="status" required
                               value="{{ old('status') }}"
                               placeholder="Contoh: Izin Sakit, Izin Keluarga, Urusan Penting"
                               style="width:100%; padding:11px 12px 11px 38px; border:1px solid #D1D5DB; border-radius:9px; font-size:13px; color:#0F172A; box-sizing:border-box; outline:none;"
                               onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                               onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none'">
                    </div>
                </div>

                {{-- Tanggal Izin --}}
                <div style="margin-bottom:20px;">
                    <label style="display:block; font-size:12px; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:7px;">
                        Tanggal Izin <span style="color:#EF4444;">*</span>
                    </label>
                    <div style="position:relative;">
                        <i class="ti ti-calendar-event" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); font-size:16px; color:#94A3B8; pointer-events:none;"></i>
                        <input type="date" name="tanggal_mulai" required
                               value="{{ old('tanggal_mulai', now()->toDateString()) }}"
                               min="{{ now()->toDateString() }}"
                               style="width:100%; padding:11px 12px 11px 38px; border:1px solid #D1D5DB; border-radius:9px; font-size:13px; color:#0F172A; box-sizing:border-box; outline:none;"
                               onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                               onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none'">
                    </div>
                </div>

                {{-- Keterangan --}}
                <div style="margin-bottom:22px;">
                    <label style="display:block; font-size:12px; font-weight:600; color:#374151; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:7px;">
                        Keterangan
                    </label>
                    <div style="position:relative;">
                        <i class="ti ti-notes" style="position:absolute; left:12px; top:13px; font-size:16px; color:#94A3B8; pointer-events:none;"></i>
                        <textarea name="keterangan" rows="4" maxlength="1000"
                                  placeholder="Jelaskan alasan izin Anda secara singkat..."
                                  style="width:100%; padding:11px 12px 11px 38px; border:1px solid #D1D5DB; border-radius:9px; font-size:13px; color:#0F172A; resize:vertical; box-sizing:border-box; outline:none; font-family:inherit; line-height:1.5;"
                                  onfocus="this.style.borderColor='#3B82F6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'"
                                  onblur="this.style.borderColor='#D1D5DB';this.style.boxShadow='none'">{{ old('keterangan') }}</textarea>
                    </div>
                </div>

                {{-- Info box --}}
                <div style="display:flex; align-items:flex-start; gap:10px; background:#EFF6FF; border:1px solid #BFDBFE; border-radius:9px; padding:12px 14px; margin-bottom:22px;">
                    <i class="ti ti-info-circle" style="font-size:17px; color:#3B82F6; flex-shrink:0; margin-top:1px;"></i>
                    <p style="font-size:12px; color:#1E40AF; margin:0; line-height:1.6;">
                        Izin yang diajukan akan diproses oleh admin sekolah. Pastikan data yang diisi sudah benar sebelum mengirim.
                    </p>
                </div>

                {{-- Tombol --}}
                <div style="display:flex; gap:10px;">
                    <a href="{{ route('izin.form') }}"
                       style="flex:1; background:white; color:#64748B; border:1px solid #D1D5DB; padding:12px; border-radius:9px; font-size:13px; font-weight:600; text-decoration:none; display:flex; align-items:center; justify-content:center; gap:7px;"
                       onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='white'">
                        <i class="ti ti-arrow-left" style="font-size:15px;"></i> Batal
                    </a>
                    <button type="submit"
                            style="flex:2; background:#2563EB; color:white; padding:12px; border-radius:9px; font-size:13px; font-weight:600; border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:7px;"
                            onmouseover="this.style.background='#1D4ED8'" onmouseout="this.style.background='#2563EB'">
                        <i class="ti ti-send" style="font-size:15px;"></i> Kirim Pengajuan
                    </button>
                </div>

            </form>
        </div>

    </div>
</main>
</div>

</x-app-layout>