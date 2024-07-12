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
        Schema::create('mutasis', function (Blueprint $table) {
            $table->id();
            // Pengirim
            $table->string('penanggung_jawab');
            $table->string('dibuat_oleh');
            $table->date('tgl_buat');
            // Tujuan
            $table->string('lokasi');
            $table->string('divisi_tujuan');   
            $table->string('foto_mutasi');        
            $table->timestamps();
        });

        Schema::create('mutasi_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mutasi_id'); // Relasi ke mutasis
            $table->string('nama_barang');
            $table->string('merk');
            $table->string('kategori');
            $table->string('no_inventaris');
            $table->string('keterangan');
            $table->timestamps();
            // Foreign key constraint
            $table->foreign('mutasi_id')->references('id')->on('mutasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasis');
    }
};
