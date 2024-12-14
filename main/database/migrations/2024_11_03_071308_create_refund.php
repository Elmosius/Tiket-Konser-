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
        Schema::create('refund', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('id_pembelian');
            $table->foreign('id_pembelian')->references('id')->on('pembelian');
            $table->dateTime('tanggal_pengajuan');
            $table->text('alasan');
            $table->string('status_refund');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund');
    }
};
