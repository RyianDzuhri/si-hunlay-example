<?php

namespace App\Http\Controllers\Warga; // Sesuaikan dengan namespace Anda

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Models\HistoriPengajuan;
use App\Models\Kecamatan; // Jangan lupa import model
use App\Models\Kelurahan; // Jangan lupa import model
use App\Models\Pengajuan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AjukanController extends Controller // Sesuaikan nama controller Anda
{
    public function formPengajuan(): View
    {
        $user = Auth::user();
        $warga = $user->warga;

        $kecamatans = Kecamatan::orderBy('nama_kecamatan', 'asc')->get();

        return view('warga.ajukan.index', compact(
            'user',
            'warga',
            'kecamatans'
        ));
    }

    public function getKelurahan(int $kecamatanId): JsonResponse
    {
        // Cari semua kelurahan berdasarkan kecamatan_id, diurutkan berdasarkan nama
        $kelurahanData = Kelurahan::where('kecamatan_id', $kecamatanId)
                                  ->orderBy('nama_kelurahan', 'asc')
                                  ->get(['id', 'nama_kelurahan']); // Ambil kolom yang benar

        // Kembalikan sebagai JSON
        return response()->json($kelurahanData); 
    }

    public function store(Request $request)
    {
        // 1. VALIDASI INPUT
        // Saya lengkapi validasi untuk input yang berupa array (dari checkbox)
        $validatedData = $request->validate([
            'kelurahan_id'          => 'required|exists:kelurahan,id',
            'alamat_lengkap'        => 'required|string|max:500',
            'jumlah_penghuni'       => 'required|integer|min:1',
            'pekerjaan'             => 'required|string|max:100',
            'penghasilan'           => 'required|numeric',
            'luas_rumah'            => 'required|numeric',
            'kondisi_atap'          => 'required|array|min:1', // Diperbaiki: harus array, minimal pilih 1
            'kondisi_dinding'       => 'required|array|min:1',
            'kondisi_lantai'        => 'required|array|min:1',
            'ventilasi_pencahayaan' => 'required|array|min:1',
            'sanitasi_airbersih'    => 'required|array|min:1', // Perbaikan nama dari 'sanitasi_air_bersih'
            'persetujuan'           => 'accepted',
            // Validasi untuk file upload (nama input harus sesuai dengan form)
            'file_ktp'              => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_kk'               => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_sktm'             => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_kepemilikan_rumah'  => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'foto_tampak_depan'     => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'foto_tampak_belakang'    => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'foto_bagian_rusak'     => 'required|array|min:1',
            'foto_bagian_rusak.*'   => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // 2. MULAI DATABASE TRANSACTION
        try {
            DB::beginTransaction();

            // 3. SIMPAN DATA UTAMA KE TABEL PENGAJUAN
            // PERBAIKAN PENTING: Menggunakan json_encode() untuk data array dari checkbox
            $pengajuan = Pengajuan::create([
                'warga_nik'             => Auth::user()->warga->nik,
                'tgl_pengajuan'         => now(),
                'status'                => 'DIAJUKAN',
                'kelurahan_id'          => $validatedData['kelurahan_id'],
                'alamat_lengkap'        => $validatedData['alamat_lengkap'],
                'jumlah_penghuni'       => $validatedData['jumlah_penghuni'],
                'pekerjaan'             => $validatedData['pekerjaan'],
                'penghasilan'           => $validatedData['penghasilan'],
                'luas_rumah'            => $validatedData['luas_rumah'],
                'kondisi_atap'          => json_encode($validatedData['kondisi_atap']),
                'kondisi_dinding'       => json_encode($validatedData['kondisi_dinding']),
                'kondisi_lantai'        => json_encode($validatedData['kondisi_lantai']),
                'ventilasi_pencahayaan' => json_encode($validatedData['ventilasi_pencahayaan']),
                'sanitasi_airbersih'    => json_encode($validatedData['sanitasi_airbersih']),
                // Perbaikan: Kolom kecamatan_id tidak perlu disimpan sesuai kesepakatan Normalisasi
            ]);

            // 4. PROSES SEMUA FILE UPLOAD (Dilengkapi)
            $dokumenToUpload = [
                'KTP'                   => 'file_ktp',
                'KK'                    => 'file_kk',
                'SKTM'                  => 'file_sktm',
                'BUKTI_KEPEMILIKAN'     => 'file_kepemilikan_rumah',
                'FOTO_RUMAH_DEPAN'      => 'foto_tampak_depan',
                'FOTO_RUMAH_BELAKANG'   => 'foto_tampak_belakang',
            ];
            
            foreach ($dokumenToUpload as $jenis => $inputName) {
                if ($request->hasFile($inputName)) {
                    $file = $request->file($inputName);
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('dokumen_pengajuan', $fileName, 'public');

                    Dokumen::create([
                        'pengajuan_id' => $pengajuan->id,
                        'jenis_dokumen' => $jenis,
                        'path_file' => $path,
                    ]);
                }
            }
            // Penanganan khusus untuk upload multiple file
            if ($request->hasFile('foto_bagian_rusak')) {
                foreach ($request->file('foto_bagian_rusak') as $file) {
                    $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('dokumen_pengajuan/kerusakan', $fileName, 'public');
                    Dokumen::create([
                        'pengajuan_id' => $pengajuan->id,
                        'jenis_dokumen' => 'FOTO_BAGIAN_RUSAK',
                        'path_file' => $path,
                    ]);
                }
            }

            // 5. BUAT CATATAN HISTORI PERTAMA (Dilengkapi)
            HistoriPengajuan::create([
                'pengajuan_id' => $pengajuan->id,
                'user_id' => Auth::id(),
                'status_sebelum' => null,
                'status_sesudah' => 'DIAJUKAN',
                'catatan' => 'Pengajuan berhasil dibuat oleh warga.',
            ]);

            DB::commit();

            // 6. ALIHKAN PENGGUNA DENGAN PESAN SUKSES (Dilengkapi)
            return redirect()->route('warga.dashboard')->with('success', 'Pengajuan Anda berhasil dikirim dan sedang dalam proses verifikasi!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}