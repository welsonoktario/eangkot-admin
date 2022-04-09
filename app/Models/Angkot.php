<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\SpatialBuilder;

class Angkot extends Model
{
    protected $fillable = ['trayek_id', 'no_kendaraan', 'aktif', 'lokasi'];
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

    public function drivers()
    {
        return $this->belongsToMany(Driver::class, 'driver_angkot');
    }
}
