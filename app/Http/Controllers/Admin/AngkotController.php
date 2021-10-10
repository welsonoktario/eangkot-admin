<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Angkot;
use App\Models\Trayek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AngkotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trayeks = Trayek::get(['id', 'kode']);
        $angkots = Angkot::with('trayek')
            ->exclude(['lokasi'])
            ->whereRaw('LOWER(no_kendaraan) LIKE ? ', ['%' . strtolower($request->search ?: '') . '%'])
            ->paginate($request->show ?: 5)
            ->withQueryString()
            ->through(
                fn ($item) =>
                [
                    'id' => $item->id,
                    'trayek' => $item->trayek,
                    'no_kendaraan' => $item->no_kendaraan,
                    'aktif' => $item->status
                ]
            );

        return Inertia::render('Admin/Angkot', ['angkots' => $angkots, 'trayeks' => $trayeks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trayeks = Trayek::all();

        return $this->success('OK', ['trayeks' => $trayeks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Angkot::create([
            'trayek_id' => $request->trayek['id'],
            'no_kendaraan' => $request->plat,
            'aktif' => $request->status ? true : false
        ]);

        return Redirect::route('admin.angkot.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        Angkot::find($id)->update([
            'no_kendaraan' => $request->plat,
            'trayek_id' => $request->trayek['id'],
            'aktif' => $request->status ? true : false
        ]);

        return Redirect::route('admin.angkot.index');
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
}
