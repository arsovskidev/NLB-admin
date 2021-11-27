<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;

class HomeController extends Controller
{
    public function index()
    {
        $banks = Bank::get();
        return view('index', compact('banks'));
    }
}
