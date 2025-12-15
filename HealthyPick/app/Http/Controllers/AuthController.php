<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Show register form
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()
                ->route('dashboard')
                ->with('success', 'Login berhasil! Selamat datang ' . Auth::user()->name);
        }

        return redirect()
            ->route('login')
            ->withErrors(['login_error' => 'Email atau password salah'])
            ->withInput($request->only('email'));
    }

    /**
     * Handle register
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|min:10|max:15|unique:users,phone_number',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'Nama harus diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'phone_number.required' => 'Nomor telepon harus diisi',
            'phone_number.min' => 'Nomor telepon minimal 10 digit',
            'phone_number.max' => 'Nomor telepon maksimal 15 digit',
            'phone_number.unique' => 'Nomor telepon sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('register')
                ->withErrors($validator)
                ->withInput($request->only('name', 'email', 'phone_number'));
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($user);

            return redirect()
                ->route('dashboard')
                ->with('success', 'Registrasi berhasil! Selamat datang ' . $user->name);
        } catch (\Exception $e) {
            return redirect()
                ->route('register')
                ->withErrors(['error' => 'Terjadi kesalahan saat pendaftaran'])
                ->withInput($request->only('name', 'email', 'phone_number'));
        }
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Logout berhasil! Sampai jumpa lagi');
    }
}
