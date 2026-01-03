<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Vendor;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }


    public function showVendorLogin()
    {
        return view('auth.loginVendor');
    }

    /**
     * Handle vendor login - menggunakan User dengan role vendor
     */
    public function vendorLogin(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ], [
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Format email tidak valid.',
                'password.required' => 'Password harus diisi.',
                'password.min' => 'Password minimal :min karakter.',
            ]);

            // Cari user dengan role vendor
            $user = User::where('email', $validated['email'])
                ->where('role', 'vendor')
                ->first();

            // Jika user tidak ada atau bukan vendor
            if (!$user) {
                return back()
                    ->withErrors(['email' => 'Email vendor tidak terdaftar.'])
                    ->withInput($request->except('password'));
            }

            // Cek password
            if (!Hash::check($validated['password'], $user->password)) {
                return back()
                    ->withErrors(['password' => 'Password salah.'])
                    ->withInput($request->except('password'));
            }

            // Login menggunakan Auth
            Auth::guard('web')->login($user, false);
            $request->session()->regenerate();

            return redirect()->intended('/vendor')
                ->with('success', 'Login vendor berhasil.');
        } catch (\Exception $e) {
            return back()
                ->withInput($request->except('password'))
                ->with('error', 'Terjadi kesalahan saat login.');
        }
    }

    /**
     * Vendor logout
     */
    public function vendorLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login/vendor');
    }

    /**
     * REGISTER - Hash password explicitly
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|min:6|confirmed',
        ]);


        User::create([
            'User_ID' => Str::uuid(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => $validated['password'],
            'role' => 'user',
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * LOGIN - Simple and direct approach
     */
    public function login(Request $request)
    {
        try {
            // Step 1: Validasi input
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            // Step 2: Cari user berdasarkan email
            $user = User::where('email', $request->email)->first();

            // Step 3: Jika user tidak ada
            if (!$user) {
                return back()
                    ->withErrors(['email' => 'Email tidak terdaftar.'])
                    ->withInput($request->except('password'));
            }

            // Step 4: Cek password
            if (!Hash::check($request->password, $user->password)) {
                return back()
                    ->withErrors(['password' => 'Password salah.'])
                    ->withInput($request->except('password'));
            }

            // Step 5: Login berhasil - gunakan Auth::guard('web')
            Auth::guard('web')->login($user, false); // false = jangan remember token
            $request->session()->regenerate();

            return redirect()->intended('/user')
                ->with('success', 'Login berhasil! Selamat datang.');

        } catch (\Exception $e) {
            return back()
                ->withInput($request->except('password'))
                ->with('error', 'Terjadi kesalahan saat login.');
        }
    }

    /**
     * LOGOUT
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * DEBUG - Test login flow
     * Akses: http://localhost:8000/test-login?email=test@test.com&password=test1234
     */
    public function testLogin(Request $request)
    {
        $email = $request->query('email');
        $password = $request->query('password');

        if (!$email || !$password) {
            return 'Masukkan email dan password sebagai query parameter';
        }

        // Cari user
        $user = User::where('email', $email)->first();
        if (!$user) {
            return "Email tidak ditemukan: $email";
        }

        // Cek password
        $match = Hash::check($password, $user->password);

        // Try login
        try {
            Auth::guard('web')->login($user, true);
            $isAuth = Auth::check();
            $authUser = Auth::user();

            return "
            <pre>
Email ditemukan: {$user->email}
Password match: " . ($match ? 'YES' : 'NO') . "
Auth::login() executed
Auth::check() result: " . ($isAuth ? 'YES (authenticated)' : 'NO (not authenticated)') . "
Authenticated user: " . ($authUser ? $authUser->email : 'NULL') . "
            </pre>";
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

}