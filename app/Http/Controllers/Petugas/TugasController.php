<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TugasController extends Controller
{
    public function showTugas(Request $request): View
    {
    // 1. Ambil profil petugas yang sedang login
        $petugas = Auth::user()->petugas;

        // 2. Buat query dasar untuk mengambil pengajuan yang ditugaskan ke petugas ini
        $query = Pengajuan::where('petugas_nip', $petugas->nip)
                         ->with('warga.user') // Ambil juga data warga & user-nya agar efisien
                         ->latest('tgl_pengajuan'); // Urutkan dari yang terbaru

        // 3. Terapkan filter jika ada input dari pengguna
        if ($request->filled('status_verifikasi')) {
            $query->where('status', $request->status_verifikasi);
        }
        if ($request->filled('tanggal_pengajuan')) {
            $query->whereDate('tgl_pengajuan', $request->tanggal_pengajuan);
        }
        // ... bisa ditambahkan filter untuk lokasi (kecamatan/kelurahan)

        // 4. Ambil data dengan paginasi (misalnya 5 data per halaman seperti di gambar)
        $daftarTugas = $query->paginate(5);

        // 5. Kirim data ke view
        return view('petugas.tugas.index', [
            'daftarTugas' => $daftarTugas
        ]);
    }
}
