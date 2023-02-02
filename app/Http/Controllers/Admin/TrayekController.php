<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trayek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Throwable;

class TrayekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trayeks = Trayek::query()
            ->whereRaw('LOWER(rute) LIKE ? ', ['%' . strtolower($request->search ?: '') . '%'])
            ->paginate($request->show ?: 5)
            ->withQueryString()
            ->through(
                fn ($item) =>
                [
                    'id' => $item->id,
                    'kode' => $item->kode,
                    'rute' => $item->rute,
                    'berangkat' => $item->rute_berangkat,
                    'kembali' => $item->rute_kembali,
                    'gambar' => $item->gambar
                ]
            );

        return Inertia::render('Admin/Trayek', ['trayeks' => $trayeks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Trayek::query()->create([
            'kode' => $request->kode,
            'rute' => $request->rute,
            'rute_berangkat' => $request->berangkat,
            'rute_kembali' => $request->kembali,
            'gambar' => $request->gambar
        ]);

        return Redirect::back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trayek  $trayek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trayek $trayek)
    {
        $trayek->update([
            'kode' => $request->kode,
            'rute' => $request->rute,
            'rute_berangkat' => $request->berangkat,
            'rute_kembali' => $request->kembali,
            'gambar' => $request->gambar
        ]);

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trayek  $trayek
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trayek $trayek)
    {
        $trayek->delete();

        return Redirect::back();
    }
}
