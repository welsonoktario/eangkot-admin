<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Pesanan extends Model
{
    use SpatialTrait;

    protected $fillable = ['driver_id', 'lokasi_jemput', 'jumlah_penumpang'];
    protected $spatialFields = ['lokasi_jemput'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trayek()
    {
        return $this->belongsTo(Trayek::class);
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