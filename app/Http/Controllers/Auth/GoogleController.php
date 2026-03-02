<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $email = $googleUser->getEmail();

            // Only authenticate if user already exists (created by admin beforehand)
            $user = User::where('email', $email)->first();

            if (!$user) {
                // User does not exist - they need to be created by an admin first
                return redirect('/admin/login')
                    ->with('error', 'Your account does not exist. Please contact your administrator to create your account.');
            }

            Auth::login($user);

            return redirect('/dashboard');
        } catch (\Exception $e) {
            return redirect('/admin/login')
                ->with('error', 'Authentication failed. Please try again.');
        }
    }
}
