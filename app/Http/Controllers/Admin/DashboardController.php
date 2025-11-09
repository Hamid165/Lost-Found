<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoundItem;
use App\Models\LostItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request; // <-- 1. WAJIB TAMBAHKAN 'Request'
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // 2. TAMBAHKAN 'Request $request' DI SINI
    public function index(Request $request) 
    {
        // 1. Data untuk Kartu Statistik Utama (Tetap All-Time)
        $totalUsers = User::count();
        $totalLostItems = LostItem::count();
        $totalFoundItems = FoundItem::count();

        // 2. Data untuk Kartu Statistik Status (Tetap All-Time)
        $foundItemsNotTaken = FoundItem::where('status', 'Belum Diambil')->count();
        $foundItemsTaken = FoundItem::where('status', 'Sudah Diambil')->count();
        $foundItemsSecured = FoundItem::where('status', 'Sudah Diamankan')->count();
        $lostItemsMissing = LostItem::where('status', 'Masih Hilang')->count();
        $lostItemsReturned = LostItem::where('status', 'Sudah Dikembalikan')->count();

        
        // =======================================================
        // 3. LOGIKA BARU UNTUK GRAFIK (Filter Bulan/Tahun)
        // =======================================================

        // Ambil bulan & tahun dari request, atau set default ke bulan & tahun saat ini
        $selectedMonth = $request->input('month', now()->month);
        $selectedYear = $request->input('year', now()->year);

        // Buat objek Carbon untuk bulan/tahun yang dipilih
        $date = Carbon::create($selectedYear, $selectedMonth, 1);
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
            $dateLabels[] = $day; // Label adalah tanggalnya
            $lostCounts[] = $lostItemsData[$day] ?? 0;
            $foundCounts[] = $foundItemsData[$day] ?? 0;
        }

        // 4. Data Chart.js (Struktur sama seperti kode lama Anda)
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
            'chartData', // <-- Ini sekarang data bulanan
            'foundItemsNotTaken',
            'foundItemsTaken',
            'foundItemsSecured',
            'lostItemsMissing',
            'lostItemsReturned',
            'selectedMonth', // <-- Variabel baru untuk filter
            'selectedYear'  // <-- Variabel baru untuk filter
        ));
    }
}