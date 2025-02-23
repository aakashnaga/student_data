<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

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

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function showResetPassword()
    {
        return view('auth.reset-password');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:email',
            'password' => 'required|min:6',
            'role' => 'in:admin,manager,employee'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'employee'
        ]);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'User registered successfully']);
        }

        return redirect()->route('auth.login')->with('success', 'Registration successful! Please log in.');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($request->expectsJson()) {
                $token = JWTAuth::fromUser($user);
                return response()->json(['token' => $token, 'user' => $user]);
            }

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'manager') {
                return redirect()->route('manager.dashboard');
            } else {
                return redirect()->route('dashboard');
            }
        }

        if ($request->expectsJson()) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'Email not found'], 404);
        }

        $otp = rand(100000, 999999);
        $user->update(['otp' => $otp]);

        Mail::raw("Your OTP is: $otp", function ($message) use ($user) {
            $message->to($user->email)->subject('Password Reset OTP');
        });

        if ($request->expectsJson()) {
            return response()->json(['message' => 'OTP sent to your email']);
        }

        return redirect()->route('auth.reset')->with('success', 'OTP sent to your email. Enter it to reset your password.');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required',
            'new_password' => 'required|min:6'
        ]);

        $user = User::where('email', $request->email)->where('otp', $request->otp)->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid OTP'], 400);
        }

        $user->update(['password' => Hash::make($request->new_password), 'otp' => null]);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Password reset successful']);
        }

        return redirect()->route('auth.login')->with('success', 'Password reset successful! Please log in.');
    }

    public function profile()
    {
        return response()->json(auth()->user());
    }

    public function logout(Request $request)
    {
        Auth::logout(); 

        if ($request->expectsJson()) {
            return response()->json(['message' => 'User logged out successfully']);
        }

        return redirect()->route('auth.login')->with('success', 'Logged out successfully');
    }
}
