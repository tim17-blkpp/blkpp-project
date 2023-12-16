<?php

namespace Database\Factories;

use App\Models\PelatihanModel;
use App\Models\SesiPelatihanModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SesiPelatihanModel>
 */
class SesiPelatihanModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $pelatihan = PelatihanModel::all()->random();
        // $count_angkatan = SesiPelatihanModel::where('id_pelatihan', $pelatihan->id)->count()+1;
        // $count_angkatan = $pelatihan->sesi->count()+1;
        $count_angkatan = rand(1, 3);
        $angkatan = $this->intToRoman($count_angkatan);
        $judul = $pelatihan->judul . ' Angkatan ' . $angkatan;

        return [
            'id_pelatihan' => $pelatihan->id,
            'judul' => $judul,
            'deskripsi' => $this->faker->sentences(6, true),
            'jumlah_peserta' => $this->faker->randomElement([20, 40, 50, 100]),
            'angkatan' => $angkatan,
            'sesi_dibuka' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'sesi_ditutup' => $this->faker->dateTimeBetween('+1 month', '+2 month'),
            'status' => 1
        ];
    }

    private function intToRoman($num) {
        $roman = '';
        $romanNumerals = [
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1,
        ];
        foreach ($romanNumerals as $symbol => $value) {
            while ($num >= $value) {
                $roman .= $symbol;
                $num -= $value;
            }
        }
        return $roman;
    }
}
