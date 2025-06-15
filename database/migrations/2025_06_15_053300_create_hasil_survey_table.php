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

            // Foreign key ke tabel pengajuan, unik karena 1 pengajuan hanya 1 hasil verifikasi
            $table->foreignId('pengajuan_id')->unique()->constrained('pengajuan')->onDelete('cascade');
            
            // Foreign key ke tabel petugas
            $table->BigInteger('petugas_nip');
            $table->foreign('petugas_nip')->references('nip')->on('petugas');
            
            $table->date('tgl_survey');
            
            // Hasil verifikasi kondisi fisik (disimpan sebagai TEXT untuk menampung string panjang)
            $table->text('kondisi_atap_aktual')->nullable();
            $table->text('kondisi_dinding_aktual')->nullable();
            $table->text('kondisi_lantai_aktual')->nullable();
            $table->text('ventilasi_pencahayaan_aktual')->nullable();
            $table->text('sanitasi_airbersih_aktual')->nullable();

            // Hasil verifikasi non-fisik
            $table->enum('status_kepemilikan', ['Milik Sendiri', 'Sewa', 'Menumpang', 'Tidak Jelas']);
            $table->enum('verifikasi_ekonomi', ['Sesuai', 'Tidak Sesuai']);
            $table->text('detail_verifikasi_dokumen')->nullable(); // Disimpan sebagai string dipisah koma

            // Catatan dan bukti dari petugas
            $table->text('catatan_survei')->nullable();
            $table->text('bukti_survei')->nullable(); // Disimpan sebagai string dipisah koma
            
            // Keputusan akhir
            $table->enum('status_rekomendasi', ['Layak', 'Tidak Layak']);
            $table->string('alasan_penolakan')->nullable();

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
