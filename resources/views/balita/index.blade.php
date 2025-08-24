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
            <form action="{{ route('balita.index') }}" method="GET" class="mb-6">
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari nama balita atau orang tua..."
                        class="w-full border-gray-300 rounded-full shadow-sm pl-10" value="{{ request('search') }}">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </form>

            <div class="p-4">
                <div class="mb-4 bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-r-lg" role="alert">
                    <p class="font-bold">Informasi</p>
                    <p class="text-sm">Data balita di bawah ini dikelola oleh admin. Silakan hubungi kader posyandu
                        untuk
                        penambahan atau perubahan data.</p>
                </div>

                <div class="space-y-4">
                    @forelse ($balitas as $balita)
                        <div class="bg-white rounded-lg p-4 shadow">
                            <div class="border-b pb-3 mb-3">
                                <h3 class="font-bold text-lg text-gray-900">{{ $balita->name }}</h3>
                                <p class="text-sm text-gray-500">Orang Tua: {{ $balita->user->name }}</p>
                                <p class="text-sm text-gray-600">Jenis Kelamin: {{ $balita->gender }}</p>
                                <p class="text-sm text-gray-600">Lahir:
                                    {{ \Carbon\Carbon::parse($balita->date_of_birth)->translatedFormat('d F Y') }}</p>
                            </div>

                            @if ($balita->measurement_date)
                                <p class="text-sm font-semibold text-gray-700 mb-3">
                                    Pengukuran Terakhir:
                                    {{ \Carbon\Carbon::parse($balita->measurement_date)->translatedFormat('d F Y') }}
                                </p>
                            @endif

                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                                <div>
                                    <p class="text-sm text-gray-500">Tinggi Badan</p>
                                    <p class="font-bold text-xl">{{ $balita->height }} <span
                                            class="text-sm font-normal">cm</span></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Berat Badan</p>
                                    <p class="font-bold text-xl">{{ $balita->weight }} <span
                                            class="text-sm font-normal">kg</span></p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Lingkar Lengan Atas</p>
                                    <p class="font-bold text-xl">{{ $balita->arm_circumference }} <span
                                            class="text-sm font-normal">cm</span></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Lingkar Kepala</p>
                                    <p class="font-bold text-lg">{{ $balita->head_circumference }} <span
                                            class="text-xs font-normal">cm</span></p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-lg p-6 text-center shadow">
                            <p class="text-sm text-gray-500">Data balita Anda belum ditambahkan oleh admin.</p>
                        </div>
                    @endforelse
                    <div class="mt-4">
                        {{ $balitas->links() }}
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
