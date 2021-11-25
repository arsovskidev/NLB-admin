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
        fsockopen("www.google.com", 80, $errno, $errstr, 30);
        $end = microtime_float();
        $ms = ($end - $start) * 1000;
        $ping = round($ms, 2);

        if ($ping < 50) {
            $message = "System is operational.";
            $color = "green";
        } else if ($ping > 50 && $ping < 100) {
            $message = "System have medium latency issues.";
            $color = "orange";
        } else {
            $message = "System have high latency issues.";
            $color = "red";
        }

        return $this->send_response("success", ["message" => $message, "color" => $color, "ping" => $ping], 200);
    }
}
