<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        }
        return view('user.index');
    }
    public function login(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'login_email' => 'required|email',
            'login_password' => 'required',
        ]);

        $credentials = [
            'email' => $input['login_email'],
            'password' => $input['login_password'],
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('user.dashboard')
                ->with('login_success', 'Successfully logged in!');
        }

        return redirect()->back()->with('invalid_credentials', 'Login credentials are invalid.');
    }
    public function register(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'name' => 'required|alpha|max:255',
            'surname' => 'required|alpha|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
        ]);


        if ($input['password'] != $input['confirm_password']) {
            return redirect()->back()->with('invalid_password', 'Invalid password confirmation!');
        }

        $input['password'] = Hash::make($request->password);

        $user = User::create($input);
        Auth::login($user);

        return redirect()->route('user.dashboard')
            ->with('login_success', 'Successfully registered!');
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route('home.index');
        }
    }
}
