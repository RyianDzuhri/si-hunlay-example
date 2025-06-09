<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    if (!Schema::hasTable('admin_dinas')) {
        Schema::create('admin_dinas', function (Blueprint $table) {
            $table->bigInteger('nip')->primary();
            $table->unsignedBigInteger('id_user')->unique(); // UBAH dari unsignedInteger menjadi unsignedBigInteger
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
}

    public function down()
    {
        Schema::dropIfExists('admin_dinas');
    }
};