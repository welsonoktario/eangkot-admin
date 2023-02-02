<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $hidden = ['alamat'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trayek()
    {
        return $this->belongsTo(Trayek::class);
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
