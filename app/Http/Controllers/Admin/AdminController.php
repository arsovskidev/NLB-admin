<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Bank;

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
                    ->with('alert_message', 'Successfully logged in!');
            }
        }

        return redirect()->back()->with('invalid_credentials', 'Login credentials are invalid.');
    }

    public function dashboard()
    {
        $users = User::orderBy('created_at', "DESC")->paginate(10)->onEachSide(1);
        $banks = Bank::get();

        return view('admin.dashboard', compact('users', 'banks'));
    }

    public function bankAdd(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'bank_name' => 'required|alpha|max:64',
            'bank_api' => 'required|url',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['errors' => $validator->errors(), 'scroll' => 'banks']);
        }

        Bank::create([
            'name' => $input['bank_name'],
            'api' => $input['bank_api'],
        ]);
        return redirect()->back()->with(['alert_message' => "Successfully added Bank system.", 'scroll' => 'banks']);
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
