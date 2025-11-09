@extends('layouts.app')
@section('title', 'Manajemen Laporan')
@section('content')
<div class="container mx-auto pt-24 px-4">
    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800">Manajemen Laporan</h1>
        <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">Cari barang yang hilang atau ditemukan di bawah ini.</p>

        <form action="{{ route('admin.reports.index') }}" method="GET" class="mt-8 max-w-2xl mx-auto">
            <div class="relative flex items-center">
                <input type="text" name="search" placeholder="Cari nama barang, deskripsi, atau lokasi..."
                       class="block w-full rounded-full border-gray-300 shadow-sm py-3 pl-6 pr-32 text-base focus:border-red-500 focus:ring-red-500"
                       value="{{ request('search') }}">
                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 inline-flex items-center rounded-full bg-red-800 px-6 py-2 text-sm font-semibold text-white hover:bg-red-700">
                    Cari
                </button>
            </div>
        </form>
    </div>

    {{-- Tabel Barang Ditemukan --}}
    <div class="bg-white rounded-lg shadow-md p-8 mb-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Barang Ditemukan</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-red-800 text-white uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">Nama Barang</th>
                        <th class="py-3 px-6 text-left">Deskripsi</th>
                        <th class="py-3 px-6 text-center">Lokasi Penemuan</th>
                        <th class="py-3 px-6 text-center">Tanggal Penemuan</th>
                        <th class="py-3 px-6 text-center">Status</th>
                        @auth
                            @if(auth()->user()->isAdmin())
                                <th class="py-3 px-6 text-center">Aksi</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($foundItems as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $item->nama_barang }}</td>
                            <td class="py-3 px-6 text-left">{{ Str::limit($item->deskripsi, 40) }}</td>
                            <td class="py-3 px-6 text-center">{{ $item->lokasi_penemuan }}</td>
                            <td class="py-3 px-6 text-center">{{ \Carbon\Carbon::parse($item->tanggal_penemuan)->format('d M Y') }}</td>
                            <td class="py-3 px-6 text-center">
                                @if($item->status == 'Belum Diambil')
                                    <span class="bg-yellow-200 text-yellow-700 py-1 px-3 rounded-full text-xs font-semibold">{{ $item->status }}</span>
                                @else
                                    <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs font-semibold">{{ $item->status }}</span>
                                @endif
                            </td>
                            @auth
                                @if(auth()->user()->isAdmin())
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">

                                            {{-- UBAH $item->id MENJADI $item --}}
                                            <a href="{{ route('admin.reports.found.show', $item) }}" class="w-5 mr-2 transform hover:text-blue-500 hover:scale-110" title="Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </a>

                                            {{-- UBAH $item->id MENJADI $item --}}
                                            <a href="{{ route('admin.reports.found.edit', $item) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L16.732 3.732z" /></svg>
                                            </a>

                                            {{-- UBAH $item->id MENJADI $item --}}
                                            <form action="{{ route('admin.reports.found.destroy', $item) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="delete-button w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            @endauth
                        </tr>
                    @empty
                        <td colspan="{{ auth()->check() && auth()->user()->isAdmin() ? '6' : '5' }}" class="text-center py-4">Belum ada barang temuan yang dilaporkan.</td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $foundItems->appends(request()->query())->links('vendor.pagination.tailwind-white') }}</div>
    </div>

    {{-- Tabel Barang Hilang --}}
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
                            @if(auth()->user()->isAdmin())
                                <th class="py-3 px-6 text-center">Aksi</th>
                            @endif
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
                                    <span class="bg-red-200 text-red-700 py-1 px-3 rounded-full text-xs font-semibold">{{ $item->status }}</span>
                                @else
                                    <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs font-semibold">{{ $item->status }}</span>
                                @endif
                            </td>
                            @auth
                                @if(auth()->user()->isAdmin())
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">

                                            {{-- UBAH $item->id MENJADI $item --}}
                                            <a href="{{ route('admin.reports.lost.show', $item) }}" class="w-5 mr-2 transform hover:text-blue-500 hover:scale-110" title="Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </a>

                                            {{-- UBAH $item->id MENJADI $item --}}
                                            <a href="{{ route('admin.reports.lost.edit', $item) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L16.732 3.732z" /></svg>
                                            </a>

                                            {{-- UBAH $item->id MENJADI $item --}}
                                            <form action="{{ route('admin.reports.lost.destroy', $item) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="delete-button w-4 mr-2 transform hover:text-red-500 hover:scale-110 cursor-pointer" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            @endauth
                        </tr>
                    @empty
                        <td colspan="{{ auth()->check() && auth()->user()->isAdmin() ? '6' : '5' }}" class="text-center py-4">Belum ada barang hilang yang dilaporkan.</td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $lostItems->appends(request()->query())->links('vendor.pagination.tailwind-white') }}</div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Script SweetAlert biarkan saja, ini sudah benar --}}
<script>
    // Pastikan script hanya berjalan jika ada tombol hapus (jika admin login)
    const deleteButtons = document.querySelectorAll('.delete-button');

    if (deleteButtons.length > 0) {
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();

                const form = this.closest('form');

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
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    }
</script>
@endpush
