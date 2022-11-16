<?php

namespace App\Http\Controllers\API\Driver;

use App\Http\Controllers\Controller;
use App\Http\Resources\AngkotResource;
use App\Models\Angkot;
use Illuminate\Http\Request;

class AngkotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
     * @param  \App\Models\Angkot  $angkot
     * @return \Illuminate\Http\Response
     */
    public function show(Angkot $angkot)
    {
        $angkot->load('trayek');

        return $this->success(null, new AngkotResource($angkot));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Angkot  $angkot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Angkot $angkot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Angkot  $angkot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Angkot $angkot)
    {
        //
    }
}
