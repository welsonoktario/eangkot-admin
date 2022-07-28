<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $hidden = ['bank_id', 'nik', 'rekening', 'alamat'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rekenings()
    {
        return $this->belongsToMany(Bank::class, 'driver_banks');
    }

    public function angkot()
    {
        return $this->belongsTo(Angkot::class);
    }

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class);
    }
}
