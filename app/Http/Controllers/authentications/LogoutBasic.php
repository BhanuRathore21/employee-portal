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
        $checkuser=session('usertype');
        $url='';
        if($checkuser == 'admin'){
            $url= '/admin';
        }else{
            $url= '/';
        }
        $request->session()->forget('usertype');
        return redirect($url);
    }
}