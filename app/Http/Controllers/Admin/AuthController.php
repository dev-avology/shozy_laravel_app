<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        // Debug: Check if admin is authenticated before logout
        if (Auth::guard('admin')->check()) {
            $adminUser = Auth::guard('admin')->user();
            Log::info('Admin logout: ' . $adminUser->email);
        } else {
            Log::info('Admin logout: No admin user found');
        }

        // Debug: Check session before logout
        Log::info('Session before logout: ' . json_encode($request->session()->all()));

        // Clear admin authentication from all guards
        Auth::guard('admin')->logout();
        Auth::guard('web')->logout(); // Also clear web guard just in case
        
        // Clear all session data completely
        $request->session()->flush();
        
        // Clear specific session keys
        $request->session()->forget('admin');
        $request->session()->forget('auth');
        $request->session()->forget('guard');
        
        // Clear any remember me tokens
        $request->session()->forget('remember_web');
        $request->session()->forget('remember_admin');
        
        // Regenerate session ID for security
        $request->session()->regenerate();
        $request->session()->regenerateToken();

        // Debug: Check session after logout
        Log::info('Session after logout: ' . json_encode($request->session()->all()));

        Log::info('Admin logout completed, redirecting to login');

        // Force redirect to admin login page with absolute URL
        return redirect('/admin/login')->with('success', 'Logged out successfully');
    }
}
