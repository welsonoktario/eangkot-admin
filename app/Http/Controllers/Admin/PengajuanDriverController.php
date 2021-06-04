<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanDriver;
use App\Models\User;
use Illuminate\Http\Request;
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
    public function index()
    {
        $pengajuans = PengajuanDriver::with('user')->get();

        return Inertia::render('Admin/Pengajuan/Driver', ['pengajuans' => $pengajuans]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengajuan = PengajuanDriver::with(['user', 'angkot', 'detail'])->find($id);

        if ($pengajuan->isEmpty()) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Data pengajuan tidak ditemukan'
            ], 404);
        }

        try {
            $user = $pengajuan->user;
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
                'pengajuan' => $pengajuan,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pengajuan = PengajuanDriver::find($id);
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

        return response()->json([
            'status' => 'OK',
        ], 201);
    }
}
