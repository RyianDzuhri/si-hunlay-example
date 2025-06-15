<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Petugas;
use App\Models\Kecamatan;
use App\Models\HistoriPengajuan;


class PenugasanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua kecamatan untuk dropdown
        $kecamatans = Kecamatan::orderBy('nama_kecamatan')->get();

        // Query dasar pengajuan dengan relasi
        $pengajuansQuery = Pengajuan::with(['warga.user', 'kelurahan.kecamatan', 'petugas.user'])
            ->where('status', '!=', 'DITOLAK');

        // Filter berdasarkan kecamatan jika ada
        if ($request->filled('kecamatan_id')) {
            $pengajuansQuery->whereHas('kelurahan', function ($query) use ($request) {
                $query->where('kecamatan_id', $request->kecamatan_id);
            });
        }

        $pengajuans = $pengajuansQuery->paginate(10);

        // Ambil semua petugas dengan user-nya
        $petugas = Petugas::with('user')->get();

        return view('admin.penugasan.index', compact('pengajuans', 'petugas', 'kecamatans'));
    }

    public function pilihPetugas($id)
    {
        // Ambil pengajuan berdasarkan ID, dengan relasi warga->user dan kelurahan->kecamatan
        $pengajuan = Pengajuan::with(['warga.user', 'kelurahan.kecamatan'])->findOrFail($id);

        // Ambil nama kecamatan dari pengajuan
        $kecamatan = strtolower(trim($pengajuan->kelurahan->kecamatan->nama_kecamatan));

        // Ambil petugas yang bertugas di kecamatan tersebut
        $petugasList = Petugas::with('user')
            ->whereRaw('LOWER(TRIM(REPLACE(wilayahTugas, "Kecamatan ", ""))) = ?', [$kecamatan])
            ->get();

        return view('admin.penugasan.pilih_petugas', compact('pengajuan', 'petugasList'));
    }

    public function tugaskan(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'petugas_nip' => 'required|exists:petugas,nip',
        ]);
    
        $statusSebelum = $pengajuan->status;
    
        $pengajuan->update([
            'petugas_nip' => $request->petugas_nip,
            'status' => 'PROSES_SURVEY',
        ]);
    
        // Simpan ke histori
        HistoriPengajuan::create([
            'pengajuan_id' => $pengajuan->id,
            'user_id' => auth()->id(),
            'status_sebelum' => $statusSebelum,
            'status_sesudah' => 'PROSES_SURVEY',
            'catatan' => 'Petugas ditugaskan oleh admin.',
        ]);
    
        return redirect()->back()->with('success', 'Petugas berhasil ditugaskan dan status diubah.');
    }
    
}
