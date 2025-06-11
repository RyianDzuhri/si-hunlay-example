<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminDinas extends Model
{
    use HasFactory;

    protected $table = 'admin_dinas'; // Menentukan nama tabel
    protected $primaryKey = 'nip';      // Menentukan Primary Key
    public $incrementing = false;       // PK bukan auto-increment
    protected $keyType = 'string';    // Tipe data PK adalah string

    protected $fillable = ['nip', 'user_id'];

    // Relasi "dimiliki oleh" ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}