<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <div class="p-4 flex items-center border-b sticky top-0 bg-white z-10">
            <a href="{{ route('dashboard') }}" class="text-gray-700"><svg class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg></a>
            <h1 class="text-lg font-bold text-center flex-grow">Konsultasi Anda</h1>
            <a href="{{ route('konsultasi.create') }}" class="text-green-600 font-bold text-2xl">+</a>
        </div>

        <div class="p-4 space-y-3">
            @forelse ($consultations as $consultation)
                <a href="{{ route('konsultasi.show', $consultation) }}"
                    class="block bg-white p-4 rounded-lg shadow-sm border">
                    <div class="flex justify-between items-start">
                        <h3 class="font-bold text-gray-800">{{ $consultation->subject }}</h3>
                        <span
                            class="text-xs font-semibold px-2 py-1 rounded-full {{ $consultation->status == 'open' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ $consultation->status }}</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Update terakhir:
                        {{ $consultation->updated_at->diffForHumans() }}</p>
                </a>
            @empty
                <p class="text-center text-gray-500 pt-10">Anda belum memiliki riwayat konsultasi. Klik tombol '+' untuk
                    memulai.</p>
            @endforelse
            <div class="mt-4">{{ $consultations->links() }}</div>
        </div>
    </div>
</x-app-layout>
