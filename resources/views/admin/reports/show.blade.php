@extends('layouts.app') 
@section('title', 'Detail Laporan')

<x-app-layout>
    {{-- Slot header dikosongkan --}}
    <x-slot name="header">
    </x-slot>

    {{-- Div pembungkus utama dengan padding-top --}}
    <div class="pt-20">
        <div class="pb-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 md:p-8 text-white">

                        {{-- Judul --}}
                        <h2 class="font-semibold text-3xl text-white leading-tight text-center mb-8">
                            Detail Laporan: {{ $item->nama_barang }}
                        </h2>

                        {{-- ======================================================= --}}
                        {{-- INFORMASI BARANG (Kartu Putih, Teks Merah) --}}
                        {{-- ======================================================= --}}
                        <div class="mb-8">
                            <h3 class="text-xl text-center font-semibold text-gray-100 border-b border-gray-500 pb-2 mb-6">Informasi Barang</h3>
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                {{-- Setiap data dibungkus 'card' --}}
                                <div class="bg-white shadow p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-red-700">Nama Barang</dt>
                                    <dd class="mt-1 text-lg font-semibold text-red-900">{{ $item->nama_barang }}</dd>
                                </div>

                                <div class="bg-white shadow p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-red-700">Status</dt>
                                    <dd class="mt-1 text-lg font-semibold text-red-900">
                                        {{-- LOGIKA BADGE STATUS --}}
                                        @php
                                            $status = $item->status;
                                            $badgeColor = 'bg-gray-200 text-gray-800'; // Default
                                            
                                            if ($type == 'lost') {
                                                if ($status == 'Masih Hilang') $badgeColor = 'bg-red-200 text-red-900';
                                                if ($status == 'Sudah Dikembalikan') $badgeColor = 'bg-green-200 text-green-900';
                                            } else {
                                                if ($status == 'Belum Diambil') $badgeColor = 'bg-yellow-200 text-yellow-900';
                                                if ($status == 'Sudah Diambil') $badgeColor = 'bg-green-200 text-green-900';
                                                if ($status == 'Diamankan') $badgeColor = 'bg-blue-200 text-blue-900';
                                            }
                                        @endphp
                                        <span class="px-3 py-1 text-sm rounded-full font-bold {{ $badgeColor }}">
                                            {{ $status ?? ($type == 'lost' ? 'Masih Hilang' : 'Belum Diambil') }}
                                        </span>
                                    </dd>
                                </div>

                                <div class="bg-white shadow p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-red-700">
                                        @if($type == 'lost')
                                            Lokasi Terakhir
                                        @else
                                            Lokasi Penemuan
                                        @endif
                                    </dt>
                                    <dd class="mt-1 text-lg font-semibold text-red-900">
                                        {{ $item->lokasi_terakhir ?? $item->lokasi_penemuan }}
                                    </dd>
                                </div>

                                <div class="bg-white shadow p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-red-700">
                                        @if($type == 'lost')
                                            Tanggal Kehilangan
                                        @else
                                            Tanggal Penemuan
                                        @endif
                                    </dt>
                                    <dd class="mt-1 text-lg font-semibold text-red-900">
                                        {{ \Carbon\Carbon::parse($item->tanggal_kehilangan ?? $item->tanggal_penemuan)->format('d F Y') }}
                                    </dd>
                                </div>

                                <div class="bg-white shadow p-4 rounded-lg md:col-span-2">
                                    <dt class="text-sm font-medium text-red-700">Deskripsi</dt>
                                    <dd class="mt-1 text-lg text-red-900 whitespace-pre-wrap">{{ $item->deskripsi }}</dd>
                                </div>
                            </dl>
                        </div>

                        {{-- ======================================================= --}}
                        {{-- INFORMASI PELAPOR (Kartu Putih, Teks Merah) --}}
                        {{-- ======================================================= --}}
                        <div>
                            <h3 class="text-xl text-center font-semibold text-gray-100 border-b border-gray-500 pb-2 mb-6">Informasi Pelapor</h3>
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-white shadow p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-red-700">Nama Pelapor</dt>
                                    <dd class="mt-1 text-lg font-semibold text-red-900">{{ $item->nama_pelapor }}</dd>
                                </div>
                                <div class="bg-white shadow p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-red-700">Status Pelapor</dt>
                                    <dd class="mt-1 text-lg font-semibold text-red-900">{{ $item->status_pelapor }}</dd>
                                </div>
                                <div class="bg-white shadow p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-red-700">NIM / NIP</dt>
                                    <dd class="mt-1 text-lg font-semibold text-red-900">{{ $item->NIM_NIP ?? '-' }}</dd>
                                </div>
                                <div class="bg-white shadow p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-red-700">No. Telepon</dt>
                                    <dd class="mt-1 text-lg font-semibold text-red-900">{{ $item->no_telp ?? '-' }}</dd>
                                </div>
                            </dl>
                        </div>

                        {{-- Tombol Kembali (Tetap gaya "Ghost" putih) --}}
                        <div class="flex justify-end mt-8 pt-6 border-t border-gray-500">
                            <a href="{{ route('admin.reports.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-transparent border border-gray-400 rounded-md font-semibold text-xs text-gray-200 uppercase tracking-widest
                                      hover:bg-gray-200 hover:text-red-800 
                                      focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 focus:ring-offset-red-800 
                                      transition ease-in-out duration-150">
                                Kembali
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>