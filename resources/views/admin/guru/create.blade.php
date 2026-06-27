<x-app-layout>

    <div class="p-6 max-w-lg mx-auto bg-white rounded-xl shadow">

        <h1 class="text-xl font-bold mb-4">Tambah Guru</h1>

        <form method="POST" action="{{ route('guru.store') }}">
            @csrf

            <!-- Nama -->
            <div class="mb-3">
                <label class="font-semibold">Nama</label>
                <input type="text" name="name"
                    class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="font-semibold">Email</label>
                <input type="email" name="email"
                    class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            <!-- Sekolah -->
<div class="mb-3">
    <label class="font-semibold">Sekolah</label>

    <select name="school_id"
        class="w-full border rounded px-3 py-2 mt-1" required>

        <option value="">-- Pilih Sekolah --</option>

        @foreach ($schools as $school)
            <option value="{{ $school->id }}">
                {{ $school->nama_sekolah }}
            </option>
        @endforeach

    </select>
</div>

            <!-- Password -->
            <div class="mb-3">
                <label class="font-semibold">Password</label>
                <input type="password" name="password"
                    class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Simpan
            </button>

        </form>

    </div>

</x-app-layout>