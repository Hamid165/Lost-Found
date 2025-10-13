@extends('layouts.app')

@section('content')
<div class="container mx-auto pt-24 px-4 min-h-screen">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Laporan Barang Ditemukan</h1>
        <form action="{{ route('found-items.update', $foundItem->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nama_barang" class="block text-gray-700 text-sm font-bold mb-2">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" value="{{ $foundItem->nama_barang }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>{{ $foundItem->deskripsi }}</textarea>
            </div>
            <div class="mb-4">
                <label for="lokasi_penemuan" class="block text-gray-700 text-sm font-bold mb-2">Lokasi Penemuan</label>
                <input type="text" name="lokasi_penemuan" id="lokasi_penemuan" value="{{ $foundItem->lokasi_penemuan }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>
            <div class="mb-6">
                <label for="tanggal_penemuan" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Penemuan</label>
                <input type="date" name="tanggal_penemuan" id="tanggal_penemuan" value="{{ $foundItem->tanggal_penemuan }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>
            <div class="flex items-center justify-end">
                 <a href="{{ route('items.index') }}" class="text-gray-600 hover:text-gray-800 font-bold py-2 px-4 mr-2">Batal</a>
                <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Perbarui Laporan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
