<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)
            ->orWhere('nama', $request->email)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user); // tanpa remember token

            return $user->role === 'admin'
                ? redirect()->route('dashboard')
                : redirect()->route('dashboardUser');
        }

        return back()->withErrors([
            'email' => 'Email/Username atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect()->route('login');
    }
}
