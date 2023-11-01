<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JPLModel extends Model
{
    use HasFactory;

    protected $table = 'jpl';

    protected $fillable = [
        'tahun', 'anggaran', 'pelatihan', 'kode', 'jpl', 'status'
    ];

    protected $hidden = [];
}
