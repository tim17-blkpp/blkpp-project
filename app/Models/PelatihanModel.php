<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelatihanModel extends Model
{
    use HasFactory;

    protected $table = 'pelatihan';

    protected $fillable = [
        'id_kategori', 'id_jpl', 'judul', 'gambar', 'deskripsi', 'dilihat', 'status'
    ];

    protected $hidden = [];

    public function kategori()
    {
        return $this->hasOne(KategoriPelatihanModel::class, 'id', 'id_kategori');
    }

    public function jpl()
    {
        return $this->hasOne(JPLModel::class, 'id', 'id_jpl');
    }

    public function sesi()
    {
        return $this->hasMany(SesiPelatihanModel::class, 'id_pelatihan', 'id');
    }
}
