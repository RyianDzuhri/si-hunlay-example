<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;
use App\Models\Petugas;
use App\Models\Warga;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User Admin
        $userAdmin = User::create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'nama' => 'Admin Dinas',
            'role' => 'admin_dinas',
        ]);
        Admin::create([
            'nip' => 1234567890,
            'id_user' => $userAdmin->id,
        ]);

        // User Petugas
        $userPetugas = User::create([
            'email' => 'petugas@example.com',
            'password' => Hash::make('password123'),
            'nama' => 'Petugas Lapangan',
            'role' => 'petugas',
        ]);
        Petugas::create([
            'nip' => 9876543210,
            'wilayahTugas' => 'Kecamatan A',
            'id_user' => $userPetugas->id,
        ]);

        // User Warga
        $userWarga = User::create([
            'email' => 'warga@example.com',
            'password' => Hash::make('password123'),
            'nama' => 'Warga Biasa',
            'role' => 'warga',
        ]);
        Warga::create([
            'nik' => 1234567890123456,
            'tanggalLahir' => '1990-05-15',
            'jenisKelamin' => 'Laki-laki',
            'no_hp' => '08123456789',
            'id_user' => $userWarga->id,
        ]);
    }
}
