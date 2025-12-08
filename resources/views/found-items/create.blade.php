@extends('layouts.app')
{{-- Layout Utama --}}

@section('title', 'Lapor Barang Ditemukan')
{{-- Judul Halaman --}}

@section('content')
{{-- Content Section --}}

{{-- Wrapper Utama. bg-gray-50: Abu muda. py-16: Padding vertikal 4rem. sm:py-24: Padding vertikal 6rem di tablet+. --}}
<div class="bg-gray-50 py-16 sm:py-24">
    
    {{-- Wrapper Rata Tengah. max-w-4xl: Lebar maks 56rem. mx-auto: Tengah. px-6: Padding horiz 1.5rem. --}}
    <div class="mx-auto max-w-4xl px-6 lg:px-8">
        
        {{-- Header Form --}}
        {{-- text-center: Rata tengah. mb-16: Margin bawah 4rem. --}}
        <div class="text-center mb-16">
            {{-- Judul. text-4xl font-bold: Besar & tebal. tracking-tight: Spasi rapat. sm:text-5xl: Lebih besar di tablet. --}}
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Form Laporan Penemuan</h1>
            
            {{-- Subjudul. mt-4: Margin atas. text-lg: Font besar. leading-8: Jarak baris. text-gray-600: Abu sedang. --}}
            <p class="mt-4 text-lg leading-8 text-gray-600">
                Terima kasih telah membantu. Mohon isi detail barang yang Anda temukan di bawah ini.
            </p>
        </div>

        {{-- Form Card --}}
        {{-- bg-white: Putih. p-8: Padding dalam. sm:p-12: Padding lebih besar di tablet. rounded-xl: Sudut membulat besar. shadow-lg: Bayangan besar. --}}
        <div class="bg-white p-8 sm:p-12 rounded-xl shadow-lg">
            
            {{-- Form Element. action: Store route. method: POST. --}}
            <form action="{{ route('found-items.store') }}" method="POST">
                @csrf
                {{-- Wrapper Form Fields. space-y-8: Jarak vertikal antar elemen 2rem. --}}
                <div class="space-y-8">
                    
                    {{-- Input: Nama Barang --}}
                    <div>
                        {{-- Label --}}
                        <label for="nama_barang" class="block text-sm font-semibold leading-6 text-gray-900">Nama Barang</label>
                        {{-- Wrapper Input --}}
                        <div class="mt-2.5">
                            {{-- Input Text. 
                                 block w-full: Lebar penuh. 
                                 rounded-md: Sudut membulat. 
                                 border-0: Tanpa border default. 
                                 py-2 px-3.5: Padding. 
                                 shadow-sm: Bayangan tipis. 
                                 ring-1 ring-inset ring-gray-300: Border custom abu. 
                                 focus:ring-2 focus:ring-gray-600: Fokus ring abu tua. 
                            --}}
                            <input type="text" name="nama_barang" id="nama_barang" required placeholder="Contoh: Kunci Motor Honda"
                                   class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    {{-- Grid 2 Kolom: Lokasi & Tanggal --}}
                    <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">
                        {{-- Input: Lokasi Penemuan --}}
                        <div>
                            <label for="lokasi_penemuan" class="block text-sm font-semibold leading-6 text-gray-900">Lokasi Penemuan</label>
                            <div class="mt-2.5">
                                <input type="text" name="lokasi_penemuan" id="lokasi_penemuan" required placeholder="Contoh: Area Parkir Gedung B"
                                       class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        {{-- Input: Tanggal Penemuan --}}
                        <div>
                            <label for="tanggal_penemuan" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal Penemuan</label>
                            <div class="mt-2.5">
                                <input type="date" name="tanggal_penemuan" id="tanggal_penemuan" required
                                       class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>

                    {{-- Separator --}}
                    <hr class="my-6">
                    
                    {{-- Header Bagian Pelapor --}}
                    <p class="text-lg font-semibold mb-4 text-gray-700">Informasi Pelapor</p>

                    {{-- Input: Nama Pelapor (Menggunakan Komponen x-text-input) --}}
                    <div class="mb-4">
                        <x-input-label for="nama_pelapor" :value="__('Nama Pelapor')" />
                        <x-text-input id="nama_pelapor" class="block mt-1 w-full" type="text" name="nama_pelapor" :value="old('nama_pelapor')" required autofocus />
                        <x-input-error :messages="$errors->get('nama_pelapor')" class="mt-2" />
                    </div>

                    {{-- Input: Status Pelapor --}}
                    <div class="mb-4">
                        <x-input-label for="status_pelapor" :value="__('Status Pelapor')" />
                        {{-- Select Input Standar --}}
                        <select name="status_pelapor" id="status_pelapor" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Pilih Status</option>
                            <option value="Mahasiswa" {{ old('status_pelapor') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                            <option value="Dosen" {{ old('status_pelapor') == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                            <option value="Lainnya" {{ old('status_pelapor') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        <x-input-error :messages="$errors->get('status_pelapor')" class="mt-2" />
                    </div>

                    {{-- Input: NIM/NIP (Opsional) --}}
                    <div class="mb-4">
                        <x-input-label for="NIM_NIP" :value="__('NIM / NIP (Opsional)')" />
                        <x-text-input id="NIM_NIP" class="block mt-1 w-full" type="text" name="NIM_NIP" :value="old('NIM_NIP')" />
                        <x-input-error :messages="$errors->get('NIM_NIP')" class="mt-2" />
                    </div>

                    {{-- Input: No Telepon (Opsional) --}}
                    <div class="mb-4">
                        <x-input-label for="no_telp" :value="__('No. Telepon (Opsional)')" />
                        <x-text-input id="no_telp" class="block mt-1 w-full" type="tel" name="no_telp" :value="old('no_telp')" />
                        <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
                    </div>

                    {{-- Textarea: Deskripsi Barang --}}
                    <div>
                        <label for="deskripsi" class="block text-sm font-semibold leading-6 text-gray-900">Deskripsi Barang</label>
                        <div class="mt-2.5">
                            <textarea name="deskripsi" id="deskripsi" rows="4" required placeholder="Jelaskan ciri-ciri spesifik barang yang ditemukan."
                                      class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                {{-- mt-10: Margin atas besar. border-t: Garis pemisah. --}}
                <div class="mt-10 flex justify-end items-center gap-x-6 border-t border-gray-900/10 pt-6">
                    {{-- Tombol Batal --}}
                    <a href="{{ url()->previous() }}" class="text-sm font-semibold leading-6 text-gray-900">Batal</a>
                    
                    {{-- Tombol Submit. bg-gray-800: Hitam abu. hover:bg-gray-700: Lebih terang saat hover. --}}
                    <button type="submit"
                            class="rounded-md bg-red-800 px-6 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                        Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
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
