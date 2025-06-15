<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilSurvey extends Model
{
    use HasFactory;

    protected $table = 'hasil_survey';

    protected $fillable = [
        'pengajuan_id',
        'petugas_nip',
        'tgl_survey',
        'kondisi_atap_aktual',
        'kondisi_dinding_aktual',
        'kondisi_lantai_aktual',
        'ventilasi_pencahayaan_aktual',
        'sanitasi_airbersih_aktual',
        'status_kepemilikan',
        'verifikasi_ekonomi',
        'detail_verifikasi_dokumen',
        'catatan_survei',
        'bukti_survei',
        'status_rekomendasi',
        'alasan_penolakan',
    ];

    protected $casts = [
        'tgl_survey' => 'date',
    ];

    /**
     * Mendefinisikan relasi: Satu HasilSurvey dimiliki oleh satu Pengajuan.
     */
    public function pengajuan(): BelongsTo
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }

    /**
     * Mendefinisikan relasi: Satu HasilSurvey dimiliki oleh satu Petugas.
     */
    public function petugas(): BelongsTo
    {
        return $this->belongsTo(Petugas::class, 'petugas_nip', 'nip');
    }


    protected function detailVerifikasiDokumen(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? explode(',', $value) : [],
        );
    }

    protected function buktiSurvei(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? explode(',', $value) : [],
        );
    }

    /**
     * ACCESSOR untuk kondisi_atap_aktual.
     */
    protected function kondisiAtapAktual(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? explode(',', $value) : [],
        );
    }

    /**
     * ACCESSOR untuk kondisi_dinding_aktual. (TAMBAHAN)
     */
    protected function kondisiDindingAktual(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? explode(',', $value) : [],
        );
    }

    /**
     * ACCESSOR untuk kondisi_lantai_aktual. (TAMBAHAN)
     */
    protected function kondisiLantaiAktual(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? explode(',', $value) : [],
        );
    }

    /**
     * ACCESSOR untuk ventilasi_pencahayaan_aktual. (TAMBAHAN)
     */
    protected function ventilasiPencahayaanAktual(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? explode(',', $value) : [],
        );
    }

    /**
     * ACCESSOR untuk sanitasi_airbersih_aktual. (TAMBAHAN)
     */
    protected function sanitasiAirbersihAktual(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? explode(',', $value) : [],
        );
    }
}
