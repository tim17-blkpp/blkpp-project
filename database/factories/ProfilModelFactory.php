<?php

namespace Database\Factories;

use App\Models\ProfilModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfilModel>
 */
class ProfilModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = ProfilModel::class;

    public function definition()
    {
        $user = User::factory()->create();
        $nik = $this->faker->unique()->numerify('################');
        $jenis_kelamin = 'L';
        if ((int)(substr($nik, 6, 2)) > 40) {
            $jenis_kelamin = 'P';
        }
        return [
            //
            'id_user' => $user->id,
            'nik' => $nik,
            'jenis_kelamin' => $jenis_kelamin,
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'pendidikan' => $this->faker->randomElement(['SMA', 'SMK', 'D3', 'S1', 'S2', 'S3']),
            'tahun_pendidikan' => $this->faker->year(),
            // 'alamat' => $this->faker->address(),
            'nomor_hp' => $this->faker->phoneNumber(),
        ];
    }
}
