<x-app-layout>

<div class="flex min-h-screen bg-gradient-to-br from-gray-100 to-gray-200">

@php
$user = auth()->user();
@endphp

    <!-- SIDEBAR -->
    <div class="w-64 bg-gradient-to-b from-blue-800 to-blue-900 text-white p-5 flex flex-col justify-between shadow-xl">
        <div>
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 mb-8 hover:bg-blue-700 p-2 rounded-lg transition">
    
    <img src="{{ auth()->check() && auth()->user()->photo
    ? asset('storage/'.auth()->user()->photo)
    : 'https://i.pravatar.cc/50' }}" 
class="rounded-full w-10 h-10 object-cover">

<div>
    <h2 class="font-semibold">{{ $user->name ?? 'Guest' }}</h2>
    <p class="text-sm opacity-80">Admin</p>
</div>

</a>

            <div class="space-y-2">
                 <a href="{{ route('dashboard') }}"
               class="block p-2 py-2 rounded-lg hover:bg-blue-700"
               {{ request()->routeIs('dashboard') ? 'bg-white text-blue-800 font-semibold' : 'hover:bg-blue-700' }}">
                Beranda
            </a>

                <a href="{{ route('izin.form') }}" class="block p-2 rounded-lg hover:bg-blue-700">
                    Izin
                </a>

                <a href="{{ route('cuti.index') }}"
                class="flex items-center gap-2 p-2 rounded-lg hover:bg-blue-700 transition">
                    <span>Cuti</span>
                </a>

                <a href="{{ route('history') }}" class="block p-2 rounded-lg hover:bg-blue-700">
                    Riwayat
                </a>

                <a href="{{ route('pengaturan') }}" class="block p-2 rounded-lg hover:bg-blue-700">
                    Pengaturan
                </a>
            </div>
        </div>

        
            <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit"
        class="w-full bg-red-500 text-white py-3 rounded-lg">
        Keluar
    </button>
</form>
    </div>

    <!-- MAIN -->
    <div class="flex-1 p-6">

<form method="POST" action="{{ route('profil.update') }}" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <div class="text-center">

    <!-- FOTO -->
   <img 
    id="preview"
    src="{{ auth()->user()->photo 
        ? asset('storage/' . auth()->user()->photo) . '?v=' . time() 
        : 'https://i.pravatar.cc/100' }}"
    class="w-24 h-24 rounded-full mx-auto mb-3 object-cover"
>

    <!-- INPUT FILE (HIDDEN) -->
    <input type="file" name="photo" id="photo" style="display: none;">

    <!-- BUTTON -->
    <button type="button" 
        onclick="document.getElementById('photo').click()"
        class="bg-gray-200 px-4 py-2 rounded-lg">
        Ganti Foto
    </button>

    @error('photo')
    <p class="text-red-500 text-sm mt-2">
        {{ $message }}
    </p>
@enderror

</div>

<!-- NAMA -->
<div class="mb-4">
    <label class="block text-sm mb-1">Nama</label>
    <input type="text" name="name" value="{{ $user->name }}"
        class="w-full border p-2 rounded-lg">
</div>

<!-- EMAIL -->
<div class="mb-4">
    <label class="block text-sm mb-1">Email</label>
    <input type="email" name="email" value="{{ $user->email }}"
        class="w-full border p-2 rounded-lg">
</div>

<!-- BUTTON -->
<div class="text-center">
    <button class="bg-blue-500 text-white px-6 py-2 rounded-lg">
        Simpan
    </button>
</div>

</form>

</div>

<script>

document.getElementById('photo').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(file);
    }
});
</script>
</x-app-layout>