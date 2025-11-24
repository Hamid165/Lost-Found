<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use App\Models\LostItem;
use Illuminate\Http\Request;
use Illuminate\View\View; // Import View

class ItemController extends Controller
{
    public function index(Request $request): View
    {
        // PERBAIKAN PHPSTAN LEVEL 9:
        // Gunakan helper string() -> toString().
        // Jangan gunakan (string) $request->input(...) karena input dianggap mixed.
        // Helper ini menjamin outputnya adalah string murni.
        $search = $request->string('search')->toString();

        $foundItemsQuery = FoundItem::query();
        $lostItemsQuery = LostItem::query();

        if ($search !== '') { // Cek string kosong lebih eksplisit daripada if($search)
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
     */
    public function showLost(LostItem $lostItem): View
    {
        return view('items.show', [
            'item' => $lostItem,
            'type' => 'lost',
        ]);
    }

    /**
     * Menampilkan detail satu barang ditemukan.
     */
    public function showFound(FoundItem $foundItem): View
    {
        return view('items.show', [
            'item' => $foundItem,
            'type' => 'found',
        ]);
    }
}