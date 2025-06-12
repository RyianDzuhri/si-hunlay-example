<?php

// database/migrations/xxxx_xx_xx_create_kecamatan_table.php (nama file mungkin berbeda, tapi kontennya ini)

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kecamatan', function (Blueprint $table) { // Pastikan ini 'kecamatan' (singular)
            $table->id();
            $table->string('nama', 100)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kecamatan'); // Pastikan ini 'kecamatan' (singular)
    }
};