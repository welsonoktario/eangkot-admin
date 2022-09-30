<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TrayekCollection;
use App\Http\Resources\TrayekResource;
use App\Models\Trayek;
use Illuminate\Support\Facades\Cache;

class TrayekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trayeks = Cache::store('redis')->get('trayeks');

        if (!$trayeks) {
            $trayeks = Trayek::query()
                ->orderBy('kode')
                ->get();

            Cache::store('redis')->set('trayeks', $trayeks);
        }

        if (!$trayeks) {
            return $this->fail('Terjadi kesalahan memuat data trayek');
        }

        return $this->success(null, new TrayekCollection($trayeks));
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

        return $this->success(null, new TrayekResource($trayek));
    }
}
