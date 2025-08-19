{{-- resources/views/profile/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profil') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Notifikasi flash message --}}
            @if (session('status'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition
                    class="fixed top-5 right-5 z-50 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414L9 14.414 5.293 10.707a1 1 0 111.414-1.414L9 11.586l6.293-6.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>
                        @if (session('status') === 'profile-updated')
                            Profil berhasil diperbarui 🎉
                        @elseif (session('status') === 'photo-updated')
                            Foto profil berhasil diganti 📷
                        @elseif (session('status') === 'password-updated')
                            Password berhasil diperbarui 🔑
                        @else
                            {{ session('status') }}
                        @endif
                    </span>
                </div>
            @endif

            {{-- Error validasi --}}
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- === FORM UPDATE PROFIL === --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    {{-- Nama --}}
                    <div class="mb-4">
                        <label for="name" class="block font-medium text-sm text-gray-700">Nama</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    {{-- Phone --}}
                    <div class="mb-4">
                        <label for="phone" class="block font-medium text-sm text-gray-700">Nomor HP</label>
                        <input id="phone" type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    {{-- Gender --}}
                    <div class="mb-4">
                        <label for="gender" class="block font-medium text-sm text-gray-700">Jenis Kelamin</label>
                        <select id="gender" name="gender"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="Laki-laki"
                                {{ old('gender', $user->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan"
                                {{ old('gender', $user->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="mb-4">
                        <label for="date_of_birth" class="block font-medium text-sm text-gray-700">Tanggal Lahir</label>
                        <input id="date_of_birth" type="date" name="date_of_birth"
                            value="{{ old('date_of_birth', $user->date_of_birth) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    {{-- Foto Profil --}}
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Foto Profil</label>

                        @if ($user->profile_photo_path)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Profile Photo"
                                    class="w-24 h-24 rounded-full object-cover">
                            </div>
                        @endif

                        <input type="file" name="profile_photo" accept="image/*"
                            class="block w-full text-sm text-gray-500">
                    </div>

                    <div class="flex items-center gap-3">
                        <x-primary-button>Simpan</x-primary-button>
                        {{-- Tombol kembali --}}
                        <a href="{{ 'profil' }}"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>

            {{-- === FORM UPDATE PASSWORD === --}}
            <section>
                <form method="post" action="{{ route('password.update') }}"> @csrf @method('put') <div
                        class="bg-white rounded-lg shadow p-4 space-y-4">
                        <h3 class="font-bold text-lg">Ubah Password</h3>
                        {{-- Current Password --}}
                        <div>
                            <x-input-label for="current_password" value="Password Saat Ini" /> <x-text-input
                                id="current_password" name="current_password" type="password" class="mt-1 block w-full"
                                autocomplete="current-password" /> <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>
                        {{-- New Password --}}
                        <div> <x-input-label for="password" value="Password Baru" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                                autocomplete="new-password" /> <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>
                        {{-- Confirm New Password --}}
                        <div> <x-input-label for="password_confirmation" value="Konfirmasi Password Baru" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                class="mt-1 block w-full" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>
                        <x-primary-button class="w-full justify-center"> {{ __('Simpan Password Baru') }}
                        </x-primary-button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
