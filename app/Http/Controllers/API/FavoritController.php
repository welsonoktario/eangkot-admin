<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavoritCollection;
use App\Models\Favorit;
use App\Models\Trayek;
use Illuminate\Http\Request;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Throwable;

class FavoritController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $favorits = Favorit::query()
            ->with('trayek')
            ->whereRaw('user_id = ?', $request->user_id)
            ->get();

        if (!$favorits) {
            return $this->fail('Terjadi kesalahan sistem');
        }

        return $this->success(null, new FavoritCollection($favorits));
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
        } catch (Throwable $err) {
            return $this->fail('Terjadi kesalahan sistem', $err->getMessage());
        }

        return $this->success('Rute favorit berhasil ditambah', $favorit);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $favorit = Favorit::with('trayek')->find($id);

        if (!$favorit) {
            return response()->json([
                'status' => 'FAIL',
                'msg' => 'Data favorit tidak ditemukan',
            ], 500);
        }

        return $this->success(null, $favorit);
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
            return $this->fail('Data favorit tidak ditemukan');
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

            if ($request->has('trayek_id')) {
                $favorit->trayek()->associate($request->trayek);
            }
        } catch (Throwable $err) {
            return $this->fail('Terjadi kesalahan sistem', $err->getMessage());
        }

        return $this->success('Rute favorit berhasil diubah', $favorit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Favorit::destroy($id);
        } catch (Throwable $e) {
            return $this->fail('Terjadi kesalahan sistem', $e->getMessage());
        }

        return $this->success();
    }
}
