<x-app-layout>
    <div class="bg-gray-50 min-h-screen flex flex-col">
        <div class="p-4 flex items-center border-b sticky top-0 bg-white z-10">
            <a href="{{ route('konsultasi.index') }}" class="text-gray-700"><svg class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg></a>
            <h1 class="text-lg font-bold text-center flex-grow truncate px-2">{{ $consultation->subject }}</h1>
            <div class="w-6"></div>
        </div>

        <div class="flex-grow p-4 space-y-4">
            @foreach ($consultation->messages as $message)
                <div
                    class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg {{ $message->user_id === Auth::id() ? 'bg-green-200' : 'bg-white shadow' }}">
                    <div class="prose prose-sm max-w-none">{!! $message->body !!}</div>
                    <p class="text-xs text-gray-400 mt-1 text-right">{{ $message->created_at->format('H:i') }}</p>
                </div>
            @endforeach
        </div>

        <div class="p-4 bg-white border-t">
            <form action="{{ route('konsultasi.reply', $consultation) }}" method="POST">
                @csrf
                <div class="flex items-center space-x-2">
                    <input type="text" name="body" placeholder="Ketik balasan Anda..."
                        class="w-full border-gray-300 rounded-full" required>
                    <button type="submit" class="p-2 bg-green-500 text-white rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
