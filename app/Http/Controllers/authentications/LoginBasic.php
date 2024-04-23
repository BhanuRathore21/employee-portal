<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  public function index()
  {
    if (Auth::check()) {
      return redirect()->route('dashboards-analytics');
    }
    return view('content.authentications.auth-login-basic');
  }

  public function logincheck(Request $request)
  {
    $request->validate([
      'email' => 'required|string',
      'password' => 'required|string',
    ]);
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
      $user = Auth::user();
      if (!$user->active) {
        Auth::logout();
        return redirect()->back()->withErrors(['error' => 'Your account is inactive. Please contact support.']);
      }
      return redirect()->route('dashboards-analytics')->with('success', 'Login successful');
    } else {
      return redirect()->back()->withErrors(['error' => 'Invalid credentials. Please try again.']);
    }
  }
}
