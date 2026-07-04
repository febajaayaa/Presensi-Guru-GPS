<x-guest-layout>

    <div class="w-full max-w-sm bg-white/80 backdrop-blur-lg p-6 rounded-3xl shadow-2xl">

        <!-- LOGO -->
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('login.png') }}"
                 class="w-30 h-20 rounded-2xl shadow-md hover:scale-110 transition duration-300"
                 alt="Logo">

            <h1 class="text-2xl font-extrabold text-gray-800 mt-3 italic">
                Selamat Datang
            </h1>
            <p class="text-sm text-gray-500">
                Presensi Guru Berbasis GPS
            </p>
        </div>

        <!-- STATUS -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- PESAN ERROR UMUM (email/password salah) -->
        @if ($errors->has('email'))
            <div class="mb-4 flex items-start gap-2 rounded-xl border border-red-300 bg-red-50 px-4 py-3">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.007v.008H12v-.008zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm text-red-600 font-medium">
                    {{ $errors->first('email') }}
                </p>
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label class="text-sm font-semibold text-gray-600">Email</label>
                <input type="email" name="email"
                    value="{{ old('email') }}"
                    class="w-full mt-1 px-4 py-2 rounded-xl border focus:ring-2 focus:outline-none
                        {{ $errors->has('email') ? 'border-red-400 focus:ring-red-300' : 'border-gray-300 focus:ring-blue-400' }}"
                    required autofocus>
                @error('email')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="text-sm font-semibold text-gray-600">Password</label>
                <input type="password" name="password"
                    class="w-full mt-1 px-4 py-2 rounded-xl border focus:ring-2 focus:outline-none
                        {{ $errors->has('email') ? 'border-red-400 focus:ring-red-300' : 'border-gray-300 focus:ring-blue-400' }}"
                    required>
                @error('password')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember -->
            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center text-sm">
                    <input type="checkbox" name="remember" class="mr-2">
                    Ingat saya
                </label>

                <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">
                    Lupa?
                </a>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-xl font-semibold hover:bg-blue-700 transition duration-300 shadow-md">
                Login
            </button>

        </form>

    </div>

</x-guest-layout>