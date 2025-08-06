<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-white px-6 lg:px-0">
        <!-- Container -->
        <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-6 lg:p-10">
            <!-- Logo -->
            <div class="mb-6 text-center">
                <img src="{{ asset('images/logoSipakaberu.png') }}" alt="Logo" class="w-16 h-16 mx-auto">
            </div>

            <!-- Judul -->
            <h2 class="text-2xl font-bold text-gray-900 text-center">Selamat Datang</h2>
            <p class="text-gray-600 text-center mb-6 text-sm lg:text-base">
                Bersama SIKABERU,<br>
                hidup sehat dimulai dari sini.
            </p>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="w-full">
                @csrf

                <!-- Nomor Telepon -->
                <div class="mb-4 relative">
                    <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                        class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-100 placeholder-gray-500 focus:ring-green-500 focus:border-green-500"
                        placeholder="Nomor Telepon" required autofocus>
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4 relative">
                    <input id="password" type="password" name="password"
                        class="block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-100 placeholder-gray-500 focus:ring-green-500 focus:border-green-500"
                        placeholder="••••••••" required>
                    <button type="button" onclick="togglePassword()" class="absolute right-3 top-2.5 text-gray-500">
                        👁
                    </button>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Tombol Masuk -->
                <button type="submit"
                    class="w-full py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition text-base lg:text-lg font-medium">
                    Masuk
                </button>
            </form>

            <!-- Divider -->
            <div class="flex items-center w-full my-4">
                <hr class="flex-grow border-gray-300">
                <span class="mx-2 text-gray-500 text-sm lg:text-base">atau lanjutkan dengan</span>
                <hr class="flex-grow border-gray-300">
            </div>

            <!-- Daftar -->
            <p class="text-gray-600 text-sm lg:text-base text-center">
                Jika Anda sudah memiliki akun,<br>
                Anda dapat <a href="{{ route('register') }}" class="text-green-500 hover:underline">Daftar di sini</a>
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
