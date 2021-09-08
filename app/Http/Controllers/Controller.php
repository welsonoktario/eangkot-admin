<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success($message = null, $data = null)
    {
        return response()->json([
            'status' => 'OK',
            'data' => $data,
            'msg' => $message
        ]);
    }

    public function fail($message = null, $error = null, $statusCode = 500)
    {
        return response()->json([
            'status' => 'FAIL',
            'error' => $error,
            'msg' => $message
        ], $statusCode);
    }
}
