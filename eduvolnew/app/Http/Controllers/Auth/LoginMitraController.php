<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginMitraController extends Controller
{
    public function showLoginForm()
    {
        return view('loginmitra');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Check if user is mitra (role_id = 4)
            if ($user->role_id === 4) {
                $request->session()->regenerate();
                return redirect()->intended('/posting-event');
            } else {
                // If not mitra, logout and return with error
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Anda tidak memiliki akses sebagai mitra.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password yang dimasukkan tidak sesuai.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('registermitra');
    }
} 