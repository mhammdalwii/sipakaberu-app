<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        {{-- Header --}}
        <div class="p-4 flex items-center border-b sticky top-0 bg-white z-10">
            <a href="{{ route('balita.index') }}" class="text-gray-700">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-lg font-bold text-center flex-grow truncate px-4">{{ $balita->name }}</h1>
            <div class="w-6"></div>
        </div>

        <div class="p-4 space-y-6">
            {{-- Data Dasar --}}
            <div class="bg-white rounded-lg p-4 shadow">
                <h2 class="text-xl font-bold text-gray-900">{{ $balita->name }}</h2>
                <p class="text-sm text-gray-600">{{ $balita->gender }}</p>
                <p class="text-sm text-gray-500">Lahir:
                    {{ \Carbon\Carbon::parse($balita->date_of_birth)->translatedFormat('d F Y') }}
                </p>
                <p class="text-sm text-gray-500">Orang Tua: {{ $balita->user->name }}</p>
            </div>

            {{-- Pengukuran Pertama & Terakhir --}}
            @if ($balita->measurements->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Terakhir --}}
                    @php $lastMeasurement = $balita->measurements->first(); @endphp
                    <div class="bg-white rounded-lg p-4 shadow border-l-4 border-green-500">
                        <h3 class="font-bold text-md mb-2">Pengukuran Terakhir</h3>
                        <p class="text-sm text-gray-500 mb-2">
                            {{ \Carbon\Carbon::parse($lastMeasurement->measurement_date)->translatedFormat('d F Y') }}
                        </p>
                        <div class="grid grid-cols-2 gap-2 text-center">
                            <div>
                                <p class="text-xs">Tinggi Badan</p>
                                <p class="font-semibold">{{ $lastMeasurement->height }} cm</p>
                            </div>
                            <div>
                                <p class="text-xs">Berat Badan</p>
                                <p class="font-semibold">{{ $lastMeasurement->weight }} kg</p>
                            </div>
                            <div>
                                <p class="text-xs">Lingkar Lengan Atas</p>
                                <p class="font-semibold">{{ $lastMeasurement->arm_circumference }} cm</p>
                            </div>
                            <div>
                                <p class="text-xs">Lingkar Kepala</p>
                                <p class="font-semibold">{{ $lastMeasurement->head_circumference }} cm</p>
                            </div>
                        </div>
                    </div>

                    {{-- Pertama --}}
                    @if ($balita->measurements->count() > 1)
                        @php $firstMeasurement = $balita->measurements->last(); @endphp
                        <div class="bg-white rounded-lg p-4 shadow border-l-4 border-blue-500">
                            <h3 class="font-bold text-md mb-2">Pengukuran Pertama</h3>
                            <p class="text-sm text-gray-500 mb-2">
                                {{ \Carbon\Carbon::parse($firstMeasurement->measurement_date)->translatedFormat('d F Y') }}
                            </p>
                            <div class="grid grid-cols-2 gap-2 text-center">
                                <div>
                                    <p class="text-xs">Tinggi Badan</p>
                                    <p class="font-semibold">{{ $firstMeasurement->height }} cm</p>
                                </div>
                                <div>
                                    <p class="text-xs">Berat Badan</p>
                                    <p class="font-semibold">{{ $firstMeasurement->weight }} kg</p>
                                </div>
                                <div>
                                    <p class="text-xs">Lingkar Lengan Atas</p>
                                    <p class="font-semibold">{{ $firstMeasurement->arm_circumference }} cm</p>
                                </div>
                                <div>
                                    <p class="text-xs">Lingkar Kepala</p>
                                    <p class="font-semibold">{{ $firstMeasurement->head_circumference }} cm</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            {{-- Semua Riwayat --}}
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-lg font-bold mb-4">Semua Riwayat Pengukuran</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-2">Tanggal</th>
                                <th class="p-2 text-center">Tinggi (cm)</th>
                                <th class="p-2 text-center">Berat (kg)</th>
                                <th class="p-2 text-center">Lengan (cm)</th>
                                <th class="p-2 text-center">Kepala (cm)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($balita->measurements as $measurement)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-2 font-medium">
                                        {{ \Carbon\Carbon::parse($measurement->measurement_date)->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="p-2 text-center">{{ $measurement->height }}</td>
                                    <td class="p-2 text-center">{{ $measurement->weight }}</td>
                                    <td class="p-2 text-center">{{ $measurement->arm_circumference }}</td>
                                    <td class="p-2 text-center">{{ $measurement->head_circumference }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-4 text-center text-gray-500">
                                        Belum ada riwayat pengukuran.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
