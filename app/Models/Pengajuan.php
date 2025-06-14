<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; 

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';

    protected $fillable = [
        'warga_nik',
        'petugas_nip',
        'kelurahan_id', 
        'alamat_lengkap',
        'tgl_pengajuan',
        'status',
        'jumlah_penghuni',
        'pekerjaan',
        'penghasilan',
        'kondisi_atap',
        'kondisi_dinding',
        'kondisi_lantai',
        'ventilasi_pencahayaan',
        'sanitasi_airbersih',
        'luas_rumah',
    ];

    protected $casts = [
        'tgl_pengajuan'         => 'date',
        'penghasilan'           => 'double',
        'luas_rumah'            => 'decimal:2',
        'jumlah_penghuni'       => 'integer',
        'kondisi_atap'          => 'array',
        'kondisi_dinding'       => 'array',
        'kondisi_lantai'        => 'array',
        'ventilasi_pencahayaan' => 'array',
        'sanitasi_airbersih'    => 'array',
    ];


    public function getJenisKerusakanAttribute()
    {
        $kerusakanFormatted = [];

        // Kita buat peta antara nama kolom di database dan nama kategori yang ingin ditampilkan
        $kategoriMap = [
            'kondisi_atap'    => 'Atap',
            'kondisi_dinding' => 'Dinding',
            'kondisi_lantai'  => 'Lantai',
        ];

        foreach ($kategoriMap as $kolom => $namaKategori) {
            // Cek apakah data untuk kategori ini ada dan merupakan array
            if (!empty($this->{$kolom}) && is_array($this->{$kolom})) {
                
                // Looping untuk setiap kondisi di dalam kategori ini
                foreach ($this->{$kolom} as $kondisi) {
                    // Format teksnya: "Kategori: Kondisi"
                    // contoh: "Atap: Rangka lapuk"
                    $teksKondisi = Str::ucfirst(str_replace('_', ' ', $kondisi));
                    $kerusakanFormatted[] = $namaKategori . ': ' . $teksKondisi;
                }
            }
        }

        return $kerusakanFormatted;
    }


    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_nik', 'nik');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_nip', 'nip');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'id');
    }
    
    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'pengajuan_id', 'id');
    }

    public function hasil_survey()
    {
        return $this->hasOne(HasilSurvey::class, 'pengajuan_id', 'id');
    }

    public function histori_pengajuan()
    {
        return $this->hasMany(HistoriPengajuan::class, 'pengajuan_id', 'id');
    }
}
