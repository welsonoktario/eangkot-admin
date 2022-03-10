<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\MultiPoint;
use MatanYadaev\EloquentSpatial\SpatialBuilder;

class Pesanan extends Model
{
    protected $fillable = [
        'user_id',
        'driver_id',
        'penumpang',
        'rute',
        'status'
    ];
    protected $casts = ['rute' => MultiPoint::class];

    public function newEloquentBuilder($query): SpatialBuilder
    {
        return new SpatialBuilder($query);
    }

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
