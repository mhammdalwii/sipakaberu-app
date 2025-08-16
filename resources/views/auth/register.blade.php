<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg">

            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Buat Akun Anda</h1>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mt-4">
                    <x-text-input id="name" placeholder="Nama Lengkap" class="block mt-1 w-full" type="text"
                        name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-text-input id="phone" placeholder="Nomor Telepon" class="block mt-1 w-full" type="text"
                        name="phone" :value="old('phone')" required />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-text-input id="password" placeholder="Password" class="block mt-1 w-full" type="password"
                        name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-text-input id="password_confirmation" placeholder="Konfirmasi Password" class="block mt-1 w-full"
                        type="password" name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <x-text-input id="date_of_birth" placeholder="Tanggal Lahir" class="block w-full" type="text"
                            onfocus="(this.type='date')" onblur="(this.type='text')" name="date_of_birth"
                            :value="old('date_of_birth')" required />
                        <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                    </div>
                    <div>
                        <select name="gender" id="gender"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full">
                            <option value="">Jenis Kelamin</option>
                            <option value="Laki-laki" @if (old('gender') == 'Laki-laki') selected @endif>Laki-laki
                            </option>
                            <option value="Perempuan" @if (old('gender') == 'Perempuan') selected @endif>Perempuan
                            </option>
                        </select>
                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-4">
                    <textarea name="address" placeholder="Alamat"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full">{{ old('address') }}</textarea>
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>


                <div class="flex items-center justify-end mt-6">
                    <x-primary-button class="w-full justify-center text-lg"
                        style="background-color: #2ECC71; hover:background-color: #27AE60;">
                        Daftar
                    </x-primary-button>
                </div>
            </form>

            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">
                    Jika Anda sudah memiliki akun, Anda dapat
                    <a class="underline text-sm text-green-600 hover:text-green-800 rounded-md"
                        href="{{ route('login') }}">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
