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
            {{-- Menampilkan pesan status jika ada --}}
            @if (session('status'))
                <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm font-medium text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            @forelse ($notifications as $notification)
                <div class="flex items-center space-x-2">
                    <a href="{{ $notification->link ?? '#' }}"
                        class="block w-full bg-white rounded-lg p-4 shadow-sm border">
                        <p class="font-bold text-gray-800">{{ $notification->title }}</p>
                        <p class="text-sm text-gray-600 mt-1">{{ $notification->message }}</p>
                        <p class="text-xs text-gray-400 mt-2 text-right">
                            {{ $notification->created_at->diffForHumans() }}</p>
                    </a>

                    <form action="{{ route('notifikasi.destroy', $notification) }}" method="POST"
                        onsubmit="return confirm('Anda yakin ingin menghapus notifikasi ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-gray-400 hover:text-red-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            @empty
                <div class="bg-white rounded-lg p-6 text-center shadow">
                    <p class="text-sm text-gray-500">Tidak ada notifikasi untuk Anda.</p>
                </div>
            @endforelse

            <div class="mt-4">
                {{ $notifications->links() }}
            </div>
        </div>
</x-app-layout>
