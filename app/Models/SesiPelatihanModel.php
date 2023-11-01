<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesiPelatihanModel extends Model
{
    use HasFactory;

    protected $table = 'sesi_pelatihan';

    protected $fillable = [
        'id_pelatihan', 'judul', 'jumlah_peserta', 'deskripsi', 'status'
    ];

    protected $hidden = [];

    public function pelatihan()
    {
        return $this->hasOne(PelatihanModel::class, 'id', 'id_pelatihan');
    }
}
