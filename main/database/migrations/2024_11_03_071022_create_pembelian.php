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
        Schema::create('pembelian', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('id_pemesanan');
            $table->foreign('id_pemesanan')->references('id')->on('detail_pembelian');
            $table->integer('total');
            $table->string('tipe_pembayaran');
            $table->string('kode_pembayaran');
            $table->binary('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian');
    }
};
