<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilModel extends Model
{
    public $timestamps = true;

    use HasFactory;

    protected $table = 'profil';

    protected $fillable = [
        'id_user', 'nik', 'jenis_kelamin', 'avatar', 'tempat_lahir', 'tanggal_lahir', 'pendidikan',
        'tahun_pendidikan', 'alamat', 'nomor_hp', 'ktp', 'ijazah'
    ];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
