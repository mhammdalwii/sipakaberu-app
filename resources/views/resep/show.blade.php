<x-app-layout>
    <div class="bg-white min-h-screen">
        <div class="p-4 flex items-center border-b sticky top-0 bg-white z-10">
            <a href="{{ route('resep.index') }}" class="text-gray-700">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-lg font-bold text-center flex-grow truncate px-4">{{ $recipe->title }}</h1>
            <div class="w-6"></div>
        </div>

        <div>
            <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}"
                class="w-full h-56 object-cover">

            <div class="p-4">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $recipe->title }}</h2>
                <p class="text-gray-600 mb-6">{{ $recipe->description }}</p>

                <div class="flex flex-wrap gap-4 text-center border-y py-4 mb-6">
                    <div class="flex-1">
                        <p class="text-sm text-gray-500">Waktu Siap</p>
                        <p class="font-bold">{{ $recipe->prep_time ?? 'N/A' }} Menit</p>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-500">Waktu Masak</p>
                        <p class="font-bold">{{ $recipe->cook_time ?? 'N/A' }} Menit</p>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-500">Porsi</p>
                        <p class="font-bold">{{ $recipe->servings ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-xl font-bold mb-3">Bahan-bahan</h3>
                    <div class="prose max-w-none text-gray-700">
                        {!! $recipe->ingredients !!}
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-3">Cara Membuat</h3>
                    <div class="prose max-w-none text-gray-700">
                        {!! $recipe->instructions !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
