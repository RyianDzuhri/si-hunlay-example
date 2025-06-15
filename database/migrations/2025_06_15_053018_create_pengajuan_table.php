<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warga_nik')->unique();
            $table->bigInteger('petugas_nip')->nullable();
            $table->foreignId('kelurahan_id')->constrained('kelurahan')->onDelete('cascade');
            $table->text('alamat_lengkap');
            $table->date('tgl_pengajuan');
            $table->enum('status', ['DIAJUKAN', 'DOKUMEN_LENGKAP', 'PROSES_SURVEY', 'EVALUASI_AKHIR', 'DISETUJUI', 'DITOLAK'])->default('DIAJUKAN');
            $table->tinyInteger('jumlah_penghuni');
            $table->string('pekerjaan', 100);
            $table->double('penghasilan')->nullable();
            $table->string('kondisi_atap');
            $table->string('kondisi_dinding');
            $table->string('kondisi_lantai');
            $table->string('ventilasi_pencahayaan');
            $table->string('sanitasi_airbersih');
            $table->decimal('luas_rumah', 8, 2);
            $table->timestamps();

            // Definisi Foreign Keys
            $table->foreign('warga_nik')->references('nik')->on('warga')->onDelete('cascade');
            $table->foreign('petugas_nip')->references('nip')->on('petugas')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
