@section('title', 'Detail Laporan')
{{-- Set Judul Halaman --}}

<x-app-layout>
    {{-- Slot Header Dikosongkan --}}
    <x-slot name="header">
    </x-slot>

    {{-- Wrapper Utama. pt-20: Padding atas 5rem agar tidak tertutup navbar. --}}
    <div class="pt-20">
        {{-- Wrapper Konten. pb-12: Padding bawah 3rem. --}}
        <div class="pb-12">
            {{-- Container Responsif. max-w-4xl: Lebar maksimal 56rem. mx-auto: Tengah. sm:px-6: Padding horiz tablet. lg:px-8: Padding horiz desktop. --}}
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                
                {{-- Card Background Merah. --}}
                {{-- bg-red-800: Latar merah tua. overflow-hidden: Sembunyikan konten lebih. shadow-sm: Bayangan tipis. sm:rounded-lg: Sudut membulat. --}}
                <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- Inner Padding. p-6 md:p-8: Padding responsif. text-white: Teks putih. --}}
                    <div class="p-6 md:p-8 text-white">

                        {{-- Judul Halaman Detail. font-semibold: Tebal. text-3xl: Besar. leading-tight: Spasi baris rapat. text-center: Rata tengah. mb-8: Margin bawah. --}}
                        <h2 class="font-semibold text-3xl text-white leading-tight text-center mb-8">
                            Detail Laporan: {{ $item->nama_barang }}
                        </h2>

                        {{-- ======================================================= --}}
                        {{-- INFORMASI BARANG --}}
                        {{-- ======================================================= --}}
                        
                        {{-- Bagian Info Barang --}}
                        <div class="mb-8">
                            {{-- Subjudul Section --}}
                            <h3 class="text-xl text-center font-semibold text-gray-100 border-b border-gray-500 pb-2 mb-6">Informasi Barang</h3>
                            
                            {{-- Grid Layout 2 Kolom --}}
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                {{-- Card Data: Nama Barang --}}
                                <div class="bg-white shadow p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-red-700">Nama Barang</dt>
                                    <dd class="mt-1 text-lg font-semibold text-red-900">{{ $item->nama_barang }}</dd>
                                </div>

                                {{-- Card Data: Status --}}
                                <div class="bg-white shadow p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-red-700">Status</dt>
                                    <dd class="mt-1 text-lg font-semibold text-red-900">
                                        {{-- Logika Penentuan Warna Badge --}}
                                        @php
                                            $status = $item->status;
                                            $badgeColor = 'bg-gray-200 text-gray-800'; // Default
                                            
                                            // Jika Laporan Kehilangan
                                            if ($type == 'lost') {
                                                if ($status == 'Masih Hilang') $badgeColor = 'bg-red-200 text-red-900';
                                                if ($status == 'Sudah Dikembalikan') $badgeColor = 'bg-green-200 text-green-900';
                                            } else {
                                                // Jika Laporan Penemuan
                                                if ($status == 'Belum Diambil') $badgeColor = 'bg-yellow-200 text-yellow-900';
                                                if ($status == 'Sudah Diambil') $badgeColor = 'bg-green-200 text-green-900';
                                                if ($status == 'Diamankan') $badgeColor = 'bg-blue-200 text-blue-900';
                                            }
                                        @endphp
                                        {{-- Menampilkan Badge --}}
                                        <span class="px-3 py-1 text-sm rounded-full font-bold {{ $badgeColor }}">
                                            {{ $status ?? ($type == 'lost' ? 'Masih Hilang' : 'Belum Diambil') }}
                                        </span>
                                    </dd>
                                </div>

                                {{-- Card Data: Lokasi --}}
                                <div class="bg-white shadow p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-red-700">
                                        @if($type == 'lost')
                                            Lokasi Terakhir
                                        @else
                                            Lokasi Penemuan
                                        @endif
                                    </dt>
                                    <dd class="mt-1 text-lg font-semibold text-red-900">
                                        {{ $item->lokasi_terakhir ?? $item->lokasi_penemuan }}
                                    </dd>
                                </div>

                                {{-- Card Data: Tanggal --}}
                                <div class="bg-white shadow p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-red-700">
                                        @if($type == 'lost')
                                            Tanggal Kehilangan
                                        @else
                                            Tanggal Penemuan
                                        @endif
                                    </dt>
                                    <dd class="mt-1 text-lg font-semibold text-red-900">
                                        {{ \Carbon\Carbon::parse($item->tanggal_kehilangan ?? $item->tanggal_penemuan)->format('d F Y') }}
                                    </dd>
                                </div>

                                {{-- Card Data: Deskripsi (Full Width) --}}
                                <div class="bg-white shadow p-4 rounded-lg md:col-span-2">
                                    <dt class="text-sm font-medium text-red-700">Deskripsi</dt>
                                    <dd class="mt-1 text-lg text-red-900 whitespace-pre-wrap">{{ $item->deskripsi }}</dd>
                                </div>
                            </dl>
                        </div>

                        {{-- ======================================================= --}}
                        {{-- INFORMASI PELAPOR --}}
                        {{-- ======================================================= --}}
                        <div>
                            <h3 class="text-xl text-center font-semibold text-gray-100 border-b border-gray-500 pb-2 mb-6">Informasi Pelapor</h3>
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Card Data: Nama Pelapor --}}
                                <div class="bg-white shadow p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-red-700">Nama Pelapor</dt>
                                    <dd class="mt-1 text-lg font-semibold text-red-900">{{ $item->nama_pelapor }}</dd>
                                </div>
                                {{-- Card Data: Status Pelapor --}}
                                <div class="bg-white shadow p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-red-700">Status Pelapor</dt>
                                    <dd class="mt-1 text-lg font-semibold text-red-900">{{ $item->status_pelapor }}</dd>
                                </div>
                                {{-- Card Data: NIM/NIP --}}
                                <div class="bg-white shadow p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-red-700">NIM / NIP</dt>
                                    <dd class="mt-1 text-lg font-semibold text-red-900">{{ $item->NIM_NIP ?? '-' }}</dd>
                                </div>
                                {{-- Card Data: No. Telepon --}}
                                <div class="bg-white shadow p-4 rounded-lg">
                                    <dt class="text-sm font-medium text-red-700">No. Telepon</dt>
                                    <dd class="mt-1 text-lg font-semibold text-red-900">{{ $item->no_telp ?? '-' }}</dd>
                                </div>
                            </dl>
                        </div>

                        {{-- Tombol Kembali --}}
                        <div class="flex justify-end mt-8 pt-6 border-t border-gray-500">
                            {{-- Link Kembali dengan gaya transparan border --}}
                            <a href="{{ route('admin.reports.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-transparent border border-gray-400 rounded-md font-semibold text-xs text-gray-200 uppercase tracking-widest
                                      hover:bg-gray-200 hover:text-red-800
                                      focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 focus:ring-offset-red-800
                                      transition ease-in-out duration-150">
                                Kembali
                            </a>
                        </div>

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
