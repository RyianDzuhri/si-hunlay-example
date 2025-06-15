<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilSurvey;
use App\Models\HistoriPengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifikasiController extends Controller
{
    public function index()
    {
        $verifikasiList = HasilSurvey::with(['pengajuan.warga', 'petugas.user'])->paginate(10);
        $statusList = ['Di Review', 'Diterima', 'Ditolak'];
        $petugasList = \App\Models\Petugas::with('user')->get();

        return view('admin.verifikasi.index', compact('verifikasiList', 'statusList', 'petugasList'));
    }

    public function show($id)
    {
        $hasil = HasilSurvey::with(['pengajuan.warga.user'])->findOrFail($id);
        return view('admin.verifikasi.show', compact('hasil'));
    }

    public function setujui($id)
    {
        $hasil = HasilSurvey::findOrFail($id);
        $hasil->update(['status_rekomendasi' => 'Diterima']);

        HistoriPengajuan::create([
            'pengajuan_id' => $hasil->pengajuan_id,
            'user_id' => Auth::id(),
            'status_sebelum' => $hasil->status_rekomendasi,
            'status_sesudah' => 'Diterima',
            'catatan' => 'Disetujui oleh admin.'
        ]);

        return redirect()->route('admin.verifikasi.index')->with('success', 'Verifikasi disetujui.');
    }

    public function tolak(Request $request, $id)
    {
        $request->validate(['alasan_penolakan' => 'required|string']);

        $hasil = HasilSurvey::findOrFail($id);
        $hasil->update([
            'status_rekomendasi' => 'Ditolak',
            'alasan_penolakan' => $request->alasan_penolakan
        ]);

        HistoriPengajuan::create([
            'pengajuan_id' => $hasil->pengajuan_id,
            'user_id' => Auth::id(),
            'status_sebelum' => $hasil->status_rekomendasi,
            'status_sesudah' => 'Ditolak',
            'catatan' => 'Ditolak: ' . $request->alasan_penolakan
        ]);

        return redirect()->route('admin.verifikasi.index')->with('success', 'Verifikasi ditolak.');
    }
    
}
