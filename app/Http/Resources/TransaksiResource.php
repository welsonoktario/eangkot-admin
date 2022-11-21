<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class TransaksiResource extends JsonResource
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
            'ongkos' => $this->ongkos,
            'durasiPerjalanan' => $this->durasi_perjalanan,
            'jarakPerjalanan' => $this->jarak_perjalanan,
            'lokasiJemput' => $this->lokasi_jemput,
            'lokasiTujuan' => $this->lokasi_tujuan,
            'tanggal' => Carbon::parse($this->created_at, 'Asia/Jakarta')->translatedFormat('d F Y, H:i:s'),
            'driver' => DriverResource::make($this->whenLoaded('driver')),
            'user' => UserResource::make($this->whenLoaded('user')),
            'ulasan' => UlasanResource::make($this->whenLoaded('ulasan'))
        ];
    }
}
