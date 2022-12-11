<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanDriver extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'tanggal' => 'datetime:d F Y, H:i:s'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trayek()
    {
        return $this->belongsTo(Trayek::class);
    }
}
