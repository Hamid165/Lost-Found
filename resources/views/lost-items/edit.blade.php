@extends('layouts.app')

@section('content')
<div class="container mx-auto pt-24 px-4 min-h-screen">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Laporan Barang Hilang</h1>
        <form action="{{ route('lost-items.update', $lostItem->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nama_barang" class="block text-gray-700 text-sm font-bold mb-2">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" value="{{ $lostItem->nama_barang }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>{{ $lostItem->deskripsi }}</textarea>
            </div>
            <div class="mb-4">
                <label for="lokasi_terakhir" class="block text-gray-700 text-sm font-bold mb-2">Lokasi Terakhir</label>
                <input type="text" name="lokasi_terakhir" id="lokasi_terakhir" value="{{ $lostItem->lokasi_terakhir }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>
            <div class="mb-6">
                <label for="tanggal_kehilangan" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Kehilangan</label>
                <input type="date" name="tanggal_kehilangan" id="tanggal_kehilangan" value="{{ $lostItem->tanggal_kehilangan }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>
            <div class="flex items-center justify-end">
                <a href="{{ route('items.index') }}" class="text-gray-600 hover:text-gray-800 font-bold py-2 px-4 mr-2">Batal</a>
                <button type="submit" class="bg-red-800 hover:bg-red-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Perbarui Laporan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
