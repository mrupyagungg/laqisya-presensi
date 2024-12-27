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
    public function showRegistrationForm()
    {
        return view('register.index', [
            'title' => 'Register'
        ]);
    }

    // Proses registrasi pengguna
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Simpan pengguna baru ke database
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Redirect ke halaman dashboard
        return redirect()->route('/dashboard')->with('messageSuccess', 'Registration successful. Welcome to the dashboard!');
    }

    // Menampilkan halaman login
    public function index()
    {
        return view('login.index', [
            'title' => 'Login'
        ]);
    }

    // Proses login pengguna
    public function authenticate(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // Coba otentikasi pengguna
        if (Auth::attempt($credentials)) {
            // Regenerasi sesi untuk keamanan
            $request->session()->regenerate();
            $request->session()->put('email', $request->email);

            return redirect()->intended('/dashboard')->with('messageSuccess', 'Login berhasil!');
        }

        // Login gagal
        return back()
            ->withErrors(['email' => 'Email atau password salah!'])
            ->withInput();
    }

    // Proses logout pengguna
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate sesi
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('messageSuccess', 'Logout berhasil.');
}
}
