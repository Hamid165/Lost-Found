<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Tambahkan ini

class FoundItemController extends Controller
{
    // ... (method create, edit, update, destroy tidak perlu diubah)

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

        // =================================================================
        // PERUBAHAN DI SINI: Redirect berdasarkan role pengguna
        // =================================================================
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.reports.index')->with('success', 'Laporan barang ditemukan berhasil ditambahkan.');
        }

        return redirect()->route('items.index')->with('success', 'Laporan barang ditemukan berhasil ditambahkan.');
    }

    public function edit(FoundItem $foundItem)
    {
        return view('found-items.edit', compact('foundItem'));
    }

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

    public function destroy(FoundItem $foundItem)
    {
        // TODO: Tambahkan otorisasi untuk Admin saja nanti
        $foundItem->delete();

        return redirect()->route('items.index')->with('success', 'Laporan barang ditemukan berhasil dihapus.');
    }
}
