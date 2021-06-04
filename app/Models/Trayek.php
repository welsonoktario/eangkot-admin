<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trayek extends Model
{
    public function angkots()
    {
        return $this->hasMany(Angkot::class);
    }

    public function favorits()
    {
        return $this->hasMany(Favorit::class);
    }

    public function trayeks()
    {
        return $this->hasMany(PengajuanDriver::class);
    }
}