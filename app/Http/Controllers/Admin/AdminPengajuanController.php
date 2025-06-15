<?php

namespace App\Http\Controllers\Admin;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Exports\PengajuanExport;
use App\Models\HistoriPengajuan;


class AdminPengajuanController extends Controller
{
    public function index(Request $request)
    {
        $pengajuanQuery = Pengajuan::with('warga.user')
        ->when($request->q, function ($query) use ($request) {
            $query->whereHas('warga.user', function ($userQuery) use ($request) {
                $userQuery->where('nama', 'like', '%' . $request->q . '%');
            })->orWhereHas('warga', function ($wargaQuery) use ($request) {
                $wargaQuery->where('nik', 'like', '%' . $request->q . '%');
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
                // 'nama' => $item->warga->nama ?? '-',
                'id' => $item->id,
                'nama' => $item->warga->user->nama ?? '-',
                'nik' => $item->warga->nik ?? '-',
                'alamat' => $item->alamat_lengkap,
                'tanggal_pengajuan' => $item->tgl_pengajuan,
                'status' => match($item->status) {
                    'DIAJUKAN' => 'Menunggu',
                    'DOKUMEN_LENGKAP', 'PROSES_SURVEY', 'EVALUASI_AKHIR' => 'Diverifikasi',
                    'DISETUJUI' => 'Disetujui',
                    'DITOLAK' => 'Ditolak',
                    default => 'Menunggu',
                },
                
                'kode_pengajuan' => 'PGJ-' . str_pad($item->id, 5, '0', STR_PAD_LEFT),
            ];
        });


        return view('admin.pengajuan.index', [
            'pengajuan' => $pengajuanQuery, // Sudah berisi data yang dimodifikasi dan tetap paginatable
        ]);
    }
    public function export(Request $request)
{
    $pengajuan = Pengajuan::with('warga.user')
        ->when($request->status, function ($query) use ($request) {
            $query->where('status', $request->status);
        })
        ->get()
        ->map(function ($item) {
            return [
                'nama' => $item->warga->user->nama ?? '-',
                'nik' => $item->warga->nik ?? '-',
                'alamat' => $item->alamat_lengkap,
                'tanggal_pengajuan' => $item->tgl_pengajuan,
                'status' => match($item->status) {
                    'DIAJUKAN' => 'Menunggu',
                    'DOKUMEN_LENGKAP', 'PROSES_SURVEY', 'EVALUASI_AKHIR' => 'Diverifikasi',
                    'DISETUJUI' => 'Disetujui',
                    'DITOLAK' => 'Ditolak',
                    default => 'Menunggu',
                },
            ];
        });

    return Excel::download(new PengajuanExport($pengajuan), 'pengajuan.xlsx');
}
public function verifikasi($id)
{
    $pengajuan = Pengajuan::with(['warga.user', 'dokumen'])->findOrFail($id);
    return view('admin.pengajuan.verifikasi_pengajuan.detail', compact('pengajuan'));
}

// ✅ Tambahan method SETUJUI
public function setujui($id)
{
    $pengajuan = Pengajuan::findOrFail($id);
    $statusSebelum = $pengajuan->status;
    $pengajuan->status = 'DOKUMEN_LENGKAP';
    $pengajuan->save();

    HistoriPengajuan::create([
        'pengajuan_id' => $pengajuan->id,
        'user_id' => auth()->id(), // User admin yang melakukan perubahan
        'status_sebelum' => $statusSebelum,
        'status_sesudah' => $pengajuan->status,
        'catatan' => 'Pengajuan telah disetujui oleh admin.',
    ]);

    return redirect()->route('admin.pengajuan.index')->with('success', 'Pengajuan telah disetujui.');
}


public function tolak($id)
{
    $pengajuan = Pengajuan::findOrFail($id);
    $statusSebelum = $pengajuan->status;
    $pengajuan->status = 'DITOLAK';
    $pengajuan->save();

    HistoriPengajuan::create([
        'pengajuan_id' => $pengajuan->id,
        'user_id' => auth()->id(),
        'status_sebelum' => $statusSebelum,
        'status_sesudah' => $pengajuan->status,
        'catatan' => 'Pengajuan ditolak oleh admin.',
    ]);

    return redirect()->route('admin.pengajuan.index')->with('success', 'Pengajuan ditolak.');
}


}
