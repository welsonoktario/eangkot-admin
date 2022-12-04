<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trayek extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function angkots()
    {
        return $this->hasMany(Angkot::class);
    }

    public function trayeks()
    {
        return $this->hasMany(PengajuanDriver::class);
    }
}
