<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AjukanController extends Controller
{
    public function formPengajuan()
    {
        // Get the authenticated user
        $user = Auth::user();
        $warga = $user->warga;
        $kecamatan = Kecamatan::orderBy('nama')->get();

        return view('warga.ajukan.index', compact(
            'user',
            'warga',
            'kecamatan'
        ));
    }

    public function getKelurahanByKecamatan(int $kecamatanId): JsonResponse // Nama fungsi diubah dari getKelurahansByKecamatan
    {
        $kelurahanData = Kelurahan::where('kecamatan_id', $kecamatanId) // Variabel dan query tetap merujuk ke data kelurahan
                               ->orderBy('nama')
                               ->get(['id', 'nama']);

        return response()->json($kelurahanData); // Mengembalikan koleksi data kelurahan
    }
}
