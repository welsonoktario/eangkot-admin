<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PengajuanDriver;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Grimzy\LaravelMysqlSpatial\Doctrine\Point;
use Illuminate\Support\Facades\Storage;
use Throwable;

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
            return $this->fail('Data user tidak ditemukan', null);
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
        } catch (Throwable $e) {
            return $this->fail('Terjadi kesalahan sistem', $e->getMessage());
        }

        return $this->success();
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
            return $this->fail('Data driver tidak ditemukan');
        }

        return $this->success(null, $user);
    }

    public function statusPengajuan($id)
    {
        $pengajuan = PengajuanDriver::where('user_id', $id)->orderBy('id', 'DESC')->first();

        if (!$pengajuan) {
            return $this->fail('Data pengajuan tidak ditemukan');
        }

        return $this->success(null, $pengajuan);
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
