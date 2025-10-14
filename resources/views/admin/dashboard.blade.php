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
                                <h3 class="text-lg font-medium text-white mb-4">
                                    Laporan Baru (7 Hari Terakhir)
                                </h3>
                                <div class="relative h-80">
                                    <canvas id="reportsChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
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

                {{-- Kartu Statistik Utama --}}
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

                {{-- ======================================================= --}}
                {{-- PENAMBAHAN: Kartu Statistik Berdasarkan Status --}}
                {{-- ======================================================= --}}
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
        {{-- (Script Chart.js tidak perlu diubah) --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // ... (kode script Anda yang sudah ada)
        </script>
    @endpush

    @push('scripts')
    {{-- Kode script Chart.js Anda tetap sama --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const lineChartData = @json($chartData);
            const totalLost = @json($totalLostItems);
            const totalFound = @json($totalFoundItems);

            Chart.defaults.color = '#FFFFFF';
            Chart.defaults.borderColor = 'rgba(255, 255, 255, 0.2)';

            const lineCtx = document.getElementById('reportsChart').getContext('2d');
            new Chart(lineCtx, {
                type: 'line',
                data: {
                    labels: lineChartData.labels,
                    datasets: [
                        {
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
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false 
                }
            });

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