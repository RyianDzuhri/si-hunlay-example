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
        // 🔒 Blok akses jika status pengajuan sudah bukan VERIFIKASI_LAPANGAN
        if ($pengajuan->status !== 'PROSES_SURVEY') {
            return redirect()->route('petugas.tugas')
                ->with('error', 'Pengajuan ini sudah tidak dapat diverifikasi karena statusnya telah berubah.');
        }

        // ✅ 1. Validasi input
        $validatedData = $request->validate([
            'tgl_survey' => 'required|date',
            'status_kepemilikan' => ['required', Rule::in(['Milik Sendiri', 'Sewa', 'Menumpang', 'Tidak Jelas'])],
            'verifikasi_ekonomi' => ['required', Rule::in(['Sesuai', 'Tidak Sesuai'])],
            'detail_verifikasi_dokumen' => 'nullable|array',
            'catatan_survei' => 'nullable|string|max:5000',
            'bukti_survei' => 'nullable|array',
            'bukti_survei.*' => 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048',
            'status_rekomendasi' => ['required', Rule::in(['Layak', 'Tidak Layak'])],
            'alasan_penolakan' => 'required_if:status_rekomendasi,Tidak Layak|nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // ✅ 2. Proses upload file bukti survei
            $buktiPaths = [];
            if ($request->hasFile('bukti_survei')) {
                foreach ($request->file('bukti_survei') as $file) {
                    $path = $file->store('bukti_survei', 'public');
                    $buktiPaths[] = $path;
                }
            }

            // ✅ 3. Konversi array menjadi string
            $verifikasiDokumenString = null;
            if (!empty($validatedData['detail_verifikasi_dokumen'])) {
                $verifikasiDokumenString = collect($validatedData['detail_verifikasi_dokumen'])
                    ->map(fn($status, $jenis) => "$jenis:$status")
                    ->implode(',');
            }
            $buktiSurveiString = implode(',', $buktiPaths);

            // ✅ 4. Simpan atau update hasil survey
            $hasilVerifikasi = HasilSurvey::firstOrNew(['pengajuan_id' => $pengajuan->id]);
            $hasilVerifikasi->pengajuan_id = $pengajuan->id;
            $hasilVerifikasi->petugas_nip = Auth::user()->petugas->nip;
            $hasilVerifikasi->tgl_survey = $validatedData['tgl_survey'];
            $hasilVerifikasi->status_kepemilikan = $validatedData['status_kepemilikan'];
            $hasilVerifikasi->verifikasi_ekonomi = $validatedData['verifikasi_ekonomi'];
            $hasilVerifikasi->detail_verifikasi_dokumen = $verifikasiDokumenString;
            $hasilVerifikasi->catatan_survei = $validatedData['catatan_survei'];
            $hasilVerifikasi->bukti_survei = $buktiSurveiString;
            $hasilVerifikasi->status_rekomendasi = $validatedData['status_rekomendasi'];
            $hasilVerifikasi->alasan_penolakan = $validatedData['alasan_penolakan'];
            $hasilVerifikasi->save();

            // ✅ 5. Update status pengajuan
            $statusSebelumnya = $pengajuan->status;
            $statusSesudah = 'EVALUASI_AKHIR';
            $pengajuan->update(['status' => $statusSesudah]);

            // ✅ 6. Catat histori perubahan
            HistoriPengajuan::create([
                'pengajuan_id' => $pengajuan->id,
                'user_id' => Auth::id(),
                'status_sebelum' => $statusSebelumnya,
                'status_sesudah' => $statusSesudah,
                'catatan' => 'Verifikasi lapangan telah selesai dilakukan oleh petugas.',
            ]);

            DB::commit();

            return redirect()->route('petugas.tugas')
                ->with('success', 'Hasil verifikasi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Hapus file yang sudah terupload jika gagal simpan
            if (!empty($buktiPaths)) {
                foreach ($buktiPaths as $path) {
                    Storage::disk('public')->delete($path);
                }
            }

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

}
