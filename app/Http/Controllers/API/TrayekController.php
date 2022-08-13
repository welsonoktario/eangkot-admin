<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Trayek;

class TrayekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trayeks = Trayek::all(['id', 'kode', 'rute']);

        if (!$trayeks) {
            return $this->fail('Terjadi kesalahan memuat data trayek');
        }

        return $this->success(null, $trayeks);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trayek  $trayek
     * @return \Illuminate\Http\Response
     */
    public function show($trayek)
    {
        if (!$trayek) {
            return $this->fail('Terjadi kesalahan memuat data trayek');
        }

        return $this->success(null, $trayek);
    }
}
