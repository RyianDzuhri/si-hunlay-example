<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Petugas extends Model
{
    protected $table = 'petugas';

    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = ['nip', 'wilayahTugas', 'id_user'];

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
