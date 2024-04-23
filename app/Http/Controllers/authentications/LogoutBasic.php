<?php
namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogoutBasic extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}