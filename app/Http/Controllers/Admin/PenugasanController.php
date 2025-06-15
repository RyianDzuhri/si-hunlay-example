<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Petugas;


class PenugasanController extends Controller
{
    public function index()
    {
        $pengajuans = Pengajuan::with('warga.user') // tambahkan eager loading relasi
                        ->where('status', 'DOKUMEN_LENGKAP')
                        ->latest()
                        ->paginate(10);
                        $petugas = Petugas::with('user')->get();
        return view('admin.penugasan.index', compact('pengajuans'));
    }
    

    public function pilihPetugas($id)
{
    $pengajuan = Pengajuan::with(['warga.user', 'kelurahan.kecamatan'])->findOrFail($id);

    // Ambil wilayah kecamatan dari pengajuan
    $kecamatan = $pengajuan->kelurahan->kecamatan->nama_kecamatan;

    // Ambil petugas sesuai wilayah kecamatan
    $petugasList = Petugas::with('user')
        ->where('wilayahTugas', $kecamatan)
        ->get();

    return view('admin.penugasan.pilih_petugas', compact('pengajuan', 'petugasList'));
}

    

}
