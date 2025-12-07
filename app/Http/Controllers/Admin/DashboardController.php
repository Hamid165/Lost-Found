<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoundItem;
use App\Models\LostItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        // 1. Data untuk Kartu Statistik Utama (Tetap All-Time)
        $totalUsers = User::count();
        $totalLostItems = LostItem::count();
        $totalFoundItems = FoundItem::count();

        // 2. Data untuk Kartu Statistik Status (Tetap All-Time)
        $foundItemsNotTaken = FoundItem::where('status', 'Belum Diambil')->count();
        $foundItemsTaken = FoundItem::where('status', 'Sudah Diambil')->count();
        $foundItemsSecured = FoundItem::where('status', 'Diamankan')->count();
        $lostItemsMissing = LostItem::where('status', 'Masih Hilang')->count();
        $lostItemsReturned = LostItem::where('status', 'Sudah Dikembalikan')->count();

        // =======================================================
        // 3. LOGIKA BARU UNTUK GRAFIK (Filter Bulan/Tahun)
        // =======================================================

        // PERBAIKAN 1: Gunakan helper $request->integer()
        // Ini solusi paling aman untuk PHPStan Level 9 daripada casting (int) manual pada mixed input
        $selectedMonth = $request->integer('month', (int) now()->month);
        $selectedYear = $request->integer('year', (int) now()->year);

        // Buat objek Carbon.
        $date = Carbon::createFromDate($selectedYear, $selectedMonth, 1);

        // PERBAIKAN 2: Menghapus pengecekan 'if (!$date)'
        // PHPStan mengetahui bahwa createFromDate selalu mengembalikan objek Carbon (tidak pernah null/false),
        // sehingga pengecekan if (!$date) dianggap "dead code" atau logic yang tidak mungkin terjadi.

        $daysInMonth = $date->daysInMonth;

        // Ambil data harian untuk bulan/tahun yang dipilih
        $lostItemsData = LostItem::select(
            DB::raw('DAY(created_at) as day'),
            DB::raw('count(*) as count')
        )
            ->whereYear('created_at', $selectedYear)
            ->whereMonth('created_at', $selectedMonth)
            ->groupBy('day')
            ->pluck('count', 'day');

        $foundItemsData = FoundItem::select(
            DB::raw('DAY(created_at) as day'),
            DB::raw('count(*) as count')
        )
            ->whereYear('created_at', $selectedYear)
            ->whereMonth('created_at', $selectedMonth)
            ->groupBy('day')
            ->pluck('count', 'day');

        // Menyiapkan label (Tanggal 1, 2, ... 31) dan data
        $dateLabels = [];
        $lostCounts = [];
        $foundCounts = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dateLabels[] = $day;
            // Akses array dengan aman menggunakan Null Coalescing Operator
            $lostCounts[] = $lostItemsData[$day] ?? 0;
            $foundCounts[] = $foundItemsData[$day] ?? 0;
        }

        // 4. Data Chart.js
        $chartData = [
            'labels' => $dateLabels,
            'lost' => $lostCounts,
            'found' => $foundCounts,
        ];

        // 5. Mengirim semua data ke view
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalLostItems',
            'totalFoundItems',
            'chartData',
            'foundItemsNotTaken',
            'foundItemsTaken',
            'foundItemsSecured',
            'lostItemsMissing',
            'lostItemsReturned',
            'selectedMonth',
            'selectedYear'
        ));
    }
}
