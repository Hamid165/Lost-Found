<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use App\Models\LostItem;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Menampilkan daftar semua barang (hilang dan ditemukan)
     * dengan fungsionalitas pencarian dan pengurutan berdasarkan tanggal kejadian.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // --- Query untuk Barang Ditemukan ---
        $foundItemsQuery = FoundItem::query();
        if ($search) {
            $foundItemsQuery->where(function($query) use ($search) {
                $query->where('nama_barang', 'like', "%{$search}%")
                      ->orWhere('deskripsi', 'like', "%{$search}%")
                      ->orWhere('lokasi_penemuan', 'like', "%{$search}%");
            });
        }
        // DIUBAH: Mengurutkan berdasarkan tanggal penemuan secara menurun (descending)
        $foundItems = $foundItemsQuery->orderBy('tanggal_penemuan', 'desc')->paginate(10)->appends($request->query());


        // --- Query untuk Barang Hilang ---
        $lostItemsQuery = LostItem::query();
        if ($search) {
            $lostItemsQuery->where(function($query) use ($search) {
                $query->where('nama_barang', 'like', "%{$search}%")
                      ->orWhere('deskripsi', 'like', "%{$search}%")
                      ->orWhere('lokasi_terakhir', 'like', "%{$search}%");
            });
        }
        // DIUBAH: Mengurutkan berdasarkan tanggal kehilangan secara menurun (descending)
        $lostItems = $lostItemsQuery->orderBy('tanggal_kehilangan', 'desc')->paginate(10)->appends($request->query());

        return view('items.index', compact('foundItems', 'lostItems'));
    }
}
