<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <div class="p-4 flex items-center border-b sticky top-0 bg-white z-10">
            <a href="{{ route('dashboard') }}" class="text-gray-700">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-lg font-bold text-center flex-grow">Tanaman Obat</h1>
            <div class="w-6"></div>
        </div>

        <div class="p-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @forelse ($plants as $plant)
                    <a href="{{ route('tanaman-obat.show', $plant->slug) }}"
                        class="block bg-white rounded-lg shadow overflow-hidden group">
                        <img src="{{ asset('storage/' . $plant->image) }}" alt="{{ $plant->name }}"
                            class="w-full h-32 object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="p-3">
                            <h3 class="font-semibold text-sm truncate">{{ $plant->name }}</h3>
                        </div>
                    </a>
                @empty
                    <p class="col-span-full text-center text-gray-500">Belum ada data tanaman obat.</p>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $plants->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
