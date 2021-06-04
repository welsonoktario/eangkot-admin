<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Promo;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transaksis = Transaksi::with([
            'detail',
            'pesanan' => function ($q) use ($request) {
                $q->where('user_id', $request->user);
            },
            'pesanan.driver' => function ($q) {
                $q->with(['angkot', 'angkot.trayek', 'user']);
            },
            'promo',
            'ulasan'
        ])->get();

        if ($transaksis->isEmpty()) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Data user tidak ditemukan'
            ], 500);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $transaksis
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pesanan = Pesanan::find($request->pesanan);
        $transaksi = $pesanan->transaksi()->create([
            'tanggal' => Carbon::now(),
            'user_id' => $request->user,
            'driver_id' => $request->driver
        ]);

        if (!$transaksi) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Gagal membuat transaksi'
            ], 500);
        } else {
            if ($request->promo) {
                $promo = Promo::find($request->promo);
                $transaksi->promo()->associate($promo);
                $transaksi->save();
            }

            $detail = $transaksi->detail()->create([
                'durasi_perjalanan' => $request->detail->durasi,
                'jarak_perjalanan' => $request->detail->jarak
            ]);

            if (!$detail) {
                return response()->json([
                    'status' => 'GAGAL',
                    'msg' => 'Gagal membuat detail transaksi'
                ], 500);
            }
        }

        return response()->json([
            'status' => 'OK',
            'data' => $transaksi
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
        $transaksis = Transaksi::with(['detail', 'driver', 'promo', 'ulasan'])->firstWhere('id', $id);

        if ($transaksis->isEmpty()) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Data transaksi tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $transaksis
        ], 200);
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
}