<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class InfoController extends ResponseController
{
    public function status(Request $request)
    {
        function microtime_float()
        {
            list($usec, $sec) = explode(" ", microtime());
            return ((float)$usec + (float)$sec);
        }

        $start = microtime_float();
        fsockopen($request->ip(), 80, $errno, $errstr, 30);
        $end = microtime_float();
        $ms = ($end - $start) * 1000;
        $ping = round($ms, 2);

        if ($ping < 50) {
            $ping_message = "Low latency.";
        } else if ($ping > 50 && $ping < 100) {
            $ping_message = "Medium latency.";
        } else {
            $ping_message = "High latency!";
        }

        return $this->send_response("success", ["message" => $ping_message, "ping" => $ping], 404);
    }
}
