@php use Carbon\Carbon; @endphp

<title>Dashboard</title>
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="pt-20">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="font-semibold text-5xl text-black leading-tight">
                Dashboard
            </h1>
        </div>

        <div class="pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{-- Grafik --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

                    <div class="lg:col-span-2">
                        <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">

                                <div class="flex flex-wrap justify-between items-start mb-4 gap-4">
                                    <h3 class="text-lg font-medium text-white">
                                        Grafik Laporan Harian
                                    </h3>

                                    <form action="{{ route('admin.dashboard') }}" method="GET">
                                        <div class="flex flex-wrap items-end gap-2">
                                            <div>
                                                <label for="month" class="block text-xs font-medium text-gray-200">Bulan:</label>
                                                {{-- Dropdown ini perlu 'text-black' agar terbaca saat dibuka --}}
                                                <select name="month" id="month" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm text-sm py-1 text-black">
                                                    @for ($m = 1; $m <= 12; $m++)
                                                        <option value="{{ $m }}" {{ $selectedMonth == $m ? 'selected' : '' }} class="text-black">
                                                            {{ Carbon::create(null, $m)->monthName }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div>
                                                <label for="year" class="block text-xs font-medium text-gray-200">Tahun:</label>
                                                <select name="year" id="year" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm text-sm py-1 text-black">
                                                    @for ($y = now()->year; $y >= now()->year - 5; $y--)
                                                        <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }} class="text-black">
                                                            {{ $y }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div>
                                                {{-- Tombol dengan style kebalikan (putih) agar kontras --}}
                                                <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-1 text-sm font-medium text-red-800 shadow-sm hover:bg-gray-100">
                                                    Filter
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="relative h-80">
                                    <canvas id="reportsChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Kotak Grafik Donut (Tidak Berubah) --}}
                    <div>
                        <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h3 class="text-lg font-medium text-white mb-4">
                                    Perbandingan Laporan
                                </h3>
                                <div class="relative h-80 flex justify-center items-center">
                                    <canvas id="comparisonChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kartu Statistik Utama (Tidak Berubah) --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-white">
                            <h3 class="text-lg font-medium text-gray-200">Total Pengguna</h3>
                            <p class="mt-1 text-3xl font-semibold">{{ $totalUsers }}</p>
                        </div>
                    </div>
                    <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-white">
                            <h3 class="text-lg font-medium text-gray-200">Total Laporan Kehilangan</h3>
                            <p class="mt-1 text-3xl font-semibold">{{ $totalLostItems }}</p>
                        </div>
                    </div>
                    <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-white">
                            <h3 class="text-lg font-medium text-gray-200">Total Laporan Ditemukan</h3>
                            <p class="mt-1 text-3xl font-semibold">{{ $totalFoundItems }}</p>
                        </div>
                    </div>
                </div>

                {{-- Kartu Statistik Status (Tidak Berubah) --}}
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mt-6">
                    <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-white text-center">
                            <h3 class="text-base font-medium text-gray-200">Belum Diambil</h3>
                            <p class="mt-1 text-3xl font-semibold">{{ $foundItemsNotTaken }}</p>
                        </div>
                    </div>
                    <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-white text-center">
                            <h3 class="text-base font-medium text-gray-200">Sudah Diambil</h3>
                            <p class="mt-1 text-3xl font-semibold">{{ $foundItemsTaken }}</p>
                        </div>
                    </div>
                    <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-white text-center">
                            <h3 class="text-base font-medium text-gray-200">Diamankan</h3>
                            <p class="mt-1 text-3xl font-semibold">{{ $foundItemsSecured }}</p>
                        </div>
                    </div>
                    <div class="bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-white text-center">
                            <h3 class="text-base font-medium text-gray-200">Masih Hilang</h3>
                            <p class="mt-1 text-3xl font-semibold">{{ $lostItemsMissing }}</p>
                        </div>
                    </div>
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
    {{-- Kode script Chart.js Anda tetap sama dan tidak perlu diubah --}}
    <script nonce="{{ $csp_nonce }}" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script nonce="{{ $csp_nonce }}">
        document.addEventListener('DOMContentLoaded', function () {
            // 3. AMBIL DATA BARU (yang sekarang bulanan)
            const lineChartData = @json($chartData);
            const totalLost = @json($totalLostItems);
            const totalFound = @json($totalFoundItems);

            Chart.defaults.color = '#FFFFFF';
            Chart.defaults.borderColor = 'rgba(255, 255, 255, 0.2)';

            // Script Grafik Garis (Tidak perlu diubah, karena format data $chartData sama)
            const lineCtx = document.getElementById('reportsChart').getContext('2d');
            new Chart(lineCtx, {
                type: 'line',
                data: {
                    labels: lineChartData.labels, // Sekarang ini akan berisi [1, 2, 3, ... 31]
                    datasets: [
                        {
                            label: 'Laporan Kehilangan',
                            data: lineChartData.lost, // Data harian baru
                            borderColor: 'rgb(250, 204, 21)',
                            backgroundColor: 'rgba(250, 204, 21, 0.2)',
                            tension: 0.1,
                            fill: true,
                        },
                        {
                            label: 'Laporan Ditemukan',
                            data: lineChartData.found, // Data harian baru
                            borderColor: 'rgb(5, 150, 105)',
                            backgroundColor: 'rgba(5, 150, 105, 0.2)',
                            tension: 0.1,
                            fill: true,
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                color: '#FFFFFF'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#FFFFFF'
                            },
                            // 4. TAMBAHAN: Label sumbu X agar jelas
                            title: {
                                display: true,
                                text: 'Tanggal',
                                color: '#FFFFFF'
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Script Grafik Donut (Tidak Berubah)
            const doughnutCtx = document.getElementById('comparisonChart').getContext('2d');
            new Chart(doughnutCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Hilang', 'Ditemukan'],
                    datasets: [{
                        label: 'Jumlah Laporan',
                        data: [totalLost, totalFound],
                        backgroundColor: [
                            'rgb(250, 204, 21)',
                            'rgb(5, 150, 105)'
                        ],
                        hoverOffset: 4,
                        borderColor: '#800000'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                color: '#FFFFFF'
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
