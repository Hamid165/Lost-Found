@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
<div class="bg-slate-50 min-h-screen flex items-center">
    <div class="container mx-auto py-16 px-4">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800">Pilih Jenis Laporan Anda</h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">Apakah Anda kehilangan sesuatu atau menemukan barang milik orang lain? Pilih salah satu opsi di bawah ini untuk melanjutkan.</p>
        </div>

        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">

            <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center text-center transform hover:-translate-y-2 transition-transform duration-300">
                {{-- Ikon --}}
                <div class="bg-red-100 p-4 rounded-full mb-5">
                    <svg class="w-10 h-10 text-red-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM13.5 10.5h-6" />
                    </svg>
                </div>

                <h2 class="text-2xl font-bold text-gray-800 mb-3">Saya Kehilangan Barang</h2>
                <p class="text-gray-600 mb-6 flex-grow">Buat laporan untuk barang Anda yang hilang agar dapat segera ditemukan oleh komunitas.</p>
                <a href="{{ route('lost-items.create') }}" class="bg-red-800 text-white font-bold py-3 px-10 rounded-full hover:bg-red-900 transition duration-300 w-full">
                    Lapor Kehilangan
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center text-center transform hover:-translate-y-2 transition-transform duration-300">
                {{-- Ikon --}}
                <div class="bg-gray-200 p-4 rounded-full mb-5">
                     <svg class="w-10 h-10 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                </div>

                <h2 class="text-2xl font-bold text-gray-800 mb-3">Saya Menemukan Barang</h2>
                <p class="text-gray-600 mb-6 flex-grow">Bantu orang lain dengan melaporkan barang yang Anda temukan. Kebaikan kecil Anda sangat berarti.</p>
                <a href="{{ route('found-items.create') }}" class="bg-gray-800 text-white font-bold py-3 px-10 rounded-full hover:bg-gray-900 transition duration-300 w-full">
                    Lapor Penemuan
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
