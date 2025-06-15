<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Petugas extends Model
{
    use HasFactory;

    protected $table = 'petugas';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'integer';

    protected $fillable = ['nip', 'id_user', 'wilayahTugas', 'kecamatan_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function hasilSurvey(): HasMany
    {
        return $this->hasMany(HasilSurvey::class, 'petugas_nip', 'nip');
    }

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
}
