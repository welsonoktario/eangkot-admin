<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }

    public function ulasan()
    {
        return $this->hasOne(Ulasan::class);
    }

    public function detail()
    {
        return $this->hasOne(TransaksiDetail::class);
    }
}