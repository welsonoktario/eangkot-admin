<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update($id, Request $request)
    {
        $user = User::find($id);

        try {
            $user->update($request->all());
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                return response()->json([
                    'status' => 'FAIL',
                    'msg' => 'Email telah digunakan. Silahkan coba email lain',
                    'error' => $e->errorInfo[2]
                ], 500);
            } else {
                return response()->json([
                    'status' => 'FAIL',
                    'msg' => 'Terjadi kesalahan sistem',
                    'error' => $e->errorInfo[2]
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'FAIL',
                'msg' => 'Terjadi kesalahan sistem',
                'error' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'OK'
        ], 204);
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
        } catch (Exception $e) {
            return response()->json([
                'status' => 'FAIL',
                'msg' => 'Terjadi kesalahan sistem',
                'error' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => 'OK'
        ], 204);
    }
}
