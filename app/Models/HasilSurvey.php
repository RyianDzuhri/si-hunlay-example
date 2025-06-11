<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilSurvey extends Model
{
    protected $table = 'hasil_survey';
    // Isi $fillable dengan semua kolom dari tabel hasil_survey
    protected $fillable = [
        'pengajuan_id', 'petugas_nip', 'tgl_survey', 'kondisi_atap', 'kondisi_dinding', 
        'kondisi_lantai', 'ventilasi', 'sanitasi_airbersih', 'kondisi_listrik', 
        'verifikasi_ktp_kk', 'verifikasi_sktm', 'verifikasi_kepemilikan', 
        'verifikasi_foto_awal', 'rekomendasi_petugas'
    ];

    public function pengajuan() { return $this->belongsTo(Pengajuan::class); }
    public function petugas() { return $this->belongsTo(Petugas::class, 'petugas_nip', 'nip'); }
}