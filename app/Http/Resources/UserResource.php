<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'nama' => $this->nama,
            'noHp' => $this->no_hp,
            'email' => $this->email,
            'hasPassword' => $this->has_password,
            'roles' => RoleCollection::make($this->whenLoaded('roles')),
            'driver' => DriverResource::make($this->whenLoaded('driver')),
            'pengajuan' => PengajuanResource::make($this->whenLoaded('pengajuan'))
        ];
    }
}
