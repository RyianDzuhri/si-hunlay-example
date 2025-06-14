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
                $table->foreignId('pengajuan_id')->unique()->constrained('pengajuan')->onDelete('cascade');
                $table->bigInteger('petugas_nip');
                $table->date('tgl_survey');
                $table->enum('status_kepemilikan', ['Milik Sendiri', 'Sewa', 'Menumpang', 'Tidak Jelas']);
                $table->enum('verifikasi_ekonomi', ['Sesuai', 'Tidak Sesuai']);
                $table->text('detail_verifikasi_dokumen')->nullable();
                $table->text('catatan_survei')->nullable();
                $table->text('bukti_survei')->nullable();
                $table->enum('status_rekomendasi', ['Layak', 'Tidak Layak']);
                $table->string('alasan_penolakan')->nullable();
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
