<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;

class AdminPengajuanController extends Controller
{
    public function index(Request $request)
    {
        $pengajuanQuery = Pengajuan::with('warga')
            ->when($request->q, function ($query) use ($request) {
                $query->whereHas('warga', function ($wargaQuery) use ($request) {
                    $wargaQuery->where('nama', 'like', '%' . $request->q . '%')
                               ->orWhere('nik', 'like', '%' . $request->q . '%');
                });
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(10);

        // Gunakan through untuk memodifikasi tiap item tanpa menghilangkan pagination
        $pengajuanQuery->getCollection()->transform(function ($item) {
            return [
                'nama' => $item->warga->nama ?? '-',
                'nik' => $item->warga->nik ?? '-',
                'alamat' => $item->alamat_lengkap,
                'tanggal_pengajuan' => $item->tgl_pengajuan,
                'status' => match($item->status) {
                    'DIAJUKAN' => 'Menunggu',
                    'DOKUMEN_LENGKAP', 'PROSES_SURVEY', 'EVALUASI_AKHIR' => 'Diverifikasi',
                    'DISETUJUI', 'DITOLAK' => 'Ditolak',
                    default => 'Menunggu',
                },
                'kode_pengajuan' => 'PGJ-' . str_pad($item->id, 5, '0', STR_PAD_LEFT),
            ];
        });

        return view('admin.pengajuan.index', [
            'pengajuan' => $pengajuanQuery, // Sudah berisi data yang dimodifikasi dan tetap paginatable
        ]);
    }
}
