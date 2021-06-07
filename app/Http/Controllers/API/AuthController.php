<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::firstWhere('no_hp', $request->phone);

        if (!$user) {
            return response()->json([
                'status' => 'OK',
                'msg' => 'REGISTER',
            ], 200);
        }

        $token = $user->createToken($user->nama)->plainTextToken;

        return response()->json([
            'status' => 'OK',
            'msg' => 'REGISTERED',
            'data' => [
                'user' => $user->only(['id', 'nama', 'no_hp', 'email', 'secure']),
                'token' => $token
            ]
        ], 200);
    }

    public function requestOtp(Request $request)
    {
        // random otp number
        $randomNum = '1234';// random_int(10 ** (4 - 1), (10 ** 4) - 1);
        $hash = Hash::make($randomNum, ['rounds' => 12]);

        /* $msg = "$randomNum adalah kode OTP untuk aplikasi eAngkot anda. Jangan sebarkan kode OTP anda kepada siapapun!";

        $req = Http::post('https://console.zenziva.net/reguler/api/sendsms/', [
            'userkey' => env('ZENZIVA_USER_KEY'),
            'passkey' => env('ZENZIVA_API_KEY'),
            'to' => $request->phone,
            'message' => $msg
        ]);

        if ($req->failed()) {
            return response()->json([
                'status' => 'FAIL',
                'msg' => $req->body()
            ]);
        } */

        return response()->json([
            'status' => 'OK',
            'data' => [
                'otp' => $hash
            ]
        ]);
    }

    public function register(Request $request)
    {
        try {
            $user = User::create([
                'nama' => $request->nama,
                'no_hp' => $request->phone
            ]);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                return response()->json([
                    'status' => 'FAIL',
                    'msg' => 'Nomor HP telah digunakan',
                    'error' => $e
                ], 500);
            } else {
                return response()->json([
                    'status' => 'FAIL',
                    'msg' => 'Terjadi kesalahan sistem',
                    'error' => $e
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'FAIL',
                'msg' => 'Terjadi kesalahan sistem',
                'error' => $e->getMessage()
            ], 500);
        }

        $user->roles()->sync([2]);
        $token = $user->createToken($user->nama)->plainTextToken;

        return response()->json([
            'status' => 'OK',
            'data' => [
                'user' => $user->only(['id', 'nama', 'no_hp', 'email', 'secure']),
                'token' => $token
            ],
        ], 200);
    }
}
