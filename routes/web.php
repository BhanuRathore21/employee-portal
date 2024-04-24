<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\authentications\LogoutBasic;
use App\Http\Controllers\users\UsersList;

// Main Page Route
Route::get('/', [LoginBasic::class, 'index'])->name('auth-login-basic');

Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboards-analytics');
Route::get('/users', [UsersList::class, 'index'])->name('users-list');
// pages
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
Route::post('/pages/account-settings-account', [AccountSettingsAccount::class, 'save_setting'])->name('pages.account.settings.account.submit');
Route::post('/pages/account-settings-account/deactivate', [AccountSettingsAccount::class, 'deactivate'])->name('pages.account.settings.account.submit.deactivate');
Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');

// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::post('/auth/login-basic', [LoginBasic::class, 'logincheck'])->name('auth.login.basic.submit');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');
Route::get('/logout', [LogoutBasic::class, 'logout'])->name('logout');
