@extends('admin.layouts.layout')

@section('title', 'Dashboard Admin - SI-Hunlay')

@section('content')
@section('content')
<div class="px-2 py-2">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-black">
            Selamat Datang Admin
        </h1>
        <p class="text-base text-gray-600">
            Ringkasan data dan aktivitas SI-Hunlay Kota Kendari
        </p>
    </div>

    <!-- Statistik Pengajuan -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Pengajuan Masuk -->
        <div class="bg-white rounded-xl shadow-md p-5 relative">
            <div class="text-gray-600 font-semibold">Total Pengajuan Masuk</div>
            <div class="text-4xl font-bold mt-2">100</div>
            <div class="flex items-center gap-2 mt-2 text-green-500 font-semibold text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 10l7-7 7 7" />
                </svg>
                <span>50% dari bulan lalu</span>
            </div>
            <div class="absolute top-5 right-5 bg-blue-100 rounded-full p-2">
                <img src="{{ asset('assets/icons/document-text.svg') }}" alt="Total Masuk Icon" class="w-6 h-6">
            </div>
        </div>

        <!-- Pengajuan Diverifikasi -->
        <div class="bg-white rounded-xl shadow-md p-5 relative">
            <div class="text-gray-600 font-semibold">Pengajuan Diverifikasi</div>
            <div class="text-4xl font-bold mt-2">100</div>
            <div class="flex items-center gap-2 mt-2 text-green-500 font-semibold text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 10l7-7 7 7" />
                </svg>
                <span>50% dari bulan lalu</span>
            </div>
            <div class="absolute top-5 right-5 bg-blue-100 rounded-full p-2">
                <img src="{{ asset('assets/icons/clipboard-check.svg') }}" alt="Diverifikasi Icon" class="w-6 h-6">
            </div>
        </div>

        <!-- Disetujui -->
        <div class="bg-white rounded-xl shadow-md p-5 relative">
            <div class="text-gray-600 font-semibold">Disetujui</div>
            <div class="text-4xl font-bold mt-2">100</div>
            <div class="flex items-center gap-2 mt-2 text-green-500 font-semibold text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 10l7-7 7 7" />
                </svg>
                <span>50% dari bulan lalu</span>
            </div>
            <div class="absolute top-5 right-5 bg-green-100 rounded-full p-2">
                <img src="{{ asset('assets/icons/check-circle.svg') }}" alt="Disetujui Icon" class="w-6 h-6">
            </div>
        </div>

        <!-- Ditolak -->
        <div class="bg-white rounded-xl shadow-md p-5 relative">
            <div class="text-gray-600 font-semibold">Ditolak</div>
            <div class="text-4xl font-bold mt-2">100</div>
            <div class="flex items-center gap-2 mt-2 text-green-500 font-semibold text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 10l7-7 7 7" />
                </svg>
                <span>50% dari bulan lalu</span>
            </div>
            <div class="absolute top-5 right-5 bg-red-100 rounded-full p-2">
                <img src="{{ asset('assets/icons/x-circle.svg') }}" alt="Ditolak Icon" class="w-6 h-6">
            </div>
        </div>
    </div>

    <!-- Grid Statistik -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        <!-- Grafik Bar -->
        <div class="col-span-2 bg-white rounded-xl shadow-md p-5">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold">Statistik Pengajuan per Kecamatan</h2>
                <div class="space-x-4 text-sm text-gray-500 font-medium">
                    <button class="hover:text-blue-600">Bulanan</button>
                    <button class="text-blue-600 font-semibold underline">Tahunan</button>
                </div>
            </div>
            <canvas id="barChart" class="mt-4 w-full h-64"></canvas>
        </div>

        <!-- Donut Chart -->
        <div class="bg-white rounded-xl shadow-md p-5">
            <h2 class="text-lg font-semibold mb-4">Status Pengajuan</h2>
            <canvas id="donutChart" class="w-full h-60"></canvas>
            <div class="mt-4 text-sm text-gray-600 space-y-2">
                <div><span class="inline-block w-3 h-3 bg-blue-500 rounded-full mr-2"></span>Diproses (25%)</div>
                <div><span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-2"></span>Disetujui (57%)</div>
                <div><span class="inline-block w-3 h-3 bg-yellow-400 rounded-full mr-2"></span>Menunggu (10%)</div>
                <div><span class="inline-block w-3 h-3 bg-red-500 rounded-full mr-2"></span>Ditolak (8%)</div>
            </div>
        </div>
    </div>

    <!-- Tabel Pengajuan Terbaru -->
    <div class="bg-white rounded-xl shadow-md mt-6 p-5">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Pengajuan Terbaru</h2>
            <a href="#" class="text-blue-600 text-sm font-medium hover:underline">Lihat Semua</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-700">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 px-4 font-semibold">ID PENGAJUAN</th>
                        <th class="py-2 px-4 font-semibold">NAMA</th>
                        <th class="py-2 px-4 font-semibold">KECAMATAN</th>
                        <th class="py-2 px-4 font-semibold">TANGGAL</th>
                        <th class="py-2 px-4 font-semibold">STATUS</th>
                        <th class="py-2 px-4 font-semibold">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4">RTLH-2025-01-041</td>
                        <td class="py-2 px-4">Gusti Krisna Pranata</td>
                        <td class="py-2 px-4">Baruga</td>
                        <td class="py-2 px-4">3 Juni 2025</td>
                        <td class="py-2 px-4">
                            <span class="bg-gray-200 text-gray-800 text-xs font-semibold px-2 py-1 rounded">Verifikasi</span>
                        </td>
                        <td class="py-2 px-4">
                            <a href="#" class="text-blue-600 hover:underline text-sm">Detail</a>
                        </td>
                    </tr>
                    <!-- Tambahkan baris lainnya di sini -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Bar Chart
    const barCtx = document.getElementById('barChart');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Mandonga', 'Kendari Barat', 'Poasia', 'Kadial', 'Baruga', 'Wuawua', 'Kambu', 'Abeli', 'Kendari', 'Puuwatu'],
            datasets: [{
                label: 'Jumlah Pengajuan',
                data: [30, 20, 40, 10, 25, 35, 15, 10, 22, 28],
                backgroundColor: '#3B82F6',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

    // Donut Chart
    const donutCtx = document.getElementById('donutChart');
    new Chart(donutCtx, {
        type: 'doughnut',
        data: {
            labels: ['Diproses', 'Disetujui', 'Menunggu', 'Ditolak'],
            datasets: [{
                label: 'Status',
                data: [25, 57, 10, 8],
                backgroundColor: ['#3B82F6', '#10B981', '#FACC15', '#EF4444'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            cutout: '70%',
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endsection