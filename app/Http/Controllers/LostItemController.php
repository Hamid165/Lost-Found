<?php

namespace App\Http\Controllers;

use App\Models\LostItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LostItemController extends Controller
{
    /**
     * Form create laporan.
     */
    public function create()
    {
        return view('lost-items.create');
    }

    /**
     * Simpan laporan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang'       => 'required|string|max:255|regex:/^[^<>]*$/',
            'deskripsi'         => 'required|string',
            'lokasi_terakhir'   => 'required|string|max:255|regex:/^[^<>]*$/',
            'tanggal_kehilangan' => 'required|date',
            'nama_pelapor'      => 'required|string|max:255',
            'no_telp'           => 'nullable|string|max:20',
            'status_pelapor'    => 'required|string|in:Mahasiswa,Dosen,Lainnya',
            'NIM_NIP'           => 'nullable|string|max:100',
        ], [
            'nama_barang.regex'     => 'Nama barang tidak boleh mengandung karakter HTML (< atau >).',
            'lokasi_terakhir.regex' => 'Lokasi tidak boleh mengandung karakter HTML (< atau >).',
        ]);

        LostItem::create($validated);

        // Redirect sesuai role
        // Use a safe check for admin: either a 'role' field set to 'admin' or an 'is_admin' attribute/column.
        if (Auth::check() && (Auth::user()->role === 'admin' || (Auth::user()->is_admin ?? false))) {
            return redirect()
                ->route('admin.reports.index')
                ->with('success', 'Laporan barang hilang berhasil ditambahkan.');
        }

        return redirect()
            ->route('items.index')
            ->with('success', 'Laporan barang hilang berhasil ditambahkan.');
    }

    /**
     * Form edit laporan.
     */
    public function edit(LostItem $lostItem)
    {
        return view('lost-items.edit', compact('lostItem'));
    }

    /**
     * Update laporan.
     */
    public function update(Request $request, LostItem $lostItem)
    {
        $validated = $request->validate([
            'nama_barang'       => 'required|string|max:255|regex:/^[^<>]*$/',
            'deskripsi'         => 'required|string',
            'lokasi_terakhir'   => 'required|string|max:255|regex:/^[^<>]*$/',
            'tanggal_kehilangan' => 'required|date',
            'nama_pelapor'      => 'required|string|max:255',
            'no_telp'           => 'nullable|string|max:20',
            'status_pelapor'    => 'required|string|in:Mahasiswa,Dosen,Lainnya',
            'NIM_NIP'           => 'nullable|string|max:100',
        ], [
            'nama_barang.regex'     => 'Nama barang tidak boleh mengandung karakter HTML (< atau >).',
            'lokasi_terakhir.regex' => 'Lokasi tidak boleh mengandung karakter HTML (< atau >).',
        ]);

        $lostItem->update($validated);

        return redirect()
            ->route('items.index')
            ->with('success', 'Laporan barang hilang berhasil diperbarui.');
    }

    /**
     * Hapus laporan.
     */
    public function destroy(LostItem $lostItem)
    {
        // (Nanti bisa tambahkan authorization Admin-only)
        $lostItem->delete();

        return redirect()
            ->route('items.index')
            ->with('success', 'Laporan barang hilang berhasil dihapus.');
    }
}
