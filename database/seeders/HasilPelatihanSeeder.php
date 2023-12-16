<?php

namespace Database\Seeders;

use App\Models\HasilPelatihanModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HasilPelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HasilPelatihanModel::factory(500)->create();
    }
}
