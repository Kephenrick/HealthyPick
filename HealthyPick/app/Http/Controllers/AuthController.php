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
            'email.required' => 'Email needs to be filled',
            'email.email' => 'Invalid email format',
            'password.required' => 'Password needs to be filled',
            'password.min' => 'Password minimum 6 characters',
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
                ->with('success', 'Login Successful! Welcome ' . Auth::user()->name);
        }

        return redirect()
            ->route('login')
            ->withErrors(['login_error' => 'Email or password is wrong'])
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
            'name.required' => 'Name needs to be filled',
            'name.min' => 'Name minimum 3 characters',
            'name.max' => 'Name maksimal 255 characters',
            'email.required' => 'Email needs to be filled',
            'email.email' => 'Invalid email format',
            'email.unique' => 'Email has been registered',
            'phone_number.required' => 'Phone number needs to be filled',
            'phone_number.min' => 'Phone number minimum 10 digits',
            'phone_number.max' => 'Phone number maximum 15 digits',
            'phone_number.unique' => 'Phone number has been registered',
            'password.required' => 'Password needs to be filled',
            'password.min' => 'Password minimum 6 characters',
            'password.confirmed' => 'Confirmed password does not match',
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
                ->with('success', 'Registration successful! Welcome ' . $user->name);
        } catch (\Exception $e) {
            return redirect()
                ->route('register')
                ->withErrors(['error' => 'Something went wrong while registering'])
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
            ->with('success', 'Logout successful! See you again');
    }
}
