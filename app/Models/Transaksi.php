<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = ['id', 'pesanan_id'];
    protected $casts = [
        'created_at' => 'datetime:d F Y, H:i:s'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function ulasan()
    {
        return $this->hasOne(Ulasan::class);
    }
}
