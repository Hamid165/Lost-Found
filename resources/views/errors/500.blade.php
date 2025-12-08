<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 | Terjadi Kesalahan</title>

    {{-- Memuat Vite untuk Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @import url('https://fonts.bunny.net/css?family=figtree:400,500,600,700,900&display=swap');
        body {
            font-family: 'Figtree', sans-serif;
        }

        /* 
           Warna Custom.
           Didefinisikan di sini karena warna spesifik (hex code) belum tentu ada di config standar Tailwind.
        */
        .bg-blue { background-color: #1E3A8A; }
        .bg-maroon-800 { background-color: #800000; }
        .bg-maroon-700 { background-color: #6B0F1A; }
        .text-maroon-800 { color: #800000; }
        .text-maroon-200 { color: #F5D0D0; }
    </style>
</head>
{{-- Body: Flexbox center, background abu, padding 1rem --}}
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    {{-- Wrapper Card Utama --}}
    <div class="w-full max-w-2xl mx-auto">
        {{-- Card Jendela --}}
        <div class="bg-white rounded-lg shadow-2xl">
            
            {{-- Header Window (Title Bar) --}}
            <div class="bg-maroon-700 p-3 flex items-center rounded-t-lg">
                {{-- Tombol Dekoratif --}}
                <div class="flex space-x-2">
                    <span class="block w-3 h-3 bg-white rounded-full"></span>
                    <span class="block w-3 h-3 bg-yellow-500 rounded-full"></span>
                    <span class="block w-3 h-3 bg-blue rounded-full"></span>
                </div>
            </div>

            {{-- Isi Konten --}}
            <div class="bg-maroon-800 p-8 sm:p-12 text-center text-white rounded-b-lg">

                {{-- Judul Besar "Waduh!" --}}
                <h1 class="text-6xl sm:text-8xl font-black tracking-wider leading-none">Waduh!</h1>

                {{-- Subjudul 500 --}}
                <h2 class="mt-2 text-2xl sm:text-3xl font-bold tracking-tight">500 - TERJADI KESALAHAN</h2>
                
                {{-- Pesan Error --}}
                <p class="mt-4 text-base sm:text-lg text-maroon-200">
                    Sepertinya ada yang tidak beres di sistem kami. Maaf atas ketidaknyamanannya.
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

</body>
</html>

{{-- ========================================================================================= --}}
{{--                    PANDUAN PENGUBAHAN GAYA (CUSTOMIZATION GUIDE)                          --}}
{{-- ========================================================================================= --}}
{{-- 
    1. MENGUBAH WARNA (Background & Text)
       Format: 'bg-{warna}-{intensitas}' atau 'text-{warna}-{intensitas}'
       Contoh:
       - 'bg-red-800' (Merah Tua)    -> Ubah ke 'bg-blue-600' (Biru Sedang) atau 'bg-green-500' (Hijau)
       - 'text-white' (Putih)         -> Ubah ke 'text-black' (Hitam) atau 'text-gray-200' (Abu Terang)
       
       CATATAN PENTING:
       - Jika Anda mengubah 'bg-white' menjadi 'blue', itu TIDAK AKAN BERJALAN.
       - Anda harus spesifik: 'bg-blue-500' (standar).
       - Angka intensitas: 
         50 (paling terang), 100, 200, 300, 400, 500 (standar), 600, 700, 800, 900 (paling gelap).
       - Jika angka tidak cocok (misal 'bg-blue-333'), class tersebut tidak akan dikenali dan warnanya hilang.

    2. MENGUBAH UKURAN TEXT
       Format: 'text-{ukuran}'
       Pilihan:
       - 'text-xs'   (Sangat Kecil)
       - 'text-sm'   (Kecil)
       - 'text-base' (Normal/Standar)
       - 'text-lg'   (Besar)
       - 'text-xl'   (Lebih Besar)
       - 'text-2xl' s/d 'text-9xl' (Sangat Besar untuk Judul)

    3. MENGUBAH JARAK (Margin & Padding)
       - Margin (Jarak Luar): 'm-{ukuran}' (semua sisi), 'my-{ukuran}' (atas-bawah), 'mx-{ukuran}' (kiri-kanan)
       - Padding (Jarak Dalam): 'p-{ukuran}' (sama seperti margin formatnya)
       Contoh:
       - 'mb-4' (Margin Bawah level 4) -> Ubah ke 'mb-8' (lebih jauh) atau 'mb-2' (lebih dekat).
       - Skala ukuran Tailwind: 0, 1, 2, 4, 8, 12, 16, 20, dll.
--}}
{{-- ========================================================================================= --}}
