<x-app-layout>
    <x-slot name="header">
        <div class="hidden"></div>
    </x-slot>

    <div class="bg-gray-50 min-h-screen">
        {{-- Header Hijau --}}
        <div class="bg-green-500 p-4 rounded-b-3xl shadow-lg text-white">
            <div class="flex items-center space-x-4">
                <img src="https://i.pravatar.cc/150?u={{ Auth::user()->id }}" alt="Avatar"
                    class="h-16 w-16 rounded-full border-2 border-white">
                <div>
                    {{-- Mengambil nama pengguna yang sedang login --}}
                    <h1 class="text-xl font-bold">{{ Auth::user()->name }}</h1>
                </div>
            </div>
        </div>

        {{-- Menu List --}}
        <div class="p-4">
            <div class="bg-white rounded-lg shadow">
                <ul class="divide-y divide-gray-200">
                    {{-- Link ke Halaman Edit Profil Bawaan Breeze --}}
                    <li>
                        <a href="{{ route('profile.edit') }}" class="flex items-center p-4 space-x-3 hover:bg-gray-50">
                            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="font-medium text-gray-700">Profil Saya</span>
                        </a>
                    </li>
                    {{-- Link Pengaturan (Placeholder) --}}
                    <li>
                        <a href="#" class="flex items-center p-4 space-x-3 hover:bg-gray-50">
                            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="font-medium text-gray-700">Pengaturan</span>
                        </a>
                    </li>
                    {{-- Tombol Keluar --}}
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="flex items-center p-4 space-x-3 hover:bg-gray-50">
                                <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                <span class="font-medium text-gray-700">Keluar</span>
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom Navigation Bar --}}
        <div class="fixed bottom-0 left-0 w-full bg-white shadow-[0_-2px_5px_rgba(0,0,0,0.1)] px-4 py-2 z-20">
            <div class="flex justify-around">
                <a href="{{ route('dashboard') }}"
                    class="flex flex-col items-center text-gray-400 hover:text-green-500">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                        </path>
                    </svg>
                    <span class="text-xs">Beranda</span>
                </a>
                <a href="#" class="flex flex-col items-center text-gray-400 hover:text-green-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                    <span class="text-xs">Konsultasi</span>
                </a>
                <a href="{{ route('notifikasi.index') }}"
                    class="flex flex-col items-center text-gray-400 hover:text-green-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                    <span class="text-xs">Notifikasi</span>
                </a>
                <a href="{{ route('profile.show') }}" class="flex flex-col items-center text-green-500">
                    {{-- <-- Link Aktif --}}
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="text-xs">Profil</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
