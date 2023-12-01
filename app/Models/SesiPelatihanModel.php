<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HasilPelatihanModel;

class SesiPelatihanModel extends Model
{
    use HasFactory;

    protected $table = 'sesi_pelatihan';

    protected $fillable = [
        'id_pelatihan', 'judul', 'jumlah_peserta', 'angkatan', 'sesi_dibuka', 'sesi_ditutup', 'deskripsi', 'status'
    ];

    protected $hidden = [];

    public function pelatihan()
    {
        return $this->hasOne(PelatihanModel::class, 'id', 'id_pelatihan');
    }

    public function pendaftar()
    {
        return $this->hasMany(HasilPelatihanModel::class, 'id_sesi', 'id');
    }
}
