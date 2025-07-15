<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:3'

            ]
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek role
            if (Auth::user()->role === 'admin') {
                return redirect('/admin/dashboard-home')->with('success', 'Welcome Admin ' . Auth::user()->name . '!');
            }

            return redirect('/')->with('success', 'Welcome ' . Auth::user()->name . '!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }



    ///register

    public function registerForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
            'password' => 'required|min:8',
        ]);

        // Simpan user baru
        User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'phone' => $credentials['phone'],
            'password' => Hash::make($credentials['password']),
            'role' => 'user', // default role
        ]);

        // Redirect ke halaman login tanpa login otomatis
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login untuk melanjutkan.');
    }
}
