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

/**
 * Class DashboardController
 *
 * Controller khusus untuk Admin Dashboard.
 * Bertanggung jawab untuk mengambil data statistik, menghitung jumlah laporan,
 * dan menyiapkan data untuk grafik (charts).
 */
class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin beserta statistik dan grafik.
     *
     * @param  \Illuminate\Http\Request  $request
     * Object request untuk menangkap filter bulan/tahun (opsional).
     *
     * @return \Illuminate\View\View
     * Mengembalikan view 'admin.dashboard' dengan data lengkap.
     */
    public function index(Request $request): View
    {
        // 1. Ambil Input Filter Bulan & Tahun (Pindahkan ke atas agar bisa dipakai untuk semua query)
        $selectedMonth = $request->integer('month', (int) now()->month);
        $selectedYear = $request->integer('year', (int) now()->year);

        // 2. Ambil Statistik Umum (Total Keseluruhan)
        // Menghitung jumlah record di masing-masing tabel tanpa filter waktu (Dashboard Global Info).
        $totalUsers = User::count();
        $totalLostItems = LostItem::count();
        $totalFoundItems = FoundItem::count();

        // 3. Ambil Statistik Berdasarkan Status (DIFILTER BERDASARKAN BULAN & TAHUN)
        // User mengharapkan kotak-kotak status ini berubah sesuai filter yang dipilih.
        $foundItemsNotTaken = FoundItem::where('status', 'Belum Diambil')
            ->whereMonth('created_at', $selectedMonth)
            ->whereYear('created_at', $selectedYear)
            ->count();

        $foundItemsTaken = FoundItem::where('status', 'Sudah Diambil')
            ->whereMonth('created_at', $selectedMonth)
            ->whereYear('created_at', $selectedYear)
            ->count();

        $foundItemsSecured = FoundItem::where('status', 'Sudah Diamankan')
            ->whereMonth('created_at', $selectedMonth)
            ->whereYear('created_at', $selectedYear)
            ->count();

        $lostItemsMissing = LostItem::where('status', 'Masih Hilang')
            ->whereMonth('created_at', $selectedMonth)
            ->whereYear('created_at', $selectedYear)
            ->count();

        $lostItemsReturned = LostItem::where('status', 'Sudah Dikembalikan')
            ->whereMonth('created_at', $selectedMonth)
            ->whereYear('created_at', $selectedYear)
            ->count();

        // 4. Persiapan Data Grafik (Laporan Harian per Bulan)
        // Membuat objek Carbon untuk tanggal awal bulan yang dipilih
        $date = Carbon::createFromDate($selectedYear, $selectedMonth, 1);
        $daysInMonth = $date->daysInMonth;

        // Query Agregasi: Menghitung jumlah laporan per hari (group by day)
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

        // Normalisasi Data Grafik
        // Chart.js membutuhkan array data yang urut dari tanggal 1 sampai akhir bulan.
        // Kita loop dari hari 1 sampai $daysInMonth. Jika tidak ada data di hari itu, kita isi 0.
        $dateLabels = [];
        $lostCounts = [];
        $foundCounts = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dateLabels[] = $day; // Label sumbu X (Tanggal)
            
            // Ambil jumlah dari hasil query, jika tidak ada (null), pakai 0.
            $lostCounts[] = $lostItemsData[$day] ?? 0;
            $foundCounts[] = $foundItemsData[$day] ?? 0;
        }

        // Susun data untuk dikirim ke view (akan dikonsumsi oleh JavaScript Chart.js)
        $chartData = [
            'labels' => $dateLabels,
            'lost' => $lostCounts,
            'found' => $foundCounts,
        ];

        // 4. Return View dengan Compact
        // Mengirimkan semua variabel yang sudah didefinisikan ke view.
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
