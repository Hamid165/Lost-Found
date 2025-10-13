@extends('layouts.app')

@section('title', 'Lapor Barang Ditemukan')

@section('content')
<div class="bg-gray-50 py-16 sm:py-24">
    <div class="mx-auto max-w-4xl px-6 lg:px-8">
        {{-- Header Form --}}
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Form Laporan Penemuan</h1>
            <p class="mt-4 text-lg leading-8 text-gray-600">
                Terima kasih telah membantu. Mohon isi detail barang yang Anda temukan di bawah ini.
            </p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white p-8 sm:p-12 rounded-xl shadow-lg">
            <form action="{{ route('found-items.store') }}" method="POST">
                @csrf
                <div class="space-y-8">
                    {{-- Nama Barang --}}
                    <div>
                        <label for="nama_barang" class="block text-sm font-semibold leading-6 text-gray-900">Nama Barang</label>
                        <div class="mt-2.5">
                            <input type="text" name="nama_barang" id="nama_barang" required placeholder="Contoh: Kunci Motor Honda"
                                   class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    {{-- Lokasi Penemuan & Tanggal Penemuan (Satu Baris) --}}
                    <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">
                        <div>
                            <label for="lokasi_penemuan" class="block text-sm font-semibold leading-6 text-gray-900">Lokasi Penemuan</label>
                            <div class="mt-2.5">
                                <input type="text" name="lokasi_penemuan" id="lokasi_penemuan" required placeholder="Contoh: Area Parkir Gedung B"
                                       class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div>
                            <label for="tanggal_penemuan" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal Penemuan</label>
                            <div class="mt-2.5">
                                <input type="date" name="tanggal_penemuan" id="tanggal_penemuan" required
                                       class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label for="deskripsi" class="block text-sm font-semibold leading-6 text-gray-900">Deskripsi Barang</label>
                        <div class="mt-2.5">
                            <textarea name="deskripsi" id="deskripsi" rows="4" required placeholder="Jelaskan ciri-ciri spesifik barang yang ditemukan."
                                      class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="mt-10 flex justify-end items-center gap-x-6 border-t border-gray-900/10 pt-6">
                    <a href="{{ url()->previous() }}" class="text-sm font-semibold leading-6 text-gray-900">Batal</a>
                    <button type="submit"
                            class="rounded-md bg-gray-800 px-6 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                        Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
