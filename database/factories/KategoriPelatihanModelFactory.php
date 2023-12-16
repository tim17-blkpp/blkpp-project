<?php

namespace Database\Factories;

use App\Models\KategoriPelatihanModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */

class KategoriPelatihanModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = KategoriPelatihanModel::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->randomElement(['Bisnis Manajemen', 'Elektronika', 'Desain dan Kreatif', 'Tata Boga', 'Manajemen Produktivitas']),
            'status' => 1,
        ];
    }
}
