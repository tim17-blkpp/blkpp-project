<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanUserModel extends Model
{
    use HasFactory;

    protected $table = 'jawaban_user';

    protected $fillable = [
        'id_soal', 'id_user', 'jawaban', 'poin', 'status'
    ];

    protected $hidden = [];

    public function pilihan_jawaban()
    {
        return $this->hasOne(PilihanJawabanModel::class, 'id_soal', 'id');
    }
}
