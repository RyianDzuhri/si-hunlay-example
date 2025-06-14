<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilSurvey extends Model
{
    use HasFactory;

    /**
     * Nama tabel database yang terhubung dengan model ini.
     *
     * @var string
     */
    protected $table = 'hasil_survey';

    /**
     * Daftar kolom yang boleh diisi secara massal.
     * Pastikan semua kolom dari form verifikasi ada di sini.
     *
     * @var array
     */
    protected $fillable = [
        'pengajuan_id',
        'petugas_nip',
        'tgl_survey',
        'status_kepemilikan',
        'verifikasi_ekonomi',
        'detail_verifikasi_dokumen', // Disimpan sebagai TEXT dipisah koma
        'catatan_survei',
        'bukti_survei',             // Disimpan sebagai TEXT dipisah koma
        'status_rekomendasi',
        'alasan_penolakan',
    ];

    /**
     * Casting tipe data atribut.
     *
     * @var array
     */
    protected $casts = [
        'tgl_survey' => 'date', // Otomatis mengubah tgl_survey menjadi objek Carbon
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

    /**
     * ACCESSOR: Mengubah string 'detail_verifikasi_dokumen' menjadi array
     * saat dipanggil.
     *
     * Ini memungkinkan Anda menggunakan @foreach($hasil->detail_verifikasi_dokumen) di view.
     */
    protected function detailVerifikasiDokumen(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? explode(',', $value) : [],
        );
    }

    /**
     * ACCESSOR: Mengubah string 'bukti_survei' menjadi array
     * saat dipanggil.
     *
     * Ini memungkinkan Anda menggunakan @foreach($hasil->bukti_survei) di view.
     */
    protected function buktiSurvei(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? explode(',', $value) : [],
        );
    }
}
