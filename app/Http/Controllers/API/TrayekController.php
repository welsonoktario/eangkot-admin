<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Trayek;
use Illuminate\Http\Request;

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
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Gagal memuat data angkot'
            ], 500);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $trayeks
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trayek = Trayek::find($id);

        if (!$trayek) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Data trayek tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $trayek
        ], 200);
    }
}
