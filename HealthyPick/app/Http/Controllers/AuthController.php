<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Vendor;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Log current auth/session state to help debug unexpected redirects
        try {
            $user = Auth::user();
            $userId = $user ? ($user->Customer_ID ?? $user->id ?? null) : null;
            $userEmail = $user ? ($user->Email ?? $user->email ?? null) : null;
            \Log::info('AuthController::showLogin - session_id: ' . session()->getId() . ' | Auth::check: ' . (Auth::check() ? 'true' : 'false') . ' | user_id: ' . ($userId ?? 'null') . ' | user_email: ' . ($userEmail ?? 'null'));
        } catch (\Exception $e) {
            \Log::error('AuthController::showLogin log error: ' . $e->getMessage());
        }

        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Vendor login form
     */
    public function showVendorLogin()
    {
        // simple logging
        try {
            \Log::info('AuthController::showVendorLogin - session_id: ' . session()->getId() . ' | vendor_session: ' . session()->get('vendor_id'));
        } catch (\Exception $e) {
            \Log::error('AuthController::showVendorLogin log error: ' . $e->getMessage());
        }

        return view('auth.loginVendor');
    }

    /**
     * Handle vendor login (session-based)
     */
    public function vendorLogin(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email|exists:vendors,Email',
            'password' => 'required|min:6',
        ], [
            'email.exists' => 'Email vendor tidak terdaftar.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal :min karakter.',
        ]);

        $vendor = Vendor::where('Email', $validated['email'])->first();

        if (!Hash::check($validated['password'], $vendor->Password)) {
            return back()->withErrors(['password' => 'Password salah.'])->withInput($request->except('password'));
        }

        // Set vendor session
        session(['vendor_id' => $vendor->Vendor_ID]);
        $request->session()->regenerate();

        return redirect('/vendor')->with('success', 'Login vendor berhasil.');
    }

    /**
     * Vendor logout (clear vendor session)
     */
    public function vendorLogout(Request $request)
    {
        $request->session()->forget('vendor_id');
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
            'email' => 'required|email|unique:customers,Email',
            'phone_number' => 'required|string|max:20',
            'password' => 'required|min:6|confirmed',
        ]);

        // Hash password explicitly
        Customer::create([
            'Customer_ID' => Str::uuid(),
            'Name' => $validated['name'],
            'Email' => $validated['email'],
            'Phone_Number' => $validated['phone_number'],
            'Password' => Hash::make($validated['password']),
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

            // Step 2: Cari customer berdasarkan email
            $customer = Customer::where('Email', $request->email)->first();

            // Step 3: Jika customer tidak ada
            if (!$customer) {
                return back()
                    ->withErrors(['email' => 'Email tidak terdaftar.'])
                    ->withInput($request->except('password'));
            }

            // Step 4: Cek password
            if (!Hash::check($request->password, $customer->Password)) {
                return back()
                    ->withErrors(['password' => 'Password salah.'])
                    ->withInput($request->except('password'));
            }

            // Step 5: Login berhasil - gunakan Auth::guard('web')
            Auth::guard('web')->login($customer, false); // false = jangan remember token
            $request->session()->regenerate();

            return redirect()->intended('/user')
                ->with('success', 'Login berhasil! Selamat datang.');

        } catch (\Exception $e) {
            \Log::error('Login Exception: ' . $e->getMessage());
            \Log::error('Stack: ' . $e->getTraceAsString());

            return back()
                ->withInput($request->except('password'))
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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

        // Cari customer
        $customer = Customer::where('Email', $email)->first();
        if (!$customer) {
            return "Email tidak ditemukan: $email";
        }

        // Cek password
        $match = Hash::check($password, $customer->Password);

        // Try login
        try {
            Auth::guard('web')->login($customer, true);
            $isAuth = Auth::check();
            $authUser = Auth::user();

            return "
            <pre>
Email ditemukan: {$customer->Email}
Password match: " . ($match ? 'YES' : 'NO') . "
Auth::login() executed
Auth::check() result: " . ($isAuth ? 'YES (authenticated)' : 'NO (not authenticated)') . "
Authenticated user: " . ($authUser ? $authUser->Email : 'NULL') . "
            </pre>";
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

}