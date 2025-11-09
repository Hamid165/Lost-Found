<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use App\Models\LostItem;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $foundItemsQuery = FoundItem::query();
        $lostItemsQuery = LostItem::query();

        if ($search) {
            $foundItemsQuery->where(function ($query) use ($search) {
                $query->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('lokasi_penemuan', 'like', "%{$search}%");
            });

            $lostItemsQuery->where(function ($query) use ($search) {
                $query->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('lokasi_terakhir', 'like', "%{$search}%");
            });
        }

        $foundItems = $foundItemsQuery->latest()->paginate(5, ['*'], 'found_page');
        $lostItems = $lostItemsQuery->latest()->paginate(5, ['*'], 'lost_page');

        $foundItems->appends(['search' => $search]);
        $lostItems->appends(['search' => $search]);

        return view('items.index', compact('foundItems', 'lostItems'));
    }

    /**
     * Menampilkan detail satu barang hilang.
     * UBAH (LostItem $item) MENJADI (LostItem $lostItem)
     */
    public function showLost(LostItem $lostItem) // <-- UBAH DI SINI
    {
        return view('items.show', [
            'item' => $lostItem, // <-- UBAH DI SINI
            'type' => 'lost'
        ]);
    }

    /**
     * Menampilkan detail satu barang ditemukan.
     * UBAH (FoundItem $item) MENJADI (FoundItem $foundItem)
     */
    public function showFound(FoundItem $foundItem) // <-- UBAH DI SINI
    {
        return view('items.show', [
            'item' => $foundItem, // <-- UBAH DI SINI
            'type' => 'found'
        ]);
    }
}