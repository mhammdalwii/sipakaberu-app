<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <div class="p-4 flex items-center border-b sticky top-0 bg-white z-10">
            <a href="{{ route('dashboard') }}" class="text-gray-700">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-lg font-bold text-center flex-grow">Pusat Bantuan</h1>
            <div class="w-6"></div>
        </div>

        <div class="p-4 space-y-2">
            @forelse ($articles as $article)
                {{-- Kita menggunakan Alpine.js (bawaan Breeze) untuk toggle --}}
                <div x-data="{ open: false }" class="bg-white rounded-lg shadow">
                    {{-- Judul Artikel (Tombol Toggle) --}}
                    <button @click="open = !open" class="w-full flex justify-between items-center text-left p-4">
                        <h3 class="font-bold text-md text-gray-800">{{ $article->title }}</h3>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform"
                            :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Konten Artikel yang bisa disembunyikan/ditampilkan --}}
                    <div x-show="open" x-collapse class="p-4 border-t">
                        <div class="prose max-w-none text-gray-700">
                            {!! $article->content !!}
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg p-6 text-center shadow">
                    <p class="text-sm text-gray-500">Belum ada artikel bantuan yang ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
