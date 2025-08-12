<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        {{-- Header --}}
        <div class="p-4 flex items-center border-b sticky top-0 bg-white z-10">
            <a href="{{ route('profile.show') }}" class="text-gray-700">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-lg font-bold text-center flex-grow">Profil Saya</h1>
            <div class="w-6"></div>
        </div>

        {{-- Avatar --}}
        <div class="bg-green-500 p-4 rounded-b-3xl text-white text-center">
            <div class="flex justify-center mb-2">
                <div class="relative">
                    <img src="https://i.pravatar.cc/150?u={{ Auth::user()->id }}" alt="Avatar"
                        class="h-24 w-24 rounded-full border-4 border-white">
                </div>
            </div>
            <button class="text-sm font-semibold">Ubah Foto</button>
        </div>

        <div class="p-4 space-y-6">
            {{-- Update Profile --}}
            <section>
                @if (session('status') === 'profile-updated')
                    {{-- Modal Notification --}}
                    <div id="successModal"
                        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
                        <div class="bg-white rounded-xl shadow-lg max-w-sm w-full p-6 text-center">
                            <svg class="w-12 h-12 mx-auto text-green-500" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2l4-4m6 2a9 9 0 1 1 -18 0a9 9 0 0 1 18 0z" />
                            </svg>
                            <h2 class="mt-4 text-lg font-semibold text-gray-800">Berhasil!</h2>
                            <p class="mt-2 text-sm text-gray-600">Data profil berhasil diperbarui.</p>
                        </div>
                    </div>

                    {{-- Script Auto-Close --}}
                    <script>
                        setTimeout(() => {
                            const modal = document.getElementById('successModal');
                            if (modal) {
                                modal.style.display = 'none';
                            }
                        }, 3000);
                    </script>
                @endif

                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="bg-white rounded-lg shadow p-4 space-y-4">
                        {{-- Name --}}
                        <div>
                            <x-input-label for="name" value="Nama" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $user->name)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        {{-- Gender --}}
                        <div>
                            <x-input-label for="gender" value="Jenis Kelamin" />
                            <select name="gender" id="gender"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="Laki-laki" @if (old('gender', $user->gender) == 'Laki-laki') selected @endif>
                                    Laki-laki
                                </option>
                                <option value="Perempuan" @if (old('gender', $user->gender) == 'Perempuan') selected @endif>
                                    Perempuan
                                </option>
                            </select>
                        </div>

                        {{-- Date of Birth --}}
                        <div>
                            <x-input-label for="date_of_birth" value="Tanggal Lahir" />
                            <x-text-input id="date_of_birth" name="date_of_birth" type="date"
                                class="mt-1 block w-full" :value="old('date_of_birth', $user->date_of_birth)" />
                        </div>

                        {{-- Phone --}}
                        <div>
                            <x-input-label for="phone" value="No. Telepon" />
                            <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full"
                                :value="old('phone', $user->phone)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>

                        <x-primary-button class="w-full justify-center">
                            {{ __('Simpan Perubahan') }}
                        </x-primary-button>
                    </div>
                </form>
            </section>

            {{-- Update Password --}}
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
                            {{ __('Simpan Password Baru') }}
                        </x-primary-button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
