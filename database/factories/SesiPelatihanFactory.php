<?php

namespace Database\Factories;

use App\Models\PelatihanModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SesiPelatihanModel>
 */
class SesiPelatihanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $pelatihan = PelatihanModel::factory()->create();

        return [
            //
        ];
    }
}
