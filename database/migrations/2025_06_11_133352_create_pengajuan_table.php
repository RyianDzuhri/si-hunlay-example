<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_create_pengajuan_table.php

    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            
            // Foreign key ke warga (dengan batasan UNIQUE)
            $table->unsignedBigInteger('warga_nik')->unique();
            $table->foreign('warga_nik')->references('nik')->on('warga')->onDelete('cascade');
            
            // Foreign key ke petugas (bisa NULL)
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
            
            $table->string('kecamatan', 100);
            $table->string('kelurahan', 100);
            $table->text('alamat_lengkap');
            $table->tinyInteger('jumlah_penghuni');
            $table->string('pekerjaan', 100);
            $table->double('penghasilan')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
