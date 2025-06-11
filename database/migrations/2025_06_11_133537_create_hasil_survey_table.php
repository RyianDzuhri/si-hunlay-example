<?php

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
        Schema::create('hasil_survey', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained('pengajuan')->onDelete('cascade');
            
            $table->bigInteger('petugas_nip');
            $table->foreign('petugas_nip')->references('nip')->on('petugas')->onDelete('cascade');

            $table->date('tgl_survey');
            $table->string('kondisi_atap');
            $table->string('kondisi_dinding');
            $table->string('kondisi_lantai');
            $table->string('ventilasi');
            $table->string('sanitasi_airbersih');
            $table->string('kondisi_listrik');
            $table->boolean('verifikasi_ktp_kk')->default(false);
            $table->boolean('verifikasi_sktm')->default(false);
            $table->boolean('verifikasi_kepemilikan')->default(false);
            $table->boolean('verifikasi_foto_awal')->default(false);
            $table->enum('rekomendasi_petugas', ['Layak', 'Tidak Layak']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_survey');
    }
};
