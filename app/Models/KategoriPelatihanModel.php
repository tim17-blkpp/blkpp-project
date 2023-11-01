<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPelatihanModel extends Model
{
    use HasFactory;

    protected $table = 'kategori_pelatihan';

    protected $fillable = [
        'id_induk', 'nama', 'deskripsi', 'status'
    ];

    protected $hidden = [];

    public function sub_kategori()
    {
        return $this->hasMany(KategoriPelatihanModel::class, 'id_induk', 'id');
    }
}
