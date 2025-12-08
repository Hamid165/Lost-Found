<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 | Halaman Tidak Ditemukan</title>

    {{-- Memuat Vite untuk Tailwind CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Memuat font custom Poppins */
        @import url('https://fonts.bunny.net/css?family=figtree:400,500,600,700,900&display=swap');
        
        /* Mengatur font default body */
        body {
            font-family: 'Figtree', sans-serif;
        }

        /* 
           Menambahkan warna marun custom langsung di CSS.
           Ini mendefinisikan class yang tidak ada di config Tailwind default.
        */
        .bg-blue { background-color: #1E3A8A; }
        .bg-maroon-800 { background-color: #800000; }
        .bg-maroon-700 { background-color: #6B0F1A; }
        .text-maroon-800 { color: #800000; }
        .text-maroon-200 { color: #F5D0D0; }
    </style>
</head>

{{-- 
    Body Element.
    - bg-gray-100: Latar belakang abu muda.
    - flex items-center justify-center: Flexbox untuk menengahkan konten secara vertikal dan horizontal.
    - min-h-screen: Tinggi minimum setinggi layar penuh.
    - p-4: Padding di semua sisi 1rem.
--}}
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    {{-- Wrapper Utama. w-full: Lebar penuh. max-w-2xl: Lebar maksimum 42rem. mx-auto: Rata tengah. --}}
    <div class="w-full max-w-2xl mx-auto">
        
        {{-- Desain Kotak Jendela (Card). bg-white: Background putih. rounded-lg: Sudut membulat. shadow-2xl: Bayangan sangat besar. --}}
        <div class="bg-white rounded-lg shadow-2xl">
            
            {{-- Bagian Header Jendela (Title Bar). bg-maroon-700: Merah marun gelap. p-3: Padding. flex items-center: Layout flex. rounded-t-lg: Sudut atas membulat. --}}
            <div class="bg-maroon-700 p-3 flex items-center rounded-t-lg">
                {{-- Tombol Jendela (Hiasan). flex space-x-2: Flex baris dengan jarak antar elemen. --}}
                <div class="flex space-x-2">
                    {{-- Tombol Putih --}}
                    <span class="block w-3 h-3 bg-white rounded-full"></span>
                    {{-- Tombol Kuning --}}
                    <span class="block w-3 h-3 bg-yellow-500 rounded-full"></span>
                    {{-- Tombol Biru --}}
                    <span class="block w-3 h-3 bg-blue rounded-full"></span>
                </div>
            </div>

            {{-- Bagian Konten Utama. bg-maroon-800: Background merah marun sangat gelap. p-8 sm:p-12: Padding responsif. text-center: Teks rata tengah. text-white: Teks putih. rounded-b-lg: Sudut bawah membulat. --}}
            <div class="bg-maroon-800 p-8 sm:p-12 text-center text-white rounded-b-lg">

                {{-- Judul Besar "Ops!".
                     text-8xl: Ukuran font sangat besar di mobile.
                     sm:text-9xl: Ukuran font raksasa di tablet+.
                     font-black: Font weight paling tebal (900).
                     tracking-wider: Spasi antar huruf renggang.
                     leading-none: Line height 1.
                --}}
                <h1 class="text-8xl sm:text-9xl font-black tracking-wider leading-none">Ops!</h1>
                <br>
                
                {{-- Subjudul. mt-2: Margin atas. text-2xl sm:text-3xl: Ukuran font responsif. font-bold: Tebal. tracking-tight: Spasi rapat. --}}
                <h2 class="mt-2 text-2xl sm:text-3xl font-bold tracking-tight">404 - PAGE NOT FOUND</h2>
                
                {{-- Deskripsi. mt-4: Margin atas. text-base sm:text-lg: Ukuran font responsif. text-maroon-200: Warna teks merah muda pucat. --}}
                <p class="mt-4 text-base sm:text-lg text-maroon-200">
                    Halaman yang anda cari tidak ditemukan, maaf ya.
                </p>

                {{-- Tombol Kembali --}}
                <div class="mt-10">
                    {{-- Link Button.
                         inline-block: Display inline block.
                         rounded-full: Bentuk kapsul.
                         bg-white: Background putih.
                         px-8 py-3: Padding tombol besar.
                         text-sm font-semibold: Font kecil tebal.
                         text-maroon-800: Teks merah marun.
                         shadow-lg: Bayangan besar.
                         hover:bg-gray-200: Abu saat hover.
                         transition-transform transform hover:scale-105: Efek zoom saat hover.
                    --}}
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
