<?php

namespace App\Http\Controllers\API;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PengajuanDriver;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use Carbon\Carbon;
use Grimzy\LaravelMysqlSpatial\Doctrine\Point;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
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
        $user = User::with(['driver', 'driver.angkot'])->find($id);

        if (!$user) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Data user tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $user
        ], 200);
    }

    public function pengajuanDriver(Request $request)
    {
        $user = User::find($request->user_id);

        // kalo user not found
        if (!$user) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Data user tidak ditemukan',
            ], 404);
        }

        try {
            $pengajuan = $user->pengajuanDrivers()->create([
                'trayek_id' => $request->trayek,
                'status' => 'Pending',
                'tanggal' => Carbon::now()
            ]);
            $pengajuan->detail()->create([
                'bank_id' => $request->bank,
                'nama' => $request->nama,
                'nik' => $request->nik,
                'no_kendaraan' => $request->plat,
                'alamat' => $request->alamat,
                'rekening' => $request->rekening,
            ]);

            // Upload foto-foto dokumen untuk
            $this->uploadImage($user, 'ktp', $request->input('detail.ktp.base64'), $request->input('detail.ktp.format'));
            $this->uploadImage($user, 'sim', $request->input('detail.sim.base64'), $request->input('detail.sim.format'));
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Terjadi kesalahan sistem',
                'error' => $e,
            ], 500);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $pengajuan
        ], 201);
    }

    public function statusPengajuan($id)
    {
        $pengajuan = PengajuanDriver::where('user_id', $id)->orderBy('id', 'DESC')->first();

        if (!$pengajuan) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Data user tidak ditemukan',
            ]);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $pengajuan
        ]);
    }

    // Function upload file
    private function uploadImage($user, String $jenis, String $base64, String $format)
    {
        $fileName = "{$jenis}-{$user->id}-{$user->nama}.{$format}";

        Storage::disk('local')->put(
            "public/$jenis/$fileName",
            base64_decode($base64)
        );
    }

    public function updateLokasi(Request $request)
    {
        $driver = Driver::find($request->driver);
        $driver->update([
            'lokasi' => new Point($request->lat, $request->lng)
        ]);
    }

    public function getLokasi(Request $request)
    {
        $driver = Driver::find($request->driver);

        return response()->json(['driver' => $driver], 201);
    }
}
