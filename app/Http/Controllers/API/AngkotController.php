<?php

namespace App\Http\Controllers\API;

use App\Events\AngkotLokasiUpdated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AngkotResource;
use App\Models\Angkot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Throwable;

class AngkotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $angkots = Angkot::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $angkot = Angkot::query()
            ->with('drivers')
            ->find($id);

        if (!$angkot) {
            return response()->json([
                'status' => 'NOT_AVAIL',
                'msg' => 'Data angkot tidak ditemukan',
            ], 200);
        }

        return response()->json([
            'status' => 'OK',
            'data' => new AngkotResource($angkot)
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateDoc(Angkot $angkot, Request $request)
    {
        try {
            Log::debug($angkot);
            $angkot->update(['doc_id' => $request->doc_id]);
        } catch (Throwable $err) {
            return $this->fail(
                'Terjadi kesalahan mengubah data $angkot',
                $err->getMessage(),
            );
        }

        return $this->success('Data angkot berhasil diperbarui');
    }

    public function cariAngkot(Request $request)
    {
        try {
            $trayek = $request->trayek;
            $titikJemput = new Point($request->titikJemput->latitude, $request->titikJemput->longitude);
            $query = "ST_DISTANCE($titikJemput, lokasi) jarak";

            $angkots = Angkot::query()
                ->select(DB::raw($query))
                ->where('trayek_id', $trayek->id)
                ->whereNotIn('id', $request->blacklist)
                ->get();
        } catch (Throwable $err) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Tidak ada angkot tersedia untuk saat ini',
                'err' => $err->getMessage()
            ]);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $angkots
        ]);
    }

    public function updateLokasi(Request $request, $id)
    {
        try {
            $lokasi = new Point($request->lat, $request->lang);
            $angkot = tap(Angkot::find($id)->update(['lokasi' => $lokasi]));
            broadcast(new AngkotLokasiUpdated($angkot))->toOthers();
        } catch (Throwable $err) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Terjadi kesalahan sistem',
                'err' => $err->getMessage()
            ]);
        }

        return response()->json([
            'status' => 'OK'
        ]);
    }
}
