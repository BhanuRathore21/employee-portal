<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class GoogleLogin extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $existingUser = User::where('email', $user->email)->first();

            if ($existingUser) {
                Auth::login($existingUser);
            } else {
                // Create new user
                $newUser = new User();
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->google_id = $user->id; // Add more fields as needed
                $newUser->save();
                Auth::login($newUser);
            }

            return redirect()->intended('/'); // Redirect to home page after login

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
