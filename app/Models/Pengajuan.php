<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';

    protected $fillable = [
        'warga_nik',
        'petugas_nip',
        'tgl_pengajuan',
        'status',
        'kecamatan_id',
        'kelurahan_id',
        'alamat_lengkap',
        'jumlah_penghuni',
        'pekerjaan',
        'penghasilan',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_nik', 'nik');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_nip', 'nip');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id');
    }
    
    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'pengajuan_id', 'id');
    }

    public function hasilSurvey()
    {
        return $this->hasOne(HasilSurvey::class, 'pengajuan_id', 'id');
    }

    public function histori()
    {
        return $this->hasMany(HistoriPengajuan::class, 'pengajuan_id', 'id');
    }
}
