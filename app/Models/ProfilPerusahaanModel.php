<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilPerusahaanModel extends Model
{
    public $timestamps = true;

    use HasFactory;

    protected $table = 'profil_perusahaan';

    protected $fillable = [
        'id_user', 'avatar', 'alamat', 'nomor_hp', 'deskripsi'
    ];

    protected $hidden = [];
}
