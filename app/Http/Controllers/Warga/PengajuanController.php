<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PengajuanController extends Controller
{
    public function showPengajuan(): View
    {
        $user = Auth::user();

        if (!$user || !$user->warga) {
            abort(404, 'Data Pengguna atau Warga tidak ditemukan.');
        }
        $warga = $user->warga;

        $pengajuan = Pengajuan::where('warga_nik', $warga->nik)
                              ->with('dokumen')
                              ->firstOrFail();
        //  dd($pengajuan->toArray()); 
        return view('warga.pengajuan-saya.index', compact('user', 'warga', 'pengajuan'));
    }
}