<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class AuthController
{
    public function checkUser(Request $request)
    {
        $user = User::firstWhere('no_hp', $request->phone);

        if (!$user) {
            return response()->json([
                'status' => 'OK',
                'msg' => 'NOT_REGISTERED',
            ], 200);
        }

        return response()->json([
            'status' => 'OK',
            'msg' => 'REGISTERED'
        ], 200);
    }

    public function login(Request $request)
    {
        $user = User::firstWhere('no_hp', $request->phone);

        if (!$user) {
            return response()->json([
                'status' => 'FAIL',
                'msg' => 'User tidak ditemukan',
            ], 200);
        }

        return response()->json([
            'status' => 'OK',
            'data' => [
                'user' => $user,
                'access_token' => $user->createToken($user->nama)
            ]
        ], 200);
    }

    public function requestOtp(Request $request)
    {
        // random otp number
        $randomNum = random_int(10 ** (4 - 1), (10 ** 4) - 1);
        $hash = Hash::make($randomNum, ['rounds' => 12]);

        $msg = "$randomNum adalah kode OTP anda. Jangan sebarkan kode OTP anda kepada siapapun!";

        $req = Http::post('https://console.zenziva.net/reguler/api/sendsms/', [
            'userKey' => env('ZENZIVA_USER_KEY'),
            'passKey' => env('ZENZIVA_API_KEY'),
            'to' => $request->phone,
            'message' => $msg
        ]);

        if ($req->failed()) {
            return 'FAIL';
        }

        return response()->json([
            'status' => 'OK',
            'data' => [
                'res' => $req->body(),
                'otp' => $hash
            ]
        ]);
    }

    public function register(Request $request)
    {
        $user = User::create($request->all());

        if (!$user) {
            return response()->json([
                'status' => 'FAIL',
                'msg' => 'Terjadi kesalahan sistem',
            ], 500);
        }

        return response()->json([
            'status' => 'OK',
            'data' => $user,
        ], 200);
    }
}
