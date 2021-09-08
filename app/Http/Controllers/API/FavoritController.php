<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Favorit;
use App\Models\Trayek;
use Exception;
use Grimzy\LaravelMysqlSpatial\Types\Point;
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
        $favorits = Favorit::with('trayek')->where('user_id', $request->user_id)->get();

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
            $tujuan = $request->tujuan['lokasi'];

            $lokasi_tujuan = new Point($tujuan['lat'], $tujuan['lng']);

            $trayek = Trayek::firstWhere('kode', $request->trayek);

            $favorit = Favorit::create([
                'user_id' => $request->user_id,
                'trayek_id' => $trayek->id,
                'nama' => $request->nama,
                'alamat' => $request->tujuan['alamat'],
                'tujuan' => $lokasi_tujuan
            ]);
        } catch (Exception $err) {
            return response()->json([
                'status' => 'FAIL',
                'msg' => $err->getMessage(),
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
            ['user_id', $request->user_id]
        ]);

        if (!$favorit) {
            return response()->json([
                'status' => 'FAIL',
                'msg' => 'Data favorit tidak ditemukan'
            ], 500);
        }

        try {
            if (array_key_exists('coordinates', $request->tujuan)) {
                $coords = $request->tujuan['coordinates'];
                $lokasi_tujuan = new Point($coords[1], $coords[0]);
            } else {
                $lokasi_tujuan = new Point($request->tujuan['lat'], $request->tujuan['lng']);
            }

            $favorit->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'tujuan' => $lokasi_tujuan
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
