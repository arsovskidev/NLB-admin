<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\WidgetKey;
use App\Models\ApiKey;

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

        $validator = Validator::make($request->all(), [
            'login_email' => 'required|email',
            'login_password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['errors' => $validator->errors()]);
        }

        $credentials = [
            'email' => $input['login_email'],
            'password' => $input['login_password'],
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('user.dashboard')
                ->with('alert_message', 'Successfully logged in!');
        }

        return redirect()->back()->with('alert_message', 'Login credentials are invalid.');
    }
    public function register(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required|alpha|max:255',
            'surname' => 'required|alpha|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required_with:confirm_password|same:confirm_password|min:6',
            'confirm_password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with(['errors' => $validator->errors(), 'scroll' => 'register']);
        }

        $input['password'] = Hash::make($request->password);

        $user = User::create($input);

        WidgetKey::create(['user_id' => $user->id, 'key' => WidgetKey::generate()]);
        ApiKey::create(['user_id' => $user->id, 'key' => ApiKey::generate()]);

        Auth::login($user);

        return redirect()->route('user.dashboard')
            ->with('alert_message', 'Successfully registered!');
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function revokeApiKey()
    {
        $user = Auth::user();
        $user->apiKey->delete();
        ApiKey::create(['user_id' => $user->id, 'key' => ApiKey::generate()]);
        return redirect()->route('user.dashboard')->with(['alert_message' => 'Successfully revoked API Key!', 'scroll' => 'keys']);
    }

    public function revokeWidgetKey()
    {
        $user = Auth::user();
        $user->widgetKey->delete();
        WidgetKey::create(['user_id' => $user->id, 'key' => widgetKey::generate()]);
        return redirect()->route('user.dashboard')->with(['alert_message' => 'Successfully revoked Widget Key!', 'scroll' => 'keys']);
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route('home.index');
        }
    }
}
