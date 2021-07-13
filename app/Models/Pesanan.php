<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use SpatialTrait;

    protected $fillable = [
        'user_id',
        'driver_id',
        'penumpang',
        'rute',
        'status'
    ];
    protected $spatialFields = ['rute'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class);
    }
}
