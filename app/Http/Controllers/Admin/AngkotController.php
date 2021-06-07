<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Angkot;
use Illuminate\Http\Request;
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

        return Inertia::render('Admin/Angkot', ['angkots' => $angkots]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
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
}
