<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoundItem;
use App\Models\LostItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data untuk Kartu Statistik Utama
        $totalUsers = User::count();
        $totalLostItems = LostItem::count();
        $totalFoundItems = FoundItem::count();

        // PENAMBAHAN: Data untuk Kartu Statistik Status
        $foundItemsNotTaken = FoundItem::where('status', 'Belum Diambil')->count();
        $foundItemsTaken = FoundItem::where('status', 'Sudah Diambil')->count();
        $foundItemsSecured = FoundItem::where('status', 'Diamankan')->count();
        $lostItemsMissing = LostItem::where('status', 'Masih Hilang')->count();
        $lostItemsReturned = LostItem::where('status', 'Sudah Dikembalikan')->count();

        // 2. Data untuk Grafik Garis (Laporan 7 hari terakhir)
        $lostItemsData = LostItem::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('count', 'date');

        $foundItemsData = FoundItem::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('count', 'date');

        // 3. Menyiapkan label dan data untuk Chart.js
        $dates = [];
        for ($i = 6; $i >= 0; $i--) {
            $dates[Carbon::now()->subDays($i)->toDateString()] = Carbon::now()->subDays($i)->format('d M');
        }

        $lostCounts = [];
        $foundCounts = [];
        foreach ($dates as $dateString => $formattedDate) {
            $lostCounts[] = $lostItemsData[$dateString] ?? 0;
            $foundCounts[] = $foundItemsData[$dateString] ?? 0;
        }

        $chartData = [
            'labels' => array_values($dates),
            'lost' => $lostCounts,
            'found' => $foundCounts,
        ];

        // 4. Mengirim semua data ke view
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalLostItems',
            'totalFoundItems',
            'chartData',
            'foundItemsNotTaken',
            'foundItemsTaken',
            'foundItemsSecured',
            'lostItemsMissing',
            'lostItemsReturned'
        ));
    }
}