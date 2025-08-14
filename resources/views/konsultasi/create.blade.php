<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <div class="p-4 flex items-center border-b sticky top-0 bg-white z-10">
            <a href="{{ route('konsultasi.index') }}" class="text-gray-700"><svg class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg></a>
            <h1 class="text-lg font-bold text-center flex-grow">Pertanyaan Baru</h1>
            <div class="w-6"></div>
        </div>

        <form action="{{ route('konsultasi.store') }}" method="POST" class="p-4 space-y-4">
            @csrf
            <div>
                <label for="subject" class="block font-medium text-sm text-gray-700">Subjek</label>
                <input type="text" name="subject" id="subject"
                    class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div>
                <label for="body" class="block font-medium text-sm text-gray-700">Tulis pesan pertama Anda</label>
                <textarea name="body" id="body" rows="8" class="w-full mt-1 border-gray-300 rounded-md shadow-sm"
                    required></textarea>
            </div>
            <div>
                <button type="submit" class="w-full bg-green-500 text-white font-bold py-2 px-4 rounded-lg">Kirim
                    Pertanyaan</button>
            </div>
        </form>
    </div>
</x-app-layout>
