@extends('layouts.app')
{{-- Layout Utama --}}

@section('content')
{{-- Konten Utama --}}

{{-- Wrapper Utama --}}
<div class="container mx-auto pt-24 px-4 min-h-screen">
    {{-- Card Container --}}
    <div class="bg-white rounded-lg shadow-md p-8">
        
        {{-- Header Section (Centered) --}}
        <div class="text-center mb-8">
            <h1 class="text-5xl font-bold text-gray-800 mb-2">Manajemen Laporan</h1>
            <p class="text-gray-600">Cari barang yang hilang atau ditemukan di bawah ini.</p>
        </div>

        {{-- Search Bar Section --}}
        <div class="mb-10 flex justify-center">
            <form action="{{ route('admin.reports.index') }}" method="GET" class="w-full max-w-2xl relative">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari nama barang, deskripsi, atau lokasi..." 
                       class="w-full pl-6 pr-24 py-3 rounded-full border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300">
                <button type="submit" 
                        class="absolute right-2 top-2 bottom-2 px-8 bg-red-800 text-white font-bold rounded-full hover:bg-red-900 transition duration-300 flex items-center justify-center">
                    Cari
                </button>
            </form>
        </div>

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 text-center" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- ======================================================= --}}
        {{-- TABEL 1: DAFTAR BARANG DITEMUKAN (Found Items)          --}}
        {{-- (Dipindahkan ke atas sesuai request user)               --}}
        {{-- ======================================================= --}}
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4 px-1 border-l-4 border-red-800 pl-3">Daftar Barang Ditemukan</h2>
            <div class="overflow-x-auto rounded-lg shadow-sm">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-red-800 text-white uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-4 px-6 text-left">Nama Barang</th>
                            <th class="py-4 px-6 text-left">Deskripsi</th>
                            <th class="py-4 px-6 text-center">Lokasi Penemuan</th>
                            <th class="py-4 px-6 text-center">Tanggal Penemuan</th>
                            <th class="py-4 px-6 text-center">Status</th>
                            <th class="py-4 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @forelse ($foundItems as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150">
                                <td class="py-3 px-6 text-left font-medium text-gray-800">
                                    {{ $item->nama_barang }}
                                </td>
                                <td class="py-3 px-6 text-left max-w-xs truncate" title="{{ $item->deskripsi }}">
                                    {{ Str::limit($item->deskripsi, 50) }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ $item->lokasi_penemuan }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ \Carbon\Carbon::parse($item->tanggal_penemuan)->format('d M Y') }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    @if($item->status == 'Belum Diambil')
                                        <span class="bg-yellow-200 text-yellow-800 py-1 px-3 rounded-full text-xs font-bold">{{ $item->status }}</span>
                                    @elseif($item->status == 'Diamankan' || $item->status == 'Sudah Diamankan')
                                        <span class="bg-blue-200 text-blue-800 py-1 px-3 rounded-full text-xs font-bold">{{ $item->status }}</span>
                                    @else
                                        <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-xs font-bold">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center space-x-3">
                                        {{-- Lihat --}}
                                        <a href="{{ route('admin.reports.found.show', $item->uuid) }}" class="transform hover:text-blue-500 hover:scale-110 transition duration-150" title="Lihat Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        {{-- Edit --}}
                                        <a href="{{ route('admin.reports.found.edit', $item->uuid) }}" class="transform hover:text-yellow-500 hover:scale-110 transition duration-150" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L16.732 3.732z" />
                                            </svg>
                                        </a>
                                        {{-- Hapus --}}
                                        <form action="{{ route('admin.reports.found.destroy', $item->uuid) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="delete-button transform hover:text-red-600 hover:scale-110 transition duration-150" title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-8 bg-gray-50 text-gray-500 italic">
                                    Belum ada data barang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $foundItems->links('vendor.pagination.tailwind') }}
            </div>
        </div>

        {{-- ======================================================= --}}
        {{-- TABEL 2: DAFTAR BARANG HILANG (Lost Items)              --}}
        {{-- ======================================================= --}}
        <div>
            <h2 class="text-3xl font-bold text-gray-800 mb-4 px-1 border-l-4 border-red-800 pl-3">Daftar Barang Hilang</h2>
            <div class="overflow-x-auto rounded-lg shadow-sm">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-red-800 text-white uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-4 px-6 text-left">Nama Barang</th>
                            <th class="py-4 px-6 text-left">Deskripsi</th>
                            <th class="py-4 px-6 text-center">Lokasi Terakhir</th>
                            <th class="py-4 px-6 text-center">Tanggal Kehilangan</th>
                            <th class="py-4 px-6 text-center">Status</th>
                            <th class="py-4 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @forelse ($lostItems as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150">
                                <td class="py-3 px-6 text-left font-medium text-gray-800">
                                    {{ $item->nama_barang }}
                                </td>
                                <td class="py-3 px-6 text-left max-w-xs truncate" title="{{ $item->deskripsi }}">
                                    {{ Str::limit($item->deskripsi, 50) }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ $item->lokasi_terakhir }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ \Carbon\Carbon::parse($item->tanggal_kehilangan)->format('d M Y') }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    @if($item->status == 'Masih Hilang')
                                        <span class="bg-red-100 text-red-800 py-1 px-3 rounded-full text-xs font-bold">{{ $item->status }}</span>
                                    @else
                                        <span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-xs font-bold">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center space-x-3">
                                        {{-- Lihat --}}
                                        <a href="{{ route('admin.reports.lost.show', $item->uuid) }}" class="transform hover:text-blue-500 hover:scale-110 transition duration-150" title="Lihat Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        {{-- Edit --}}
                                        <a href="{{ route('admin.reports.lost.edit', $item->uuid) }}" class="transform hover:text-yellow-500 hover:scale-110 transition duration-150" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L16.732 3.732z" />
                                            </svg>
                                        </a>
                                        {{-- Hapus --}}
                                        <form action="{{ route('admin.reports.lost.destroy', $item->uuid) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="delete-button transform hover:text-red-600 hover:scale-110 transition duration-150" title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-8 bg-gray-50 text-gray-500 italic">
                                    Belum ada data barang hilang.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $lostItems->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
{{-- Script SweetAlert untuk Hapus --}}
<script @if(isset($csp_nonce)) nonce="{{ $csp_nonce }}" @endif>
    const deleteButtons = document.querySelectorAll('.delete-button');
    if (deleteButtons.length > 0) {
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const form = this.closest('form');
                Swal.fire({
                    title: 'Hapus Laporan?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#991b1b', // Red-800
                    cancelButtonColor: '#6b7280', // Gray-500
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
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
@endsection
