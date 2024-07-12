<?php

namespace Database\Factories;

use App\Models\SuratJalan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class SuratJalanFactory extends Factory
{
    protected $model = SuratJalan::class;

    public function definition()
    {
        $faker = \Faker\Factory::create();

        return [
            'nomorSurat' => $faker->unique()->randomNumber(6),
            'tglKirim' => $faker->dateTimeBetween('2022-01-01', '2024-12-31'),
            'tujuanTempat' => $faker->randomElement([
                'Grand JM', 'JM Lemabang', 'Gudang Bambang Utoyo', 'CM Sako',
                'Center Point Malang', 'Center Point Lampung', 'JM Kenten',
                'JM Sukarami', 'JM Plaju'
            ]),
            'foto' => 'https://picsum.photos/200/300',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
