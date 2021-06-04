<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public function driver()
    {
        return $this->hasMany(Driver::class);
    }

    public function pengajuanDriverDetail()
    {
        return $this->hasMany(PengajuanDriverDetail::class);
    }
}