<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoundItem;
use App\Models\LostItem;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $lostItems = LostItem::latest()->paginate(10, ['*'], 'lost_page');
        $foundItems = FoundItem::latest()->paginate(10, ['*'], 'found_page');

        return view('admin.reports.index', compact('lostItems', 'foundItems'));
    }

    // ===================================================
    // Method untuk Barang Hilang (Lost Items)
    // ===================================================
    public function editLostItem(LostItem $item)
    {
        return view('admin.reports.edit', [
            'item' => $item,
            'updateRoute' => route('admin.reports.lost.update', $item->id),
            'statusOptions' => ['Masih Hilang', 'Sudah Dikembalikan'],
            'locationField' => 'lokasi_terakhir',
            'dateField' => 'tanggal_kehilangan',
            'pageTitle' => 'Edit Barang Hilang'
        ]);
    }

    public function updateLostItem(Request $request, LostItem $item)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|string',
            'lokasi_terakhir' => 'required|string|max:255',
            'tanggal_kehilangan' => 'required|date',

            // --- VALIDASI TAMBAHAN ---
            'nama_pelapor' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'status_pelapor' => 'required|string|in:Mahasiswa,Dosen,Lainnya',
            'NIM_NIP' => 'nullable|string|max:100',
            // -------------------------
        ]);
        $item->update($request->all());
        return redirect()->route('admin.reports.index')->with('success', 'Laporan barang hilang berhasil diperbarui.');
    }

    // ===================================================
    // Method untuk Barang Ditemukan (Found Items)
    // ===================================================
    public function editFoundItem(FoundItem $item)
    {
        return view('admin.reports.edit', [
            'item' => $item,
            'updateRoute' => route('admin.reports.found.update', $item->id),
            'statusOptions' => ['Belum Diambil', 'Sudah Diambil', 'Diamankan'],
            'locationField' => 'lokasi_penemuan',
            'dateField' => 'tanggal_penemuan',
            'pageTitle' => 'Edit Barang Ditemukan'
        ]);
    }

    public function updateFoundItem(Request $request, FoundItem $item)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|string',
            'lokasi_penemuan' => 'required|string|max:255',
            'tanggal_penemuan' => 'required|date',

            // --- VALIDASI TAMBAHAN ---
            'nama_pelapor' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'status_pelapor' => 'required|string|in:Mahasiswa,Dosen,Lainnya',
            'NIM_NIP' => 'nullable|string|max:100',
            // -------------------------
        ]);
        $item->update($request->all());
        return redirect()->route('admin.reports.index')->with('success', 'Laporan barang ditemukan berhasil diperbarui.');
    }

    // ===================================================
    // Method untuk Menghapus Laporan
    // ===================================================
    public function destroyLostItem(LostItem $item)
    {
        $item->delete();
        return redirect()->route('admin.reports.index')->with('success', 'Laporan barang hilang berhasil dihapus.');
    }

    public function destroyFoundItem(FoundItem $item)
    {
        $item->delete();
        return redirect()->route('admin.reports.index')->with('success', 'Laporan barang ditemukan berhasil dihapus.');
    }
    public function showLostItem(LostItem $item)
    {
        return view('admin.reports.show', [
            'item' => $item,
            'type' => 'lost'
        ]);
    }

    public function showFoundItem(FoundItem $item)
    {
        return view('admin.reports.show', [
            'item' => $item,
            'type' => 'found'
        ]);
    }
}
