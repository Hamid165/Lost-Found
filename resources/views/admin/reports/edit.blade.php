@section('title', $pageTitle)
{{-- @section('title'): Menetapkan judul halaman dinamis --}}

<x-app-layout>
    {{-- Slot Header Dikosongkan --}}
    <x-slot name="header">
    </x-slot>

    {{-- Wrapper Utama. pt-20: Padding atas 5rem agar tidak tertutup navbar. --}}
    <div class="pt-20">
        {{-- Wrapper Konten. pb-12: Padding bawah 3rem. --}}
        <div class="pb-12">
            {{-- Container Responsif. max-w-4xl: Lebar maks 56rem. mx-auto: Tengah. sm:px-6: Padding horiz tablet. lg:px-8: Padding horiz desktop. --}}
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                
                {{-- Card Background Merah. --}}
                {{-- bg-red-800: Latar merah tua. overflow-hidden: Sembunyikan overflow. shadow-sm: Bayangan tipis. sm:rounded-lg: Sudut membulat. --}}
                <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- Inner Padding. p-6 md:p-8: Padding responsif. text-white: Teks putih. --}}
                    <div class="p-6 md:p-8 text-white">
                        
                        {{-- Judul Halaman Edit --}}
                        <div class="text-center mb-6">
                            <h2 class="font-semibold text-2xl text-white leading-tight">
                                {{ $pageTitle }}
                            </h2>
                        </div>
                        
                        {{-- Form Edit --}}
                        <form action="{{ $updateRoute }}" method="POST">
                            @csrf
                            {{-- Method PATCH untuk update --}}
                            @method('PATCH')

                            {{-- ======================================================= --}}
                            {{-- BAGIAN INFO BARANG --}}
                            {{-- ======================================================= --}}
                            <p class="font-semibold text-center text-lg text-gray-100 mb-4">Informasi Barang</p>

                            {{-- Grid 2 Kolom untuk Baris 1: Nama & Status --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Input Nama Barang --}}
                                <div>
                                    <label for="nama_barang" class="block font-medium text-sm text-gray-200">Nama Barang</label>
                                    {{-- Input Field. text-gray-900: Teks hitam (karena bg-white). focus:ring-red-500: Ring fokus merah. --}}
                                    <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $item->nama_barang) }}" class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-red-500 focus:border-red-500" required>
                                </div>
                                {{-- Select Status Laporan --}}
                                <div>
                                    <label for="status" class="block font-medium text-sm text-gray-200">Status Laporan</label>
                                    <select name="status" id="status" class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-red-500 focus:border-red-500" required>
                                        {{-- Loop Opsi Status dari Controller --}}
                                        @foreach($statusOptions as $option)
                                            <option value="{{ $option }}" @if($item->status == $option) selected @endif>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Grid 2 Kolom untuk Baris 2: Lokasi & Tanggal --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                {{-- Input Lokasi (Dinamis: 'lokasi_terakhir' atau 'lokasi_penemuan') --}}
                                <div>
                                    <label for="{{ $locationField }}" class="block font-medium text-sm text-gray-200 capitalize">{{ str_replace('_', ' ', $locationField) }}</label>
                                    <input type="text" name="{{ $locationField }}" id="{{ $locationField }}" value="{{ old($locationField, $item->$locationField) }}" class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-red-500 focus:border-red-500" required>
                                </div>
                                {{-- Input Tanggal (Dinamis) --}}
                                <div>
                                    <label for="{{ $dateField }}" class="block font-medium text-sm text-gray-200 capitalize">{{ str_replace('_', ' ', $dateField) }}</label>
                                    <input type="date" name="{{ $dateField }}" id="{{ $dateField }}" value="{{ old($dateField, \Carbon\Carbon::parse($item->$dateField)->format('Y-m-d')) }}" class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-red-500 focus:border-red-500" required>
                                </div>
                            </div>

                            {{-- Input Deskripsi --}}
                            <div class="mt-6">
                                <label for="deskripsi" class="block font-medium text-sm text-gray-200">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-red-500 focus:border-red-500" required>{{ old('deskripsi', $item->deskripsi) }}</textarea>
                            </div>

                            {{-- Pemisah Garis --}}
                            <hr class="my-6 border-gray-500">

                            {{-- ======================================================= --}}
                            {{-- BAGIAN INFO PELAPOR --}}
                            {{-- ======================================================= --}}
                            <p class="font-semibold text-center text-lg text-gray-100 mb-4">Informasi Pelapor</p>

                            {{-- Grid 2 Kolom untuk Baris 3: Nama & Status Pelapor --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama_pelapor" class="block font-medium text-sm text-gray-200">Nama Pelapor</label>
                                    <input type="text" name="nama_pelapor" id="nama_pelapor" value="{{ old('nama_pelapor', $item->nama_pelapor) }}" class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-red-500 focus:border-red-500" required>
                                </div>
                                <div>
                                    <label for="status_pelapor" class="block font-medium text-sm text-gray-200">Status Pelapor</label>
                                    <select name="status_pelapor" id="status_pelapor" class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-red-500 focus:border-red-500" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Mahasiswa" {{ old('status_pelapor', $item->status_pelapor) == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                        <option value="Dosen" {{ old('status_pelapor', $item->status_pelapor) == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                                        <option value="Lainnya" {{ old('status_pelapor', $item->status_pelapor) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            
                            {{-- Grid 2 Kolom untuk Baris 4: NIM/NIP & No. Telp --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                <div>
                                    <label for="NIM_NIP" class="block font-medium text-sm text-gray-200">NIM / NIP (Opsional)</label>
                                    <input type="text" name="NIM_NIP" id="NIM_NIP" value="{{ old('NIM_NIP', $item->NIM_NIP) }}" class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-red-500 focus:border-red-500">
                                </div>
                                <div>
                                    <label for="no_telp" class="block font-medium text-sm text-gray-200">No. Telepon (Opsional)</label>
                                    <input type="tel" name="no_telp" id="no_telp" value="{{ old('no_telp', $item->no_telp) }}" class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-red-500 focus:border-red-500">
                                </div>
                            </div>


                            {{-- Aksi --}}
                            <div class="flex items-center justify-end mt-6">
                                <a href="{{ route('admin.reports.index') }}" class="text-gray-300 hover:text-white mr-4">
                                    Batal
                                </a>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-yellow-400 active:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

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