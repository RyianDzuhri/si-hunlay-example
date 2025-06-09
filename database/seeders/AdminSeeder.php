<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User biasa
        User::factory()->create([
            'nama' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
            'noTelpon' => '08123456789',
        ]);

        // User admin_dinas
        $user = User::create([
            'nama' => 'Admin SI-Hunlay',
            'email' => 'admin@si-hunlay.com',
            'password' => bcrypt('password123'),
            'noTelpon' => '08123456789',
        ]);

        AdminDinas::create([
            'nip' => 1234567890123456,
            'id_user' => $user->id,
        ]);
    }
}
