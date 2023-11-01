<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PilihanJawabanModel extends Model
{
    use HasFactory;

    protected $table = 'pilihan_jawaban';

    protected $fillable = [
        'id_soal', 'pilihan_jawaban', 'pilihan_jawaban_gambar', 'poin', 'status'
    ];

    protected $hidden = [];
}
