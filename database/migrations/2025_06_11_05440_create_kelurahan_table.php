<?php

// database/migrations/xxxx_xx_xx_create_kelurahan_table.php (nama file mungkin berbeda, tapi kontennya ini)

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
        Schema::create('kelurahan', function (Blueprint $table) { // Pastikan ini 'kelurahan' (singular)
            $table->id();
            $table->foreignId('kecamatan_id')->constrained('kecamatan')->onDelete('cascade');
            $table->string('nama', 100);
            $table->timestamps();
            $table->unique(['kecamatan_id', 'nama']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelurahan'); // Pastikan ini 'kelurahan' (singular)
    }
};