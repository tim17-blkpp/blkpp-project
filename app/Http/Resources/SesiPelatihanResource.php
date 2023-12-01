<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SesiPelatihanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'tahun' => $this->pelatihan->jpl->tahun,
            'anggaran' => $this->pelatihan->jpl->anggaran,
            'angkatan' => $this->angkatan,
            'kategori' => $this->pelatihan->kategori->nama,
            'pelatihan' => $this->pelatihan->judul,
        ];
    }
}
