<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PesananResource extends JsonResource
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
            'jemput' => $this->jemput,
            'tujuan' => $this->tujuan,
            'penumpang' => $this->penumpang,
            'status' => $this->status,
            'user' => UserResource::make($this->whenLoaded('user')),
            'driver' => DriverResource::make($this->whenLoaded('driver')),
            'transaksi' => TransaksiResource::make($this->whenLoaded('transaksi'))
        ];
    }
}
