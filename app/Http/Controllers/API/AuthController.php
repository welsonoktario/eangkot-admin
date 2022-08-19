<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Throwable;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::query()
            ->when($request->driver, fn ($q) => $q->with('driver'))
            ->firstWhere('no_hp', $request->phone);

        if (!$user) {
            return $this->success('REGISTER');
        }

        $token = $user->createToken($user->nama)->plainTextToken;

        return $this->success('REGISTERED', [
            'user' => new UserResource($user),
            'token' => $token
        ]);
    }

    public function requestOtp(Request $request)
    {
        // random otp number
        $randomNum = '1234'; // random_int(10 ** (4 - 1), (10 ** 4) - 1);
        $hash = Hash::make($randomNum, ['rounds' => 12]);

        if (!Cache::tags(['otp'])->put($request->phone, $hash, 300)) {
            return $this->fail(null, 'Terjadi kesalahan sistem');
        }

        /* $msg = "$randomNum adalah kode OTP untuk aplikasi eAngkot anda. Jangan sebarkan kode OTP anda kepada siapapun!";

        $req = Http::post('https://console.zenziva.net/reguler/api/sendsms/', [
            'userkey' => env('ZENZIVA_USER_KEY'),
            'passkey' => env('ZENZIVA_API_KEY'),
            'to' => $request->phone,
            'message' => $msg
        ]);

        if ($req->failed()) {
            return $this->fail($req->body());
        } */

        return $this->success();
    }

    public function checkOtp(Request $request)
    {
        Log::debug($request->all());
        try {
            $hash = Cache::tags(['otp'])->pull($request->phone);
            $compare = Hash::check($request->pin, $hash);
        } catch (Throwable $e) {
            return $this->fail('Terjadi kesalahan sistem', $e->getMessage());
        }

        return $this->success($compare);
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
                return $this->fail('Nomor HP telah digunakan', $e->getMessage());
            }

            return $this->fail('Terjadi kesalahan sistem', $e->getMessage());
        } catch (Throwable $e) {
            return $this->fail('Terjadi kesalahan sistem', $e->getMessage());
        }

        $user->roles()->sync([2]);
        $token = $user->createToken($user->nama)->plainTextToken;

        return $this->success(null, [
            'user' => new UserResource($user),
            'token' => $token
        ]);
    }
}
