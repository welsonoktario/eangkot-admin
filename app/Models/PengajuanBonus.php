<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanBonus extends Model
{
    protected $table = 'pengajuan_bonus';

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
