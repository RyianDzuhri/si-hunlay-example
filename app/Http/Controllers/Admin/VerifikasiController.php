<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilSurvey;
use App\Models\HistoriPengajuan;
use App\Models\Pengajuan; // Pastikan model Pengajuan diimport
use App\Models\Petugas; // Pastikan model Petugas diimport
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifikasiController extends Controller
{
    public function index(Request $request) // Tambahkan Request $request di sini untuk filter
    {
        $verifikasiListQuery = HasilSurvey::with(['pengajuan.warga', 'petugas.user']);

        // Filter berdasarkan pencarian nama pemohon
        if ($request->filled('search')) {
            $verifikasiListQuery->whereHas('pengajuan.warga.user', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan status rekomendasi (Layak/Tidak Layak)
        if ($request->filled('status')) {
            $verifikasiListQuery->where('status_rekomendasi', $request->status);
        }

        // Filter berdasarkan petugas
        if ($request->filled('petugas')) {
            $verifikasiListQuery->where('petugas_nip', $request->petugas);
        }

        $verifikasiList = $verifikasiListQuery->latest()->paginate(10);
        
        // StatusList untuk filter (sesuai ENUM HasilSurvey.status_rekomendasi)
        $statusList = ['Layak', 'Tidak Layak']; 
        $petugasList = Petugas::with('user')->get(); // Ambil daftar petugas

        return view('admin.verifikasi.index', compact('verifikasiList', 'statusList', 'petugasList'));
    }

    public function show($id)
    {
        // Eager load pengajuan.warga.user DAN pengajuan.kelurahan.kecamatan untuk detail lengkap
        $hasil = HasilSurvey::with(['pengajuan.warga.user', 'pengajuan.kelurahan.kecamatan', 'petugas.user'])->findOrFail($id); 
        return view('admin.verifikasi.show', compact('hasil'));
    }

    public function setujui($id)
    {
        // Ambil HasilSurvey dan eager load Pengajuan terkait
        $hasil = HasilSurvey::with('pengajuan')->findOrFail($id);
        $pengajuan = $hasil->pengajuan; // Dapatkan model Pengajuan yang terkait

        // Simpan status pengajuan sebelum diubah
        $statusSebelumPengajuan = $pengajuan->status; 

        // ✅ PERUBAHAN UTAMA: Update status di model Pengajuan, BUKAN HasilSurvey
        $pengajuan->status = 'DISETUJUI'; // Ubah status PENGajuan menjadi DISETUJUI
        $pengajuan->save();

        // Catatan: status_rekomendasi di HasilSurvey tetap sesuai rekomendasi surveyor ('Layak'/'Tidak Layak').

        // Simpan ke histori pengajuan
        HistoriPengajuan::create([
            'pengajuan_id' => $pengajuan->id, // Menggunakan ID pengajuan
            'user_id' => Auth::id(), // User admin yang melakukan perubahan
            'status_sebelum' => $statusSebelumPengajuan,
            'status_sesudah' => 'DISETUJUI',
            'catatan' => 'Pengajuan disetujui final oleh admin setelah review hasil survei lapangan.'
        ]);

        // Redirect ke daftar verifikasi dengan pesan sukses
        return redirect()->route('admin.verifikasi.index')->with('success', 'Verifikasi disetujui. Status pengajuan telah diperbarui menjadi DISETUJUI.');
    }

    public function tolak(Request $request, $id)
    {
        // Admin harus mengisi alasan penolakan
        $request->validate(['alasan_penolakan' => 'required|string']);

        // Ambil HasilSurvey dan eager load Pengajuan terkait
        $hasil = HasilSurvey::with('pengajuan')->findOrFail($id);
        $pengajuan = $hasil->pengajuan; // Dapatkan model Pengajuan yang terkait

        // Simpan status pengajuan sebelum diubah
        $statusSebelumPengajuan = $pengajuan->status; 

        // ✅ PERUBAHAN UTAMA: Update status di model Pengajuan, BUKAN HasilSurvey
        $pengajuan->status = 'DITOLAK'; // Ubah status PENGajuan menjadi DITOLAK
        $pengajuan->save();

        // Catatan: status_rekomendasi di HasilSurvey tetap sesuai rekomendasi surveyor.
        // Simpan alasan penolakan ke histori
        HistoriPengajuan::create([
            'pengajuan_id' => $pengajuan->id,
            'user_id' => Auth::id(),
            'status_sebelum' => $statusSebelumPengajuan,
            'status_sesudah' => 'DITOLAK',
            'catatan' => 'Pengajuan ditolak oleh admin: ' . $request->alasan_penolakan
        ]);

        // Redirect ke daftar verifikasi dengan pesan sukses
        return redirect()->route('admin.verifikasi.index')->with('success', 'Verifikasi ditolak. Status pengajuan telah diperbarui menjadi DITOLAK.');
    }
}