@extends('layouts.app')
{{-- Meng-extend layout utama dari file layouts/app.blade.php --}}

@section('title', 'Laporan')
{{-- Mengisi bagian 'title' pada layout dengan 'Laporan' --}}

@section('content')
{{-- Membuka section 'content' untuk isi halaman --}}

{{-- Container Utama Halaman. bg-slate-50: Background abu sangat muda. min-h-screen: Minimal tinggi satu layar (100vh). flex items-center: Flexbox rata tengah vertikal. --}}
<div class="bg-slate-50 min-h-screen flex items-center">
    
    {{-- Container Konten. container: Wrapper responsif. mx-auto: Rata tengah (margin kiri-kanan auto). py-16: Padding vertikal 4rem. px-4: Padding horizontal 1rem. --}}
    <div class="container mx-auto py-16 px-4">
        
        {{-- Header Teks. text-center: Rata tengah. mb-12: Margin bawah 3rem. --}}
        <div class="text-center mb-12">
            {{-- Judul Besar. text-4xl: Font besar. md:text-5xl: Font lebih besar di desktop. font-extrabold: Sangat tebal. text-gray-800: Abu gelap. --}}
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800">Pilih Jenis Laporan Anda</h1>
            
            {{-- Deskripsi. mt-4: Margin atas 1rem. text-lg: Font agak besar. text-gray-600: Abu sedang. max-w-2xl mx-auto: Lebar max dibatasi & rata tengah. --}}
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">Apakah Anda kehilangan sesuatu atau menemukan barang milik orang lain? Pilih salah satu opsi di bawah ini untuk melanjutkan.</p>
        </div>

        {{-- Grid Pilihan. max-w-4xl mx-auto: Lebar max 4xl & rata tengah. grid grid-cols-1 md:grid-cols-2: 1 kolom (mobile), 2 kolom (tablet+). gap-8: Jarak 2rem. --}}
        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- OPSI 1: KEHILANGAN (KIRI) --}}
            {{-- Card Container. bg-white: Putih. rounded-xl: Sudut membulat XL. shadow-lg: Bayangan besar. p-8: Padding 2rem. flex flex-col items-center text-center: Flex kolom rata tengah. transform hover:-translate-y-2: Efek naik saat hover. --}}
            <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center text-center transform hover:-translate-y-2 transition-transform duration-300">
                
                {{-- Wrapper Ikon. bg-red-100: Background merah muda. p-4: Padding. rounded-full: Bentuk lingkaran. mb-5: Margin bawah. --}}
                <div class="bg-red-100 p-4 rounded-full mb-5">
                    {{-- SVG Icon Laporan Hilang. w-10 h-10: Ukuran 2.5rem. text-red-800: Warna merah tua. --}}
                    <svg class="w-10 h-10 text-red-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        {{-- Path Icon --}}
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM13.5 10.5h-6" />
                    </svg>
                </div>

                {{-- Judul Card. text-2xl font-bold: Besar & tebal. text-gray-800: Abu gelap. mb-3: Margin bawah. --}}
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Saya Kehilangan Barang</h2>
                
                {{-- Deskripsi Card. text-gray-600: Abu sedang. mb-6: Margin bawah 1.5rem. flex-grow: Isi ruang kosong. --}}
                <p class="text-gray-600 mb-6 flex-grow">Buat laporan untuk barang Anda yang hilang agar dapat segera ditemukan oleh komunitas.</p>
                
                {{-- Tombol Aksi. bg-red-800: Merah tua. text-white: Putih. font-bold: Tebal. py-3 px-10: Padding tombol. rounded-full: Kapsul. hover:bg-red-900: Gelap saat hover. w-full: Lebar penuh. --}}
                <a href="{{ route('lost-items.create') }}" class="bg-red-800 text-white font-bold py-3 px-10 rounded-full hover:bg-red-900 transition duration-300 w-full">
                    Lapor Kehilangan
                </a>
            </div>

            {{-- OPSI 2: PENEMUAN (KANAN) --}}
            {{-- Card Container. bg-white: Putih. rounded-xl: Sudut membulat. shadow-lg: Bayangan. flex flex-col...: Layout kolom rata tengah. --}}
            <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center text-center transform hover:-translate-y-2 transition-transform duration-300">
                
                {{-- Wrapper Ikon. bg-gray-200: Abu muda. --}}
                <div class="bg-gray-200 p-4 rounded-full mb-5">
                     {{-- SVG Icon Penemuan. text-gray-800: Abu gelap (untuk ikon). --}}
                     <svg class="w-10 h-10 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        {{-- Path Icon --}}
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                </div>

                {{-- Judul Card. --}}
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Saya Menemukan Barang</h2>
                
                {{-- Deskripsi Card. --}}
                <p class="text-gray-600 mb-6 flex-grow">Bantu orang lain dengan melaporkan barang yang Anda temukan. Kebaikan kecil Anda sangat berarti.</p>
                
                {{-- Tombol Aksi. bg-gray-800: Abu gelap (Hitam soft). hover:bg-gray-900: Hitam pekat saat hover. --}}
                <a href="{{ route('found-items.create') }}" class="bg-gray-800 text-white font-bold py-3 px-10 rounded-full hover:bg-gray-900 transition duration-300 w-full">
                    Lapor Penemuan
                </a>
            </div>

        </div>
    </div>
</div>

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

@endsection
