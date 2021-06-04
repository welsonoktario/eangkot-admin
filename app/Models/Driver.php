<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = ['user_id', 'angkot_id', 'bank_id', 'alamat', 'nik', 'rekening'];
    protected $hidden = ['bank_id', 'nik', 'rekening', 'alamat'];

    public function user()
    {
        return $this->belongsTo(User::class);
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
