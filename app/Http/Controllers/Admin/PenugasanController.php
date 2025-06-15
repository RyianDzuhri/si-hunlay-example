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
        $pengajuans = Pengajuan::with(['warga.user', 'kelurahan.kecamatan'])->paginate(10);
    
        // Group berdasarkan nama kecamatan yang sudah dibersihkan dan sesuai format nama_kecamatan dari database
        // $petugas = Petugas::with('user')->get()->groupBy(function ($item) {
        //     return strtolower(str_replace('Kecamatan ', '', $item->wilayahTugas));
        // });
        $petugas = Petugas::with(['user', 'kecamatan'])->get()->groupBy(function ($item) {
            return strtolower($item->kecamatan->nama_kecamatan ?? '');
        });
        
    
        return view('admin.penugasan.index', compact('pengajuans', 'petugas'));
    }

    public function pilihPetugas($id)
    {
        // Ambil pengajuan berdasarkan ID, beserta relasi warga->user dan kelurahan->kecamatan
        $pengajuan = Pengajuan::with(['warga.user', 'kelurahan.kecamatan'])->findOrFail($id);

        // Ambil nama kecamatan dari pengajuan
        $kecamatan = strtolower(trim($pengajuan->kelurahan->kecamatan->nama_kecamatan));

        // Ambil petugas yang bertugas di kecamatan tersebut, dengan penyesuaian casing
        $petugasList = Petugas::with('user')
            ->whereRaw('LOWER(TRIM(REPLACE(wilayahTugas, "Kecamatan ", ""))) = ?', [$kecamatan])
            ->get();

        return view('admin.penugasan.pilih_petugas', compact('pengajuan', 'petugasList'));
    }
}
