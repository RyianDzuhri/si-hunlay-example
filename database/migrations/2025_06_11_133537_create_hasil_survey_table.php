<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_survey', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained('pengajuan')->onDelete('cascade');
            $table->bigInteger('petugas_nip');
            $table->date('tgl_survey');
            $table->string('kondisi_atap_aktual');
            $table->string('kondisi_dinding_aktual');
            $table->string('kondisi_lantai_aktual');
            $table->string('ventilasi_aktual');
            $table->string('sanitasi_airbersih_aktual');
            $table->string('kondisi_listrik_aktual');
            $table->boolean('verifikasi_ktp_kk')->default(false);
            $table->boolean('verifikasi_sktm')->default(false);
            $table->boolean('verifikasi_kepemilikan')->default(false);
            $table->boolean('verifikasi_foto_awal')->default(false);
            $table->enum('rekomendasi_petugas', ['Layak', 'Tidak Layak']);
            $table->timestamps();

            $table->foreign('petugas_nip')->references('nip')->on('petugas')->onDelete('cascade');
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
