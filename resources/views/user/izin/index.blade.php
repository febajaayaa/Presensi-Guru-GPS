<x-app-layout>
    <div class="p-6">
        <div class="mb-5">
            <h1 class="text-2xl font-bold text-gray-800">Data Izin &amp; Sakit</h1>
            <p class="text-gray-500 text-sm">Pantau riwayat pengajuan izin dan statusnya.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-5 py-4 bg-gradient-to-r from-blue-600 to-sky-600">
                <div class="flex items-center justify-between gap-4">
                    <div class="text-white">
                        <p class="text-sm opacity-90">Total Pengajuan</p>
                        <p class="text-2xl font-bold">
                            {{ $izins->count() }}
                        </p>
                    </div>
                    <div class="hidden sm:block text-white/90 text-sm text-right">
                        <p class="font-semibold">Pembaruan:</p>
                        <p class="opacity-90">Terakhir: {{ now()->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-xs font-semibold text-gray-500">
                            <th class="p-3">Nama</th>
                            <th class="p-3">Tanggal</th>
                            <th class="p-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($izins as $izin)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">
                                    <div class="font-semibold text-gray-800">{{ $izin->user->name }}</div>
                                    <div class="text-xs text-gray-500">ID: #{{ $izin->id }}</div>
                                </td>
                                <td class="p-3">
                                    <div class="text-sm font-medium text-gray-800">{{ $izin->created_at ? $izin->created_at->format('d M Y') : '-' }}</div>
                                </td>
                                <td class="p-3">
                                    @php
                                        $status = strtolower($izin->status ?? '');
                                        $label = ucfirst($izin->status ?? '-');
                                    @endphp
                                    @if($status === 'pending')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-semibold">{{ $label }}</span>
                                    @elseif($status === 'disetujui')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold">{{ $label }}</span>
                                    @elseif($status === 'ditolak')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-800 text-xs font-semibold">{{ $label }}</span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-semibold">{{ $label }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-6 text-center">
                                    <div class="mx-auto w-max">
                                        <div class="text-4xl">📭</div>
                                        <p class="mt-2 font-semibold text-gray-700">Tidak ada data izin</p>
                                        <p class="text-sm text-gray-500">Silakan ajukan izin terlebih dahulu.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </x-app-layout>