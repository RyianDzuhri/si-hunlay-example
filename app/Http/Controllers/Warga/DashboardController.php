<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function showDashboard(): View
    {
        $user = Auth::user();
        $warga = $user->warga;
        $pengajuan = $warga->pengajuan;

        $statusMapping = [];
        $currentStep = 0;

        if ($pengajuan) {
            $statusMapping = [
                'DIAJUKAN'           => ['step' => 1, 'label' => 'Pengajuan Dibuat'],
                'DOKUMEN_LENGKAP'    => ['step' => 2, 'label' => 'Verifikasi Dokumen'],
                'PROSES_SURVEY'      => ['step' => 3, 'label' => 'Proses Survei'],
                'EVALUASI_AKHIR'     => ['step' => 4, 'label' => 'Evaluasi Final'],
                'DISETUJUI'          => ['step' => 5, 'label' => 'Bantuan Disetujui'],
            ];
            
            // Tentukan langkah numerik dari status saat ini
            if (isset($statusMapping[$pengajuan->status])) {
                $currentStep = $statusMapping[$pengajuan->status]['step'];
            }
        }

        // 4. Kirim semua data yang dibutuhkan ke view
        return view('warga.dashboard.dashboard', [
            'user' => $user,
            'pengajuan' => $pengajuan,
            'statusMapping' => $statusMapping,
            'currentStep' => $currentStep,
        ]);
    }
}
