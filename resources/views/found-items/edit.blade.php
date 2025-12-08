@extends('layouts.app')
{{-- Layout Utama --}}

@section('content')
{{-- Konten Utama --}}

{{-- Wrapper Utama. pt-24: Padding atas 6rem. min-h-screen: Tinggi minimal full layar. --}}
<div class="container mx-auto pt-24 px-4 min-h-screen">
    
    {{-- Form Card --}}
    {{-- max-w-2xl: Lebar maks 42rem. mx-auto: Rata tengah. bg-white: Background putih. rounded-lg: Sudut membulat. shadow-md: Bayangan sedang. p-8: Padding dalam. --}}
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8">
        
        {{-- Judul Halaman --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Laporan Barang Ditemukan</h1>
        
        {{-- Form Edit. Method POST dengan spoofing PUT. --}}
        <form action="{{ route('found-items.update', $foundItem->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Header Bagian Barang --}}
            <p class="text-lg font-semibold text-center mb-4 text-gray-700">Informasi Barang</p>
            
            {{-- Input: Nama Barang --}}
            <div class="mb-4">
                <label for="nama_barang" class="block text-gray-700 text-sm font-bold mb-2">Nama Barang</label>
                {{-- Input Field. shadow: Bayangan. appearance-none: Reset style browser. border: Garis tepi. w-full: Lebar penuh. --}}
                <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $foundItem->nama_barang) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>

            {{-- Input: Deskripsi (Textarea) --}}
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>{{ old('deskripsi', $foundItem->deskripsi) }}</textarea>
            </div>

            {{-- Input: Lokasi Penemuan --}}
            <div class="mb-4">
                <label for="lokasi_penemuan" class="block text-gray-700 text-sm font-bold mb-2">Lokasi Penemuan</label>
                <input type="text" name="lokasi_penemuan" id="lokasi_penemuan" value="{{ old('lokasi_penemuan', $foundItem->lokasi_penemuan) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>

            {{-- Input: Tanggal Penemuan --}}
            <div class="mb-6">
                <label for="tanggal_penemuan" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Penemuan</label>
                <input type="date" name="tanggal_penemuan" id="tanggal_penemuan" value="{{ old('tanggal_penemuan', $foundItem->tanggal_penemuan) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>

            {{-- Separator --}}
            <hr class="my-6">
            
            {{-- Header Bagian Pelapor --}}
            <p class="text-lg font-semibold mb-4 text-center text-gray-700">Informasi Pelapor</p>

            {{-- Input: Nama Pelapor --}}
            <div class="mb-4">
                <label for="nama_pelapor" class="block text-gray-700 text-sm font-bold mb-2">Nama Pelapor</label>
                <input type="text" name="nama_pelapor" id="nama_pelapor" value="{{ old('nama_pelapor', $foundItem->nama_pelapor) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                @error('nama_pelapor') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Input: Status Pelapor (Select) --}}
            <div class="mb-4">
                <label for="status_pelapor" class="block text-gray-700 text-sm font-bold mb-2">Status Pelapor</label>
                <select name="status_pelapor" id="status_pelapor" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
                    <option value="">Pilih Status</option>
                    {{-- Opsi dengan logika selected --}}
                    <option value="Mahasiswa" {{ old('status_pelapor', $foundItem->status_pelapor) == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    <option value="Dosen" {{ old('status_pelapor', $foundItem->status_pelapor) == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                    <option value="Lainnya" {{ old('status_pelapor', $foundItem->status_pelapor) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('status_pelapor') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Input: NIM/NIP --}}
            <div class="mb-4">
                <label for="NIM_NIP" class="block text-gray-700 text-sm font-bold mb-2">NIM / NIP (Opsional)</label>
                <input type="text" name="NIM_NIP" id="NIM_NIP" value="{{ old('NIM_NIP', $foundItem->NIM_NIP) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                @error('NIM_NIP') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Input: No Telepon --}}
            <div class="mb-6">
                <label for="no_telp" class="block text-gray-700 text-sm font-bold mb-2">No. Telepon (Opsional)</label>
                <input type="tel" name="no_telp" id="no_telp" value="{{ old('no_telp', $foundItem->no_telp) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                @error('no_telp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex items-center justify-end">
                {{-- Tombol Batal --}}
                <a href="{{ route('items.index') }}" class="text-gray-600 hover:text-gray-800 font-bold py-2 px-4 mr-2">Batal</a>
                
                {{-- Tombol Submit. bg-red-800: Merah tua. --}}
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