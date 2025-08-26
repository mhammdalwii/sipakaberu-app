<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-50 px-6">
        <!-- Container -->
        <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8 lg:p-10">
            <!-- Logo -->
            <div class="mb-6 text-center">
                <img src="{{ asset('images/logoSipakaberu.png') }}" alt="Logo" class="w-20 h-20 mx-auto">
            </div>

            <!-- Judul -->
            <h2 class="text-2xl font-bold text-gray-900 text-center mb-2">Selamat Datang</h2>
            <p class="text-gray-600 text-center mb-6 text-sm lg:text-base">
                Bersama <span class="font-semibold text-green-600">Sipakaberu</span>, hidup sehat dimulai dari sini.
            </p>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Nomor Telepon -->
                <div class="relative">
                    <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                        class="block w-full px-4 py-3 text-gray-900 border border-gray-300 rounded-lg bg-white placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:border-green-500"
                        placeholder="Nomor Telepon" required autofocus>
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="relative">
                    <input id="password" type="password" name="password"
                        class="block w-full px-4 py-3 text-gray-900 border border-gray-300 rounded-lg bg-white placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:border-green-500"
                        placeholder="Kata Sandi" required>
                    <button type="button" onclick="togglePassword()"
                        class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">
                        <!-- Ikon mata -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Tombol Masuk -->
                <button type="submit"
                    class="w-full py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition font-medium">
                    Masuk
                </button>
            </form>

            <!-- Divider -->
            <div class="flex items-center my-6">
                <hr class="flex-grow border-gray-300">
                <span class="mx-2 text-gray-400 text-sm">atau</span>
                <hr class="flex-grow border-gray-300">
            </div>

            <!-- Daftar -->
            <p class="text-gray-600 text-sm text-center">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-green-600 hover:underline font-medium">Daftar di sini</a>
            </p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        }
    </script>
</x-guest-layout>
