<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\AdminLoginBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\authentications\LogoutBasic;
use App\Http\Controllers\authentications\GoogleLoginController;
use App\Http\Controllers\users\UsersList;
use App\Http\Controllers\project_list\ProjectList;
use App\Http\Controllers\project_list\ProjectTaskController;

// Main Page Route
Route::get('/', [LoginBasic::class, 'userlogin'])->name('auth-login-users');

Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboards-analytics');
Route::get('/users', [UsersList::class, 'index'])->name('users-list');
Route::get('/users/create', [UsersList::class, 'create'])->name('users-create');
Route::post('/users/create', [UsersList::class, 'CreateSubmit'])->name('users-create.submit');
Route::get('/manage-user/{id}', [UsersList::class, 'manage'])->name('users.users-update');
Route::post('/manage-user', [UsersList::class, 'edit'])->name('users.users-update.submit');
Route::delete('user/delete/{id}', [UsersList::class, 'delete'])->name('users.delete');
Route::get('/project-list', [ProjectList::class, 'index'])->name('projectlist');
Route::get('/project-add', [ProjectList::class, 'list'])->name('project_list.create');
Route::post('/project-add', [ProjectList::class, 'store'])->name('project_list.create.submit');
Route::get('/manage-project/{id}', [ProjectList::class, 'manage'])->name('project_list.update');
Route::get('/timelog-project/{id}', [ProjectList::class, 'addtimelog'])->name('project_list.timelog');
Route::get('/project/{id}/tasks/create', [ProjectTaskController::class, 'createform'])->name('project_list.taskscreate');
Route::post('/project/{id}/tasks/create', [ProjectTaskController::class, 'createtask'])->name('project_list.taskscreate.submit');
Route::get('/project/{id}/tasks', [ProjectTaskController::class, 'index'])->name('project_list.tasklist');
Route::post('/manage-project', [ProjectList::class, 'edit'])->name('project_list.update.submit');
Route::delete('project/delete/{id}', [ProjectList::class, 'delete'])->name('project_list.delete');

// pages
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
Route::post('/pages/account-settings-account', [AccountSettingsAccount::class, 'save_setting'])->name('pages.account.settings.account.submit');
Route::post('/pages/account-settings-account/deactivate', [AccountSettingsAccount::class, 'deactivate'])->name('pages.account.settings.account.submit.deactivate');
Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');

// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'userlogin'])->name('auth-login-users');
Route::post('/auth/login-basic', [LoginBasic::class, 'logincheckuser'])->name('auth.login.users.submit');

Route::get('/admin', [AdminLoginBasic::class, 'adminlogin'])->name('auth-login-basic');
Route::post('/admin', [AdminLoginBasic::class, 'logincheckadmin'])->name('auth.login.basic.submit');

Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

Route::get('/logout', [LogoutBasic::class, 'logout'])->name('logout');


Route::get('/auth/login/google', [GoogleLoginController::class, 'redirectToGoogle']);
Route::get('/auth/login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);



