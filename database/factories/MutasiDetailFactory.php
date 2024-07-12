<?php

namespace Database\Factories;

use App\Models\Mutasi;
use App\Models\MutasiDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MutasiDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MutasiDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mutasi_id' => Mutasi::factory(), // Menggunakan factory untuk membuat Mutasi terkait
            'nama_barang' => $this->faker->word,
            'merk' => $this->faker->word,
            'kategori' => $this->faker->randomElement(['Baru', 'Mutasi', 'Rusak']),
            'no_inventaris' => $this->faker->unique()->numerify('INV-####'),
            'keterangan' => $this->faker->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
