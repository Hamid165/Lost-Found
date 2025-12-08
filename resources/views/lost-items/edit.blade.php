@extends('layouts.app')
{{-- Meng-extend layout utama --}}

@section('content')
{{-- Section Content Utama --}}

{{-- Container Utama. pt-24: Padding atas besar (karena ada navbar fixed). px-4: Padding horizontal. min-h-screen: Tinggi minimal layar penuh. --}}
<div class="container mx-auto pt-24 px-4 min-h-screen">
    
    {{-- Form Card. max-w-2xl: Lebar maksimum lebih kecil dari create (opsional, sesuaikan). mx-auto: Rata tengah. bg-white: Putih. rounded-lg: Sudut membulat. shadow-md: Bayangan sedang. p-8: Padding dalam. --}}
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8">
        
        {{-- Judul Halaman. text-3xl font-bold: Besar & tebal. text-gray-800: Abu gelap. mb-6: Margin bawah. --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Laporan Barang Hilang</h1>
        
        {{-- Form Edit. action: Route update. method="POST": HTML form cuma support GET/POST. --}}
        <form action="{{ route('lost-items.update', $lostItem->id) }}" method="POST">
            @csrf
            {{-- Method Spoofing PUT untuk update data --}}
            @method('PUT')

            {{-- Judul Seksi Barang --}}
            <p class="text-lg font-semibold text-center mb-4 text-gray-700">Informasi Barang</p>
            
            {{-- Input Nama Barang --}}
            <div class="mb-4">
                {{-- Label --}}
                <label for="nama_barang" class="block text-gray-700 text-sm font-bold mb-2">Nama Barang</label>
                {{-- Input dengan Value Lama --}}
                <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $lostItem->nama_barang) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>

            {{-- Input Deskripsi --}}
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                {{-- Textarea isi manual di antara tag --}}
                <textarea name="deskripsi" id="deskripsi" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>{{ old('deskripsi', $lostItem->deskripsi) }}</textarea>
            </div>

            {{-- Input Lokasi Terakhir --}}
            <div class="mb-4">
                <label for="lokasi_terakhir" class="block text-gray-700 text-sm font-bold mb-2">Lokasi Terakhir</label>
                <input type="text" name="lokasi_terakhir" id="lokasi_terakhir" value="{{ old('lokasi_terakhir', $lostItem->lokasi_terakhir) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>

            {{-- Input Tanggal Kehilangan --}}
            <div class="mb-6">
                <label for="tanggal_kehilangan" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Kehilangan</label>
                <input type="date" name="tanggal_kehilangan" id="tanggal_kehilangan" value="{{ old('tanggal_kehilangan', $lostItem->tanggal_kehilangan) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>

            {{-- Separator --}}
            <hr class="my-6">
            
            {{-- Judul Seksi Pelapor --}}
            <p class="text-lg font-semibold mb-4 text-center text-gray-700">Informasi Pelapor</p>

            {{-- Input Nama Pelapor --}}
            <div class="mb-4">
                <label for="nama_pelapor" class="block text-gray-700 text-sm font-bold mb-2">Nama Pelapor</label>
                <input type="text" name="nama_pelapor" id="nama_pelapor" value="{{ old('nama_pelapor', $lostItem->nama_pelapor) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                {{-- Error Message Manual --}}
                @error('nama_pelapor') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Input Status Pelapor --}}
            <div class="mb-4">
                <label for="status_pelapor" class="block text-gray-700 text-sm font-bold mb-2">Status Pelapor</label>
                <select name="status_pelapor" id="status_pelapor" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                    <option value="">Pilih Status</option>
                    {{-- Seleksi Opsi Berdasarkan Data Lama --}}
                    <option value="Mahasiswa" {{ old('status_pelapor', $lostItem->status_pelapor) == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    <option value="Dosen" {{ old('status_pelapor', $lostItem->status_pelapor) == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                    <option value="Lainnya" {{ old('status_pelapor', $lostItem->status_pelapor) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('status_pelapor') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Input NIM/NIP --}}
            <div class="mb-4">
                <label for="NIM_NIP" class="block text-gray-700 text-sm font-bold mb-2">NIM / NIP (Opsional)</label>
                <input type="text" name="NIM_NIP" id="NIM_NIP" value="{{ old('NIM_NIP', $lostItem->NIM_NIP) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                @error('NIM_NIP') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Input No Telepon --}}
            <div class="mb-6">
                <label for="no_telp" class="block text-gray-700 text-sm font-bold mb-2">No. Telepon (Opsional)</label>
                <input type="tel" name="no_telp" id="no_telp" value="{{ old('no_telp', $lostItem->no_telp) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                @error('no_telp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex items-center justify-end">
                {{-- Tombol Batal --}}
                <a href="{{ route('items.index') }}" class="text-gray-600 hover:text-gray-800 font-bold py-2 px-4 mr-2">Batal</a>
                
                {{-- Tombol Update. bg-red-800: Merah tua. hover:bg-red-900: Gelap saat hover. --}}
                <button type="submit" class="bg-red-800 hover:bg-red-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Perbarui Laporan
                </button>
            </div>
        </form>
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