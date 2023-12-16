<?php

namespace Database\Factories;

use App\Models\JPLModel;
use App\Models\KategoriPelatihanModel;
use App\Models\PelatihanModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PelatihanModel>
 */
class PelatihanModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = PelatihanModel::class;

    public function definition()
    {
        $id_kategori = KategoriPelatihanModel::inRandomOrder()->first()->id;
        $id_jpl = JPLModel::inRandomOrder()->first()->id;
        $judul = $this->faker->randomElement(['Pembuatan Produk Roti dan Pattiserie', 'Pelatihan Peningkatan Produktivitas',
                                            'Desain UI/UX dengan Figma bagi Desainer Website', 'Pelatihan Embedded System',
                                            'Pelatihan Peningkatan Produktivitas']);
        $deskripsi = $this->faker->sentences(6, true);

        return [
            'id_kategori' => $id_kategori,
            'id_jpl' => $id_jpl,
            'judul' => $judul,
            // 'gambar' => $this->faker->imageUrl(640, 480, 'animals', true),
            'deskripsi' => $deskripsi,
            'dilihat' => 0,
            'status' => 1
        ];
    }
}
