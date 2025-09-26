<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost & Found Kampus</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    {{-- Navbar sekarang berada di luar container utama --}}
    @include('layouts.partials.navbar')

    {{-- Konten halaman akan disisipkan di sini --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer tetap di bawah --}}
    @include('layouts.partials.footer')

    {{-- TAMBAHKAN BARIS INI UNTUK MEMUAT JAVASCRIPT --}}
    @vite('resources/js/app.js')
</body>
</html>
