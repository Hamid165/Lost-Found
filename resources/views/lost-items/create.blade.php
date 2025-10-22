@extends('layouts.app')

@section('title', 'Lapor Barang Hilang')

@section('content')
<div class="bg-gray-50 py-16 sm:py-24">
    <div class="mx-auto max-w-4xl px-6 lg:px-8">
        {{-- Header Form --}}
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Form Laporan Kehilangan</h1>
            <p class="mt-4 text-lg leading-8 text-gray-600">
                Mohon isi detail barang Anda yang hilang. Informasi yang akurat akan sangat membantu proses pencarian barang anda.
            </p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white p-8 sm:p-12 rounded-xl shadow-lg">
            <form action="{{ route('lost-items.store') }}" method="POST">
                @csrf
                <div class="space-y-8">
                    {{-- Nama Barang --}}
                    <div>
                        <label for="nama_barang" class="block text-sm font-semibold leading-6 text-gray-900">Nama Barang</label>
                        <div class="mt-2.5">
                            <input type="text" name="nama_barang" id="nama_barang" required placeholder="Contoh: Dompet Kulit Warna Coklat"
                                   class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    {{-- Lokasi Terakhir & Tanggal Kehilangan (Satu Baris) --}}
                    <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">
                        <div>
                            <label for="lokasi_terakhir" class="block text-sm font-semibold leading-6 text-gray-900">Lokasi Terakhir</label>
                            <div class="mt-2.5">
                                <input type="text" name="lokasi_terakhir" id="lokasi_terakhir" required placeholder="Contoh: Perpustakaan Lt. 2"
                                       class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div>
                            <label for="tanggal_kehilangan" class="block text-sm font-semibold leading-6 text-gray-900">Tanggal Kehilangan</label>
                            <div class="mt-2.5">
                                <input type="date" name="tanggal_kehilangan" id="tanggal_kehilangan" required
                                       class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                    <hr class="my-6">
                        <p class="text-lg font-semibold mb-4 text-gray-700">Informasi Pelapor</p>

                        <div class="mb-4">
                            <x-input-label for="nama_pelapor" :value="__('Nama Pelapor')" />
                            <x-text-input id="nama_pelapor" class="block mt-1 w-full" type="text" name="nama_pelapor" :value="old('nama_pelapor')" required autofocus />
                            <x-input-error :messages="$errors->get('nama_pelapor')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="status_pelapor" :value="__('Status Pelapor')" />
                            <select name="status_pelapor" id="status_pelapor" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Pilih Status</option>
                                <option value="Mahasiswa" {{ old('status_pelapor') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                <option value="Dosen" {{ old('status_pelapor') == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                                <option value="Lainnya" {{ old('status_pelapor') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <x-input-error :messages="$errors->get('status_pelapor')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="NIM_NIP" :value="__('NIM / NIP (Opsional)')" />
                            <x-text-input id="NIM_NIP" class="block mt-1 w-full" type="text" name="NIM_NIP" :value="old('NIM_NIP')" />
                            <x-input-error :messages="$errors->get('NIM_NIP')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="no_telp" :value="__('No. Telepon (Opsional)')" />
                            <x-text-input id="no_telp" class="block mt-1 w-full" type="tel" name="no_telp" :value="old('no_telp')" />
                            <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
                        </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label for="deskripsi" class="block text-sm font-semibold leading-6 text-gray-900">Deskripsi Barang</label>
                        <div class="mt-2.5">
                            <textarea name="deskripsi" id="deskripsi" rows="4" required placeholder="Jelaskan ciri-ciri spesifik barang Anda, misal: merek, warna, atau tanda khusus lainnya."
                                      class="block w-full rounded-md border-0 py-2 px-3.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="mt-10 flex justify-end items-center gap-x-6 border-t border-gray-900/10 pt-6">
                    <a href="{{ url()->previous() }}" class="text-sm font-semibold leading-6 text-gray-900">Batal</a>
                    <button type="submit"
                            class="rounded-md bg-red-800 px-6 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                        Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
