<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Database\Seeder;
use App\Models\Mutasi;
use App\Models\MutasiDetail;
use App\Models\SuratJalan;
use App\Models\SuratJalanDetail;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        Mutasi::factory()->count(120)->create()->each(function ($mutasi) {
            MutasiDetail::factory()->count(rand(1, 5))->create(['mutasi_id' => $mutasi->id]);
        });
        SuratJalan::factory(243)->create()->each(function ($suratJalan) {
            SuratJalanDetail::factory(rand(1, 5))->create(['surat_jalan_id' => $suratJalan->id]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        });
    }
}

