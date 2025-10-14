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

        // Penting: Tambahkan 'appends' agar paginasi mengingat query pencarian
        $foundItems->appends(['search' => $search]);
        $lostItems->appends(['search' => $search]);

        return view('items.index', compact('foundItems', 'lostItems'));
    }
}