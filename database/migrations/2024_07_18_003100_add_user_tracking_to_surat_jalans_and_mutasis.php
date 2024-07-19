<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat_jalans', function (Blueprint $table) {
            if (!Schema::hasColumn('surat_jalans', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable()->after('divisi_pengirim');
                $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            }
            if (!Schema::hasColumn('surat_jalans', 'updated_by')) {
                $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
                $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            }
            if (!Schema::hasColumn('surat_jalans', 'deleted_by')) {
                $table->unsignedBigInteger('deleted_by')->nullable()->after('updated_by');
                $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
            }
        });

        Schema::table('mutasis', function (Blueprint $table) {
            if (!Schema::hasColumn('mutasis', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable()->after('foto_mutasi');
                $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            }
            if (!Schema::hasColumn('mutasis', 'updated_by')) {
                $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
                $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            }
            if (!Schema::hasColumn('mutasis', 'deleted_by')) {
                $table->unsignedBigInteger('deleted_by')->nullable()->after('updated_by');
                $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('surat_jalans', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
            $table->dropColumn(['created_by', 'updated_by', 'deleted_by']);
        });

        Schema::table('mutasis', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
            $table->dropColumn(['created_by', 'updated_by', 'deleted_by']);
        });
    }
};
