@extends('layouts.app')

@section('content')
<div class="container mx-auto pt-24 px-4 min-h-screen">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Laporan Barang Hilang</h1>
        <form action="{{ route('lost-items.update', $lostItem->id) }}" method="POST">
            @csrf
            @method('PUT')

            <p class="text-lg font-semibold text-center mb-4 text-gray-700">Informasi Barang</p>
            <div class="mb-4">
                <label for="nama_barang" class="block text-gray-700 text-sm font-bold mb-2">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $lostItem->nama_barang) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>{{ old('deskripsi', $lostItem->deskripsi) }}</textarea>
            </div>
            <div class="mb-4">
                <label for="lokasi_terakhir" class="block text-gray-700 text-sm font-bold mb-2">Lokasi Terakhir</label>
                <input type="text" name="lokasi_terakhir" id="lokasi_terakhir" value="{{ old('lokasi_terakhir', $lostItem->lokasi_terakhir) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>
            <div class="mb-6">
                <label for="tanggal_kehilangan" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Kehilangan</label>
                <input type="date" name="tanggal_kehilangan" id="tanggal_kehilangan" value="{{ old('tanggal_kehilangan', $lostItem->tanggal_kehilangan) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>

            <hr class="my-6">
            <p class="text-lg font-semibold mb-4 text-center text-gray-700">Informasi Pelapor</p>

            <div class="mb-4">
                <label for="nama_pelapor" class="block text-gray-700 text-sm font-bold mb-2">Nama Pelapor</label>
                <input type="text" name="nama_pelapor" id="nama_pelapor" value="{{ old('nama_pelapor', $lostItem->nama_pelapor) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                @error('nama_pelapor') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="status_pelapor" class="block text-gray-700 text-sm font-bold mb-2">Status Pelapor</label>
                <select name="status_pelapor" id="status_pelapor" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                    <option value="">Pilih Status</option>
                    <option value="Mahasiswa" {{ old('status_pelapor', $lostItem->status_pelapor) == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    <option value="Dosen" {{ old('status_pelapor', $lostItem->status_pelapor) == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                    <option value="Lainnya" {{ old('status_pelapor', $lostItem->status_pelapor) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('status_pelapor') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="NIM_NIP" class="block text-gray-700 text-sm font-bold mb-2">NIM / NIP (Opsional)</label>
                <input type="text" name="NIM_NIP" id="NIM_NIP" value="{{ old('NIM_NIP', $lostItem->NIM_NIP) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                @error('NIM_NIP') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label for="no_telp" class="block text-gray-700 text-sm font-bold mb-2">No. Telepon (Opsional)</label>
                <input type="tel" name="no_telp" id="no_telp" value="{{ old('no_telp', $lostItem->no_telp) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                @error('no_telp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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