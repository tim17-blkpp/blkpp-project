<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowonganKerjaModel extends Model
{
    use HasFactory;

    protected $table = 'lowongan_kerja';

    protected $fillable = [
        'id_kategori', 'id_perusahaan', 'judul', 'gambar', 'gaji_min',
        'gaji_max', 'tipe_pekerjaan', 'deskripsi', 'dilihat', 'status'
    ];

    protected $hidden = [];

    public function kategori()
    {
        return $this->hasOne(KategoriLowonganKerjaModel::class, 'id', 'id_kategori');
    }

    public function perusahaan()
    {
        return $this->hasOne(User::class, 'id', 'id_perusahaan');
    }
}
