<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}