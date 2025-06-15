<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HasilSurvey;
use App\Models\Petugas;

class VerifikasiController extends Controller
{
    public function index(Request $request)
    {
        $query = HasilSurvey::with(['pengajuan.warga.user', 'petugas.user']);

        // Filter berdasarkan status_rekomendasi
        if ($request->filled('status')) {
            $query->where('status_rekomendasi', $request->status);
        }

        // Filter berdasarkan petugas
        if ($request->filled('petugas')) {
            $query->where('petugas_nip', $request->petugas);
        }

        // Filter berdasarkan nama warga
        if ($request->filled('search')) {
            $query->whereHas('pengajuan.warga.user', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        $verifikasiList = $query->latest()->paginate(10);
        $statusList = ['Di Review', 'Diterima', 'Ditolak'];
        $petugasList = Petugas::with('user')->get();

        return view('admin.verifikasi.index', compact('verifikasiList', 'statusList', 'petugasList'));
    }
}
