<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\SpatialBuilder;

/**
 * @property Point $lokasi
 * @method static SpatialBuilder query()
 */
class Angkot extends Model
{
use SoftDeletes;

    protected $guarded = ['id'];
    protected $columns = ['id', 'trayek_id', 'no_kendaraan', 'aktif', 'lokasi'];
    protected $casts = ['lokasi' => Point::class];

    public function newEloquentBuilder($query): SpatialBuilder
    {
        return new SpatialBuilder($query);
    }

    public function scopeExclude($query, $value = [])
    {
        return $query->select(array_diff($this->columns, (array) $value));
    }

    public function trayek()
    {
        return $this->belongsTo(Trayek::class);
    }

    public function driver()
    {
        return $this->hasOne(Driver::class);
    }
}
