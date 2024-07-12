<?php

namespace Database\Factories;

use App\Models\SuratJalanDetail;
use App\Models\SuratJalan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class SuratJalanDetailFactory extends Factory
{
    protected $model = SuratJalanDetail::class;

    public function definition()
    {
        $faker = \Faker\Factory::create();

        return [
            'surat_jalan_id' => SuratJalan::factory(),
            'namaBarang' => $faker->word,
            'jumlahBarang' => $faker->numberBetween(1, 100),
            'kode_barang' => $faker->randomNumber(4),
            'keterangan_barang' => $faker->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
