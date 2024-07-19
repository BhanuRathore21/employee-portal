<?php
namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserDetail;

class LoginBasic extends Controller
{
    public function userlogin()
    {
      if (Auth::check()) {
        return redirect()->route('dashboards-analytics');
      }
      return view('content.authentications.auth-login-users');
    }
    public function logincheckuser(Request $request)
    {
        $request->validate([
            'login' => 'required|string', 
            'password' => 'required|string',
        ]);

        $login = $request->input('login');
        $password = $request->input('password');

        $user = UserDetail::findByEmailOrUsername($login);

        if ($user && $user->validatePassword($password)) {
          Auth::login($user);
          $customValue = 'user';
          $request->session()->put('usertype', $customValue);
          $request->session()->put('user_id', $user->id);
          return redirect()->route('dashboards-analytics')->with('success', 'Login successful');
        }

        // Invalid credentials
        return redirect()->back()->withErrors(['error' => 'Invalid credentials. Please try again.']);
    }
}
