<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBlogModel extends Model
{
    use HasFactory;

    protected $table = 'kategori_blog';

    protected $fillable = [
        'id_induk', 'nama', 'deskripsi', 'status'
    ];

    protected $hidden = [];

    public function sub_kategori()
    {
        return $this->hasMany(KategoriBlogModel::class, 'id_induk', 'id');
    }
}
