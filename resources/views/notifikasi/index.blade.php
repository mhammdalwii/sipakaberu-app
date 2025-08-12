<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <div class="p-4 flex items-center border-b sticky top-0 bg-white z-10">
            <a href="{{ route('dashboard') }}" class="text-gray-700">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-lg font-bold text-center flex-grow">Notifikasi</h1>
            <div class="w-6"></div>
        </div>

        <div class="p-4 space-y-3">
            @forelse ($notifications as $notification)
                <a href="{{ $notification->link ?? '#' }}" class="block bg-white rounded-lg p-4 shadow-sm border">
                    <p class="font-bold text-gray-800">{{ $notification->title }}</p>
                    <p class="text-sm text-gray-600 mt-1">{{ $notification->message }}</p>
                    <p class="text-xs text-gray-400 mt-2 text-right">{{ $notification->created_at->diffForHumans() }}
                    </p>
                </a>
            @empty
                <div class="bg-white rounded-lg p-6 text-center shadow">
                    <p class="text-sm text-gray-500">Tidak ada notifikasi untuk Anda.</p>
                </div>
            @endforelse

            <div class="mt-4">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
