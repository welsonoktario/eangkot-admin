<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PengajuanDriver;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransaksiCollection;
use App\Http\Resources\UserResource;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        $user = User::query()
            ->find($request->user_id);

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
        $user = User::query()
            ->with(['driver', 'driver.angkot'])
            ->find($id);

        if (!$user) {
            return $this->fail('Data driver tidak ditemukan');
        }

        return $this->success(null, new UserResource($user));
    }

    public function statusPengajuan($id)
    {
        $pengajuan = PengajuanDriver::query()
            ->where('user_id', $id)
            ->orderBy('id', 'DESC')
            ->first();

        if (!$pengajuan) {
            return $this->fail('Data pengajuan tidak ditemukan');
        }

        return $this->success(null, $pengajuan);
    }

    public function statistik(Request $request)
    {
        $driver = Auth::user()->driver;
        $days = Carbon::now()->subDays($request->days ?: 7);

        $data = [];
        $transaksis = Transaksi::query()
            ->whereHas('pesanan', fn ($q) => $q->where('driver_id', $driver->id))
            ->whereDate('created_at', '>=', $days)
            ->get();
        $transaksis = $transaksis->map(function ($transaksi) {
            $tmp = $transaksi;
            $tmp['tanggal'] = $transaksi->created_at->format('Y-m-d');
            unset($tmp['created_at']);
            unset($tmp['updated_at']);

            return $tmp;
        });
        $transaksis = $transaksis->groupBy('tanggal');
        $transaksis = $transaksis->map(function ($tanggal) {
            $tmp = [
                'total' => 0,
                'transaksi' => 0
            ];

            foreach ($tanggal as $transaksi) {
                $tmp['transaksi'] += 1;
                $tmp['total'] += $transaksi->ongkos;
            }

            return $tmp;
        });

        return response()->json($transaksis);
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
