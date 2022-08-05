<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public function driver()
    {
        return $this->belongsToMany(Driver::class, 'driver_banks');
    }
}
