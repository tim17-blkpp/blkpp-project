<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalModel extends Model
{
    use HasFactory;

    protected $table = 'soal';

    protected $fillable = [
        'id_pelatihan', 'nomor', 'tipe', 'pertanyaan', 'pertanyaan_gambar', 'kunci_jawaban', 'status'
    ];

    protected $hidden = [];

    public function pilihan_jawaban()
    {
        return $this->hasMany(PilihanJawabanModel::class, 'id_soal', 'id');
    }

    // public function jawaban_user($id_user)
    // {
    //     return $this->hasOne(JawabanUserModel::class, 'id_soal', 'id')->where('id_user', $id_user);
    // }
}
