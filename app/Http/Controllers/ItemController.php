<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use App\Models\LostItem;
use Illuminate\Http\Request;
use Illuminate\View\View; // Import View

/**
 * Class ItemController
 *
 * Controller ini menangani tampilan publik untuk data barang.
 * Berfungsi untuk menampilkan daftar barang (index) dan detail barang (show),
 * baik itu barang hilang (LostItem) maupun barang ditemukan (FoundItem).
 */
class ItemController extends Controller
{
    /**
     * Menampilkan daftar semua barang (Hilang & Ditemukan) dengan fitur pencarian dan paginasi.
     *
     * @param  \Illuminate\Http\Request  $request
     * Object request untuk mengambil parameter pencarian ('search').
     *
     * @return \Illuminate\View\View
     * Mengembalikan view 'items.index' dengan data 'foundItems' dan 'lostItems'.
     */
    public function index(Request $request): View
    {
        // 1. Ambil Query Pencarian
        // Menggunakan helper string() -> toString() untuk memastikan tipe data string murni (aman untuk PHPStan Level 9).
        // Menghindari masalah jika input null atau array.
        $search = $request->string('search')->toString();

        // 2. Inisialisasi Query Builder
        // Kita mulai dengan query kosong agar bisa menambah kondisi dinamis.
        $foundItemsQuery = FoundItem::query();
        $lostItemsQuery = LostItem::query();

        // 3. Terapkan Filter Pencarian (Jika ada input)
        if ($search !== '') {
            // Filter untuk Barang Ditemukan
            // Mencari kecocokan di kolom nama, deskripsi, atau lokasi.
            $foundItemsQuery->where(function ($query) use ($search) {
                $query->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('lokasi_penemuan', 'like', "%{$search}%");
            });

            // Filter untuk Barang Hilang
            // Logika yang sama diterapkan untuk tabel lost_items.
            $lostItemsQuery->where(function ($query) use ($search) {
                $query->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('lokasi_terakhir', 'like', "%{$search}%");
            });
        }

        // 4. Eksekusi Query dengan Paginasi
        // latest(): Urutkan dari yang terbaru (created_at desc).
        // paginate(5): Batasi 5 item per halaman.
        // ['*'], 'found_page' / 'lost_page': Memberi nama unik parameter page agar paginasi kedua tabel tidak bentrok di satu halaman.
        $foundItems = $foundItemsQuery->latest()->paginate(5, ['*'], 'found_page');
        $lostItems = $lostItemsQuery->latest()->paginate(5, ['*'], 'lost_page');

        // 5. Appends Search Query
        // Agar saat pindah halaman, parameter pencarian tetap terbawa di URL.
        $foundItems->appends(['search' => $search]);
        $lostItems->appends(['search' => $search]);

        // 6. Return View
        return view('items.index', compact('foundItems', 'lostItems'));
    }

    /**
     * Menampilkan halaman detail untuk satu barang hilang secara spesifik.
     *
     * @param  \App\Models\LostItem  $lostItem
     * Model Binding akan otomatis mencari item berdasarkan ID/UUID di URL.
     *
     * @return \Illuminate\View\View
     * Mengembalikan view 'items.show' dengan tipe 'lost'.
     */
    public function showLost(LostItem $lostItem): View
    {
        return view('items.show', [
            'item' => $lostItem,
            'type' => 'lost', // Penanda untuk view bahwa ini barang hilang
        ]);
    }

    /**
     * Menampilkan halaman detail untuk satu barang ditemukan secara spesifik.
     *
     * @param  \App\Models\FoundItem  $foundItem
     * Model Binding otomatis mencari item.
     *
     * @return \Illuminate\View\View
     * Mengembalikan view 'items.show' dengan tipe 'found'.
     */
    public function showFound(FoundItem $foundItem): View
    {
        return view('items.show', [
            'item' => $foundItem,
            'type' => 'found', // Penanda untuk view bahwa ini barang ditemukan
        ]);
    }
}