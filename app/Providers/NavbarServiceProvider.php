<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\UserData; 
use Illuminate\Support\Facades\Auth;

class NavbarServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('layouts.sections.navbar.navbar', function ($view) {
            $user = Auth::user();
            $userData = UserData::where('id', $user->id)->first();
            $view->with('userData', $userData); 
        });
    }
}

