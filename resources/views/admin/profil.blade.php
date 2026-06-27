<x-app-layout>
<div class="p-6">
    <!-- SIDEBAR -->
    <div class="w-64 bg-gradient-to-b from-blue-950 via-blue-900 to-blue-700 text-white p-5 fixed top-0 left-0 h-screen shadow-2xl">

        <!-- PROFIL -->
        <a href="{{ route('profil') }}"
           class="flex items-center gap-3 mb-8 p-3 rounded-lg hover:bg-blue-700 transition">

            <img src="{{ Auth::user()->photo ? asset('storage/'.Auth::user()->photo) : 'https://i.pravatar.cc/50' }}"
                 class="rounded-full w-11 h-11 object-cover border-2 border-white">

            <div>
                <h2 class="font-semibold">
                    {{ Auth::user()->name }}
                </h2>

                <p class="text-xs text-blue-200">
                    Beranda Admin
                </p>
            </div>

        </a>

        <!-- MENU -->
         <nav class="space-y-3 text-sm">

        <a href="{{ route('admin.dashboard') }}"
        class="block p-2 rounded-lg hover:bg-blue-700 {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-blue-700' : '' }}">
        Beranda
        </a>

        <a href="{{ route('guru.index') }}"
           class="block p-2 rounded-lg hover:bg-blue-700">
            Data Guru
        </a>

        <a href="{{ route('admin.rekap') }}"
           class="block p-2 rounded-lg hover:bg-blue-700">
            Rekapan Presensi
        </a>

        <a href="{{ route('admin.registrasi') }}"
           class="block p-2 rounded-lg hover:bg-blue-700">
            Registrasi Guru
        </a>
        
        <a href="/admin/users"
            class="block p-2 rounded-lg hover:bg-blue-700">
            Kelola Akun
        </a>        
        <a href="/admin/izin"
           class="block p-2 rounded-lg hover:bg-blue-700">
            Persetujuan
        </a>

        <a href="{{ route('admin.pengaturan') }}"
            class="block p-2 rounded-lg hover:bg-blue-700">
            Pengaturan
        </a>
    </nav>

        <div class="flex-1"></div>
        <div class="mt-4">
        <p class="text-gray-400 text-sm mb-2">MASTER SEKOLAH</p>

        <a href="/admin/schools" class="block p-2 hover:bg-blue-700 rounded">
            Data Sekolah
        </a>

        <a href="/admin/schools/create" class="block p-2 hover:bg-blue-700 rounded">
            Tambah Sekolah
        </a>
    </div>

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}" class="absolute bottom-5 left-5 right-5">
            @csrf

            <button class="w-full bg-red-500 py-2 rounded-lg hover:bg-red-600">
                Keluar
            </button>

        </form>

    </div>

    <h1 class="text-2xl font-bold mb-4">Profil Admin</h1>

    <form method="POST" action="{{ route('profil.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <input type="text" name="name" value="{{ $user->name }}" class="border p-2 w-full mb-2">

        <input type="email" name="email" value="{{ $user->email }}" class="border p-2 w-full mb-2">

        <input type="file" name="photo" class="mb-2">

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Simpan
        </button>

    </form>

</div>
</x-app-layout>