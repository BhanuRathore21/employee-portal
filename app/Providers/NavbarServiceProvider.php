<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\UserData; 

class NavbarServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('layouts.sections.navbar.navbar', function ($view) {
            $userData = UserData::first();
            $view->with('userData', $userData); 
        });
    }
}

