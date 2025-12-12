@php use Carbon\Carbon; @endphp

<title>Dashboard</title>
<x-app-layout>
    {{-- Slot Header Dikosongkan --}}
    <x-slot name="header">
    </x-slot>

    {{-- Wrapper Utama. pt-20: Padding atas 5rem (menghindari navbar fixed). --}}
    <div class="pt-20">
        {{-- Header Dashboard. max-w-7xl: Lebar maks 80rem. mx-auto: Tengah. py-6: Padding vertikal. --}}
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="font-semibold text-5xl text-black leading-tight">
                Dashboard
            </h1>
        </div>

        {{-- Wrapper Konten. pb-12: Padding bawah 3rem. --}}
        <div class="pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                {{-- Grid Grafik Utama --}}
                {{-- items-start: Agar tinggi kolom menyesuaikan konten masing-masing (bisa beda tinggi) --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6 items-start">

                    {{-- Kolom Kiri (Grafik Garis). lg:col-span-2: Mengambil 2/3 lebar di desktop. --}}
                    <div class="lg:col-span-2">
                        {{-- Tambahkan h-full agar kartu mengisi tinggi penuh grid --}}
                        <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                            <div class="p-6">

                                {{-- Header Chart & Filter --}}
                                <div class="flex flex-wrap justify-between items-start mb-4 gap-4">
                                    <h3 class="text-lg font-medium text-white">
                                        Grafik Laporan Harian
                                    </h3>

                                    {{-- Form Filter --}}
                                    <form action="{{ route('admin.dashboard') }}" method="GET">
                                        <div class="flex flex-wrap items-end gap-2">
                                            {{-- Filter Bulan --}}
                                            <div>
                                                <label for="month"
                                                    class="block text-xs font-medium text-gray-200">Bulan:</label>
                                                {{-- Select Input. text-black: Teks hitam agar terbaca di latar putih dropdown. --}}
                                                <select name="month" id="month"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm text-sm py-1 text-black">
                                                    @for ($m = 1; $m <= 12; $m++)
                                                        <option value="{{ $m }}"
                                                            {{ $selectedMonth == $m ? 'selected' : '' }}
                                                            class="text-black">
                                                            {{ Carbon::create(null, $m)->monthName }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                            {{-- Filter Tahun --}}
                                            <div>
                                                <label for="year"
                                                    class="block text-xs font-medium text-gray-200">Tahun:</label>
                                                <select name="year" id="year"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm text-sm py-1 text-black">
                                                    @for ($y = now()->year; $y >= now()->year - 5; $y--)
                                                        <option value="{{ $y }}"
                                                            {{ $selectedYear == $y ? 'selected' : '' }}
                                                            class="text-black">
                                                            {{ $y }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                            {{-- Tombol Filter --}}
                                            <div>
                                                <button type="submit"
                                                    class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-1 text-sm font-medium text-red-800 shadow-sm hover:bg-gray-100">
                                                    Filter
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                {{-- Area Canvas Grafik Garis. relative h-96: Tinggi saya perbesar sedikit agar seimbang --}}
                                <div class="relative bg-white rounded-lg shadow-sm p-4" style="height: 300px;">
                                    <canvas id="reportsChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan (Grafik Donut). --}}
                    {{-- Kolom Kanan (Grafik Donut). --}}
                    <div>
                        {{-- Wrapper Card: UBAH bg-white JADI bg-red-800 (Merah Maroon) --}}
                        <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg h-full">
                            <div class="p-6">
                                {{-- Judul: UBAH text-red-800 JADI text-white (Agar terbaca) --}}
                                <h3 class="text-lg font-medium text-white mb-4">
                                    Perbandingan Laporan
                                </h3>

                                {{-- Area Canvas: TAMBAHKAN bg-white (Agar dalam outline putih) --}}
                                <div
                                    class="relative min-h-[26rem] h-auto w-full border-2 border-red-800 rounded-lg p-4 bg-white">
                                    <canvas id="comparisonChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ======================================================= --}}
                {{-- KARTU STATISTIK UTAMA --}}
                {{-- ======================================================= --}}
                {{-- Grid 3 Kolom di Medium. --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Card Total Users --}}
                    <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-white">
                            <h3 class="text-lg font-medium text-gray-200">Total Pengguna</h3>
                            <p class="mt-1 text-3xl font-semibold">{{ $totalUsers }}</p>
                        </div>
                    </div>
                    {{-- Card Total Kehilangan --}}
                    <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-white">
                            <h3 class="text-lg font-medium text-gray-200">Total Laporan Kehilangan</h3>
                            <p class="mt-1 text-3xl font-semibold">{{ $totalLostItems }}</p>
                        </div>
                    </div>
                    {{-- Card Total Temuan --}}
                    <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-white">
                            <h3 class="text-lg font-medium text-gray-200">Total Laporan Ditemukan</h3>
                            <p class="mt-1 text-3xl font-semibold">{{ $totalFoundItems }}</p>
                        </div>
                    </div>
                </div>

                {{-- ======================================================= --}}
                {{-- KARTU STATISTIK STATUS RINCI --}}
                {{-- ======================================================= --}}
                {{-- Grid Responsif 2 -> 3 -> 5 Kolom. --}}
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mt-6">
                    {{-- Status: Belum Diambil --}}
                    <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-white text-center">
                            <h3 class="text-base font-medium text-gray-200">Belum Diambil</h3>
                            <p class="mt-1 text-3xl font-semibold">{{ $foundItemsNotTaken }}</p>
                        </div>
                    </div>
                    {{-- Status: Sudah Diambil --}}
                    <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-white text-center">
                            <h3 class="text-base font-medium text-gray-200">Sudah Diambil</h3>
                            <p class="mt-1 text-3xl font-semibold">{{ $foundItemsTaken }}</p>
                        </div>
                    </div>
                    {{-- Status: Diamankan --}}
                    <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-white text-center">
                            <h3 class="text-base font-medium text-gray-200">Diamankan</h3>
                            <p class="mt-1 text-3xl font-semibold">{{ $foundItemsSecured }}</p>
                        </div>
                    </div>
                    {{-- Status: Masih Hilang --}}
                    <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-white text-center">
                            <h3 class="text-base font-medium text-gray-200">Masih Hilang</h3>
                            <p class="mt-1 text-3xl font-semibold">{{ $lostItemsMissing }}</p>
                        </div>
                    </div>
                    {{-- Status: Dikembalikan --}}
                    <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-white text-center">
                            <h3 class="text-base font-medium text-gray-200">Dikembalikan</h3>
                            <p class="mt-1 text-3xl font-semibold">{{ $lostItemsReturned }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
        {{-- Memuat Library Chart.js --}}
        <script nonce="{{ $csp_nonce }}" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script nonce="{{ $csp_nonce }}">
            document.addEventListener('DOMContentLoaded', function() {
                // Ambil data dari server (Blade variable)
                const lineChartData = @json($chartData);

                // Ambil data status rinci dari server
                const lostMissing = @json($lostItemsMissing);
                const lostReturned = @json($lostItemsReturned);
                const foundNotTaken = @json($foundItemsNotTaken);
                const foundTaken = @json($foundItemsTaken);
                const foundSecured = @json($foundItemsSecured);

                // UPDATE: Karena background chart sekarang putih, text harus HITAM/GELAP
                Chart.defaults.color = '#374151'; // Abu tua (Gray-700)
                Chart.defaults.borderColor = 'rgba(0, 0, 0, 0.1)'; // Garis grid halus

                // 1. CHART GARIS
                const lineCtx = document.getElementById('reportsChart').getContext('2d');
                new Chart(lineCtx, {
                    type: 'line',
                    data: {
                        labels: lineChartData.labels,
                        datasets: [{
                                label: 'Laporan Kehilangan',
                                data: lineChartData.lost,
                                borderColor: 'rgb(250, 204, 21)',
                                backgroundColor: 'rgba(250, 204, 21, 0.2)',
                                tension: 0.1,
                                fill: true,
                            },
                            {
                                label: 'Laporan Ditemukan',
                                data: lineChartData.found,
                                borderColor: 'rgb(5, 150, 105)',
                                backgroundColor: 'rgba(5, 150, 105, 0.2)',
                                tension: 0.1,
                                fill: true,
                            }
                        ]
                    },
                    options: {
                        scales: {
                            // UPDATE: Text color diubah ke hitam
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0,
                                    color: '#374151'
                                },
                                title: {
                                    display: true,
                                    text: 'Total',
                                    color: '#374151'
                                },
                                grid: {
                                    color: 'rgba(0,0,0,0.05)'
                                } // Grid halus
                            },
                            x: {
                                ticks: {
                                    color: '#374151'
                                },
                                title: {
                                    display: true,
                                    text: 'Tanggal',
                                    color: '#374151'
                                },
                                grid: {
                                    color: 'rgba(0,0,0,0.05)'
                                }
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });

                // ==============================================================
                // 2. CHART DONUT (Perbandingan Status Rinci)
                // ==============================================================
                const doughnutCtx = document.getElementById('comparisonChart').getContext('2d');
                new Chart(doughnutCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Masih Hilang', 'Sudah Dikembalikan', 'Belum Diambil', 'Sudah Diambil',
                            'Diamankan'
                        ],
                        datasets: [{
                            label: 'Jumlah Laporan',
                            data: [lostMissing, lostReturned, foundNotTaken, foundTaken, foundSecured],
                            backgroundColor: [
                                'rgb(158, 26, 26)',
                                'rgb(34, 217, 38)',
                                'rgb(217, 208, 34)',
                                'rgb(59, 130, 246)',
                                'rgba(0, 4, 255, 1)'
                            ],
                            hoverOffset: 4,
                            borderColor: '#800000',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom', // ⬇️ Legend pindah ke bawah donut
                                align: 'start', // ⬅️ Rata kiri
                                fullSize: false,
                                maxHeight: 200,
                                labels: {
                                    color: '#991b1b',
                                    padding: 12,
                                    boxWidth: 20,
                                    font: {
                                        size: 11,
                                        weight: 'bold'
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        let value = context.raw;
                                        let total = context.chart._metasets[context.datasetIndex].total;
                                        let percentage = Math.round((value / total) * 100) + '%';
                                        return label + value + ' (' + percentage + ')';
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>

// {{-- ========================================================================================= --}}
// {{--                    PANDUAN PENGUBAHAN GAYA (CUSTOMIZATION GUIDE)                          --}}
// {{-- ========================================================================================= --}}
// {{--
//     1. MENGUBAH WARNA (Background & Text)
//        Format: 'bg-{warna}-{intensitas}' atau 'text-{warna}-{intensitas}'
//        Contoh:
//        - 'bg-red-800' (Merah Tua)    -> Ubah ke 'bg-blue-600' (Biru Sedang) atau 'bg-green-500' (Hijau)
//        - 'text-white' (Putih)         -> Ubah ke 'text-black' (Hitam) atau 'text-gray-200' (Abu Terang)

//        CATATAN PENTING:
//        - Jika Anda mengubah 'bg-white' menjadi 'blue', itu TIDAK AKAN BERJALAN.
//        - Anda harus spesifik: 'bg-blue-500' (standar).
//        - Angka intensitas:
//          50 (paling terang), 100, 200, 300, 400, 500 (standar), 600, 700, 800, 900 (paling gelap).
//        - Jika angka tidak cocok (misal 'bg-blue-333'), class tersebut tidak akan dikenali dan warnanya hilang.

//     2. MENGUBAH UKURAN TEXT
//        Format: 'text-{ukuran}'
//        Pilihan:
//        - 'text-xs'   (Sangat Kecil)
//        - 'text-sm'   (Kecil)
//        - 'text-base' (Normal/Standar)
//        - 'text-lg'   (Besar)
//        - 'text-xl'   (Lebih Besar)
//        - 'text-2xl' s/d 'text-9xl' (Sangat Besar untuk Judul)

//     3. MENGUBAH JARAK (Margin & Padding)
//        - Margin (Jarak Luar): 'm-{ukuran}' (semua sisi), 'my-{ukuran}' (atas-bawah), 'mx-{ukuran}' (kiri-kanan)
//        - Padding (Jarak Dalam): 'p-{ukuran}' (sama seperti margin formatnya)
//        Contoh:
//        - 'mb-4' (Margin Bawah level 4) -> Ubah ke 'mb-8' (lebih jauh) atau 'mb-2' (lebih dekat).
//        - Skala ukuran Tailwind: 0, 1, 2, 4, 8, 12, 16, 20, dll.
// --}}
// {{-- ========================================================================================= --}}
