<x-app-layout>

{{-- ============================================================
     PRINSIP JAKOB NIELSEN YANG DITERAPKAN:
     1. Visibility of System Status       → loading popup saat cari lokasi, badge status real-time
     2. Match Between System & Real World → label bahasa Indonesia yang natural
     3. User Control and Freedom          → konfirmasi logout, tombol "Batal" di setiap popup
     4. Consistency and Standards         → ikon konsisten, warna semantik (hijau=hadir, merah=gagal)
     5. Error Prevention                  → cek internet & GPS sebelum proses, tombol disabled setelah absen
     6. Recognition Rather than Recall   → ikon + label di setiap nav item, badge status di riwayat
     7. Flexibility and Efficiency        → informasi jadwal terlihat langsung tanpa klik
     8. Aesthetic and Minimalist Design   → layout bersih, hanya info yang relevan
     9. Help Users Recover from Errors    → pesan error spesifik + tombol "Coba lagi"
    10. Help and Documentation            → tooltip & deskripsi singkat di setiap aksi penting
================================================================== --}}

@php $user = auth()->user(); @endphp

<div class="flex min-h-screen" style="background: #f1f5f9;">

    {{-- ===================== SIDEBAR ===================== --}}
    <aside class="flex flex-col justify-between flex-shrink-0 shadow-sm"
           style="width:220px; background:#1e3a8a; padding:16px 12px;">

        {{-- Profil --}}
        <div>
            <a href="{{ route('pengaturan') }}"
               title="Edit profil Anda"
               class="flex items-center gap-3 rounded-xl p-2 mb-5 transition hover:bg-white/10">
                <img src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://i.pravatar.cc/50' }}"
                     class="w-10 h-10 rounded-full object-cover flex-shrink-0"
                     alt="Foto profil {{ $user->name }}">
                <div>
                    <p class="text-sm font-medium text-white">{{ $user->name ?? 'Pengguna' }}</p>
                    <p class="text-xs text-white/60 mt-0.5">Mahasiswa PTI</p>
                </div>
            </a>

            <p class="text-[10px] font-medium uppercase tracking-widest text-white/40 px-2 mb-2">Menu</p>

            <nav class="space-y-0.5">
                @php
                    $navItems = [
                        ['route' => 'dashboard',    'icon' => 'ti-home',         'label' => 'Beranda'],
                        ['route' => 'izin.form',    'icon' => 'ti-file-text',    'label' => 'Izin'],
                        ['route' => 'cuti.index',   'icon' => 'ti-calendar-off', 'label' => 'Cuti'],
                        ['route' => 'history',      'icon' => 'ti-history',      'label' => 'Riwayat'],
                        ['route' => 'pengaturan',   'icon' => 'ti-settings',     'label' => 'Pengaturan'],
                    ];
                @endphp

                @foreach($navItems as $item)
                <a href="{{ route($item['route']) }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition
                          {{ request()->routeIs($item['route']) ? 'bg-white/20 text-white font-medium' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    <i class="ti {{ $item['icon'] }} text-base" aria-hidden="true"></i>
                    {{ $item['label'] }}
                </a>
                @endforeach
            </nav>
        </div>

        {{-- Tombol Keluar dengan konfirmasi (Nielsen #3: User Control) --}}
        <button type="button" onclick="showPopup('logout')"
                class="w-full flex items-center justify-center gap-2 rounded-lg py-2.5 text-sm font-medium transition"
                style="background:rgba(239,68,68,0.18); border:0.5px solid rgba(239,68,68,0.35); color:#fca5a5;">
            <i class="ti ti-logout text-base" aria-hidden="true"></i> Keluar
        </button>
    </aside>

<div class="flex-1 p-6">

    <!-- WRAPPER CARD -->
    <div class="max-w-4xl mx-auto">

        <!-- HEADER -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-clock text-blue-500"></i>
                Riwayat Presensi
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Data kehadiran kamu terbaru
            </p>
        </div>

        <!-- LIST -->
        <div class="space-y-4">
        @forelse ($presensis as $item)

            <div class="bg-white rounded-2xl shadow-md p-5 flex justify-between items-center hover:shadow-lg transition">

                <!-- KIRI -->
                <div>
                    <p class="font-semibold text-gray-800">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                    </p>

                    <p class="text-sm text-gray-500">
                        {{ $item->jam_masuk ? \Carbon\Carbon::parse($item->jam_masuk)->format('H:i') : '--:--' }}
                        -
                        {{ $item->jam_keluar ? \Carbon\Carbon::parse($item->jam_keluar)->format('H:i') : '--:--' }}
                    </p>
                </div>

                <!-- KANAN (STATUS BADGE) -->
                <div>
                    @if($item->status == 'hadir')
                        <span class="bg-green-100 text-green-600 text-xs px-3 py-1 rounded-full font-semibold flex items-center gap-1">
                            <i class="fas fa-check-circle"></i> Hadir
                        </span>

                    @elseif($item->status == 'terlambat')
                        <span class="bg-red-100 text-red-600 text-xs px-3 py-1 rounded-full font-semibold flex items-center gap-1">
                            <i class="fas fa-clock"></i> Terlambat
                        </span>

                    @elseif($item->status == 'izin')

                        @if($item->izin_status == 'pending')
                            <span class="bg-yellow-100 text-yellow-600 text-xs px-3 py-1 rounded-full font-semibold flex items-center gap-1">
                                <i class="fas fa-hourglass-half"></i> Izin Pending
                            </span>

                        @elseif($item->izin_status == 'ditolak')
                            <span class="bg-red-100 text-red-600 text-xs px-3 py-1 rounded-full font-semibold flex items-center gap-1">
                                <i class="fas fa-times-circle"></i> Izin Ditolak
                            </span>

                        @else
                            <span class="bg-blue-100 text-blue-600 text-xs px-3 py-1 rounded-full font-semibold flex items-center gap-1">
                                <i class="fas fa-file-alt"></i> Izin
                            </span>
                        @endif

                    @elseif($item->status == 'sakit')

                        @if($item->izin_status == 'pending')
                            <span class="bg-yellow-100 text-yellow-600 text-xs px-3 py-1 rounded-full font-semibold flex items-center gap-1">
                                <i class="fas fa-hourglass-half"></i> Sakit Pending
                            </span>

                        @elseif($item->izin_status == 'ditolak')
                            <span class="bg-red-100 text-red-600 text-xs px-3 py-1 rounded-full font-semibold flex items-center gap-1">
                                <i class="fas fa-times-circle"></i> Sakit Ditolak
                            </span>

                        @else
                            <span class="bg-orange-100 text-orange-600 text-xs px-3 py-1 rounded-full font-semibold flex items-center gap-1">
                                <i class="fas fa-procedures"></i> Sakit
                            </span>
                        @endif

                    @endif
                </div>

            </div>

        @empty
            <div class="bg-white rounded-2xl shadow-md p-6 text-center text-gray-400">
                <i class="fas fa-folder-open text-3xl mb-2"></i>
                <p>Belum ada data presensi</p>
            </div>
        @endforelse
        </div>

    </div>

</div>

</x-app-layout>