<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;  // pastikan ini nama model admin yang benar

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed user biasa dengan factory (password sudah otomatis hash)
        User::factory()->create([
            'nama' => 'Test User',
            'email' => 'test@example.com',
            'noTelpon' => '08123456789',
        ]);

        // Seed user admin secara manual (pastikan semua field wajib terisi)
        $userAdmin = User::create([
            'nama' => 'Admin SI-Hunlay',
            'email' => 'admin@si-hunlay.com',
            'password' => bcrypt('password123'),  // hash password manual
            'noTelpon' => '08123456789',
        ]);

        // Seed admin terkait user admin di tabel admin_dinas
        Admin::create([
            'nip' => 1234567890123456,
            'id_user' => $userAdmin->id,
           // 'name' => 'Admin SI-Hunlay',   // kalau di tabel admin_dinas ada kolom name, isi juga
           // 'email' => 'admin@si-hunlay.com', // sesuaikan kalau perlu
        ]);
    }
}
