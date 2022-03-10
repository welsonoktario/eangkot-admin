<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\SpatialBuilder;

/**
 * @property Point $lokasi
 * @method static SpatialBuilder query()
 */
class Favorit extends Model
{
    protected $fillable = ['user_id', 'trayek_id', 'nama', 'alamat', 'tujuan'];
    protected $casts = ['tujuan' => Point::class];
    public $timestamps = false;

    public function newEloquentBuilder($query): SpatialBuilder
    {
        return new SpatialBuilder($query);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trayek()
    {
        return $this->belongsTo(Trayek::class);
    }
}
