<x-app-layout>
    <div class="bg-white min-h-screen">
        <div class="p-4 flex items-center border-b sticky top-0 bg-white z-10">
            <a href="{{ route('dashboard') }}" class="text-gray-700">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-lg font-bold text-center flex-grow">Resep Makanan Sehat</h1>
            <div class="w-6"></div>
        </div>

        <div class="p-4">
            <form action="{{ route('resep.index') }}" method="GET">
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari nama resep..."
                        class="w-full border-gray-300 rounded-full shadow-sm pl-10" value="{{ request('search') }}">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </form>
        </div>

        <div class="space-y-6 pb-4">
            @php
                $hasRecipes = false;
            @endphp

            @foreach ($recipeCategories as $category)
                @if ($category->recipes->isNotEmpty())
                    @php $hasRecipes = true; @endphp
                    <div class="space-y-3">
                        <div class="flex justify-between items-center px-4">
                            <h2 class="font-bold text-md text-gray-800">{{ $category->name }}</h2>
                            <a href="{{ route('resep.category', $category->slug) }}"
                                class="text-sm text-green-600 font-semibold">Lihat Semua</a>
                        </div>

                        <div class="flex overflow-x-auto space-x-4 px-4 pb-2">
                            @foreach ($category->recipes as $recipe)
                                <a href="{{ route('resep.detail', $recipe->slug) }}"
                                    class="flex-shrink-0 w-2/5 md:w-1/5">
                                    <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}"
                                        class="w-full h-24 rounded-lg object-cover mb-2">
                                    <h3 class="text-sm font-medium text-gray-800 truncate">{{ $recipe->title }}</h3>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach

            {{-- Jika tidak ada resep sama sekali --}}
            @if (!$hasRecipes)
                <div class="text-center text-gray-500 py-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <p class="text-lg font-semibold">Resep tidak ditemukan</p>
                    <p class="text-sm text-gray-400">Coba gunakan kata kunci lain.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
