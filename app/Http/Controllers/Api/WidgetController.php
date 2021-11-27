<?php

namespace App\Http\Controllers\Api;

use App\Models\WidgetKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WidgetController extends ResponseController
{
    public function index()
    {
        return $this->sendResponse("success", ["message" => "Widget Key is valid!"], 200);
    }
}
