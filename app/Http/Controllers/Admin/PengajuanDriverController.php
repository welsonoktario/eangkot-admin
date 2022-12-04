<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanDriver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Throwable;

class PengajuanDriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pengajuans = PengajuanDriver::query()
            ->with(['user', 'trayek'])
            ->when(
                $request->search,
                fn ($q) =>
                    $q->whereHas(
                        'user',
                        fn ($q) =>
                        $q->whereRaw(
                            'LOWER(nama) LIKE ? ',
                            ['%' . strtolower($request->search ?: '') . '%']
                        )
                    )
            )
            ->paginate($request->show ?: 5)
            ->appends($request->all())
            ->through(fn ($item) => [
                    'id' => $item->id,
                    'tanggal' => $item->tanggal,
                    'alamat' => $item->alamat,
                    'sim' => $item->sim,
                    'nik' => $item->nik,
                    'trayek' => $item->trayek,
                    'user' => $item->user,
                    'status' => $item->status
                ]);

        return Inertia::render(
            'Admin/PengajuanDriver',
            ['pengajuans' => $pengajuans]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PengajuanDriver  $pengajuanDriver
     * @return \Illuminate\Http\Response
     */
    public function show(PengajuanDriver $pengajuanDriver)
    {
        $pengajuanDriver->load(['user', 'angkot', 'detail']);

        if ($pengajuanDriver->isEmpty()) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Data pengajuan tidak ditemukan'
            ], 404);
        }

        try {
            $user = $pengajuanDriver->user;
            $ktp = Storage::url("ktp/ktp-{$user->id}-{$user->nama}.jpeg");
            $sim = Storage::url("sim/sim-{$user->id}-{$user->nama}.jpeg");
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Terjadi kesalahan sistem',
                'error' => $e
            ], 500);
        }

        return response()->json([
            'status' => 'OK',
            'data' => [
                'pengajuan' => $pengajuanDriver,
                'dokumen' => [
                    'ktp' => $ktp,
                    'sim' => $sim,
                ]
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PengajuanDriver  $pengajuanDriver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PengajuanDriver $pengajuanDriver)
    {
        DB::beginTransaction();

        try {
            $pengajuanDriver->update([
                'status' => $request->status
            ]);

            if ($request->status === 'Diterima') {
                $user = $pengajuanDriver->user;
                $user->roles()->attach(3);
                $user->driver()->create([
                    'alamat' => $pengajuanDriver->alamat,
                ]);
            }

            DB::commit();

            return Redirect::back();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return Redirect::back();
        }

        /* try {
            $pengajuan->update([
                'status' => $request->status
            ]);

            if ($request->status === 'Diterima') {
                $user = User::with('user')->find($pengajuan->user->id);
                $user->roles()->attach(3);
                $user->driver()->create([
                    'angkot_id' => $pengajuan->angkot->angkot_id,
                    'no_kendaraan' => $pengajuan->detail->no_kendaraan,
                    'status' => 0
                ]);
                $user->driver->detail()->create([
                    'bank_id' => $pengajuan->detail->bank->id,
                    'nama' => $pengajuan->detail->nama,
                    'alamat' => $pengajuan->detail->alamat,
                    'rekening' => $pengajuan->detail->rekening,
                    'nik' => $pengajuan->detail->nik
                ]);
            }
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Terjadi kesalahan sistem',
                'error' => $e
            ], 500);
        } */
    }
}
