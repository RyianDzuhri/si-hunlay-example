@extends('admin.layouts.layout')

@section('title', 'Dashboard Admin - SI-Hunlay')

@section('content')
<div class="px-2 py-2">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-black">
            Selamat Datang Admin
        </h1>
        <p class="text-base text-gray-600">
            Ringkasan data dan aktivitas SI-Hunlay Kota Kendari
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-md p-5 relative">
            <div class="text-gray-600 font-semibold">Total Pengajuan Masuk</div>
            <div class="text-4xl font-bold mt-2">{{ $totalPengajuan }}</div>
            <div class="flex items-center gap-2 mt-2 {{ $percentageChangeTotalColor }} font-semibold text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    @if (str_contains($percentageChangeTotalText, '-'))
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7-7-7" />
                    @else
                        <path stroke-linecap="round" stroke-linejoin="2" d="M5 10l7-7 7 7" />
                    @endif
                </svg>
                <span>{{ $percentageChangeTotalText }}</span>
            </div>
            <div class="absolute top-5 right-5 bg-blue-100 rounded-full p-2">
                <img src="{{ asset('assets/icons/document-text.svg') }}" alt="Total Masuk Icon" class="w-6 h-6">
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 relative">
            <div class="text-gray-600 font-semibold">Pengajuan Diverifikasi</div>
            <div class="text-4xl font-bold mt-2">{{ $pengajuanDiverifikasi }}</div>
            <div class="flex items-center gap-2 mt-2 text-gray-500 font-semibold text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7 7 7" />
                </svg>
                <span>N/A</span>
            </div>
            <div class="absolute top-5 right-5 bg-blue-100 rounded-full p-2">
                <img src="{{ asset('assets/icons/clipboard-check.svg') }}" alt="Diverifikasi Icon" class="w-6 h-6">
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 relative">
            <div class="text-gray-600 font-semibold">Disetujui</div>
            <div class="text-4xl font-bold mt-2">{{ $pengajuanDisetujui }}</div>
            <div class="flex items-center gap-2 mt-2 text-gray-500 font-semibold text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7 7 7" />
                </svg>
                <span>N/A</span>
            </div>
            <div class="absolute top-5 right-5 bg-green-100 rounded-full p-2">
                <img src="{{ asset('assets/icons/check-circle.svg') }}" alt="Disetujui Icon" class="w-6 h-6">
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5 relative">
            <div class="text-gray-600 font-semibold">Ditolak</div>
            <div class="text-4xl font-bold mt-2">{{ $pengajuanDitolak }}</div>
            <div class="flex items-center gap-2 mt-2 text-gray-500 font-semibold text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7 7 7" />
                </svg>
                <span>N/A</span>
            </div>
            <div class="absolute top-5 right-5 bg-red-100 rounded-full p-2">
                <img src="{{ asset('assets/icons/x-circle.svg') }}" alt="Ditolak Icon" class="w-6 h-6">
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        <div class="col-span-2 bg-white rounded-xl shadow-md p-5">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold">Statistik Pengajuan per Kecamatan</h2>
                <div class="space-x-4 text-sm text-gray-500 font-medium">
                    <button class="hover:text-blue-600">Bulanan</button>
                    <button class="text-blue-600 font-semibold underline">Tahunan</button>
                </div>
            </div>
            {{-- ✅ Perubahan di sini: Tambahkan div wrapper --}}
            <div class="relative w-full" style="height: 256px;"> {{-- Berikan tinggi pada wrapper --}}
                <canvas id="barChart"></canvas> {{-- Hapus class w-full h-64 --}}
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5">
            <h2 class="text-lg font-semibold mb-4">Status Pengajuan</h2>
            {{-- ✅ Perubahan di sini: Tambahkan div wrapper --}}
            <div class="relative w-full" style="height: 240px;"> {{-- Berikan tinggi pada wrapper --}}
                <canvas id="donutChart"></canvas> {{-- Hapus class w-full h-60 --}}
            </div>
            <div class="mt-4 text-sm text-gray-600 space-y-2">
                @foreach ($legendItems as $item)
                    <div>
                        <span class="inline-block w-3 h-3 rounded-full mr-2" style="background-color: {{ $item['color'] }}"></span>
                        {{ $item['label'] }} ({{ $item['percentage'] }}%)
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md mt-6 p-5">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Pengajuan Terbaru</h2>
            <a href="{{ route('admin.pengajuan.index') }}" class="text-blue-600 text-sm font-medium hover:underline">Lihat Semua</a>
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
                    @forelse ($latestPengajuan as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4">PGJ-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td class="py-2 px-4">{{ $item->warga->user->nama ?? '-' }}</td>
                        <td class="py-2 px-4">{{ $item->kelurahan->kecamatan->nama_kecamatan ?? '-' }}</td>
                        <td class="py-2 px-4">{{ \Carbon\Carbon::parse($item->tgl_pengajuan)->translatedFormat('j F Y') }}</td>
                        <td class="py-2 px-4">
                            @php
                                $badgeColor = 'bg-gray-200 text-gray-800'; // Default
                                $statusText = '';
                                switch ($item->status) {
                                    case 'DIAJUKAN': $badgeColor = 'bg-yellow-100 text-yellow-700'; $statusText = 'Menunggu'; break;
                                    case 'DOKUMEN_LENGKAP':
                                    case 'PROSES_SURVEY':
                                    case 'EVALUASI_AKHIR': $badgeColor = 'bg-blue-100 text-blue-700'; $statusText = 'Diproses'; break;
                                    case 'DISETUJUI': $badgeColor = 'bg-green-100 text-green-700'; $statusText = 'Disetujui'; break;
                                    case 'DITOLAK': $badgeColor = 'bg-red-100 text-red-700'; $statusText = 'Ditolak'; break;
                                    default: $statusText = $item->status; break;
                                }
                            @endphp
                            <span class="text-xs font-semibold px-2 py-1 rounded {{ $badgeColor }}">{{ $statusText }}</span>
                        </td>
                        <td class="py-2 px-4">
                            <a href="{{ route('admin.pengajuan.verifikasi', $item->id) }}" class="text-blue-600 hover:underline text-sm">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-2 px-4 text-center text-gray-500">Tidak ada pengajuan terbaru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data dari Laravel akan disuntikkan di sini
    const barChartLabels = @json($barChartLabels);
    const barChartData = @json($barChartData);
    const donutChartLabels = @json($donutChartLabels);
    const donutChartData = @json($donutChartData);
    const donutChartBackgroundColors = @json($donutChartBackgroundColors);

    // Bar Chart
    const barCtx = document.getElementById('barChart');
    if (barCtx) {
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: barChartLabels,
                datasets: [{
                    label: 'Jumlah Pengajuan',
                    data: barChartData,
                    backgroundColor: '#3B82F6', // Warna solid
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true, // ✅ KEMBALIKAN KE TRUE
                maintainAspectRatio: false, // ✅ KEMBALIKAN KE FALSE
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Sembunyikan legend default Chart.js untuk bar chart
                    }
                }
            }
        });
    }


    // Donut Chart
    const donutCtx = document.getElementById('donutChart');
    if (donutCtx) {
        new Chart(donutCtx, {
            type: 'doughnut',
            data: {
                labels: donutChartLabels,
                datasets: [{
                    label: 'Status',
                    data: donutChartData,
                    backgroundColor: donutChartBackgroundColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true, // ✅ KEMBALIKAN KE TRUE
                maintainAspectRatio: false, // ✅ KEMBALIKAN KE FALSE
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false // Sembunyikan legend default Chart.js karena kita punya legend kustom di HTML
                    }
                }
            }
        });
    }
</script>
@endsection