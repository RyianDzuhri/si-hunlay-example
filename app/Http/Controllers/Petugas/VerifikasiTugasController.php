<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VerifikasiTugasController extends Controller
{
    public function showVerifikasiTugasform($id): View
    {
        $pengajuan = Pengajuan::with(['warga.user', 'dokumen'])->findOrFail($id);

        return view('petugas.verifikasi.index', compact('pengajuan'));
    }
}
