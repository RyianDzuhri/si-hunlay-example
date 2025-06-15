<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\HasilSurvey;
use App\Models\HistoriPengajuan;
use App\Models\Pengajuan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class VerifikasiTugasController extends Controller
{
    public function showVerifikasiTugasform($id): View|RedirectResponse 
    {
        $pengajuan = Pengajuan::with(['warga.user', 'dokumen'])->findOrFail($id);
        if ($pengajuan->status !== 'PROSES_SURVEY') {

        return redirect()->route('petugas.tugas')
            ->with('error', 'Pengajuan ini sudah diverifikasi atau tidak dapat diakses.');
        } else{
            return view('petugas.verifikasi.index', compact('pengajuan'));
        }
    }

    public function store(Request $request, Pengajuan $pengajuan)
    {
        // 1. Validasi
        $validatedData = $request->validate([
            'tgl_survey' => 'required|date',
            'status_kepemilikan' => ['required', Rule::in(['Milik Sendiri', 'Sewa', 'Menumpang', 'Tidak Jelas'])],
            'verifikasi_ekonomi' => ['required', Rule::in(['Sesuai', 'Tidak Sesuai'])],
            
            // Verifikasi untuk dropdown kondisi (sekarang string, bukan array)
            'kondisi_atap_aktual' => 'nullable|string',
            'kondisi_dinding_aktual' => 'nullable|string',
            'kondisi_lantai_aktual' => 'nullable|string',
            'ventilasi_pencahayaan_aktual' => 'nullable|string',
            'sanitasi_airbersih_aktual' => 'nullable|string',

            'detail_verifikasi_dokumen' => 'nullable|array',
            'catatan_survei' => 'nullable|string|max:5000',
            'bukti_survei' => 'nullable|array',
            'bukti_survei.*' => 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048',
            'status_rekomendasi' => ['required', Rule::in(['Layak', 'Tidak Layak'])],
            'alasan_penolakan' => 'required_if:status_rekomendasi,Tidak Layak|nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            
            // 2. Proses upload file
            $buktiPaths = [];
            if ($request->hasFile('bukti_survei')) {
                foreach ($request->file('bukti_survei') as $file) {
                    $path = $file->store('bukti_survei', 'public');
                    $buktiPaths[] = $path;
                }
            }

            // 3. Konversi data array menjadi string (hanya untuk yang masih array)
            $verifikasiDokumenString = null;
            if (!empty($validatedData['detail_verifikasi_dokumen'])) {
                $verifikasiDokumenString = collect($validatedData['detail_verifikasi_dokumen'])
                    ->map(fn($status, $jenis) => "$jenis:$status")
                    ->implode(',');
            }
            $buktiSurveiString = implode(',', $buktiPaths);

            // 4. Simpan atau perbarui data ke tabel 'hasil_verifikasi'
            HasilSurvey::updateOrCreate(
                ['pengajuan_id' => $pengajuan->id],
                [
                    'petugas_nip' => Auth::user()->petugas->nip,
                    'tgl_survey' => $validatedData['tgl_survey'],
                    'status_kepemilikan' => $validatedData['status_kepemilikan'],
                    'verifikasi_ekonomi' => $validatedData['verifikasi_ekonomi'],
                    
                    // Simpan langsung nilai string dari dropdown
                    'kondisi_atap_aktual' => $validatedData['kondisi_atap_aktual'],
                    'kondisi_dinding_aktual' => $validatedData['kondisi_dinding_aktual'],
                    'kondisi_lantai_aktual' => $validatedData['kondisi_lantai_aktual'],
                    'ventilasi_pencahayaan_aktual' => $validatedData['ventilasi_pencahayaan_aktual'],
                    'sanitasi_airbersih_aktual' => $validatedData['sanitasi_airbersih_aktual'],

                    'detail_verifikasi_dokumen' => $verifikasiDokumenString,
                    'catatan_survei' => $validatedData['catatan_survei'],
                    'bukti_survei' => $buktiSurveiString,
                    'status_rekomendasi' => $validatedData['status_rekomendasi'],
                    'alasan_penolakan' => $validatedData['alasan_penolakan'],
                ]
            );

            // 5. Update status pengajuan
            $statusSebelumnya = $pengajuan->status;
            $statusSesudah = ($validatedData['status_rekomendasi'] === 'Layak') ? 'EVALUASI_AKHIR' : 'DITOLAK';
            $pengajuan->update(['status' => $statusSesudah]);

            // 6. Catat histori
            HistoriPengajuan::create([
                'pengajuan_id' => $pengajuan->id,
                'user_id' => Auth::id(),
                'status_sebelum' => $statusSebelumnya,
                'status_sesudah' => $statusSesudah,
                'catatan' => 'Verifikasi lapangan telah selesai dilakukan oleh petugas.',
            ]);
            
            DB::commit();

            return redirect()->route('petugas.dashboard')->with('success', 'Hasil verifikasi berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();
            if (!empty($buktiPaths)) {
                foreach ($buktiPaths as $path) { Storage::disk('public')->delete($path); }
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

}
