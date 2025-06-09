<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guard = 'admin';
    protected $table = 'admin_dinas'; // Sesuaikan dengan tabel AdminDinas
    protected $primaryKey = 'nip';
    protected $fillable = ['nip', 'id_user', 'name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}