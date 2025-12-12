<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoundItem;
use App\Models\LostItem;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class ReportController
 *
 * Controller ini menangani manajemen laporan (Hilang & Ditemukan) untuk Admin.
 * Admin memiliki hak akses penuh (CRUD) terhadap semua laporan.
 */
class ReportController extends Controller
{
    /**
     * Menampilkan daftar semua laporan (Hilang & Ditemukan) dengan fitur pencarian.
     *
     * @param  \Illuminate\Http\Request  $request
     * Parameter pencarian ('search') diambil dari request.
     *
     * @return \Illuminate\View\View
     * Mengembalikan view 'admin.reports.index' dengan data paginasi.
     */
    public function index(Request $request): View
    {
        // 1. Ambil Query Pencarian
        // Menggunakan helper string() -> toString() agar tipe datanya pasti string (aman untuk PHPStan Level 9).
        $search = $request->string('search')->toString();

        // 2. Inisiasi Query
        $lostItemsQuery = LostItem::query();
        $foundItemsQuery = FoundItem::query();

        // 3. Terapkan Filter Pencarian (Jika ada)
        // Mengecek apakah string tidak kosong ($search !== '') lebih aman.
        if ($search !== '') {
            // Filter Laporan Hilang
            $lostItemsQuery->where(function ($query) use ($search) {
                $query->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('lokasi_terakhir', 'like', "%{$search}%")
                    ->orWhere('nama_pelapor', 'like', "%{$search}%");
            });

            // Filter Laporan Ditemukan
            $foundItemsQuery->where(function ($query) use ($search) {
                $query->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('lokasi_penemuan', 'like', "%{$search}%")
                    ->orWhere('nama_pelapor', 'like', "%{$search}%");
            });
        }

        // 4. Eksekusi Query & Paginasi
        // latest(): Urutkan terbaru.
        // paginate(10): Batas 10 per halaman.
        // 'lost_page' & 'found_page': Parameter unik agar paginasi tidak konflik di satu halaman.
        $lostItems = $lostItemsQuery->latest()->paginate(10, ['*'], 'lost_page');
        $foundItems = $foundItemsQuery->latest()->paginate(10, ['*'], 'found_page');

        // 5. Append Search Query
        // Agar parameter pencarian tetap ada saat pindah halaman.
        $lostItems->appends(['search' => $search]);
        $foundItems->appends(['search' => $search]);

        return view('admin.reports.index', compact('lostItems', 'foundItems'));
    }

    // ===================================================
    // Method untuk Barang Hilang (Lost Items)
    // ===================================================

    /**
     * Menampilkan form edit untuk barang hilang.
     *
     * @param  \App\Models\LostItem  $lostItem
     * Item yang akan diedit.
     *
     * @return \Illuminate\View\View
     * Menggunakan view 'admin.reports.edit' yang bersifat reuseable (bisa untuk lost/found).
     * Kita mengirimkan parameter konfigurasi (route, status options, field names) agar view bisa menyesuaikan.
     */
    public function editLostItem(LostItem $lostItem): View
    {
        return view('admin.reports.edit', [
            'item' => $lostItem,
            'updateRoute' => route('admin.reports.lost.update', $lostItem), // Route update spesifik lost item
            'statusOptions' => ['Masih Hilang', 'Sudah Dikembalikan'], // Pilihan status khusus lost item
            'locationField' => 'lokasi_terakhir', // Nama kolom lokasi di database
            'dateField' => 'tanggal_kehilangan', // Nama kolom tanggal di database
            'pageTitle' => 'Edit Barang Hilang', // Judul Halaman
        ]);
    }

    /**
     * Memperbarui data barang hilang oleh Admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LostItem  $lostItem
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateLostItem(Request $request, LostItem $lostItem): RedirectResponse
    {
        // Validasi
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

        // Update
        $lostItem->update($request->all());

        return redirect()->route('admin.reports.index')->with('success', 'Laporan barang hilang berhasil diperbarui.');
    }

    // ===================================================
    // Method untuk Barang Ditemukan (Found Items)
    // ===================================================

    /**
     * Menampilkan form edit untuk barang ditemukan.
     * Mirip dengan editLostItem, tapi konfigurasinya disesuaikan untuk FoundItem.
     */
    public function editFoundItem(FoundItem $foundItem): View
    {
        return view('admin.reports.edit', [
            'item' => $foundItem,
            'updateRoute' => route('admin.reports.found.update', $foundItem),
            'statusOptions' => ['Belum Diambil', 'Sudah Diambil', 'Diamankan'],
            'locationField' => 'lokasi_penemuan',
            'dateField' => 'tanggal_penemuan',
            'pageTitle' => 'Edit Barang Ditemukan',
        ]);
    }

    /**
     * Memperbarui data barang ditemukan oleh Admin.
     */
    public function updateFoundItem(Request $request, FoundItem $foundItem): RedirectResponse
    {
        // Validasi
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

        // Update
        $foundItem->update($request->all());

        return redirect()->route('admin.reports.index')->with('success', 'Laporan barang ditemukan berhasil diperbarui.');
    }

    // ===================================================
    // Method untuk Menghapus Laporan
    // ===================================================

    /**
     * Menghapus laporan barang hilang.
     */
    public function destroyLostItem(LostItem $lostItem): RedirectResponse
    {
        $lostItem->delete();

        return redirect()->route('admin.reports.index')->with('success', 'Laporan barang hilang berhasil dihapus.');
    }

    /**
     * Menghapus laporan barang ditemukan.
     */
    public function destroyFoundItem(FoundItem $foundItem): RedirectResponse
    {
        $foundItem->delete();

        return redirect()->route('admin.reports.index')->with('success', 'Laporan barang ditemukan berhasil dihapus.');
    }

    // ===================================================
    // Method untuk Detail Laporan
    // ===================================================

    /**
     * Menampilkan detail barang hilang (Admin View).
     */
    public function showLostItem(LostItem $lostItem): View
    {
        return view('admin.reports.show', [
            'item' => $lostItem,
            'type' => 'lost', // Flag untuk view
        ]);
    }

    /**
     * Menampilkan detail barang ditemukan (Admin View).
     */
    public function showFoundItem(FoundItem $foundItem): View
    {
        return view('admin.reports.show', [
            'item' => $foundItem,
            'type' => 'found', // Flag untuk view
        ]);
    }
}