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

        <div class="space-y-6 py-4">
            @foreach ($recipeCategories as $category)
                @if ($category->recipes->isNotEmpty())
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
        </div>
    </div>
</x-app-layout>
