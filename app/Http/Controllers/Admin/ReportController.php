<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoundItem;
use App\Models\LostItem;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $lostItemsQuery = LostItem::query();
        $foundItemsQuery = FoundItem::query();

        if ($search) {
            $lostItemsQuery->where(function ($query) use ($search) {
                $query->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('lokasi_terakhir', 'like', "%{$search}%")
                    ->orWhere('nama_pelapor', 'like', "%{$search}%");
            });

            $foundItemsQuery->where(function ($query) use ($search) {
                $query->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('lokasi_penemuan', 'like', "%{$search}%")
                    ->orWhere('nama_pelapor', 'like', "%{$search}%");
            });
        }

        $lostItems = $lostItemsQuery->latest()->paginate(10, ['*'], 'lost_page');
        $foundItems = $foundItemsQuery->latest()->paginate(10, ['*'], 'found_page');

        $lostItems->appends(['search' => $search]);
        $foundItems->appends(['search' => $search]);

        return view('admin.reports.index', compact('lostItems', 'foundItems'));
    }

    // ===================================================
    // Method untuk Barang Hilang (Lost Items)
    // ===================================================
    public function editLostItem(LostItem $lostItem)
    {
        return view('admin.reports.edit', [
            'item' => $lostItem,
            // PERHATIKAN: Tidak ada ->id di sini. Cukup $lostItem.
            'updateRoute' => route('admin.reports.lost.update', $lostItem),
            'statusOptions' => ['Masih Hilang', 'Sudah Dikembalikan'],
            'locationField' => 'lokasi_terakhir',
            'dateField' => 'tanggal_kehilangan',
            'pageTitle' => 'Edit Barang Hilang'
        ]);
    }

    public function updateLostItem(Request $request, LostItem $lostItem)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|string',
            'lokasi_terakhir' => 'required|string|max:255',
            'tanggal_kehilangan' => 'required|date',
            'nama_pelapor' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'status_pelapor' => 'required|string|in:Mahasiswa,Dosen,Lainnya',
            'NIM_NIP' => 'nullable|string|max:100',
        ]);
        $lostItem->update($request->all());
        return redirect()->route('admin.reports.index')->with('success', 'Laporan barang hilang berhasil diperbarui.');
    }

    // Di dalam file: app/Http/Controllers/Admin/ReportController.php

    // ===================================================
    // Method untuk Barang Ditemukan (Found Items)
    // ===================================================

    // GANTI NAMA VARIABEL '$item' MENJADI '$foundItem'
    public function editFoundItem(FoundItem $foundItem)
    {
        return view('admin.reports.edit', [
            'item' => $foundItem, // Gunakan $foundItem

            // Pastikan parameter kedua adalah $foundItem (tanpa ->id)
            'updateRoute' => route('admin.reports.found.update', $foundItem),

            'statusOptions' => ['Belum Diambil', 'Sudah Diambil', 'Diamankan'],
            'locationField' => 'lokasi_penemuan',
            'dateField' => 'tanggal_penemuan',
            'pageTitle' => 'Edit Barang Ditemukan'
        ]);
    }

    // GANTI NAMA VARIABEL '$item' MENJADI '$foundItem'
    public function updateFoundItem(Request $request, FoundItem $foundItem)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|string',
            'lokasi_penemuan' => 'required|string|max:255',
            'tanggal_penemuan' => 'required|date',
            'nama_pelapor' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'status_pelapor' => 'required|string|in:Mahasiswa,Dosen,Lainnya',
            'NIM_NIP' => 'nullable|string|max:100',
        ]);

        $foundItem->update($request->all()); // Gunakan $foundItem

        return redirect()->route('admin.reports.index')->with('success', 'Laporan barang ditemukan berhasil diperbarui.');
    }

    // ===================================================
    // Method untuk Menghapus Laporan
    // ===================================================
    public function destroyLostItem(LostItem $lostItem)
    {
        $lostItem->delete();
        return redirect()->route('admin.reports.index')->with('success', 'Laporan barang hilang berhasil dihapus.');
    }

    public function destroyFoundItem(FoundItem $foundItem)
    {
        $foundItem->delete();
        return redirect()->route('admin.reports.index')->with('success', 'Laporan barang ditemukan berhasil dihapus.');
    }

    public function showLostItem(LostItem $lostItem) 
    {
        return view('admin.reports.show', [
            'item' => $lostItem,
            'type' => 'lost'
        ]);
    }

    public function showFoundItem(FoundItem $foundItem)
    {
        return view('admin.reports.show', [
            'item' => $foundItem,
            'type' => 'found'
        ]);
    }
}
