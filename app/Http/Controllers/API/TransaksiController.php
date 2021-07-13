<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Throwable;

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
            'pesanan' => function ($q) use ($request) {
                $q->where('user_id', $request->user_id);
            },
            'pesanan.driver' => function ($q) {
                $q->with(['angkot', 'angkot.trayek', 'user']);
            },
            'ulasan'
        ])->get();

        if (!$transaksis) {
            return response()->json([
                'status' => 'FAIL',
                'msg' => 'Terjadi kesalahan memuat riwayat transaksi'
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
        try {
            $transaksi = Transaksi::create([
                'pesanan_id' => $request->pesanan_id,
                'tanggal' => Carbon::now(),
                'durasi_perjalanan' => $request->durasi,
                'jarak_perjalanan' => $request->jarak
            ]);
        } catch (Throwable $err) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Terjadi kesalahan pada sistem, silahkan coba lagi',
                'err' => $err->getMessage()
            ], 500);
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
        $transaksis = Transaksi::with(['driver', 'ulasan'])->firstWhere('id', $id);

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
