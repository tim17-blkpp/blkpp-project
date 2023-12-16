<?php

namespace Database\Seeders;

use App\Models\PelatihanModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PelatihanModel::factory()->count(10)->create();
    }
}
