<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Angkot;
use App\Models\Trayek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Throwable;

class AngkotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trayeks = Trayek::query()
            ->get(['id', 'kode']);
        $angkots = Angkot::query()
            ->with('trayek')
            ->whereRaw('LOWER(no_kendaraan) LIKE ? ', ['%' . strtolower($request->search ?: '') . '%'])
            ->paginate($request->show ?: 5)
            ->appends($request->all())
            ->through(fn ($item) => [
                    'id' => $item->id,
                    'trayek' => $item->trayek,
                    'no_kendaraan' => $item->no_kendaraan,
                ]);

        return Inertia::render('Admin/Angkot', ['angkots' => $angkots, 'trayeks' => $trayeks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trayeks = Trayek::query()->all();

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
        try {
            Angkot::create([
                'trayek_id' => $request->trayek['id'],
                'no_kendaraan' => $request->plat,
                'aktif' => $request->status ? true : false
            ]);

            return Redirect::route('admin.angkot.index');
        } catch (Throwable $e) {
            return Redirect::back()->with('error', $e->getMessage());
        }
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
        try {
            $angkot->query()
                ->update([
                    'no_kendaraan' => $request->plat,
                    'trayek_id' => $request->trayek['id'],
                    'aktif' => $request->status ? true : false
                ]);

            return Redirect::route('admin.angkot.index');
        } catch (Throwable $e) {
            return Redirect::back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Angkot  $angkot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Angkot $angkot)
    {
        $angkot->delete();

        return Redirect::route('admin.angkot.index');
    }
}
