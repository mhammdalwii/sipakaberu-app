<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Menampilkan nama kategori sebagai judul --}}
            Edukasi: {{ $category->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Tombol kembali --}}
                    <a href="{{ route('edukasi.index') }}" class="text-green-600 hover:underline mb-6 inline-block">&larr;
                        Kembali ke semua kategori</a>

                    {{-- Menampilkan daftar video --}}
                    <div class="space-y-8">
                        @forelse ($category->educationPosts as $post)
                            <div class="border rounded-lg p-6 shadow-sm">
                                <h3 class="text-2xl font-bold mb-3">{{ $post->title }}</h3>

                                {{-- Menampilkan Video (Embed dari YouTube) --}}
                                <div class="aspect-w-16 aspect-h-9 mb-4">
                                    {{-- Pastikan URL di database adalah URL embed --}}
                                    {{-- Contoh URL Embed: https://www.youtube.com/embed/KODE_VIDEO --}}
                                    <iframe src="{{ $post->video_url }}" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen class="w-full h-full rounded-md"></iframe>
                                </div>

                                {{-- Deskripsi dari Rich Editor --}}
                                <div class="prose max-w-none">
                                    {!! $post->description !!}
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500">
                                Belum ada video untuk kategori ini.
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- Catatan: Agar 'aspect-ratio' berfungsi, Anda perlu menambahkannya di tailwind.config.js jika belum ada --}}
{{-- plugins: [require('@tailwindcss/aspect-ratio')], --}}
