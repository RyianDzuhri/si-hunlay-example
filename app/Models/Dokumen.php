<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumen';
    protected $fillable = ['pengajuan_id', 'jenis_dokumen', 'path_file'];

    public function pengajuan() { return $this->belongsTo(Pengajuan::class); }
}