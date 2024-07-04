<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\authentications\GoogleLoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/apiregister', [AuthController::class, 'apiregister']); 
Route::post('/apilogin', [AuthController::class, 'apilogin']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'apilogout']);
    Route::get('/user', [AuthController::class, 'user']);
});
Route::get('/api/auth/login/google', [GoogleLoginController::class, 'redirectToGoogle']);
Route::get('/api/auth/login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);