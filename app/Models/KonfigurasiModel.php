<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonfigurasiModel extends Model
{
    use HasFactory;

    protected $table = 'konfigurasi';

    protected $fillable = [
        'nama_sistem', 'nama_instansi', 'logo', 'telp', 'email', 'alamat'
    ];

    protected $hidden = [];
}
