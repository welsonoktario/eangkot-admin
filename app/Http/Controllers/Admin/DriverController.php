<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Angkot;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Throwable;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $drivers = Driver::with(['user', 'angkot.trayek'])->whereRaw('LOWER(alamat) LIKE ? ', ['%' . strtolower($request->search ?: '') . '%'])
            ->paginate($request->show ?: 5)
            ->withQueryString()
            ->through(
                fn ($item) =>
                [
                    'id' => $item->id,
                    'user' => $item->user,
                    'alamat' => $item->alamat,
                    'angkot' => $item->angkot
                ]
            );

        return Inertia::render('Admin/Driver', ['drivers' => $drivers]);
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
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        $driver->load('angkot.trayek');

        return $this->success('OK', $driver);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        $driver->load('angkot.trayek');
        $angkots = Angkot::query()->all();

        return [
            'driver' => $driver,
            'angkots' => $angkots
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        DB::beginTransaction();

        try {
            $driver->update($request->all());
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            return Redirect::back();
        }

        return Redirect::route('admin.akun.driver.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        DB::beginTransaction();

        try {
            $driver->delete();

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            return Redirect::back();
        }

        return Redirect::route('admin.akun.driver.index');
    }
}
