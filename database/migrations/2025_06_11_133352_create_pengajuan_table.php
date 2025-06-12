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
            $table->foreign('warga_nik')->references('nik')->on('warga')->onDelete('cascade');

            $table->bigInteger('petugas_nip')->nullable();
            $table->foreign('petugas_nip')->references('nip')->on('petugas')->onDelete('set null');

            $table->date('tgl_pengajuan');
            $table->enum('status', [
                'DIAJUKAN',
                'DOKUMEN_LENGKAP',
                'PROSES_SURVEY',
                'EVALUASI_AKHIR',
                'DISETUJUI',
                'DITOLAK'
            ])->default('DIAJUKAN');

            $table->foreignId('kecamatan_id')
                  ->nullable()
                  ->constrained('kecamatan')
                  ->onDelete('set null');

            $table->foreignId('kelurahan_id')
                  ->nullable()
                  ->constrained('kelurahan')
                  ->onDelete('set null');

            $table->text('alamat_lengkap');
            $table->tinyInteger('jumlah_penghuni');
            $table->string('pekerjaan', 100);
            $table->double('penghasilan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
