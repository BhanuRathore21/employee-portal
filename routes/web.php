<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\authentications\LogoutBasic;
use App\Http\Controllers\authentications\GoogleLoginController;
use App\Http\Controllers\users\UsersList;
use App\Http\Controllers\project_list\ProjectList;
use App\Http\Controllers\ProjectController;

// Main Page Route
Route::get('/', [LoginBasic::class, 'index'])->name('auth-login-basic');

Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboards-analytics');
Route::get('/users', [UsersList::class, 'index'])->name('users-list');
Route::get('/project-list', [ProjectList::class, 'index'])->name('projectlist');
Route::get('/project-add', [ProjectController::class, 'list'])->name('project_list.create');
Route::post('/project-add', [ProjectController::class, 'store'])->name('project_list.create.submit');
Route::get('/manage-project/{id}', [ProjectController::class, 'manage'])->name('project_list.update');
Route::post('/manage-project', [ProjectController::class, 'edit'])->name('project_list.update.submit');

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
Route::get('/auth/login/google', [GoogleLoginController::class, 'redirectToGoogle']);
Route::get('/auth/login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);
