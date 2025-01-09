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
        Schema::create('event', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('id_penjual');
            $table->foreign('id_penjual')->references('id')->on('users');
            $table->string('banner')->nullable();
            $table->string('nama_event');
            $table->boolean('jenis_event');
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_akhir');
            $table->string('lokasi'); 
            $table->string("deskripsi")->nullable();
            $table->string("syarat_ketentuan")->nullable();
            $table->string("nama_kontak");
            $table->string("email_kontak");
            $table->string("tlp_kontak");
            $table->string("denah")->nullable();
            $table->integer("pembelian_maksimum")->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event');
    }
};
