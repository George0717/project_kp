<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_jalans', function (Blueprint $table) {
            $table->id();
            $table->string('nomorSurat')->unique();
            $table->date('tglKirim');
            $table->string('tujuanTempat');
            $table->string('foto')->nullable();
            $table->string('divisi_pengirim');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('surat_jalan_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_jalan_id'); // Relasi ke surat_jalans
            $table->string('namaBarang');
            $table->integer('jumlahBarang');
            $table->string('kode_barang');
            $table->string('keterangan_barang');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('surat_jalan_id')->references('id')->on('surat_jalans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_jalan_details');
        Schema::dropIfExists('surat_jalans');
    }
};