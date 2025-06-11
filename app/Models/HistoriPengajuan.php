<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriPengajuan extends Model
{
    protected $table = 'histori_pengajuan';
    public $timestamps = false; // Karena kita menggunakan nama kolom custom
    const CREATED_AT = 'waktu_perubahan'; // Memberitahu Laravel nama kolom 'created_at' kita

    protected $fillable = [
        'pengajuan_id', 'user_id', 'status_sebelum', 'status_sesudah', 'catatan'
    ];

    public function pengajuan() { return $this->belongsTo(Pengajuan::class); }
    public function user() { return $this->belongsTo(User::class); }
}