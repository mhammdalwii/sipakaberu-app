<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SipakaberuApp') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    {{-- 
        Div utama ini diberi latar belakang abu-abu muda.
        `pb-20` (padding-bottom) penting untuk memberi ruang kosong di bagian bawah,
        agar konten tidak tertutup oleh Bottom Navigation Bar yang menempel.
    --}}
    <div class="min-h-screen bg-gray-100 pb-20">
        {{--
            @include('layouts.navigation') dihapus karena desain kita tidak menggunakan
            navbar atas, melainkan Bottom Navigation Bar di setiap halaman.
        --}}

        {{--
            <header> juga dihapus dari sini agar setiap halaman (seperti dashboard)
            bisa memiliki desain header uniknya sendiri (misal: header hijau).
        --}}

        <main>
            {{-- 
                $slot adalah "jantung" dari layout ini. 
                Semua konten dari file seperti `dashboard.blade.php` akan disuntikkan ke sini.
            --}}
            {{ $slot }}
        </main>
    </div>
</body>

</html>
