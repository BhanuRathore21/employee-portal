<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserData;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-register-basic');
  }

  public function register(Request $request)
  {
    $validatedData = $request->validate([
      'username' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|string|min:8',
      'terms' => 'accepted',
    ], [
      'terms.accepted' => 'You must accept the terms and conditions.',
    ]);

    try {
      $user = new User();
      $user->name = $validatedData['username'];
      $user->email = $validatedData['email'];
      $user->password = Hash::make($validatedData['password']);
      $user->save();

      $userData = new UserData();
      $userData->user_id = $user->id;
      $userData->first_name = $validatedData['username'];
      $userData->email = $validatedData['email'];
      $userData->save();

      return redirect()->route('auth-login-basic')->with('success', 'Registration successful. Please log in.');
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => 'Failed to register user. Please try again.']);
    }
  }
}
