<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\SpatialBuilder;

/**
 * @property Point $jemput
 * @property Point $tujuan
 * @method static SpatialBuilder query()
 */
class Pesanan extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'jemput' => Point::class,
        'tujuan' => Point::class
    ];

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
