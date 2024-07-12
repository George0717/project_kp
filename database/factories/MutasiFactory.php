<?php

namespace Database\Factories;

use App\Models\Mutasi;
use Illuminate\Database\Eloquent\Factories\Factory;

class MutasiFactory extends Factory
{
    protected $model = Mutasi::class;

    public function definition()
    {
        // Generate random date between 2022-01-01 and 2024-12-31
        $randomDate = $this->faker->dateTimeBetween('2022-01-01', '2024-12-31');

        return [
            'divisi_pengirim' => $this->faker->word,
            'penanggung_jawab' => $this->faker->name,
            'dibuat_oleh' => $this->faker->name,
            'lokasi' => $this->faker->randomElement(['Head Office Lemabang / IT']),
            'divisi_tujuan' => $this->faker->randomElement(['IT Support CM Sako', 'IT Support JM Kenten', 'IT Support Center Point Malang','IT Support Center Point Lampung', 'IT Support Grand', 'IT Support Central Pavilion','IT Support JM Kenten']),
            'foto_mutasi' => 'https://picsum.photos/200/300', // Contoh penggunaan URL gambar placeholder dari Lorem Picsum
            'created_at' => $randomDate,
            'updated_at' => $randomDate,
        ];
    }
}
