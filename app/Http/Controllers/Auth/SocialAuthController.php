<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    /**
     * Redirect ke halaman login Google
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback dari Google
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah user sudah ada berdasarkan email
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // User sudah ada, update google_id jika belum ada
                if (!$user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                    ]);
                }
            } else {
                // User baru, buat akun baru
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'employee_id' => 'GOOGLE-' . strtoupper(Str::random(8)),
                    'password' => Hash::make(Str::random(32)), // Random password
                    'role' => 'user', // Default role
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]);
            }

            // Login user
            Auth::login($user, true);

            // Redirect berdasarkan role
            if ($user->role === 'admin' || $user->role === 'kontributor') {
                return redirect()->intended(route('admin.dashboard'))
                    ->with('success', 'Selamat datang, ' . $user->name . '!');
            }

            return redirect()->intended(route('home'))
                ->with('success', 'Selamat datang, ' . $user->name . '!');
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Terjadi kesalahan saat login dengan Google. Silakan coba lagi.');
        }
    }
}
