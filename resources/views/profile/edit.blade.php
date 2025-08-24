{{-- resources/views/profile/edit.blade.php --}}
<x-app-layout>
    {{-- Header --}}
    <div class="bg-gray-50 min-h-screen">
        <div class="p-4 flex items-center border-b sticky top-0 bg-white z-10">
            {{-- Tombol kembali --}}
            <a href="{{ url()->previous() }}" class="text-gray-700">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-lg font-bold text-center flex-grow">Profil Saya</h1>
            <div class="w-6"></div>
        </div>

        {{-- Bagian foto profil --}}
        <div class="bg-green-500 p-4 rounded-b-3xl text-white text-center">
            <div class="flex justify-center mb-2">
                <img src="{{ Auth::user()->profile_photo_path
                    ? asset('storage/' . Auth::user()->profile_photo_path) . '?v=' . time()
                    : 'https://i.pravatar.cc/150?u=' . Auth::user()->id }}"
                    alt="Avatar" class="h-24 w-24 rounded-full border-4 border-white object-cover">
            </div>
            <p class="text-sm">Ubah Foto di form bawah</p>
        </div>

        {{-- ✅ Notifikasi flash message sebagai popup --}}
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
            <div class="m-4 p-3 bg-red-100 text-red-700 rounded shadow">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM UPDATE PROFIL --}}
        <div class="p-4 space-y-6" x-data="{ isEditing: false }">
            <section>
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="bg-white rounded-lg shadow p-4 space-y-4">
                        {{-- Tombol Edit / Batal --}}
                        <div class="flex justify-between items-center">
                            <h3 class="font-bold text-lg">Informasi Pribadi</h3>
                            <div>
                                <button type="button" @click="isEditing = true" x-show="!isEditing"
                                    class="text-sm text-green-600 font-semibold">Edit</button>
                                <button type="button" @click="isEditing = false" x-show="isEditing"
                                    class="text-sm text-gray-600 font-semibold">Batal</button>
                            </div>
                        </div>

                        {{-- Nama --}}
                        <div>
                            <label class="text-sm text-gray-500">Nama</label>
                            <p x-show="!isEditing" class="font-semibold text-gray-800">{{ $user->name }}</p>
                            <div x-show="isEditing">
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    :value="old('name', $user->name)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="text-sm text-gray-500">Email</label>
                            <p x-show="!isEditing" class="font-semibold text-gray-800">{{ $user->email }}</p>
                            <div x-show="isEditing">
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                    :value="old('email', $user->email)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                        </div>

                        {{-- Gender --}}
                        <div>
                            <label class="text-sm text-gray-500">Jenis Kelamin</label>
                            <p x-show="!isEditing" class="font-semibold text-gray-800">{{ $user->gender }}</p>
                            <div x-show="isEditing">
                                <select name="gender" id="gender"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="Laki-laki" @if (old('gender', $user->gender) == 'Laki-laki') selected @endif>
                                        Laki-laki</option>
                                    <option value="Perempuan" @if (old('gender', $user->gender) == 'Perempuan') selected @endif>
                                        Perempuan</option>
                                </select>
                            </div>
                        </div>

                        {{-- Tanggal lahir --}}
                        <div>
                            <label class="text-sm text-gray-500">Tanggal Lahir</label>
                            <p x-show="!isEditing" class="font-semibold text-gray-800">
                                {{ \Carbon\Carbon::parse($user->date_of_birth)->translatedFormat('d F Y') }}</p>
                            <div x-show="isEditing">
                                <x-text-input id="date_of_birth" name="date_of_birth" type="date"
                                    class="mt-1 block w-full" :value="old('date_of_birth', $user->date_of_birth)" />
                            </div>
                        </div>

                        {{-- Nomor HP --}}
                        <div>
                            <label class="text-sm text-gray-500">Nomor HP</label>
                            <p x-show="!isEditing" class="font-semibold text-gray-800">{{ $user->phone }}</p>
                            <div x-show="isEditing">
                                <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full"
                                    :value="old('phone', $user->phone)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>
                        </div>

                        {{-- Foto Profil --}}
                        <div x-show="isEditing">
                            <label for="profile_photo" class="text-sm text-gray-500">Ubah Foto Profil</label>
                            <input type="file" name="profile_photo" id="profile_photo"
                                class="mt-1 block w-full text-sm text-gray-500 
                                       file:mr-4 file:py-2 file:px-4 
                                       file:rounded-full file:border-0 
                                       file:text-sm file:font-semibold 
                                       file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                        </div>

                        {{-- Tombol simpan --}}
                        <div x-show="isEditing">
                            <x-primary-button
                                class="w-full justify-center">{{ __('Simpan Perubahan') }}</x-primary-button>
                        </div>
                    </div>
                </form>
            </section>

            {{-- === FORM UPDATE PASSWORD === --}}
            <section>
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')
                    <div class="bg-white rounded-lg shadow p-4 space-y-4">
                        <h3 class="font-bold text-lg">Ubah Password</h3>

                        {{-- Current Password --}}
                        <div>
                            <x-input-label for="current_password" value="Password Saat Ini" />
                            <x-text-input id="current_password" name="current_password" type="password"
                                class="mt-1 block w-full" autocomplete="current-password" />
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>

                        {{-- New Password --}}
                        <div>
                            <x-input-label for="password" value="Password Baru" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                                autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>

                        {{-- Confirm New Password --}}
                        <div>
                            <x-input-label for="password_confirmation" value="Konfirmasi Password Baru" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                class="mt-1 block w-full" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>

                        <x-primary-button class="w-full justify-center">
                            {{ __('Simpan Password Baru') }}</x-primary-button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
