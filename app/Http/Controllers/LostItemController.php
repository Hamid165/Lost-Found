<?php

namespace App\Http\Controllers;

use App\Models\LostItem;
use Illuminate\Http\Request;

class LostItemController extends Controller
{
    // Method index() dan show() tidak kita gunakan karena daftar barang sudah ditangani ItemController

    /**
     * Menampilkan form untuk membuat laporan baru.
     */
    public function create()
    {
        return view('lost-items.create');
    }

    /**
     * Menyimpan laporan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi_terakhir' => 'required|string|max:255',
            'tanggal_kehilangan' => 'required|date',
        ]);

        LostItem::create($request->all());

        return redirect()->route('items.index')->with('success', 'Laporan barang hilang berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit laporan.
     */
    public function edit(LostItem $lostItem)
    {
        return view('lost-items.edit', compact('lostItem'));
    }

    /**
     * Memperbarui laporan di database.
     */
    public function update(Request $request, LostItem $lostItem)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi_terakhir' => 'required|string|max:255',
            'tanggal_kehilangan' => 'required|date',
        ]);

        $lostItem->update($request->all());

        return redirect()->route('items.index')->with('success', 'Laporan barang hilang berhasil diperbarui.');
    }

    /**
     * Menghapus laporan dari database. (Hanya untuk Admin)
     */
    public function destroy(LostItem $lostItem)
    {
        // TODO: Tambahkan otorisasi untuk Admin saja nanti
        $lostItem->delete();

        return redirect()->route('items.index')->with('success', 'Laporan barang hilang berhasil dihapus.');
    }
}
