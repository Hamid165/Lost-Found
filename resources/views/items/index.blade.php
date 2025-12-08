@extends('layouts.app')
{{-- Layout Utama. Menggunakan template 'layouts.app'. --}}

@section('title', 'Barang')
{{-- Set Judul Halaman Browser --}}

@section('content')
{{-- Bagian Konten Utama --}}

{{-- Container Utama. 
     container: Lebar responsif. 
     mx-auto: Rata tengah. 
     pt-24: Padding atas 6rem (karena navbar fixed). 
     px-4: Padding horizontal 1rem. 
--}}
<div class="container mx-auto pt-24 px-4">
    
    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        {{-- Alert Box.
             bg-green-100: Latar hijau muda.
             border border-green-400: Garis tepi hijau.
             text-green-700: Teks hijau tua.
             px-4 py-3: Padding dalam.
             rounded: Sudut membulat kecil.
             relative: Posisi relatif.
             mb-6: Margin bawah 1.5rem.
             role="alert": Atribut aksesibilitas.
        --}}
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            {{-- Pesan. block sm:inline: Block di mobile, inline di tablet ke atas. --}}
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Header & Pencarian --}}
    {{-- text-center: Rata tengah. mb-12: Margin bawah 3rem. --}}
    <div class="text-center mb-12">
        {{-- Judul Halaman.
             text-4xl: Font size 2.25rem (mobile).
             md:text-5xl: Font size 3rem (tablet ke atas).
             font-extrabold: Sangat tebal (800).
             text-gray-800: Abu gelap.
        --}}
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800">Daftar Laporan Barang Ditemukan dan Kehilangan</h1>
        
        {{-- Deskripsi Sub-judul.
             mt-4: Margin atas 1rem.
             text-lg: Font agak besar (1.125rem).
             text-gray-600: Abu sedang.
             max-w-2xl: Lebar maks 42rem.
             mx-auto: Rata tengah.
        --}}
        <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">Cari barang yang hilang atau ditemukan di bawah ini.</p>
        
        {{-- Form Search.
             action: Route index items.
             method: GET.
             mt-8: Margin atas 2rem.
             max-w-2xl mx-auto: Lebar maks & rata tengah.
        --}}
        <form action="{{ route('items.index') }}" method="GET" class="mt-8 max-w-2xl mx-auto">
            {{-- Wrapper Input Relatif (untuk posisi tombol search). flex items-center: Flexbox rata vertikal. --}}
            <div class="relative flex items-center">
                {{-- Input Field.
                     block w-full: Lebar penuh.
                     rounded-full: Bentuk kapsul penuh.
                     border-gray-300: Border abu.
                     shadow-sm: Bayangan tipis.
                     py-3: Padding vertikal 0.75rem.
                     pl-6: Padding kiri 1.5rem.
                     pr-32: Padding kanan 8rem (memberi ruang untuk tombol cari).
                     text-base: Font standar.
                     focus:border-red-500: Border merah saat fokus.
                     focus:ring-red-500: Ring focus merah.
                --}}
                <input type="text" name="search" placeholder="Cari nama barang, deskripsi, atau lokasi..."
                       class="block w-full rounded-full border-gray-300 shadow-sm py-3 pl-6 pr-32 text-base focus:border-red-500 focus:ring-red-500"
                       value="{{ request('search') }}">
                
                {{-- Tombol Cari.
                     absolute right-2 top-1/2 -translate-y-1/2: Posisi absolut di kanan, tengah vertikal.
                     inline-flex items-center: Flex inline.
                     rounded-full: Kapsul.
                     bg-red-800: Merah tua.
                     px-6 py-2: Padding tombol.
                     text-sm font-semibold: Font kecil tebal.
                     text-white: Teks putih.
                     hover:bg-red-700: Hover merah agak terang.
                --}}
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 inline-flex items-center rounded-full bg-red-800 px-6 py-2 text-sm font-semibold text-white hover:bg-red-700">
                    Cari
                </button>
            </div>
        </form>
    </div>

    {{-- ===================================================================================== --}}
    {{-- TABEL BARANG DITEMUKAN --}}
    {{-- ===================================================================================== --}}
    
    {{-- Card Container Tabel. bg-white: Putih. rounded-lg: Sudut membulat. shadow-md: Bayangan sedang. p-8: Padding 2rem. mb-10: Margin bawah 2.5rem. --}}
    <div class="bg-white rounded-lg shadow-md p-8 mb-10">
        {{-- Judul Tabel. text-3xl font-bold text-gray-800 mb-6: Besar, tebal, abu, margin bawah. --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Barang Ditemukan</h1>
        
        {{-- Wrapper Tabel Responsive. overflow-x-auto: Scroll horizontal jika tabel terlalu lebar di mobile. --}}
        <div class="overflow-x-auto">
            {{-- Table Element. min-w-full: Lebar minimal 100%. bg-white: Background putih. --}}
            <table class="min-w-full bg-white">
                {{-- Table Head. bg-red-800: Background merah tua. text-white: Teks putih. uppercase: Huruf kapital. text-sm leading-normal: Font kecil. --}}
                <thead class="bg-red-800 text-white uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">Nama Barang</th>
                        <th class="py-3 px-6 text-left">Deskripsi</th>
                        <th class="py-3 px-6 text-center">Lokasi Penemuan</th>
                        <th class="py-3 px-6 text-center">Tanggal Penemuan</th>
                        <th class="py-3 px-6 text-center">Status</th>
                        @auth
                            <th class="py-3 px-6 text-center">Aksi</th>
                        @endauth
                    </tr>
                </thead>
                {{-- Table Body. text-gray-600: Teks abu-abu. text-sm font-light: Font kecil tipis. --}}
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($foundItems as $item)
                        {{-- Baris Tabel. border-b border-gray-200: Garis pemisah bawah. hover:bg-gray-100: Highlight saat hover. --}}
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            {{-- Kolom Nama. whitespace-nowrap: Teks tidak wrap ke bawah. --}}
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $item->nama_barang }}</td>
                            {{-- Kolom Deskripsi. Limit karakter untuk tampilan rapi. --}}
                            <td class="py-3 px-6 text-left">{{ Str::limit($item->deskripsi, 40) }}</td>
                            <td class="py-3 px-6 text-center">{{ $item->lokasi_penemuan }}</td>
                            <td class="py-3 px-6 text-center">{{ \Carbon\Carbon::parse($item->tanggal_penemuan)->format('d M Y') }}</td>
                            {{-- Kolom Status Badge --}}
                            <td class="py-3 px-6 text-center">
                                @if($item->status == 'Belum Diambil')
                                    {{-- Badge Kuning --}}
                                    <span class="bg-yellow-200 text-yellow-700 py-1 px-3 rounded-full text-xs font-semibold">{{ $item->status }}</span>
                                @else
                                    {{-- Badge Hijau --}}
                                    <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs font-semibold">{{ $item->status }}</span>
                                @endif
                            </td>
                            @auth
                                {{-- Kolom Aksi --}}
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        @if(auth()->user()->isAdmin())
                                            {{-- AKSI ADMIN (Edit/Delete) --}}
                                            {{-- Tombol Show. transform hover:scale-110: Efek zoom saat hover. --}}
                                            <a href="{{ route('admin.reports.found.show', ['foundItem' => $item->uuid]) }}" class="w-5 mr-2 transform hover:text-blue-500 hover:scale-110" title="Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                            </a>
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('admin.reports.found.edit', ['foundItem' => $item->uuid]) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L16.732 3.732z" /></svg>
                                            </a>
                                            {{-- Form Delete --}}
                                            <form action="{{ route('admin.reports.found.destroy', ['foundItem' => $item->uuid]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="delete-button w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                        @else
                                            {{-- AKSI USER (Hanya Show) --}}
                                            <a href="{{ route('items.show.found', ['foundItem' => $item->uuid]) }}" class="w-5 mr-2 transform hover:text-blue-500 hover:scale-110" title="Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            @endauth
                        </tr>
                    @empty
                        {{-- Row Kosong --}}
                        <td colspan="{{ auth()->check() ? '6' : '5' }}" class="text-center py-4">Belum ada barang temuan yang dilaporkan.</td>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
        <div class="mt-6">{{ $foundItems->appends(request()->query())->links('vendor.pagination.tailwind-white') }}</div>
    </div>

    {{-- ===================================================================================== --}}
    {{-- TABEL BARANG HILANG --}}
    {{-- ===================================================================================== --}}
    <div class="bg-white rounded-lg shadow-md p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Barang Hilang</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-red-800 text-white uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">Nama Barang</th>
                        <th class="py-3 px-6 text-left">Deskripsi</th>
                        <th class="py-3 px-6 text-center">Lokasi Terakhir</th>
                        <th class="py-3 px-6 text-center">Tanggal Kehilangan</th>
                        <th class="py-3 px-6 text-center">Status</th>
                        @auth
                            <th class="py-3 px-6 text-center">Aksi</th>
                        @endauth
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($lostItems as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $item->nama_barang }}</td>
                            <td class="py-3 px-6 text-left">{{ Str::limit($item->deskripsi, 40) }}</td>
                            <td class="py-3 px-6 text-center">{{ $item->lokasi_terakhir }}</td>
                            <td class="py-3 px-6 text-center">{{ \Carbon\Carbon::parse($item->tanggal_kehilangan)->format('d M Y') }}</td>
                            <td class="py-3 px-6 text-center">
                                @if($item->status == 'Masih Hilang')
                                    {{-- Badge Merah --}}
                                    <span class="bg-red-200 text-red-700 py-1 px-3 rounded-full text-xs font-semibold">{{ $item->status }}</span>
                                @else
                                    {{-- Badge Hijau --}}
                                    <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs font-semibold">{{ $item->status }}</span>
                                @endif
                            </td>
                            @auth
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        @if(auth()->user()->isAdmin())
                                            {{-- AKSI ADMIN --}}
                                            <a href="{{ route('admin.reports.lost.show', ['lostItem' => $item->uuid]) }}" class="w-5 mr-2 transform hover:text-blue-500 hover:scale-110" title="Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                            </a>
                                            <a href="{{ route('admin.reports.lost.edit', ['lostItem' => $item->uuid]) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L16.732 3.732z" /></svg>
                                            </a>
                                            <form action="{{ route('admin.reports.lost.destroy', ['lostItem' => $item->uuid]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="delete-button w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                        @else
                                            {{-- AKSI USER --}}
                                            <a href="{{ route('items.show.lost', ['lostItem' => $item->uuid]) }}" class="w-5 mr-2 transform hover:text-blue-500 hover:scale-110" title="Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            @endauth
                        </tr>
                    @empty
                        <td colspan="{{ auth()->check() ? '6' : '5' }}" class="text-center py-4">Belum ada barang hilang yang dilaporkan.</td>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
        <div class="mt-6">{{ $lostItems->appends(request()->query())->links('vendor.pagination.tailwind-white') }}</div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Script SweetAlert untuk konfirmasi hapus --}}
<script @if(isset($csp_nonce)) nonce="{{ $csp_nonce }}" @endif>
    // Seleksi semua tombol dengan class delete-button
    const deleteButtons = document.querySelectorAll('.delete-button');

    if (deleteButtons.length > 0) {
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault(); // Cegah submit langsung
                const form = this.closest('form'); // Ambil form terdekat
                
                // Tampilkan SweetAlert
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    // Jika user klik Ya
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    }
</script>
@endpush

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
