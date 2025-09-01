<x-app-layout>
    <div class="bg-white min-h-screen">
        <div class="p-4 flex items-center border-b sticky top-0 bg-white z-10">
            <a href="{{ route('resep.index') }}" class="text-gray-700">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-lg font-bold text-center flex-grow">{{ $category->name }}</h1>
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

        <div class="p-4">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @forelse ($recipes as $recipe)
                    <a href="{{ route('resep.detail', $recipe->slug) }}"
                        class="block bg-white rounded-lg shadow-sm overflow-hidden">
                        <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}"
                            class="w-full h-32 object-cover">
                        <div class="p-3">
                            <h3 class="font-semibold text-sm truncate">{{ $recipe->title }}</h3>
                        </div>
                    </a>
                @empty
                    <p class="col-span-full text-center text-gray-500">Belum ada resep dalam kategori ini.</p>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $recipes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
