<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransaksiCollection;
use App\Http\Resources\TransaksiResource;
use App\Http\Resources\UlasanResource;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        $transaksis = Transaksi::query()
            ->with(['driver.user', 'driver.angkot.trayek', 'ulasan'])
            ->where('user_id', $request->user()->id)
            ->get();

        if (!$transaksis) {
            return $this->fail('Terjadi kesalahan memuat riwayat transaksi');
        }

        return $this->success(null, new TransaksiCollection($transaksis));
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
            $transaksi = Auth::user()->transaksis()
                ->create([
                    'driver_id' => $request->driver,
                    'tanggal' => Carbon::now(),
                    'ongkos' => $request->ongkos,
                    'durasi_perjalanan' => $request->durasi_perjalanan,
                    'jarak_perjalanan' => $request->jarak_perjalanan,
                    'lokasi_jemput' => $request->lokasi_jemput,
                    'lokasi_tujuan' => $request->lokasi_tujuan
                ]);
        } catch (Throwable $e) {
            return $this->fail('Terjadi kesalahan menambah transaksi', $e->getMessage());
        }

        return $this->success(null, $transaksi);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show($transaksi)
    {
        try {
            $transaksi->load(['pesanan.driver.user', 'pesanan.driver.angkot.trayek', 'ulasan']);
        } catch (Throwable $e) {
            return $this->fail('Terjadi kesalahan memuat data transaksi', $e->getMessage());
        }

        return $this->success(null, new TransaksiResource($transaksi));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        DB::beginTransaction();

        try {
            $ulasan = $transaksi->ulasan()->create([
                'rating' => $request->rating,
                'komentar' => $request->komentar
            ]);

            DB::commit();

            return $this->success(null, new UlasanResource($ulasan));
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error("Add ulasan: {$e->getMessage()}");

            return $this->fail("Terjadi kesalahan menambah ulasan");
        }
    }
}
