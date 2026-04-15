<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function showRegister(){
        return view('auth.register');
    }

    public function showForgotPassword(){
        return view('auth.forgot-password');
    }

    public function showResetPassword(Request $request, $token){
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function handleLogin(Request $request){
        // Validate input
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Get email and password data
        $credentials = $request->only('email', 'password');

        // Check user
        if (auth()->attempt($credentials, $request->remember)) {
            // Generate session
            $request->session()->regenerate();

            // Redirect to panel user
            return redirect()->intended('/panel');
        }

        // Return to login page with error information if login failed
        return back()->withErrors([
            'email' => 'Email or password is incorrect.',
        ])->onlyInput('email');
    }

    public function handleRegister(Request $request){
        // Validate input
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:100', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'role' => ['required', Rule::in(['admin', 'user'])],
            'admin_code' => ['required_if:role,admin'],
        ]);

        $role = $validated['role'];

        if ($role === 'admin') {
            $secretCode = env('ADMIN_REGISTRATION_CODE');
            if ($request->admin_code !== $secretCode) {
                return back()->withErrors(['admin_code' => 'Kode registrasi admin tidak valid'])->withInput();
            }
        }

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $role,
            'password' => Hash::make($validated['password']),
            'status' => true,
        ]);

        // Login automatically after register
        auth()->login($user);

        // Redirect to panel user
        return redirect('/panel');
    }

    public function handleForgotPassword(Request $request){
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        //cek link sudah dikirimkan atau belum 
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors([
            'email' => __($status),
        ]);
    }

    public function handleResetPassword(Request $request){
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password)
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect('/login')->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }

    public function handleLogout(Request $request){
        // Logout function
        auth()->logout();

        // Clear session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to login page
        return redirect('/login');
    }

    /**
     * Google Redirect
     */
    public function google_redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback() {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => $user->password ?? Hash::make(Str::random(12)),
                    'email_verified_at' => now(),
                    'role' => 'user',
                    'status' => true,
                ]
            );

            // Pastikan variabel $user tidak null sebelum login
            if ($user) {
                auth()->login($user, true);
                return redirect('/panel');
            }
            return redirect('/login')->withErrors(['email' => 'Gagal mengidentifikasi user.']);
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['email' => 'Terjadi Kesalahan : '. $e->getMessage()]);
        }   

    }

}
