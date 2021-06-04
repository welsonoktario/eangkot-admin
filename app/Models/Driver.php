<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Driver extends Model
{
    use SpatialTrait;

    protected $fillable = ['angkot_id', 'no_kendaraan'];
    protected $hidden = ['bank_id', 'nik', 'rekening', 'alamat'];
    protected $spatialFields = ['lokasi'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function angkot()
    {
        return $this->belongsToMany(Angkot::class, 'driver_angkot');
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function pengajuanBonus()
    {
        return $this->hasMany(PengajuanBonus::class);
    }
}
