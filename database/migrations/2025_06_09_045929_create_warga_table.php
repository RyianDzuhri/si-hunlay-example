<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWargaTable extends Migration
{
    public function up(): void
    {
        Schema::create('warga', function (Blueprint $table) {
            $table->unsignedBigInteger('nik')->primary();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('no_kk', 20)->unique();
            $table->date('tanggalLahir')->nullable();
            $table->enum('jenisKelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
}
