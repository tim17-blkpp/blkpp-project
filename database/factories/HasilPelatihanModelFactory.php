<?php

namespace Database\Factories;

use App\Models\ProfilModel;
use App\Models\SesiPelatihanModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HasilPelatihanModel>
 */
class HasilPelatihanModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $profil = ProfilModel::factory()->create();
        $sesi = SesiPelatihanModel::all()->random();
        $pelatihan = $sesi->pelatihan;

        return [
            'id_pelatihan' => $pelatihan->id,
            'id_sesi' => $sesi->id,
            'id_user' => $profil->user->id,
            'keterangan' => $this->faker->randomElement(['Lulus', 'Tidak Lulus', null]),
            'status' => 1
        ];
    }
}
