<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\User;
use GeoJson\Geometry\MultiPoint;
use GeoJson\Geometry\Point;
use Illuminate\Http\Request;
use Throwable;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pesanans = Pesanan::with('user')->where('trayek_id', $request->trayek)->get();

        return response()->json([
            'status' => 'OK',
            'data' => $pesanans
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
        $lokasi_jemput = new Point($request->lokasi->lat, $request->lokasi->lng);
        $lokasi_tujuan = new Point($request->tujuan->lat, $request->lokasi->lng);
        $user = User::find($request->user_id);

        $pesanan = $user->pesanan()::create([
            'rute' => new MultiPoint([$lokasi_jemput, $lokasi_tujuan]),
            'jumlah_penumpang' => $request->penumpang
        ]);

        if (!$pesanan) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Terjadi kesalahan membuat pesanan'
            ], 500);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $pesanan
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
        $pesanan = Pesanan::find($id);

        if (!$pesanan) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Terjadi kesalahan memuat data pesanan'
            ], 500);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $pesanan
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
        $pesanan = Pesanan::find($id);

        try {
            if ($request->tipe === 'terima') {
                $pesanan->update([
                    'driver_id' => $request->driver,
                    'status' => 'Aktif'
                ]);
            } else if ($request->tipe === 'batal') {
                $pesanan->update([
                    'status' => 'Batal'
                ]);
            }
        } catch (Throwable $err) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Terjadi kesalahan memuat data pesanan'
            ], 500);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $pesanan
        ]);
    }
}
