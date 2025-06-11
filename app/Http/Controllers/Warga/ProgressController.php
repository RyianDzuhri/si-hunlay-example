<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProgressController extends Controller // Sesuaikan nama controller
{
    public function showProgress()
    {
        // Ambil data pengajuan milik warga yang login
        $pengajuan = Auth::user()->warga?->pengajuan;
        
        // Jika tidak ada pengajuan, kirim status 0
        if (!$pengajuan) {
            return view('warga.progress.index', ['currentStep' => 0, 'pengajuan' => null]);
        }

        $statusMapping = [
            'DIAJUKAN' => [
                'step' => 1,
                'title' => 'Pengajuan Diterima',
                'desc' => 'Pengajuan bantuan rumah tidak layak huni telah kami terima dan akan segera masuk ke tahap verifikasi awal oleh admin.'
            ],
            'DOKUMEN_LENGKAP' => [
                'step' => 2,
                'title' => 'Verifikasi Dokumen',
                'desc' => 'Selamat! Dokumen persyaratan Anda telah diverifikasi dan dinyatakan lengkap. Pengajuan akan segera dijadwalkan untuk survei lapangan.'
            ],
            'PROSES_SURVEY' => [
                'step' => 3,
                'title' => 'Proses Survei Lapangan',
                'desc' => 'Seorang petugas telah ditugaskan dan akan segera atau sedang melakukan survei ke lokasi Anda untuk verifikasi data fisik.'
            ],
            'EVALUASI_AKHIR' => [
                'step' => 4,
                'title' => 'Evaluasi Hasil Survei',
                'desc' => 'Hasil survei lapangan Anda telah kami terima. Saat ini tim kami sedang melakukan evaluasi akhir untuk menentukan kelayakan.'
            ],
            'DISETUJUI' => [
                'step' => 5,
                'title' => 'Pengajuan Disetujui',
                'desc' => 'Selamat! Pengajuan bantuan Anda telah disetujui. Pihak dinas akan menghubungi Anda untuk informasi lebih lanjut mengenai pelaksanaan bantuan.'
            ]
        ];

        $currentStatusName = $pengajuan->status;
        $currentStep = 0;
        
        // Menentukan langkah saat ini berdasarkan status
        if (isset($statusMapping[$currentStatusName])) {
            $currentStep = $statusMapping[$currentStatusName]['step'];
        }

        return view('warga.progress.index', [
            'pengajuan' => $pengajuan,
            'statusMapping' => $statusMapping,
            'currentStep' => $currentStep,
        ]);
    }
}