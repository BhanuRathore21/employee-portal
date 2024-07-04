<?php
namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminDetail;

class AdminLoginBasic extends Controller
{
    public function adminlogin()
    {
      if (Auth::check()) {
        return redirect()->route('dashboards-analytics');
      }
      return view('content.authentications.auth-login-basic');
    }
    public function logincheckadmin(Request $request)
    {
        $request->validate([
            'login' => 'required|string', 
            'password' => 'required|string',
        ]);

        $login = $request->input('login');
        $password = $request->input('password');

        $admin = AdminDetail::findByEmailOrUsername($login);

        if ($admin && $admin->validatePassword($password)) {
          Auth::login($admin);
          $customValue = 'admin';
          $request->session()->put('usertype', $customValue);
          return redirect()->route('dashboards-analytics')->with('success', 'Login successful');
        }

        // Invalid credentials
        return redirect()->back()->withErrors(['error' => 'Invalid credentials. Please try again.']);
    }
}
