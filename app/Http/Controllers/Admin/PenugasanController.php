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
            // ✅ Perubahan di sini: Hanya tampilkan status DOKUMEN_LENGKAP atau PROSES_SURVEY
            ->whereIn('status', ['DOKUMEN_LENGKAP', 'PROSES_SURVEY']);

        // Filter berdasarkan kecamatan jika ada
        if ($request->filled('kecamatan_id')) {
            $pengajuansQuery->whereHas('kelurahan', function ($query) use ($request) {
                $query->where('kecamatan_id', $request->kecamatan_id);
            });
        }

        // Filter berdasarkan tanggal pengajuan jika ada
        if ($request->filled('tanggal_awal')) {
            $pengajuansQuery->whereDate('tgl_pengajuan', '>=', $request->tanggal_awal);
        }
        if ($request->filled('tanggal_akhir')) {
            $pengajuansQuery->whereDate('tgl_pengajuan', '<=', $request->tanggal_akhir);
        }

        // Filter berdasarkan status verifikasi jika ada (ini untuk filter di halaman, bukan di query utama)
        if ($request->filled('status')) {
            $pengajuansQuery->where('status', $request->status);
        }

        // Urutkan dan paginasi
        $pengajuans = $pengajuansQuery->latest()->paginate(10);

        // Ambil semua petugas dengan user-nya (untuk dropdown penugasan)
        $petugas = Petugas::with('user')->get();

        return view('admin.penugasan.index', compact('pengajuans', 'petugas', 'kecamatans'));
    }

    public function pilihPetugas($id)
    {
        // Method ini tidak terpanggil lagi dari index jika kita langsung tugaskan via dropdown select
        // Ini lebih relevan jika ada halaman detail untuk memilih petugas secara terpisah.
        // Jika masih digunakan di tempat lain, pastikan relevansi logicnya.
        
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
            'status' => 'PROSES_SURVEY', // Mengubah status menjadi PROSES_SURVEY saat ditugaskan
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