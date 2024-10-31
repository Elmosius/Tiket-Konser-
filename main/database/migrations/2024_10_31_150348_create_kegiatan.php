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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('id_penjual');
            $table->foreign('id_penjual')->references('id')->on('users');
            $table->string('nama_kegiatan');
            $table->string('keterangan');
            $table->string('lokasi');
            $table->dateTime('jam_mulai');
            $table->dateTime('jam_akhir');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
