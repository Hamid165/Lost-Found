<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use App\Models\LostItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function index(): View
    {
        $foundItems = FoundItem::latest()->paginate(10, ['*'], 'found_page');
        $lostItems = LostItem::latest()->paginate(10, ['*'], 'lost_page');

        return view('items.index', [
            'foundItems' => $foundItems,
            'lostItems' => $lostItems,
        ]);
    }
}
