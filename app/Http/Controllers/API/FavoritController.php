<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Favorit;
use Illuminate\Http\Request;
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
        $favorits = Favorit::with('trayek')->where('user_id', $request->user)->get();

        if (!$favorits) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Not found',
            ], 404);
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
            $favorit = Favorit::create(['nama' => $request->nama]);
            $favorit->user()->associate($request->user_id);
            $favorit->trayek()->associate($request->angkot_id);
        } catch (Throwable $err) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => $err
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

        if ($favorit->isEmpty()) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Not found',
            ], 404);
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
        $favorit = Favorit::where([
            ['id', $id],
            ['user_id', $request->user]
        ])->first();

        if (!$favorit) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Not found'
            ], 404);
        }

        try {
            $favorit->update(['name' => $request->name]);
            $favorit->user()->associate($request->user);
            if ($request->has('trayek_id')) $favorit->trayek()->associate($request->trayek);
        } catch (Throwable $err) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => $err
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
                'status' => 'GAGAL',
                'msg' => 'Data favorit tidak ditemukan'
            ], 404);
        }

        if (!$favorit->delete()) {
            return response()->json([
                'status' => 'OK',
                'msg' => 'Terjadi kesalahan menghapus favorit'
            ], 500);
        }

        return response()->json([
            'status' => 'OK'
        ], 200);
    }
}