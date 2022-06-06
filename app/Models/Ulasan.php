<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $guarded = ['id', 'transaksi_id'];
    protected $casts = [
        'rating' => 'integer'
    ];

    public $timestamps = false;

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
