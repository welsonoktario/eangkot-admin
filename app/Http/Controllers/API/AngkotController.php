<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Angkot;
use GeoJson\Geometry\Point;
use Illuminate\Support\Facades\DB;

class AngkotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $angkots = Angkot::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $angkot = Angkot::with('drivers')->find($id);

        if (!$angkot) {
            return response()->json([
                'status' => 'NOT_AVAIL',
                'msg' => 'Data angkot tidak ditemukan',
            ], 200);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $angkot
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cariAngkot(Request $request)
    {
        $trayek = $request->trayek;
        $titikJemput = new Point($request->titikJemput->latitude, $request->titikJemput->longitude);
        $query = "ST_DISTANCE($titikJemput, lokasi) jarak";

        $angkots = Angkot::select(DB::raw($query))->where('id', $trayek->id)->get();

        if (!$angkots) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Tidak ada angkot tersedia untuk saat ini'
            ]);
        };

        return response()->json([
            'status' => 'OK',
            'data' => $angkots
        ]);
    }
}