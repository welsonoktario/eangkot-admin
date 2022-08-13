<?php

namespace App\Http\Controllers\API;

use App\Events\PesananCreated;
use App\Events\PesananHandled;
use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MatanYadaev\EloquentSpatial\Objects\MultiPoint;
use MatanYadaev\EloquentSpatial\Objects\Point;
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
        $pesanans = Pesanan::query()
            ->with('user')
            ->where('trayek_id', $request->trayek)
            ->get();

        return $this->success(null, $pesanans);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
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
        } catch (Throwable $e) {
            return $this->fail('Terjadi kesalahan membuat pesanan', $e->getMessage());
        }

        return $this->success(null, $pesanan);
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
            return $this->fail('Terjadi kesalahan memuat data pesanan');
        }

        return $this->success(null, $pesanan);
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
        try {
            if ($request->tipe === 'Batal') {
                Pesanan::destroy($id);

                event(new PesananHandled($request->tipe));
                return $this->success();
            } else {
                $pesanan = Pesanan::find($id);
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
            }
        } catch (Throwable $e) {
            return $this->fail('Terjadi kesalahan memuat data pesanan', $e->getMessage());
        }

        return $this->success(null, $pesanan);
    }
}
