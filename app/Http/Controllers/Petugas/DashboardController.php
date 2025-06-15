<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\HasilSurvey;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function showDashboard(): View
    {
        $petugasNip = Auth::user()->petugas->nip;

        // Ambil semua hasil survey petugas, dengan relasi pengajuan, warga, kelurahan
        $hasilSurvey = HasilSurvey::with(['pengajuan.warga.user', 'pengajuan.kelurahan'])
            ->where('petugas_nip', $petugasNip)
            ->get();

        // Hitung total semua tugas survey
        $petugas = Auth::user()->petugas;

        $total = \App\Models\Pengajuan::where('petugas_nip', $petugas->nip)->count();

        // Hitung tugas yang sudah selesai (status EVALUASI_AKHIR atau DITOLAK)
        $selesai = $hasilSurvey->filter(function ($survey) {
            return in_array($survey->pengajuan->status ?? null, ['PROSES_SURVEY', 'EVALUASI_AKHIR']);
        })->count();

        $belumSelesai = $total - $selesai;

        // Ambil 5 tugas terbaru
        $tugasTerbaru = $hasilSurvey->sortByDesc('created_at')->take(5);

        return view('petugas.dashboard.dashboard', [
            'user' => Auth::user(),
            'ringkasanTugas' => (object)[
                'total' => $total,
                'berlangsung' => '-', // belum dihitung
                'selesai' => $selesai,
                'belumSelesai' => $belumSelesai,
            ],
            'tugasTerbaru' => $tugasTerbaru,
        ]);
    }
}
