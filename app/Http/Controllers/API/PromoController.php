<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Promo;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promos = Promo::all();

        return response()->json([
            'status' => 'OK',
            'data' => $promos,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promo = Promo::find($id);

        if (!$promo) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Not found',
            ], 404);
        }

        return response()->json([
            'status' => 'GAGAL',
            'data' => $promo,
        ]);
    }
}