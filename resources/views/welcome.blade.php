@extends('layouts.app')

@section('content')

{{-- 1. Hero Section --}}
<section class="relative bg-red-800 text-white text-center py-70" style="background-image: url('{{ asset('images/hero-background.jpg') }}'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative z-10 px-4">
        <h1 class="text-5xl font-extrabold mb-4">Menghubungkan Kembali yang Terpisah</h1>
        <p class="text-xl mb-8 max-w-2xl mx-auto">Platform terpusat untuk melaporkan dan menemukan barang hilang di lingkungan kampus dengan mudah dan cepat.</p>
        <a href="{{ route('items.index') }}" class="bg-red-800 text-white font-bold py-3 px-8 rounded-full hover:bg-red-900 transition duration-300">Lihat Daftar Barang</a>
    </div>
</section>

{{-- 2. Kenapa Kami? (Fitur Unggulan) - HTML Bersih --}}
<section class="bg-slate-100 py-20">
    <div class="container mx-auto px-4">
        <h2 class="text-5xl font-bold text-center text-gray-800 mb-12">Kenapa Menggunakan Platform Kami?</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            {{-- Fitur 1 (Kiri) --}}
            <div class="feature-card bg-white p-8 rounded-lg shadow-md flex flex-col text-center transition-all duration-700 ease-out">
                <div class="flex-grow">
                    <div class="flex justify-center mb-5">
                        <div class="text-red-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Cepat & Real-Time</h3>
                    <p class="text-gray-600 text-sm">Laporan barang hilang dan temuan akan langsung tampil, mempercepat proses penemuan kembali.</p>
                </div>
            </div>

            {{-- Fitur 2 (Tengah) --}}
            <div class="feature-card bg-white p-8 rounded-lg shadow-md flex flex-col text-center transition-all duration-700 ease-out delay-200">
                <div class="flex-grow">
                    <div class="flex justify-center mb-5">
                        <div class="text-red-800">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Mudah Digunakan</h3>
                    <p class="text-gray-600 text-sm">Antarmuka yang sederhana memudahkan siapa saja untuk melapor atau mencari barang tanpa perlu login.</p>
                </div>
            </div>

            {{-- Fitur 3 (Kanan) --}}
            <div class="feature-card bg-white p-8 rounded-lg shadow-md flex flex-col text-center transition-all duration-700 ease-out delay-400">
                <div class="flex-grow">
                    <div class="flex justify-center mb-5">
                        <div class="text-red-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Terpusat & Terorganisir</h3>
                    <p class="text-gray-600 text-sm">Semua informasi kehilangan dan penemuan ada di satu tempat, tidak lagi tersebar di berbagai grup.</p>
                </div>
            </div>
            
        </div>
    </div>
</section>
{{-- <script>
    // Animasi agar fitur kiri dan kanan offset-nya sama saat selesai
    document.addEventListener('DOMContentLoaded', function () {
        const cards = document.querySelectorAll('.feature-card');
        setTimeout(() => {
            cards[0].classList.remove('opacity-0', '-translate-x-10');
            cards[1].classList.remove('opacity-0', '-translate-y-10');
            cards[2].classList.remove('opacity-0', 'translate-x-10');
        }, 100); // Delay agar animasi berjalan setelah render
    });
</script> --}}

{{-- 3. Statistik (Full Width) --}}
<section class="bg-red-800 py-12">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-5xl font-bold text-white mb-12">Jumlah Laporan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
             <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <p class="text-5xl font-bold text-white">{{ \App\Models\FoundItem::count() }}</p>
                <p class="text-white text-lg mt-2">Barang Ditemukan</p>
            </div>
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-5xl font-bold text-white">{{ \App\Models\LostItem::count() }}</p>
                <p class="text-white text-lg mt-2">Barang Hilang</p>
            </div>
        </div>
    </div>
</section>

{{-- 4. FAQ Section (Full Width) --}}
<section class="bg-white py-12 mb-16">
    <div class="container mx-auto px-4 max-w-3xl">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">FAQ</h2>
        <div class="space-y-4">
            <div class="faq-item">
                <button class="faq-toggle bg-red-800 text-white p-4 rounded-lg flex justify-between items-center w-full text-left hover:bg-red-900 transition">
                    <span class="font-semibold">Apa itu Lost & Found Kampus?</span>
                    <svg class="faq-icon h-5 w-5 transform transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                </button>
                <div class="faq-answer overflow-hidden max-h-0 opacity-0 transition-all duration-500 ease-in-out">
                    <p class="p-4 bg-white border-l border-r border-b border-gray-200 rounded-b-lg text-gray-700">Ini adalah platform digital terpusat yang dirancang untuk membantu seluruh warga kampus melaporkan dan menemukan barang yang hilang atau ditemukan di area kampus.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-toggle bg-red-800 text-white p-4 rounded-lg flex justify-between items-center w-full text-left hover:bg-red-900 transition">
                    <span class="font-semibold">Bagaimana cara melaporkan barang?</span>
                    <svg class="faq-icon h-5 w-5 transform transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                </button>
                <div class="faq-answer overflow-hidden max-h-0 opacity-0 transition-all duration-500 ease-in-out">
                    <p class="p-4 bg-white border-l border-r border-b border-gray-200 rounded-b-lg text-gray-700">Anda dapat pergi ke menu "Laporan", pilih apakah Anda kehilangan atau menemukan barang, lalu isi formulir yang disediakan dengan detail yang relevan seperti nama barang, deskripsi, dan lokasi.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-toggle bg-red-800 text-white p-4 rounded-lg flex justify-between items-center w-full text-left hover:bg-red-900 transition">
                    <span class="font-semibold">Apakah saya perlu membuat akun untuk melapor?</span>
                    <svg class="faq-icon h-5 w-5 transform transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                </button>
                <div class="faq-answer overflow-hidden max-h-0 opacity-0 transition-all duration-500 ease-in-out">
                    <p class="p-4 bg-white border-l border-r border-b border-gray-200 rounded-b-lg text-gray-700">Untuk saat ini, tidak. Kami merancangnya agar mudah diakses oleh siapa saja. Namun, memberikan kontak yang valid akan sangat membantu proses pengembalian barang.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection