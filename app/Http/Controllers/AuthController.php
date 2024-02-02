<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = new User();
    }
    public function loginPage()
    {
        if (Auth::check()) {
            return redirect()->intended('/dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credential)) {
            // check password from plain to bycrpt compare
            $password = $credential['password'];
            $user = $this->user->where('email', $credential['email'])->first();
            if (!password_verify($password, $user->password)) {
                return back()->withErrors([
                    'error' => 'Password dan Email tidak cocok',
                ]);
            }
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Login Berhasil');
        }
        return back()->withErrors([
            'error' => 'Password dan Email tidak cocok',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $credential = $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'jabatan' => 'required',
            'jenis_kelamin' => 'required',
            'password' => 'required|confirmed'
        ]);

        $credential['password'] = bcrypt($credential['password']);
        $this->user->create($credential);
        return redirect()->route('login');
    }
}
