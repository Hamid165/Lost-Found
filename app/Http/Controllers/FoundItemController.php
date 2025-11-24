<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use App\Models\User; // Import Model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View; // Import View
use Illuminate\Http\RedirectResponse; // Import RedirectResponse

class FoundItemController extends Controller
{
    public function create(): View
    {
        return view('found-items.create');
    }

    /**
     * Menyimpan laporan baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi_penemuan' => 'required|string|max:255',
            'tanggal_penemuan' => 'required|date',
            'nama_pelapor' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'status_pelapor' => 'required|string|in:Mahasiswa,Dosen,Lainnya',
            'NIM_NIP' => 'nullable|string|max:100',
        ]);

        FoundItem::create($request->all());

        // =================================================================
        // PERBAIKAN PHPSTAN: Cek User Type Safety
        // =================================================================
        $user = Auth::user();

        // Pastikan user ada DAN user adalah instance dari Model User kita (supaya method isAdmin dikenali)
        if ($user instanceof User && $user->isAdmin()) {
            return redirect()->route('admin.reports.index')->with('success', 'Laporan barang ditemukan berhasil ditambahkan.');
        }

        return redirect()->route('items.index')->with('success', 'Laporan barang ditemukan berhasil ditambahkan.');
    }

    public function edit(FoundItem $foundItem): View
    {
        return view('found-items.edit', compact('foundItem'));
    }

    public function update(Request $request, FoundItem $foundItem): RedirectResponse
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi_penemuan' => 'required|string|max:255',
            'tanggal_penemuan' => 'required|date',
            'nama_pelapor' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'status_pelapor' => 'required|string|in:Mahasiswa,Dosen,Lainnya',
            'NIM_NIP' => 'nullable|string|max:100',
        ]);

        $foundItem->update($request->all());

        return redirect()->route('items.index')->with('success', 'Laporan barang ditemukan berhasil diperbarui.');
    }

    public function destroy(FoundItem $foundItem): RedirectResponse
    {
        // TODO: Tambahkan otorisasi untuk Admin saja nanti
        $foundItem->delete();

        return redirect()->route('items.index')->with('success', 'Laporan barang ditemukan berhasil dihapus.');
    }
}