<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // WAJIB: Untuk membuat URL
use Illuminate\Support\Str;             // WAJIB: Untuk mengubah teks

class Dokumen extends Model
{
    protected $table = 'dokumen';
    protected $fillable = ['pengajuan_id', 'jenis_dokumen', 'path_file'];

    public function pengajuan() 
    {
        return $this->belongsTo(Pengajuan::class);
    }

    /**
     * Membuat atribut virtual 'url' dari kolom 'path_file'.
     * Ini yang akan dipanggil oleh <img src="{{ $doc->url }}">
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Storage::url($attributes['path_file'])
        );
    }

    /**
     * Membuat atribut virtual 'nama' dari kolom 'jenis_dokumen'.
     * Ini yang akan dipanggil oleh {{ $doc->nama }}
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function nama(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                // 'jenis_dokumen' adalah nilai dari database, contoh: 'BUKTI_KEPEMILIKAN'
                $jenisDokumen = $attributes['jenis_dokumen'];

                // Kita petakan setiap jenis dokumen ke nama yang kita inginkan
                return match ($jenisDokumen) {
                    'KTP'                   => 'Kartu Tanda Penduduk (KTP)',
                    'KK'                    => 'Kartu Keluarga (KK)',
                    'SKTM'                  => 'Surat Keterangan Tidak Mampu (SKTM)',
                    'BUKTI_KEPEMILIKAN'     => 'Bukti Kepemilikan Rumah',
                    'FOTO_RUMAH_DEPAN'      => 'Foto Rumah (Tampak Depan)',
                    'FOTO_RUMAH_BELAKANG'   => 'Foto Rumah (Tampak Belakang)',
                    'FOTO_BAGIAN_RUSAK'     => 'Foto Bagian Rumah yang Rusak',
                    // `default` digunakan jika ada jenis dokumen lain yang tidak terdaftar di sini
                    default                 => Str::title(str_replace('_', ' ', $jenisDokumen)),
                };
            }
        );
    }
}