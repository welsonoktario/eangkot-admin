<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanDriver extends Model
{
    protected $fillable = ['trayek_id', 'tanggal', 'status'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trayek()
    {
        return $this->belongsTo(Trayek::class);
    }

    public function detail()
    {
        return $this->hasOne(PengajuanDriverDetail::class);
    }
}
