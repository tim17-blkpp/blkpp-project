<?php

namespace Database\Seeders;

use App\Models\KategoriPelatihanModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriPelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        KategoriPelatihanModel::factory(5)->create();
    }
}
