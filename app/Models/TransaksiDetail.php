<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    protected $primaryKey = 'transaksi_id';
    public $incrementing = false;

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}