<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

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
            'jemput' => [
                'lat' => $this->jemput->latitude,
                'long' => $this->jemput->longitude
            ],
            'tujuan' => [
                'lat' => $this->tujuan->latitude,
                'long' => $this->tujuan->longitude
            ],
            'penumpang' => $this->penumpang,
            'status' => $this->status,
            'tanggal' => Carbon::parse($this->created_at, 'Asia/Jakarta')->translatedFormat('d F Y, H:i:s'),
            'user' => UserResource::make($this->whenLoaded('user')),
            'driver' => DriverResource::make($this->whenLoaded('driver')),
            'transaksi' => TransaksiResource::make($this->whenLoaded('transaksi'))
        ];
    }
}
