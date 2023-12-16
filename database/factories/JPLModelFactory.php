<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JPLModel>
 */
class JPLModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'tahun' => $this->faker->numberBetween(2020, 2023),
            'anggaran' => $this->faker->randomElement(['APBN', 'APBD', 'APBN Covid']),
            'pelatihan' => $this->faker->randomElement(['COBA JPL', 'DBHCHT', 'DID', 'INSTITUSIONAL']),
            'kode' => $this->faker->unique()->numerify('####'),
            'jpl' => $this->faker->unique()->numerify('####'),
            'status' => '1'
        ];
    }
}
