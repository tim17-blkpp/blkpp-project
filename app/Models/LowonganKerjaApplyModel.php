<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowonganKerjaApplyModel extends Model
{
    use HasFactory;

    protected $table = 'lowongan_kerja_apply';

    protected $fillable = [
        'id_user', 'id_lowongan_kerja', 'keterangan', 'status'
    ];

    protected $hidden = [];

    public function lowongan_kerja()
    {
        return $this->hasOne(LowonganKerjaModel::class, 'id', 'id_lowongan_kerja');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
