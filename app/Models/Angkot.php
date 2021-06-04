<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Angkot extends Model
{
    use SpatialTrait;

    protected $fillable = ['trayek_id', 'no_kendaraan', 'aktif', 'lokasi'];
    protected $columns = ['id', 'trayek_id', 'no_kendaraan', 'aktif', 'lokasi'];
    protected $spatialFields = ['lokasi'];

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
