<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWargaTable extends Migration
{
    public function up(): void
    {
        Schema::create('warga', function (Blueprint $table) {
            $table->unsignedBigInteger('no_kk')->primary();
            $table->unsignedBigInteger('nik')->unique();
            $table->date('tanggalLahir')->nullable();
            $table->enum('jenisKelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('no_hp'); 
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
}
