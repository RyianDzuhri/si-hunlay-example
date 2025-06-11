<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nama_lengkap',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi One-to-One ke profil admin
    public function adminDinas()
    {
        return $this->hasOne(AdminDinas::class, 'user_id', 'id');
    }

    // Relasi One-to-One ke profil petugas
    public function petugas()
    {
        // 'id_user' adalah foreign key di tabel petugas, 'id' adalah local key di tabel users
        return $this->hasOne(Petugas::class, 'id_user', 'id');
    }

    // Relasi One-to-One ke profil warga
    public function warga()
    {
        return $this->hasOne(Warga::class, 'id_user', 'id');
    }

    // Relasi One-to-Many ke histori (seorang staf bisa punya banyak histori)
    public function historiPengajuan()
    {
        return $this->hasMany(HistoriPengajuan::class, 'user_id', 'id');
    }
}