<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Favorit;
use Exception;
use GeoJson\Geometry\MultiPoint;
use GeoJson\Geometry\Point;
use Illuminate\Http\Request;

class FavoritController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $favorits = Favorit::with('trayek')->where('user_id', $request->user)->get();

        if (!$favorits) {
            return response()->json([
                'status' => 'FAIL',
                'msg' => 'Not found',
            ], 500);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $favorits,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $lokasi_jemput = new Point($request->jemput->lat, $request->jemput->lng);
            $lokasi_tujuan = new Point($request->tujuan->lat, $request->jemput->lng);
            $favorit = Favorit::create([
                'nama' => $request->nama,
                'rute' => new MultiPoint([$lokasi_jemput, $lokasi_tujuan])
            ]);

            $favorit->user()->associate($request->user_id);
            $favorit->trayek()->associate($request->angkot_id);
        } catch (Exception $err) {
            return response()->json([
                'status' => 'FAIL',
                'msg' => $err->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $favorit,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $favorit = Favorit::with(['user', 'trayek'])->find($id);

        if (!$favorit) {
            return response()->json([
                'status' => 'FAIL',
                'msg' => 'Data favorit tidak ditemukan',
            ], 500);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $favorit,
        ]);
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
        $favorit = Favorit::firstWhere([
            ['id', $id],
            ['user_id', $request->user]
        ]);

        if (!$favorit) {
            return response()->json([
                'status' => 'FAIL',
                'msg' => 'Data favorit tidak ditemukan'
            ], 500);
        }

        try {
            $lokasi_jemput = new Point($request->jemput->lat, $request->jemput->lng);
            $lokasi_tujuan = new Point($request->tujuan->lat, $request->jemput->lng);
            $favorit->update([
                'name' => $request->name,
                'rute' => new MultiPoint([$lokasi_jemput, $lokasi_tujuan])
            ]);

            if ($request->has('trayek_id')) $favorit->trayek()->associate($request->trayek);
        } catch (Exception $err) {
            return response()->json([
                'status' => 'FAIL',
                'msg' => $err->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $favorit,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $favorit = Favorit::find($id);

        if (!$favorit) {
            return response()->json([
                'status' => 'FAIL',
                'msg' => 'Data favorit tidak ditemukan'
            ], 404);
        }

        if (!$favorit->delete()) {
            return response()->json([
                'status' => 'FAIL',
                'msg' => 'Terjadi kesalahan menghapus favorit'
            ], 500);
        }

        return response()->json([
            'status' => 'OK'
        ], 200);
    }
}
