<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    protected $primaryKey = 'transaksi_id';
    protected $guarded = ['transaksi_id'];
    protected $casts = [
        'jarak' => 'float'
    ];
    public $incrementing = false;

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
