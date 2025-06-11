<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;
    
    protected $table = 'petugas';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'integer';

    protected $fillable = ['nip', 'id_user', 'wilayahTugas'];

    // Relasi "dimiliki oleh" ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}