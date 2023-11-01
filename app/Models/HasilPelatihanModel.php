<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPelatihanModel extends Model
{
    use HasFactory;

    protected $table = 'hasil_pelatihan';

    protected $fillable = [
        'id_pelatihan', 'id_sesi', 'id_user', 'status_seleksi_administrasi', 'hasil_seleksi_administrasi', 'status_seleksi_tes',
        'hasil_seleksi_tes', 'status_seleksi_wawancara', 'hasil_seleksi_wawancara', 'status_seleksi_daftar_ulang',
        'hasil_seleksi_daftar_ulang', 'pakta_integritas', 'keterangan', 'sertifikat', 'status'
    ];

    protected $hidden = [];

    public function pelatihan()
    {
        return $this->hasOne(PelatihanModel::class, 'id', 'id_pelatihan');
    }

    public function sesi()
    {
        return $this->hasOne(SesiPelatihanModel::class, 'id', 'id_sesi');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
