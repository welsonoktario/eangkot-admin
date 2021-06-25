<?php

namespace App\Http\Controllers\API;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PengajuanDriver;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use Carbon\Carbon;
use Exception;
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
        $user = User::find($request->user_id);

        // kalo user not found
        if (!$user) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Data user tidak ditemukan',
            ], 404);
        }

        try {
            $pengajuan = $user->pengajuan()->create([
                'trayek_id' => $request->trayek,
                'status' => 'Pending',
                'tanggal' => Carbon::now()
            ]);
            $pengajuan->detail()->create([
                'nik' => $request->nik,
                'alamat' => $request->alamat,
            ]);

            // Upload foto-foto dokumen untuk
            $this->uploadImage($user, 'ktp', $request->file('foto_ktp'), $request->format_ktp);
            $this->uploadImage($user, 'sim', $request->file('foto_sim'), $request->format_sim);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'GAGAL',
                'msg' => 'Terjadi kesalahan sistem',
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $request->allFiles()
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
    private function uploadImage($user, String $jenis, $foto, String $format)
    {
        $fileName = "{$jenis}-{$user->id}-{$user->nama}.{$format}";

        Storage::disk('local')->put(
            "public/$jenis/$fileName",
            file_get_contents($foto)
        );
    }
}
