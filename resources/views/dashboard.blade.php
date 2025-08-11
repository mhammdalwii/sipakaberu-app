<x-app-layout>
    {{-- Kita kosongkan header bawaan agar bisa membuat layout custom --}}
    <x-slot name="header">
        <div class="hidden"></div>
    </x-slot>

    <div class="bg-gray-50 min-h-screen">
        {{-- BAGIAN 1: HEADER HIJAU DENGAN NAMA & AVATAR --}}
        <div class="bg-green-500 p-4 rounded-b-3xl shadow-lg text-white relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    {{-- Mengambil nama pengguna yang sedang login --}}
                    <h1 class="text-xl font-bold">Hi, {{ Auth::user()->name }}</h1>
                    <p class="text-sm">Selamat Datang di SIKABERU</p>
                </div>
                <div>
                    {{-- Avatar placeholder, akan unik untuk setiap user berdasarkan ID-nya --}}
                    <img src="https://i.pravatar.cc/150?u={{ Auth::user()->id }}" alt="Avatar"
                        class="h-14 w-14 rounded-full border-2 border-white">
                </div>
            </div>
        </div>

        {{-- BAGIAN 2: KONTEN UTAMA (SEARCH, MENU, KARTU) --}}
        <div class="p-4 -mt-2 relative z-0">
            {{-- Search Bar --}}
            <div class="mb-6">
                <input type="text" placeholder="Cari"
                    class="w-full border-gray-300 rounded-full shadow-md focus:ring-green-500 focus:border-green-500">
            </div>

            {{-- Grid Menu Utama --}}
            <div class="grid grid-cols-3 gap-4 text-center mb-6">
                {{-- Anda perlu menyiapkan gambar ikon di folder public/images/icons/ --}}
                <a href="{{ route('edukasi.index') }}"
                    class="flex flex-col items-center p-2 bg-white rounded-lg shadow">
                    <img src="https://placehold.co/48x48/E0F2F1/00796B?text=EDU" alt="Edukasi" class="h-12 w-12 mb-1">
                    <span class="text-xs font-medium">Edukasi</span>
                </a>
                <a href="{{ route('resep.index') }}" class="flex flex-col items-center p-2 bg-white rounded-lg shadow">
                    <img src="https://placehold.co/48x48/FFF3E0/E65100?text=RSP" alt="Resep" class="h-12 w-12 mb-1">
                    <span class="text-xs font-medium">Resep Makanan</span>
                </a>
                <a href="{{ route('jadwal.index') }}" class="flex flex-col items-center p-2 bg-white rounded-lg shadow">
                    <img src="https://placehold.co/48x48/F3E5F5/6A1B9A?text=JDW" alt="Jadwal" class="h-12 w-12 mb-1">
                    <span class="text-xs font-medium">Jadwal</span>
                </a>
                <a href="{{ route('tanaman-obat.index') }}"
                    class="flex flex-col items-center p-2 bg-white rounded-lg shadow">
                    <img src="https://placehold.co/48x48/E8F5E9/2E7D32?text=OBT" alt="Tanaman" class="h-12 w-12 mb-1">
                    <span class="text-xs font-medium">Tanaman Obat</span>
                </a>
                <a href="{{ route('layanan-kesehatan.index') }}"
                    class="flex flex-col items-center p-2 bg-white rounded-lg shadow">
                    <img src="https://placehold.co/48x48/FFEBEE/B71C1C?text=LYN" alt="Layanan" class="h-12 w-12 mb-1">
                    <span class="text-xs font-medium">Layanan</span>
                </a>
                <a href="{{ route('pusat-bantuan.index') }}"
                    class="flex flex-col items-center p-2 bg-white rounded-lg shadow">
                    <img src="https://placehold.co/48x48/E0F7FA/006064?text=HELP" alt="Bantuan" class="h-12 w-12 mb-1">
                    <span class="text-xs font-medium">Pusat Bantuan</span>
                </a>
            </div>

            {{-- Jadwal Pemeriksaan Mendatang --}}
            <div class="mb-6">
                <h3 class="font-bold text-lg mb-2 text-gray-800">Jadwal Pemeriksaan akan datang!</h3>

                {{-- Cek apakah ada data jadwal --}}
                @if ($upcomingAppointment)
                    <div class="bg-white rounded-lg p-4 flex justify-between items-center shadow">
                        <div>
                            <p class="text-xs text-gray-500">🗓️ {{ $upcomingAppointment->location }}</p>
                            <p class="font-bold text-md">{{ $upcomingAppointment->title }}</p>
                        </div>
                        <div class="text-center border-l pl-4 ml-4">
                            <p class="font-bold text-xl text-red-500">
                                {{ $upcomingAppointment->schedule_date->format('d') }}</p>
                            <p class="text-xs text-gray-500 uppercase">
                                {{ $upcomingAppointment->schedule_date->translatedFormat('M Y') }}</p>
                        </div>
                    </div>
                @else
                    {{-- Tampilkan ini jika tidak ada jadwal --}}
                    <div class="bg-white rounded-lg p-4 text-center shadow">
                        <p class="text-sm text-gray-500">Belum ada jadwal yang akan datang.</p>
                    </div>
                @endif
            </div>

            {{-- Spesial untukmu --}}
            <div class="mb-24">
                <h3 class="font-bold text-lg mb-2 text-gray-800">Spesial untukmu</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    {{-- Ini akan diisi dengan loop artikel/video nanti --}}
                    <div class="h-24 bg-white rounded-lg shadow"></div>
                    <div class="h-24 bg-white rounded-lg shadow"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- BAGIAN 3: BOTTOM NAVIGATION BAR --}}
    <div class="fixed bottom-0 left-0 w-full bg-white shadow-[0_-2px_5px_rgba(0,0,0,0.1)] px-4 py-2 z-20">
        <div class="flex justify-around">
            <a href="{{ route('dashboard') }}" class="flex flex-col items-center text-green-500">
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
            <a href="#" class="flex flex-col items-center text-gray-400 hover:text-green-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                    </path>
                </svg>
                <span class="text-xs">Notifikasi</span>
            </a>
            <a href="{{ route('profile.edit') }}"
                class="flex flex-col items-center text-gray-400 hover:text-green-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span class="text-xs">Profil</span>
            </a>
        </div>
    </div>
</x-app-layout>
