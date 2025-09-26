@extends('layouts.app')

@section('content')
<div class="container mx-auto pt-24 px-4">
    {{-- Tabel Barang Ditemukan --}}
    <div class="bg-white rounded-lg shadow-md p-8 mb-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Barang Ditemukan</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">Nama Barang</th>
                        <th class="py-3 px-6 text-left">Deskripsi</th>
                        <th class="py-3 px-6 text-center">Lokasi Penemuan</th>
                        <th class="py-3 px-6 text-center">Tanggal Penemuan</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($foundItems as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $item->nama_barang }}</td>
                            <td class="py-3 px-6 text-left">{{ $item->deskripsi }}</td>
                            <td class="py-3 px-6 text-center">{{ $item->lokasi_penemuan }}</td>
                            <td class="py-3 px-6 text-center">{{ \Carbon\Carbon::parse($item->tanggal_penemuan)->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">Belum ada barang temuan yang dilaporkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $foundItems->links() }}
        </div>
    </div>

    {{-- Tabel Barang Hilang --}}
    <div class="bg-white rounded-lg shadow-md p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Barang Hilang</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">Nama Barang</th>
                        <th class="py-3 px-6 text-left">Deskripsi</th>
                        <th class="py-3 px-6 text-center">Lokasi Terakhir</th>
                        <th class="py-3 px-6 text-center">Tanggal Kehilangan</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse ($lostItems as $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $item->nama_barang }}</td>
                            <td class="py-3 px-6 text-left">{{ $item->deskripsi }}</td>
                            <td class="py-3 px-6 text-center">{{ $item->lokasi_terakhir }}</td>
                            <td class="py-3 px-6 text-center">{{ \Carbon\Carbon::parse($item->tanggal_kehilangan)->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">Belum ada barang hilang yang dilaporkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $lostItems->links() }}
        </div>
    </div>
</div>
@endsection
