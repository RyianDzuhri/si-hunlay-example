<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';

    protected $fillable = [
        'warga_nik', 'petugas_nip', 'tgl_pengajuan', 'status',
        'kecamatan', 'kelurahan', 'alamat_lengkap', 'jumlah_penghuni',
        'pekerjaan', 'penghasilan'
    ];

    // Relasi ke Warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_nik', 'nik');
    }

    // Relasi ke Petugas
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_nip', 'nip');
    }

    // Relasi ke Dokumen
    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'pengajuan_id', 'id');
    }

    // Relasi ke Hasil Survey
    public function hasilSurvey()
    {
        return $this->hasOne(HasilSurvey::class, 'pengajuan_id', 'id');
    }

    // Relasi ke Histori
    public function histori()
    {
        return $this->hasMany(HistoriPengajuan::class, 'pengajuan_id', 'id');
    }
}