<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Pengajuan; // Import model Pengajuan
use App\Models\Kecamatan; // Import model Kecamatan
use App\Models\Warga; // Import model Warga, jika belum
use App\Models\Kelurahan; // Import model Kelurahan, jika belum
use Illuminate\Support\Facades\DB; // Untuk DB raw queries atau agregasi

class DashboardController extends Controller
{
    public function showDashboard (): View
    {
        // --- Statistik Kartu (Cards) ---
        $totalPengajuan = Pengajuan::count();
        $pengajuanDiverifikasi = Pengajuan::whereIn('status', ['DOKUMEN_LENGKAP', 'PROSES_SURVEY', 'EVALUASI_AKHIR'])->count();
        $pengajuanDisetujui = Pengajuan::where('status', 'DISETUJUI')->count();
        $pengajuanDitolak = Pengajuan::where('status', 'DITOLAK')->count();

        // Anda bisa menambahkan logika untuk 'dari bulan lalu' jika ada kolom tanggal_created dan ingin membandingkan
        $totalPengajuanLastMonth = Pengajuan::whereMonth('created_at', now()->subMonth()->month)
                                            ->whereYear('created_at', now()->subMonth()->year)
                                            ->count();
        $percentageChangeTotal = $totalPengajuanLastMonth > 0 ? (($totalPengajuan - $totalPengajuanLastMonth) / $totalPengajuanLastMonth) * 100 : ($totalPengajuan > 0 ? 100 : 0);
        $percentageChangeTotalText = number_format($percentageChangeTotal, 0) . '% dari bulan lalu';
        $percentageChangeTotalColor = $percentageChangeTotal >= 0 ? 'text-green-500' : 'text-red-500';

        // Lakukan hal serupa untuk statistik lainnya jika diinginkan, atau biarkan dummy untuk saat ini

        // --- Statistik Pengajuan per Kecamatan (Bar Chart Data) ---
        $pengajuanPerKecamatan = Pengajuan::select('kecamatan.nama_kecamatan', DB::raw('count(pengajuan.id) as total'))
            // ✅ Perbaikan di sini: Join langsung dari pengajuan ke kelurahan, lalu ke kecamatan
            ->join('kelurahan', 'pengajuan.kelurahan_id', '=', 'kelurahan.id')
            ->join('kecamatan', 'kelurahan.kecamatan_id', '=', 'kecamatan.id')
            ->groupBy('kecamatan.nama_kecamatan')
            ->orderBy('total', 'desc')
            ->get();

        $barChartLabels = $pengajuanPerKecamatan->pluck('nama_kecamatan')->toArray();
        $barChartData = $pengajuanPerKecamatan->pluck('total')->toArray();

        // --- Status Pengajuan (Donut Chart Data) ---
        $statusCounts = Pengajuan::select('status', DB::raw('count(*) as total'))
                                ->groupBy('status')
                                ->get()
                                ->pluck('total', 'status')
                                ->toArray();

        $totalAllStatus = array_sum($statusCounts);

        $donutChartLabels = [];
        $donutChartData = [];
        $donutChartBackgroundColors = [];
        $legendItems = [];

        // Mapping status ke label dan warna yang diinginkan
        $statusMapping = [
            'DOKUMEN_LENGKAP' => ['label' => 'Diproses', 'color' => '#3B82F6'], // Biru
            'PROSES_SURVEY' => ['label' => 'Diproses', 'color' => '#3B82F6'],
            'EVALUASI_AKHIR' => ['label' => 'Diproses', 'color' => '#3B82F6'],
            'DISETUJUI' => ['label' => 'Disetujui', 'color' => '#10B981'], // Hijau
            'DIAJUKAN' => ['label' => 'Menunggu', 'color' => '#FACC15'], // Kuning
            'DITOLAK' => ['label' => 'Ditolak', 'color' => '#EF4444'], // Merah
        ];

        $processedCount = 0;
        foreach ($statusCounts as $status => $count) {
            if (array_key_exists($status, $statusMapping)) {
                $mapped = $statusMapping[$status];
                
                // Group 'Diproses' statuses together
                if ($mapped['label'] === 'Diproses') {
                    $processedCount += $count;
                } else {
                    $percentage = $totalAllStatus > 0 ? round(($count / $totalAllStatus) * 100) : 0;
                    $donutChartLabels[] = $mapped['label'];
                    $donutChartData[] = $percentage;
                    $donutChartBackgroundColors[] = $mapped['color'];
                    $legendItems[] = ['label' => $mapped['label'], 'color' => $mapped['color'], 'percentage' => $percentage];
                }
            } else {
                // Handle any other unexpected statuses if they exist
                $percentage = $totalAllStatus > 0 ? round(($count / $totalAllStatus) * 100) : 0;
                $donutChartLabels[] = ucwords(str_replace('_', ' ', $status)); // Fallback
                $donutChartData[] = $percentage;
                $donutChartBackgroundColors[] = '#9CA3AF'; // Default gray
                $legendItems[] = ['label' => ucwords(str_replace('_', ' ', $status)), 'color' => '#9CA3AF', 'percentage' => $percentage];
            }
        }
        
        // Add processed count after others to ensure it's calculated correctly
        if ($processedCount > 0) {
            $percentage = $totalAllStatus > 0 ? round(($processedCount / $totalAllStatus) * 100) : 0;
            array_unshift($donutChartLabels, 'Diproses'); // Add to the beginning
            array_unshift($donutChartData, $percentage); // Add to the beginning
            array_unshift($donutChartBackgroundColors, $statusMapping['DOKUMEN_LENGKAP']['color']); // Use blue for processed
            array_unshift($legendItems, ['label' => 'Diproses', 'color' => $statusMapping['DOKUMEN_LENGKAP']['color'], 'percentage' => $percentage]);
        }


        // --- Pengajuan Terbaru (Latest Submissions) ---
        $latestPengajuan = Pengajuan::with(['warga.user', 'kelurahan.kecamatan'])
            ->latest()
            ->limit(5) // Ambil 5 pengajuan terbaru
            ->get();
            
        return view('admin.dashboard.dashboard', compact(
            'totalPengajuan',
            'pengajuanDiverifikasi',
            'pengajuanDisetujui',
            'pengajuanDitolak',
            'percentageChangeTotalText',
            'percentageChangeTotalColor',
            'barChartLabels',
            'barChartData',
            'donutChartLabels',
            'donutChartData',
            'donutChartBackgroundColors',
            'legendItems',
            'latestPengajuan'
        ));
    }
}