<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use Illuminate\Http\Request;

class FoundItemController extends Controller
{
    /**
     * Menampilkan form untuk membuat laporan baru.
     */
    public function create()
    {
        return view('found-items.create');
    }

    /**
     * Menyimpan laporan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi_penemuan' => 'required|string|max:255',
            'tanggal_penemuan' => 'required|date',
        ]);

        FoundItem::create($request->all());

        return redirect()->route('items.index')->with('success', 'Laporan barang ditemukan berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit laporan.
     */
    public function edit(FoundItem $foundItem)
    {
        return view('found-items.edit', compact('foundItem'));
    }

    /**
     * Memperbarui laporan di database.
     */
    public function update(Request $request, FoundItem $foundItem)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi_penemuan' => 'required|string|max:255',
            'tanggal_penemuan' => 'required|date',
        ]);

        $foundItem->update($request->all());

        return redirect()->route('items.index')->with('success', 'Laporan barang ditemukan berhasil diperbarui.');
    }

    /**
     * Menghapus laporan dari database. (Hanya untuk Admin)
     */
    public function destroy(FoundItem $foundItem)
    {
        // TODO: Tambahkan otorisasi untuk Admin saja nanti
        $foundItem->delete();

        return redirect()->route('items.index')->with('success', 'Laporan barang ditemukan berhasil dihapus.');
    }
}
