<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.index');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        $auth = Auth::guard('admin');
        if ($auth instanceof \Illuminate\Contracts\Auth\StatefulGuard) {
            if ($auth->attempt($credentials)) {
                return redirect()->route('admin.dashboard')
                    ->with('login_success', 'Successfully logged in!');
            }
        }

        return redirect()->back()->with('invalid_credentials', 'Login credentials are invalid.');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        $auth = Auth::guard('admin');
        if ($auth instanceof \Illuminate\Contracts\Auth\StatefulGuard) {
            if ($auth->check()) {
                $auth->logout();
                return redirect()->route('home.index');
            }
        }
    }
}
