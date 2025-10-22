<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 | Halaman Tidak Ditemukan</title>

    {{-- Memuat Vite untuk Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Opsi tambahan jika ingin font custom */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;900&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-2xl mx-auto">
        {{-- Desain Kotak Jendela --}}
        <div class="bg-white rounded-lg shadow-2xl">
            {{-- Bagian Header Jendela --}}
            <div class="bg-maroon-700 p-3 flex items-center rounded-t-lg">
                <div class="flex space-x-2">
                    <span class="block w-3 h-3 bg-white rounded-full"></span>
                    <span class="block w-3 h-3 bg-yellow-500 rounded-full"></span>
                    <span class="block w-3 h-3 bg-blue rounded-full"></span>
                </div>
            </div>

            {{-- Bagian Konten --}}
            <div class="bg-maroon-800 p-8 sm:p-12 text-center text-white rounded-b-lg">
                <h1 class="text-11xl sm:text-9xl font-black tracking-wider leading-none">Ops!</h1>
                <h2 class="mt-2 text-2xl sm:text-3xl font-bold tracking-tight">404 - PAGE NOT FOUND</h2>
                <p class="mt-4 text-base sm:text-lg text-maroon-200">
                    Halaman yang anda cari tidak ditemukan, maaf ya.
                </p>

                {{-- Tombol Aksi --}}
                <div class="mt-10">
                    <a href="{{ url('/') }}"
                       class="inline-block rounded-full bg-white px-8 py-3 text-sm font-semibold text-maroon-800 shadow-lg hover:bg-gray-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white transition-transform transform hover:scale-105">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk menambahkan warna custom --}}
    <script>
        // Menambahkan warna marun custom ke Tailwind
        const style = document.createElement('style');
        style.innerHTML = `
            .bg-blue { background-color: #1E3A8A; }
            .bg-maroon-800 { background-color: #800000; }
            .bg-maroon-700 { background-color: #6B0F1A; }
            .text-maroon-800 { color: #800000; }
            .text-maroon-200 { color: #F5D0D0; }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
