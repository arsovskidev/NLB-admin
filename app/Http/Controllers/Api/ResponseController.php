<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function send_response($status, $data = [], $code)
    {
        $response = [
            'status' => $status,
            'data'    => $data,
        ];

        return response()->json($response, $code);
    }
}
