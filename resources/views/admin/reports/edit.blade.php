@section('title', $pageTitle)

<x-app-layout>
    {{-- Slot header dikosongkan --}}
    <x-slot name="header">
    </x-slot>

    {{-- Div pembungkus utama dengan padding-top untuk memberi ruang bagi navbar --}}
    <div class="pt-20">
        <div class="pb-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 md:p-8 text-white">
                        
                        {{-- ======================================================= --}}
                        {{-- PERUBAHAN DI SINI: Judul dipindahkan ke dalam form box --}}
                        {{-- ======================================================= --}}
                        <div class="text-center mb-6">
                            <h2 class="font-semibold text-2xl text-white leading-tight">
                                {{ $pageTitle }}
                            </h2>
                        </div>
                        
                        <form action="{{ $updateRoute }}" method="POST">
                            @csrf
                            @method('PATCH')

                            {{-- Baris 1: Nama Barang dan Status --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama_barang" class="block font-medium text-sm text-gray-200">Nama Barang</label>
                                    <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang', $item->nama_barang) }}" class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-red-500 focus:border-red-500" required>
                                </div>
                                <div>
                                    <label for="status" class="block font-medium text-sm text-gray-200">Status Laporan</label>
                                    <select name="status" id="status" class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-red-500 focus:border-red-500" required>
                                        @foreach($statusOptions as $option)
                                            <option value="{{ $option }}" @if($item->status == $option) selected @endif>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Baris 2: Lokasi dan Tanggal --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                <div>
                                    <label for="{{ $locationField }}" class="block font-medium text-sm text-gray-200 capitalize">{{ str_replace('_', ' ', $locationField) }}</label>
                                    <input type="text" name="{{ $locationField }}" id="{{ $locationField }}" value="{{ old($locationField, $item->$locationField) }}" class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-red-500 focus:border-red-500" required>
                                </div>
                                <div>
                                    <label for="{{ $dateField }}" class="block font-medium text-sm text-gray-200 capitalize">{{ str_replace('_', ' ', $dateField) }}</label>
                                    <input type="date" name="{{ $dateField }}" id="{{ $dateField }}" value="{{ old($dateField, \Carbon\Carbon::parse($item->$dateField)->format('Y-m-d')) }}" class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-red-500 focus:border-red-500" required>
                                </div>
                            </div>

                            <div class="mt-6">
                                <label for="deskripsi" class="block font-medium text-sm text-gray-200">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm text-gray-900 focus:ring-red-500 focus:border-red-500" required>{{ old('deskripsi', $item->deskripsi) }}</textarea>
                            </div>

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