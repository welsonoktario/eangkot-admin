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
            'detail',
            'ulasan'
        ])->get();

        if (!$transaksis) {
            return $this->fail('Terjadi kesalahan memuat riwayat transaksi');
        }

        return $this->success(null, $transaksis);
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
        } catch (Throwable $e) {
            return $this->fail('Terjadi kesalahan menambah transaksi', $e->getMessage());
        }

        return $this->success(null, $transaksi);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = Transaksi::with(['driver', 'ulasan'])->firstWhere('id', $id);

        if ($transaksi->isEmpty()) {
            return $this->fail('Terjadi kesalahan memuat data transaksi');
        }

        return $this->success(null, $transaksi);
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
