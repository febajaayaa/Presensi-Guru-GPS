<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-200 via-blue-100 to-white">

    <div class="w-full max-w-md">

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

        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label class="text-sm font-semibold text-gray-600">Email</label>
                <input type="email" name="email"
                    class="w-full mt-1 px-4 py-2 rounded-xl border focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="text-sm font-semibold text-gray-600">Password</label>
                <input type="password" name="password"
                    class="w-full mt-1 px-4 py-2 rounded-xl border focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    required>
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