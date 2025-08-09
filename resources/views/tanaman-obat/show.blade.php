<x-app-layout>
    <div class="bg-white min-h-screen">
        <div class="p-4 flex items-center border-b sticky top-0 bg-white z-10">
            <a href="{{ route('tanaman-obat.index') }}" class="text-gray-700">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-lg font-bold text-center flex-grow truncate px-4">{{ $plant->name }}</h1>
            <div class="w-6"></div>
        </div>

        <div>
            <img src="{{ asset('storage/' . $plant->image) }}" alt="{{ $plant->name }}"
                class="w-full h-56 object-cover">

            <div class="p-4 space-y-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $plant->name }}</h2>
                    <p class="text-md italic text-gray-500">{{ $plant->scientific_name }}</p>
                </div>

                <div class="prose max-w-none text-gray-700">
                    {!! $plant->description !!}
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-3 border-b pb-2">Manfaat / Khasiat</h3>
                    <div class="prose max-w-none text-gray-700">
                        {!! $plant->benefits !!}
                    </div>
                </div>

                @if ($plant->how_to_use)
                    <div>
                        <h3 class="text-xl font-bold mb-3 border-b pb-2">Cara Penggunaan</h3>
                        <div class="prose max-w-none text-gray-700">
                            {!! $plant->how_to_use !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
