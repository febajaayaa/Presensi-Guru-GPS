<x-app-layout>
<div class="p-6">

    <h1 class="text-2xl font-bold mb-4">Profil Sekolah</h1>

    @if($profil)
        <div class="bg-white p-6 rounded shadow">

            <p><b>Nama:</b> {{ $profil->nama_sekolah }}</p>
            <p><b>Alamat:</b> {{ $profil->alamat }}</p>
            <p><b>Telepon:</b> {{ $profil->telepon }}</p>
            <p><b>Email:</b> {{ $profil->email }}</p>
            <p><b>Kepala Sekolah:</b> {{ $profil->kepala_sekolah }}</p>

            <a href="{{ route('profil.edit') }}"
               class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">
               Edit Profil
            </a>

        </div>
    @else
        <p>Profil belum diisi</p>
    @endif

</div>
</x-app-layout>