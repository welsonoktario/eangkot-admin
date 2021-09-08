<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserController extends Controller
{
    public function update($id, Request $request)
    {
        $user = User::find($id);

        try {
            $user->update($request->all());
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                return $this->fail('Email telah digunakan. Silahkan coba email lain', $e->errorInfo[2]);
            }

            return $this->fail('Terjadi kesalahan mengubah akun', $e->errorInfo[2]);
        } catch (Throwable $e) {
            return $this->fail('Terjadi kesalahan mengubah akun', $e->getMessage());
        }

        return $this->success();
    }

    public function ubahPassword($id, Request $request) {
        $user = User::find($id);

        if ($request->has('password_lama')) {
            if (!Hash::check($request->password_lama, $user->password)) {
                return response()->json([
                    'status' => 'NOT_MATCH',
                    'msg' => 'Password lama tidak cocok',
                ], 500);
            }
        }

        try {
            $user->update([
                'password' => Hash::make($request->password),
                'secure' => true
            ]);
        } catch (Throwable $e) {
            return $this->fail('Terjadi kesalahan mengubah password', $e->getMessage());
        }

        return $this->success();
    }
}
