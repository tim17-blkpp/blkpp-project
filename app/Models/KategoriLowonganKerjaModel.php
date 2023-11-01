<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriLowonganKerjaModel extends Model
{
    use HasFactory;

    protected $table = 'kategori_lowongan_kerja';

    protected $fillable = [
        'id_induk', 'nama', 'deskripsi', 'status'
    ];

    protected $hidden = [];

    public function sub_kategori()
    {
        return $this->hasMany(KategoriLowonganKerjaModel::class, 'id_induk', 'id');
    }
}
