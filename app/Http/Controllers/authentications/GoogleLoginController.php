<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class GoogleLoginController extends Controller
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
                $newUser = new User();
                $newUser->username = $user->name;
                $newUser->email = $user->email;
                $newUser->first_name= $user->user['given_name'];
                $newUser->last_name= $user->user['family_name'];
                $newUser->profile_image= $user->avatar;
                $newUser->remember_token= $user->token;
                $newUser->password= $user->user['id'];
                $newUser->google_id = $user->id;
                $newUser->save();
                Auth::login($newUser);
            }
            return redirect("/");

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
