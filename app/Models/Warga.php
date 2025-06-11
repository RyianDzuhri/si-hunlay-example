<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga';
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'integer';

    protected $fillable = [
        'nik', 'id_user', 'no_kk', 'tanggalLahir', 'jenisKelamin', 'no_hp'
    ];
    
    // Relasi "dimiliki oleh" ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    // Relasi One-to-One ke Pengajuan
    public function pengajuan()
    {
        return $this->hasOne(Pengajuan::class, 'warga_nik', 'nik');
    }
}