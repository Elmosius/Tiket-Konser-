<?php

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('nama_role')->unique();
            $table->timestamps();
        });

        $datas = ['Admin'];

        foreach ($datas as $data) {
            DB::table('role')->insert([
                'id' => IdGenerator::generate(['table' => 'role','field'=>'id', 'length' => 10, 'prefix' => 'ROLE-']),
                'nama_role' => $data
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role');
    }
};
