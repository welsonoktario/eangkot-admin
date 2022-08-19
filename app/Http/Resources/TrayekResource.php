<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrayekResource extends JsonResource
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
            'id' => $this->id,
            'kode' => $this->kode,
            'rute' => $this->rute,
            'ruteBerangkat' => $this->rute_berangkat,
            'rutePulang' => $this->rute_pulang,
            'gambar' => $this->gambar
        ];
    }
}
