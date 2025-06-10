<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    protected $table = 'users'; // Jika nama tabel kamu bukan 'users'

    protected $fillable = [
        'email',
        'password',
        'nama',
        'role',
    ];

    public $timestamps = true;

    // Relasi ke AdminDinas
    public function adminDinas(): HasOne
    {
        return $this->hasOne(Admin::class, 'id_user');
    }

    // Relasi ke PetugasLapangan
    public function petugasLapangan(): HasOne
    {
        return $this->hasOne(Petugas::class, 'id_user');
    }

    // Relasi ke Warga
    public function warga(): HasOne
    {
        return $this->hasOne(Warga::class, 'id_user');
    }

    protected $hidden = [
        'password'
    ];
}
