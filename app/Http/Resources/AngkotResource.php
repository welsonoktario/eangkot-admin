<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AngkotResource extends JsonResource
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
            'noKendaraan' => $this->no_kendaraan,
            'aktif' => $this->aktif,
            'lokasi' => [
                'lat' => $this->lokasi->latitude,
                'long' => $this->lokasi->longitude
            ],
            'trayek' => TrayekResource::make($this->whenLoaded('trayek'))
        ];
    }
}
