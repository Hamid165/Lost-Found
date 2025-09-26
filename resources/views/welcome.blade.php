@extends('layouts.app')

@section('content')
{{-- 1. Hero Section --}}
{{-- Kelas py-50 sesuai permintaan Anda. Hapus rounded-lg dan mb-16 --}}
<section class="relative bg-blue-600 text-white text-center py-70" style="background-image: url('{{ asset('images/hero-background.jpg') }}'); background-size: cover; background-position: center;">
    {{-- Overlay gelap agar tulisan mudah dibaca --}}
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative z-10 px-4">
        <h1 class="text-5xl font-extrabold mb-4">Menghubungkan Kembali yang Terpisah</h1>
        <p class="text-xl mb-8 max-w-2xl mx-auto">Platform terpusat untuk melaporkan dan menemukan barang hilang di lingkungan kampus dengan mudah dan cepat.</p>
        <a href="{{ route('items.index') }}" class="bg-white text-blue-600 font-bold py-3 px-8 rounded-full hover:bg-gray-200 transition duration-300">Lihat Daftar Barang</a>
    </div>
</section>

{{-- Wrapper untuk konten di bawah hero --}}
<div class="container mx-auto mt-[-4rem] relative z-10 px-4">
    {{-- 2. Kenapa Kami? (Fitur Unggulan) --}}
    <section class="mb-16">
        {{-- Konten bagian ini tetap sama, tidak perlu diubah --}}
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Kenapa Menggunakan Platform Kami?</h2>
        <div class="grid md:grid-cols-3 gap-8">
            {{-- Fitur 1 --}}
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <div class="text-blue-500 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Cepat & Real-Time</h3>
                <p class="text-gray-600">Laporan barang hilang dan temuan akan langsung tampil, mempercepat proses penemuan kembali.</p>
            </div>
            {{-- Fitur 2 --}}
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <div class="text-blue-500 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Mudah Digunakan</h3>
                <p class="text-gray-600">Antarmuka yang sederhana memudahkan siapa saja untuk melapor atau mencari barang tanpa perlu login.</p>
            </div>
            {{-- Fitur 3 --}}
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <div class="text-blue-500 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Terpusat & Terorganisir</h3>
                <p class="text-gray-600">Semua informasi kehilangan dan penemuan ada di satu tempat, tidak lagi tersebar di berbagai grup.</p>
            </div>
        </div>
    </section>

    {{-- 3. Statistik (Contoh) --}}
    <section class="bg-gray-200 rounded-lg py-12 mb-16">
        {{-- Konten bagian ini juga tetap sama --}}
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Statistik Kami</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <p class="text-5xl font-bold text-blue-600">{{ \App\Models\FoundItem::count() }}</p>
                    <p class="text-gray-600 text-lg">Total Barang Ditemukan</p>
                </div>
                <div>
                    <p class="text-5xl font-bold text-blue-600">{{ \App\Models\LostItem::count() }}</p>
                    <p class="text-gray-600 text-lg">Total Barang Hilang Dilaporkan</p>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
