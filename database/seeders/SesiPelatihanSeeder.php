<?php

namespace Database\Seeders;

use App\Models\SesiPelatihanModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SesiPelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SesiPelatihanModel::factory()->count(20)->create();
    }
}
