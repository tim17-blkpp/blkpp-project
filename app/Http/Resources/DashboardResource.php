<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
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
            'total_siswa' => $this->total_siswa,
            'count_laki' => $this->count_laki,
            'count_perempuan' => $this->count_perempuan,
            'avg_umur' => $this->avg_umur,
        ];
    }
}
