@extends('layouts.app')

@section('content')
<div class="container mx-auto pt-24 px-4 min-h-screen">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-8">

        {{-- Judul --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            Detail Laporan: {{ $item->nama_barang }}
        </h1>

        {{-- Informasi Barang --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Informasi Barang</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                <div>
                    <strong class="text-gray-600">Nama Barang:</strong>
                    <p class="text-gray-800">{{ $item->nama_barang }}</p>
                </div>
                <div>
                    <strong class="text-gray-600">Status:</strong>
                    <p class="text-gray-800">
                        {{-- Menampilkan status dengan format yang lebih baik --}}
                        @if($type == 'lost')
                            {{ $item->status ?? 'Masih Hilang' }}
                        @else
                            {{ $item->status ?? 'Belum Diambil' }}
                        @endif
                    </p>
                </div>
                <div>
                    {{-- Menampilkan Lokasi berdasarkan Tipe --}}
                    @if($type == 'lost')
                        <strong class="text-gray-600">Lokasi Terakhir:</strong>
                        <p class="text-gray-800">{{ $item->lokasi_terakhir }}</p>
                    @else
                        <strong class="text-gray-600">Lokasi Penemuan:</strong>
                        <p class="text-gray-800">{{ $item->lokasi_penemuan }}</p>
                    @endif
                </div>
                <div>
                    {{-- Menampilkan Tanggal berdasarkan Tipe --}}
                    @if($type == 'lost')
                        <strong class="text-gray-600">Tanggal Kehilangan:</strong>
                        <p class="text-gray-800">{{ \Carbon\Carbon::parse($item->tanggal_kehilangan)->format('d F Y') }}</p>
                    @else
                        <strong class="text-gray-600">Tanggal Penemuan:</strong>
                        <p class="text-gray-800">{{ \Carbon\Carbon::parse($item->tanggal_penemuan)->format('d F Y') }}</p>
                    @endif
                </div>
                <div class="md:col-span-2">
                    <strong class="text-gray-600">Deskripsi:</strong>
                    <p class="text-gray-800 whitespace-pre-wrap">{{ $item->deskripsi }}</p>
                </div>
            </div>
        </div>

        {{-- Informasi Pelapor --}}
        <div>
            <h2 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Informasi Pelapor</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                <div>
                    <strong class="text-gray-600">Nama Pelapor:</strong>
                    <p class="text-gray-800">{{ $item->nama_pelapor }}</p>
                </div>
                <div>
                    <strong class="text-gray-600">Status Pelapor:</strong>
                    <p class="text-gray-800">{{ $item->status_pelapor }}</p>
                </div>
                <div>
                    <strong class="text-gray-600">NIM / NIP:</strong>
                    <p class="text-gray-800">{{ $item->NIM_NIP ?? '-' }}</p>
                </div>
                <div>
                    <strong class="text-gray-600">No. Telepon:</strong>
                    <p class="text-gray-800">{{ $item->no_telp ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="flex justify-end mt-8">
            <a href="{{ url()->previous() }}" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Kembali
            </a>
        </div>

    </div>
</div>
@endsection