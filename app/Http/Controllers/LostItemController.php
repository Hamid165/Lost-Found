<?php

namespace App\Http\Controllers;

use App\Models\LostItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Tambahkan ini

class LostItemController extends Controller
{
    // ... (method create, edit, update, destroy tidak perlu diubah)

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

        // =================================================================
        // PERUBAHAN DI SINI: Redirect berdasarkan role pengguna
        // =================================================================
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.reports.index')->with('success', 'Laporan barang hilang berhasil ditambahkan.');
        }

        return redirect()->route('items.index')->with('success', 'Laporan barang hilang berhasil ditambahkan.');
    }

    public function edit(LostItem $lostItem)
    {
        return view('lost-items.edit', compact('lostItem'));
    }

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

    public function destroy(LostItem $lostItem)
    {
        // TODO: Tambahkan otorisasi untuk Admin saja nanti
        $lostItem->delete();

        return redirect()->route('items.index')->with('success', 'Laporan barang hilang berhasil dihapus.');
    }
}
