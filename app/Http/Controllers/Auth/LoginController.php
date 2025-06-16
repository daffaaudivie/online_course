<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); 
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Coba login sebagai admin
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard_admin');
        }

        // Coba login sebagai user biasa
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        // Gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
