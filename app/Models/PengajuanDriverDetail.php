<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanDriverDetail extends Model
{
    protected $fillable = ['bank_id', 'nama', 'nik', 'no_kendaraan', 'alamat', 'rekening'];
    public $timestamps = false;

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanDriver::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
