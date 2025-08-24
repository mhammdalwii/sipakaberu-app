<x-app-layout>
    {{-- Mengosongkan header bawaan --}}
    <x-slot name="header">
        <div class="hidden"></div>
    </x-slot>

    <div class="bg-white min-h-screen">
        <div class="p-4 flex items-center border-b">
            <a href="{{ route('dashboard') }}" class="text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-lg font-bold text-center flex-grow">Edukasi</h1>
            <div class="w-6"></div>
        </div>

        <div class="space-y-6 py-4">
            <div class="px-4">
                <div class="bg-green-100 rounded-lg flex items-center justify-center h-32">
                    <h2 class="text-green-800 font-bold text-xl">Kegiatan Posyandu</h2>
                </div>
            </div>

            @php
                $hasPosts = false;
            @endphp

            @foreach ($categories as $category)
                @if ($category->educationPosts->isNotEmpty())
                    @php $hasPosts = true; @endphp
                    <div class="space-y-3">
                        <div class="flex justify-between items-center px-4">
                            <h2 class="font-bold text-md text-gray-800">{{ $category->name }}</h2>
                            <a href="{{ route('edukasi.show', $category->slug) }}"
                                class="text-sm text-green-600 font-semibold">Lihat Semua</a>
                        </div>

                        <div class="flex overflow-x-auto space-x-4 px-4 pb-2">
                            @foreach ($category->educationPosts as $post)
                                <a href="{{ route('edukasi.post.show', $post->slug) }}"
                                    class="flex-shrink-0 w-[45%] md:w-[22%]">
                                    {{-- Thumbnail edukasi --}}
                                    <div
                                        class="bg-gray-200 rounded-lg h-24 w-full flex items-center justify-center mb-2">
                                        <img src="{{ asset('images/edukasi.png') }}" alt="{{ $post->title }}"
                                            class="w-full h-full rounded-lg object-cover">
                                    </div>
                                    <h3 class="text-sm font-medium text-gray-800 truncate">{{ $post->title }}</h3>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach

            {{-- Jika tidak ada edukasi sama sekali --}}
            @if (!$hasPosts)
                <div class="text-center text-gray-500 py-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-lg font-semibold">Belum ada edukasi tersedia</p>
                    <p class="text-sm text-gray-400">Tunggu ya, konten edukasi akan segera hadir 📚</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
