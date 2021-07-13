<?php

namespace App\Http\Controllers\API;

use App\Events\PesananCreated;
use App\Events\PesananHandled;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Pesanan;
use Carbon\Carbon;
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
        try {
            $lokasi_jemput = new Point($request->lokasi->lat, $request->lokasi->lng);
            $lokasi_tujuan = new Point($request->tujuan->lat, $request->lokasi->lng);

            $pesanan = Pesanan::create([
                'user_id' => $request->user_id,
                'driver_id' => $request->driver_id,
                'rute' => new MultiPoint([$lokasi_jemput, $lokasi_tujuan]),
                'penumpang' => $request->penumpang
            ]);

            event(new PesananCreated($request->driver_id, $pesanan));
        } catch (Throwable $err) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Terjadi kesalahan membuat pesanan',
                'err' => $err->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $pesanan
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
            if (!$request->tipe === 'Batal') {
                $pesanan = tap($pesanan->update([
                    'driver_id' => $request->driver,
                    'status' => $request->tipe
                ]));

                if ($request->tipe === 'Selesai') {
                    $pesanan->transaksi()->create([
                        'pesanan_id' => $pesanan->id,
                        'tanggal' => Carbon::now(),
                        'durasi_perjalanan' => $request->transaksi->durasi,
                        'jarak_perjalanan' => $request->transaksi->jarak
                    ]);
                }
                event(new PesananHandled($pesanan));
            } else if ($request->tipe === 'Batal') {
                $pesanan->destroy();

                event(new PesananHandled($request->tipe));
                return response()->json([
                    'status' => 'OK',
                    'data' => null
                ]);
            }
        } catch (Throwable $err) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Terjadi kesalahan memuat data pesanan',
                'err' => $err->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $pesanan
        ]);
    }
}
