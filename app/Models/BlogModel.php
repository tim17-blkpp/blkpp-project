<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
    use HasFactory;

    protected $table = 'blog';

    protected $fillable = [
        'id_kategori', 'judul', 'gambar', 'deskripsi', 'dilihat', 'status'
    ];

    protected $hidden = [];

    public function kategori()
    {
        return $this->hasOne(KategoriBlogModel::class, 'id', 'id_kategori');
    }
}
