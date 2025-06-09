<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user admin
        $user = User::create([
            'email' => 'admin@si-hunlay.com',
            'password' => bcrypt('password123'),
            'nama' => 'Admin SI-Hunlay',
            'noTelpon' => '08123456789',
        ]);

        // Buat data admin_dinas
        Admin::create([
            'nip' => 1234567890123456,
            'id_user' => $user->id,
        ]);
    }
}
