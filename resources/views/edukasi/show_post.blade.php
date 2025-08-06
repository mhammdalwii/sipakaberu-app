<x-app-layout>
    {{-- Kita kosongkan header bawaan --}}
    <x-slot name="header">
        <div class="hidden"></div>
    </x-slot>

    <div class="bg-white min-h-screen">
        <div class="p-4 flex items-center border-b sticky top-0 bg-white z-10">
            {{-- Tombol ini akan berfungsi seperti tombol "back" di browser --}}
            <a href="javascript:history.back()" class="text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-lg font-bold text-center flex-grow">Edukasi</h1>
            <div class="w-6"></div>
        </div>

        <div>
            <div class="w-full aspect-w-16 aspect-h-7">
                {{-- Pastikan URL di database adalah URL embed dari YouTube --}}
                <iframe src="{{ $post->video_url }}" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen class="w-full h-full">
                </iframe>
            </div>

            <div class="p-4">
                <h2 class="text-xl font-bold mb-3">{{ $post->title }}</h2>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <h3 class="font-bold mb-2">Deskripsi Vidio</h3>
                    <div class="prose prose-sm max-w-none text-gray-600">
                        {!! $post->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
