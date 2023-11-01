<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KonfigurasiSeeder extends Seeder
{
    public function run()
    {
        DB::table('konfigurasi')->insert([
            'nama_sistem' => 'Nama Sistem Anda',
            'nama_instansi' => 'Nama Instansi Anda',
            'telp' => '123456789',
            'alamat' => 'Alamat Instansi Anda',
            'email' => 'email@instansianda.com',
        ]);
    }
}
