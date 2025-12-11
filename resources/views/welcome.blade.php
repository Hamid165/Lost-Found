@extends('layouts.app') 
{{-- Meng-extend layout utama dari file layouts/app.blade.php --}}

@section('title', 'Beranda') 
{{-- Mengisi bagian 'title' pada layout dengan 'Beranda' --}}

@section('content') 
{{-- Membuka section 'content' untuk isi halaman --}}

    {{-- Tag Title HTML manual --}}
    <title>Profile</title>

    {{-- ========================================== --}}
    {{-- 1. HERO SECTION (Bagian Atas / Jumbotron) --}}
    {{-- ========================================== --}}

    {{-- Section Utama Hero. relative: Posisi relatif. bg-red-800: Warna background merah tua. text-white: Teks putih. text-center: Rata tengah. h-screen: Tinggi 100vh. flex items-center justify-center: Flexbox rata tengah vertikal & horizontal. --}}
    <section class="relative bg-red-800 text-white text-center h-screen flex items-center justify-center" style="background-image: url('{{ asset('images/telu.png') }}'); background-size: cover; background-position: center;">
        
        {{-- Overlay Gelap. absolute: Posisi absolut. inset-0: Menuhin parent. bg-black opacity-50: Hitam transparan 50%. --}}
        <div class="absolute inset-0 bg-black opacity-50"></div>

        {{-- Container Teks. relative z-10: Posisi relatif di atas overlay (z-index 10). px-4: Padding horizontal 1rem. --}}
        <div class="relative z-10 px-4">

            {{-- ========================================================= --}}
            {{-- LOGIKA TAMBAHAN: ALERT LOGIN DARI WHATSAPP DI SINI --}}
            {{-- ========================================================= --}}
            @if(session('sumber_login') == 'whatsapp')
                <div class="max-w-2xl mx-auto mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-lg text-left">
                    <h4 class="font-bold text-lg">✅ Login Berhasil!</h4>
                    <p class="mb-3">Akun Anda sudah terhubung. Silakan kembali ke WhatsApp untuk melanjutkan laporan.</p>
                    
                    {{-- Tombol Kembali ke WA (Pastikan .env NOMOR_WA_BOT sudah diisi) --}}
                    <a href="https://wa.me/{{ env('NOMOR_WA_BOT') }}?text=Saya%20sudah%20login" class="inline-block bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-700 transition duration-300">
                        Kembali ke WhatsApp
                    </a>
                </div>

                {{-- Hapus stempelnya agar kalau dia refresh halaman, alertnya hilang --}}
                @php
                    session()->forget('sumber_login');
                @endphp
            @endif
            {{-- ========================================================= --}}
            
            {{-- Heading Utama. text-5xl: Font 3rem. font-extrabold: Sangat tebal (800). mb-4: Margin bawah 1rem. --}}
            <h1 class="text-5xl font-extrabold mb-4">Menghubungkan Kembali yang Terpisah</h1>
            
            {{-- Deskripsi. text-xl: Font 1.25rem. mb-8: Margin bawah 2rem. max-w-2xl: Lebar max 42rem. mx-auto: Rata tengah horizontal. --}}
            <p class="text-xl mb-8 max-w-2xl mx-auto">Platform terpusat untuk melaporkan dan menemukan barang hilang di lingkungan kampus dengan mudah dan cepat.</p>
            
            {{-- Tombol CTA. bg-red-800 text-white: Merah tua teks putih. font-bold: Tebal. py-3 px-8: Padding tombol. rounded-full: Bentuk kapsul. hover:bg-red-900: Gelap saat hover. transition duration-300: Animasi 300ms. --}}
            <a href="{{ route('items.index')}}" class="bg-red-800 text-white font-bold py-3 px-8 rounded-full hover:bg-red-900 transition duration-300">Lihat Daftar Barang</a>
        </div>
    </section>


    {{-- ========================================== --}}
    {{-- 2. FEATURE SECTION (Kenapa Kami?) --}}
    {{-- ========================================== --}}

    {{-- Section Fitur. bg-slate-100: Background abu muda. py-20: Padding vertikal 5rem. --}}
    <section class="bg-slate-100 py-20">
        
        {{-- Container Utama. container mx-auto: Container rata tengah. px-4: Padding horizontal. --}}
        <div class="container mx-auto px-4">
            
            {{-- Judul Section. text-5xl font-bold: Besar dan tebal. text-center: Rata tengah. text-gray-800: Abu gelap. mb-12: Margin bawah 3rem. --}}
            <h2 class="text-5xl font-bold text-center text-gray-800 mb-12">Kenapa Menggunakan Platform Kami?</h2>
            
            {{-- Grid Wrapper. grid grid-cols-1 md:grid-cols-3: 1 kolom (mobile), 3 kolom (tablet+). gap-8: Jarak 2rem. --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                {{-- FITUR 1 (KIRI) --}}
                {{-- Card Fitur. bg-white: Putih. p-8: Padding 2rem. rounded-lg: Sudut membulat. shadow-md: Bayangan. flex flex-col text-center: Flex kolom rata tengah. transition-all duration-700 ease-out: Animasi 700ms. --}}
                <div class="feature-card bg-white p-8 rounded-lg shadow-md flex flex-col text-center transition-all duration-700 ease-out">
                    {{-- Flex Container. flex-grow: Isi sisa ruang. --}}
                    <div class="flex-grow">
                        
                        {{-- Icon Wrapper. flex justify-center mb-5: Rata tengah, margin bawah 1.25rem. --}}
                        <div class="flex justify-center mb-5">
                            {{-- Color Wrapper. text-red-800: Warna merah tua. --}}
                            <div class="text-red-800">
                                 {{-- Icon SVG h-12 w-12 --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            </div>
                        </div>
                        
                        {{-- Judul Fitur. text-xl font-semibold: Agak besar & tebal. mb-3: Margin bawah. --}}
                        <h3 class="text-xl font-semibold mb-3">Cepat & Real-Time</h3>
                        
                        {{-- Deskripsi. text-gray-600 text-sm: Abu sedang, kecil. --}}
                        <p class="text-gray-600 text-sm">Laporan barang hilang dan temuan akan langsung tampil, mempercepat proses penemuan kembali.</p>
                    </div>
                </div>

                {{-- FITUR 2 (TENGAH). delay-200: Muncul belakangan 200ms. --}}
                <div class="feature-card bg-white p-8 rounded-lg shadow-md flex flex-col text-center transition-all duration-700 ease-out delay-200">
                    {{-- Flex Container. --}}
                    <div class="flex-grow">
                        {{-- Icon Wrapper. --}}
                        <div class="flex justify-center mb-5">
                            {{-- Color Wrapper. --}}
                            <div class="text-red-800">
                                {{-- SVG Icon. --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                        </div>
                        {{-- Judul Fitur. --}}
                        <h3 class="text-xl font-semibold mb-3">Mudah Digunakan</h3>
                        {{-- Deskripsi Fitur. --}}
                        <p class="text-gray-600 text-sm">Antarmuka yang sederhana memudahkan siapa saja untuk melapor atau mencari barang.</p>
                    </div>
                </div>

                {{-- FITUR 3 (KANAN). delay-400: Muncul belakangan 400ms. --}}
                <div class="feature-card bg-white p-8 rounded-lg shadow-md flex flex-col text-center transition-all duration-700 ease-out delay-400">
                    {{-- Flex Container. --}}
                    <div class="flex-grow">
                        {{-- Icon Wrapper. --}}
                        <div class="flex justify-center mb-5">
                            {{-- Color Wrapper. --}}
                            <div class="text-red-800">
                                {{-- SVG Icon. --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </div>
                        </div>
                        {{-- Judul Fitur. --}}
                        <h3 class="text-xl font-semibold mb-3">Terpusat & Terorganisir</h3>
                        {{-- Deskripsi Fitur. --}}
                        <p class="text-gray-600 text-sm">Semua informasi kehilangan dan penemuan ada di satu tempat, tidak lagi tersebar di berbagai grup.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================== --}}
    {{-- 3. STATS SECTION (Jumlah Laporan) --}}
    {{-- ========================================== --}}

    {{-- Section Statistik. bg-red-800: Merah tua. py-20: Padding vertikal 5rem. --}}
    <section class="bg-red-800 py-20">
        {{-- Container Center. container mx-auto px-4 text-center: Container rata tengah, padding, teks tengah. --}}
        <div class="container mx-auto px-4 text-center">
            
            {{-- Judul. text-5xl font-bold text-white: Besar, tebal, putih. --}}
            <h2 class="text-5xl font-bold text-white mb-12">Jumlah Laporan</h2>
            
            {{-- Grid. 1 kolom (mobile), 2 kolom (md). gap-8: Jarak. --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                 
                 {{-- ITEM KIRI. opacity-0 -translate-x-10: Sembunyi geser kiri. transition-all: Animasi masuk. --}}
                 <div class="stat-card flex flex-col items-center opacity-0 -translate-x-10 transform transition-all duration-700 ease-out">
                    
                    {{-- Icon. h-16 w-16 text-orange-400: Besar 4rem, oranye. --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    
                    {{-- Angka. text-5xl font-bold: Sangat besar. --}}
                    <p class="text-5xl font-bold text-white">{{ \App\Models\FoundItem::count() }}</p>
                    {{-- Label. text-white text-lg: Putih besar. --}}
                    <p class="text-white text-lg mt-2">Barang Ditemukan</p>
                </div>

                {{-- ITEM KANAN. translate-x-10: Geser kanan. delay-200: Muncul lambat. --}}
                <div class="stat-card flex flex-col items-center opacity-0 translate-x-10 transform transition-all duration-700 ease-out delay-200">
                    {{-- Icon. --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    {{-- Angka. --}}
                    <p class="text-5xl font-bold text-white">{{ \App\Models\LostItem::count() }}</p>
                    {{-- Label. --}}
                    <p class="text-white text-lg mt-2">Barang Hilang</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================== --}}
    {{-- 4. FAQ SECTION (Pertanyaan Umum) --}}
    {{-- ========================================== --}}

    {{-- Section FAQ. bg-white: Putih. py-20: Padding vertikal 5rem. --}}
    <section class="bg-white py-20">
        
        {{-- Container FAQ. max-w-3xl: Lebar maksimum 48rem (fokus baca). --}}
        <div class="container mx-auto px-4 max-w-3xl">
            {{-- Judul FAQ. --}}
            <h2 class="text-5xl font-bold text-center text-gray-800 mb-10">FAQ</h2>
            
            {{-- List Wrapper. space-y-4: Jarak vertikal item 1rem. --}}
            <div class="space-y-4">
                
                {{-- FAQ 1 --}}
                <div class="faq-item">
                    {{-- Toggle Button. w-full flex justify-between: Full width, text kiri, icon kanan. hover:bg-red-900: Hover gelap. --}}
                    <button class="faq-toggle bg-red-800 text-white p-4 rounded-lg flex justify-between items-center w-full text-left hover:bg-red-900 transition">
                        {{-- Teks Pertanyaan. --}}
                        <span class="font-semibold">Apa itu Lost & Found Kampus?</span>
                        {{-- Icon Panah. --}}
                        <svg class="faq-icon h-5 w-5 transform transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                    </button>
                    
                    {{-- Answer Box. max-h-0 overflow-hidden: Default tutup. duration-500: Animasi buka pelan. --}}
                    <div class="faq-answer overflow-hidden max-h-0 opacity-0 transition-all duration-500 ease-in-out">
                        {{-- Isi Jawaban. bg-gray-50: Background abu. --}}
                        <p class="p-4 bg-gray-50 border-l border-r border-b border-gray-200 rounded-b-lg text-gray-700">Ini adalah platform digital terpusat yang dirancang untuk membantu seluruh warga kampus melaporkan dan menemukan barang yang hilang atau ditemukan di area kampus.</p>
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div class="faq-item">
                    {{-- Toggle Button. --}}
                    <button class="faq-toggle bg-red-800 text-white p-4 rounded-lg flex justify-between items-center w-full text-left hover:bg-red-900 transition">
                        {{-- Pertanyaan. --}}
                        <span class="font-semibold">Bagaimana cara melaporkan barang?</span>
                        {{-- Icon. --}}
                        <svg class="faq-icon h-5 w-5 transform transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                    </button>
                    {{-- Container Jawaban. --}}
                    <div class="faq-answer overflow-hidden max-h-0 opacity-0 transition-all duration-500 ease-in-out">
                        {{-- Jawaban. --}}
                        <p class="p-4 bg-gray-50 border-l border-r border-b border-gray-200 rounded-b-lg text-gray-700">Anda dapat pergi ke menu "Laporan", pilih apakah Anda kehilangan atau menemukan barang, lalu isi formulir yang disediakan dengan detail yang relevan seperti nama barang, deskripsi, dan lokasi.</p>
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div class="faq-item">
                    {{-- Toggle Button. --}}
                    <button class="faq-toggle bg-red-800 text-white p-4 rounded-lg flex justify-between items-center w-full text-left hover:bg-red-900 transition">
                        {{-- Pertanyaan. --}}
                        <span class="font-semibold">Apakah saya perlu membuat akun untuk melapor?</span>
                        {{-- Icon. --}}
                        <svg class="faq-icon h-5 w-5 transform transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                    </button>
                    {{-- Container Jawaban. --}}
                    <div class="faq-answer overflow-hidden max-h-0 opacity-0 transition-all duration-500 ease-in-out">
                        {{-- Jawaban. --}}
                        <p class="p-4 bg-gray-50 border-l border-r border-b border-gray-200 rounded-b-lg text-gray-700">Ya, Anda perlu login untuk membuat laporan. Ini memastikan bahwa setiap laporan memiliki penanggung jawab yang jelas dan membantu proses pengembalian barang menjadi lebih aman.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
