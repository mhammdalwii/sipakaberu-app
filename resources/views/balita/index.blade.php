<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <div class="p-4 flex items-center border-b sticky top-0 bg-white z-10">
            <a href="{{ route('dashboard') }}" class="text-gray-700">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-lg font-bold text-center flex-grow">Bank Data Balita</h1>
            <div class="w-6"></div>
        </div>

        <div class="p-4">
            {{-- Form pencarian --}}
            <form action="{{ route('balita.index') }}" method="GET" class="mb-6">
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari nama balita atau orang tua..."
                        class="w-full border-gray-300 rounded-full shadow-sm pl-10 focus:ring focus:ring-green-200 focus:border-green-500"
                        value="{{ request('search') }}">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </form>

            {{-- Info pencarian --}}
            @if (request('search'))
                <div class="mb-4 text-sm text-gray-600">
                    Ditemukan <span class="font-semibold">{{ $balitas->total() }}</span> hasil untuk pencarian
                    "<span class="italic">{{ request('search') }}</span>"
                </div>
            @endif

            {{-- informasi --}}
            <div class="mb-4 bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-r-lg" role="alert">
                <p class="font-bold">Informasi</p>
                <p class="text-sm">Data balita di bawah ini dikelola oleh admin. Klik pada nama balita untuk melihat
                    riwayat lengkap.</p>
            </div>

            <div class="space-y-4">
                @forelse ($balitas as $balita)
                    <a href="{{ route('balita.show', $balita) }}" class="block">
                        <div class="bg-white rounded-lg p-4 shadow hover:shadow-lg transition-shadow duration-300">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg text-gray-900">{{ $balita->name }}</h3>
                                    <p class="text-sm text-gray-500">Orang Tua: {{ $balita->user->name }}</p>
                                </div>
                                <div class="text-right">
                                    <span
                                        class="text-xs font-semibold text-blue-800 bg-blue-100 px-2 py-1 rounded-full">
                                        Lihat Riwayat
                                    </span>
                                </div>
                            </div>

                            {{-- pengukuran terakhir --}}
                            @if ($balita->measurement_date)
                                <div class="mt-3 border-t pt-3">
                                    <p class="text-sm text-gray-600">
                                        Pengukuran Terakhir:
                                        <span class="font-semibold">
                                            {{ \Carbon\Carbon::parse($balita->measurement_date)->translatedFormat('d F Y') }}
                                        </span>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </a>
                @empty
                    <div class="bg-white rounded-lg p-6 text-center shadow">
                        <p class="text-sm text-gray-500">Data balita tidak ditemukan.</p>
                    </div>
                @endforelse

                <div class="mt-4">
                    {{-- Pagination dengan query pencarian ikut terbawa --}}
                    {{ $balitas->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
