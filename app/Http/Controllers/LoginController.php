<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // Menampilkan halaman registrasi
   // Menampilkan halaman registrasi
public function showRegistrationForm()
{
    return view('register.index', ['title' => 'Register']);
}

// Proses registrasi pengguna
public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 0,
    ]);

    Auth::login($user);

    return redirect('/dashboard')->with('messageSuccess', 'Registrasi berhasil!');
}

    // Menampilkan halaman login
public function index()
{
    return view('login.index', ['title' => 'Login']);
}

public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Arahkan berdasarkan role
        if (Auth::user()->role == 1) {
            return redirect()->intended('/dashboard/index')->with('messageSuccess', 'Selamat datang di Dashboard Admin!');
        } else {
            return redirect()->intended('/dashboard/presensi')->with('messageSuccess', 'Selamat datang di Dashboard Presensi!');
        }
    }

    return back()->withErrors(['email' => 'Email atau password salah!'])->withInput();
}



    // Proses logout pengguna
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate sesi
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('messageSuccess', 'Logout berhasil.');
    }
}
