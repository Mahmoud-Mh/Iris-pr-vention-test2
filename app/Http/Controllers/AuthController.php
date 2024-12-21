<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Show Register Form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Handle Registration
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('status', 'Registration successful! Please login.');
    }

    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle Login
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($validated)) {
            return redirect()->intended('/home');
        } else {
            return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
        }
    }

    // Logout user
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // Show Password Reset Form
    public function showPasswordResetForm()
    {
        return view('auth.passwords.email');
    }

    // Send Password Reset Link
    public function sendPasswordResetLink(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        Password::sendResetLink($validated);

        return back()->with('status', 'We have emailed your password reset link!');
    }

    // Show Password Reset Page (with token)
    public function showPasswordResetPage($token)
    {
        return view('auth.passwords.email')->with(['token' => $token, 'email' => request()->email]);
    }
    
    // Handle Password Reset
    public function resetPassword(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email', // Validate the email exists
            'password' => 'required|string|confirmed|min:8', // Validate the password
            'token' => 'required|string', // Validate the token
        ]);
    
        // Use the Password::reset function to reset the password
        $reset = Password::reset($validated, function ($user, $password) {
            // Update the password
            $user->password = Hash::make($password);
            $user->save();
        });
    
        if ($reset == Password::PASSWORD_RESET) {
            // If the password was reset successfully, redirect to the login page
            return redirect()->route('login')->with('status', 'Password reset successful!');
        } else {
            // If the reset failed (invalid token or email), show an error message
            return back()->withErrors(['email' => 'The token is invalid or expired, please try again.']);
        }
    }
    
}    