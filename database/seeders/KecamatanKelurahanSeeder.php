<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KecamatanKelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kendariData = [
            'Abeli' => [
                'Abeli', 'Anggalomelai', 'Benuanirae', 'Lapulu', 'Poasia', 'Pudai', 'Talia'
            ],
            'Baruga' => [
                'Baruga', 'Lepo-Lepo', 'Watubangga', 'Wundudopi'
            ],
            'Kadia' => [
                'Anaiwoi', 'Bende', 'Kadia', 'Pondambea', 'Wawanggu'
            ],
            'Kambu' => [
                'Kambu', 'Lalolara', 'Mokoau', 'Padaleu'
            ],
            'Kendari' => [
                'Gunung Jati', 'Jati Mekar', 'Kampungsalo', 'Kandai', 'Kendari Caddi',
                'Kassilampe', 'Mangga Dua', 'Mata', 'Purirano'
            ],
            'Kendari Barat' => [
                'Benu-Benua', 'Dapu-Dapura', 'Kemaraya', 'Lahundape', 'Punggaloba',
                'Sadoha', 'Sanua', 'Tipulu', 'Watu-Watu'
            ],
            'Mandonga' => [
                'Alolama', 'Anggilowu', 'Korumba', 'Labibia', 'Mandonga', 'Wawonbalata'
            ],
            'Nambo' => [
                'Bungkutoko', 'Nambo', 'Petoaha', 'Sambuli', 'Tobimeita', 'Tondonggeu'
            ],
            'Poasia' => [
                'Anduonohu', 'Anggoeya', 'Matabubu', 'Rahandouna', 'Wundumbatu'
            ],
            'Puuwatu' => [
                'Abeli Dalam', 'Lalodati', 'Punggaloka', 'Puuwatu', 'Tobuuha', 'Watulondo'
            ],
            'Wua-Wua' => [
                'Anawai', 'Bonggoeya', 'Mataiwoi', 'Wua-Wua'
            ],
        ];

        $now = Carbon::now();

        foreach ($kendariData as $kecamatanNama => $kelurahan) {
            // Insert Kecamatan data
            $kecamatanId = DB::table('kecamatan')->insertGetId([
                'nama' => $kecamatanNama,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            // Insert Kelurahan data for this Kecamatan
            foreach ($kelurahan as $kelurahanNama) {
                DB::table('kelurahan')->insert([
                    'kecamatan_id' => $kecamatanId,
                    'nama' => $kelurahanNama,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
