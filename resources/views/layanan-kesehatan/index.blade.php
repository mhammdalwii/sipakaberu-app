<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <div class="p-4 flex items-center border-b sticky top-0 bg-white z-10">
            <a href="{{ route('dashboard') }}" class="text-gray-700">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-lg font-bold text-center flex-grow">Layanan Kesehatan</h1>
            <div class="w-6"></div>
        </div>

        <div class="p-4">
            <form action="{{ route('layanan-kesehatan.index') }}" method="GET" class="mb-6">
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari nama posyandu, desa..."
                        class="w-full border-gray-300 rounded-full shadow-sm pl-10" value="{{ request('search') }}">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </form>

            <div class="space-y-4">
                @forelse ($posyandus as $posyandu)
                    <div class="bg-white rounded-lg p-4 shadow">
                        <h3 class="font-bold text-md text-gray-900">{{ $posyandu->name }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ $posyandu->address }}</p>
                        <div class="mt-3 border-t pt-3 flex justify-between text-xs text-gray-500">
                            <span>🗓️ {{ $posyandu->schedule_day ?? 'Tidak terjadwal' }}</span>
                            <span>🕒 {{ $posyandu->schedule_time ?? '-' }}</span>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg p-6 text-center shadow">
                        <p class="text-sm text-gray-500">Data Posyandu tidak ditemukan.</p>
                    </div>
                @endforelse

                <div class="mt-4">
                    {{ $posyandus->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
