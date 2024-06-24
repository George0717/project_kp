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
        Schema::create('surat_jalans', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->integer('nomorSurat')->nullable();
            $table->date('tglKirim')->nullable();
            $table->string('namaBarang')->nullable();
            $table->integer('jumlahBarang')->nullable();
            $table->string('tujuanTempat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_jalans');
    }
};
