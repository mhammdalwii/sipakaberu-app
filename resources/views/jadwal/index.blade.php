<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <div class="p-4 flex items-center border-b sticky top-0 bg-white z-10">
            <a href="{{ route('dashboard') }}" class="text-gray-700">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-lg font-bold text-center flex-grow">Jadwal Pemeriksaan</h1>
            <div class="w-6"></div>
        </div>

        <div class="p-4 space-y-4">
            @forelse ($appointments as $appointment)
                <div class="bg-white rounded-lg p-4 shadow flex items-start space-x-4">
                    <div class="text-center border-r pr-4">
                        <p class="font-bold text-2xl text-red-500">{{ $appointment->schedule_date->format('d') }}</p>
                        <p class="text-xs text-gray-500 uppercase">
                            {{ $appointment->schedule_date->translatedFormat('M') }}</p>
                    </div>
                    <div>
                        <h3 class="font-bold text-md">{{ $appointment->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $appointment->location }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $appointment->schedule_date->format('H:i') }} WIB -
                            Selesai</p>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg p-6 text-center shadow">
                    <p class="text-sm text-gray-500">Tidak ada jadwal pemeriksaan yang akan datang.</p>
                </div>
            @endforelse

            <div class="mt-4">
                {{ $appointments->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
