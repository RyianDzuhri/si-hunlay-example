<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Warga extends Model
{
    protected $table = 'warga';

    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'nik',
        'tanggalLahir',
        'jenisKelamin',
        'pekerjaan',
        'penghasilan',
        'id_user'
    ];

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
