<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BankResource;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends ResponseController
{
    public function index()
    {
        $banks = Bank::get();
        if ($banks) {
            return $this->sendResponse("success", ["banks" => BankResource::collection($banks)], 200);
        }
        return $this->sendResponse("error", ["message" => "No banks available."], 404);
    }
}
