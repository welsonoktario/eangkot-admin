<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Favorit extends Model
{
    use SpatialTrait;
    protected $spatialFields = ['rute'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trayek()
    {
        return $this->belongsTo(Trayek::class);
    }
}
