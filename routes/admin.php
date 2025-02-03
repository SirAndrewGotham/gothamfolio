<?php

use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\WorkController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Settings
Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

// Posts
Route::resource('posts', PostController::class);

// Works
Route::resource('works', WorkController::class);

// Customers
Route::resource('customers', CustomerController::class);

// Users
Route::resource('users', UserController::class);

// Tags
Route::get('tags.json', [TagController::class, 'indexRaw'])->name('tags.indexRaw');
Route::resource('tags', TagController::class);

// Profile
Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');

// Authentication
//Route::get('auth/login',
//    ['as' => 'admin.auth.login', 'middleware' => 'guest', 'uses' => 'Auth\AuthController@getLogin']);
//Route::post('auth/login',
//    ['as' => 'admin.auth.login', 'middleware' => 'guest', 'uses' => 'Auth\AuthController@postLogin']);
//Route::get('auth/logout',
//    ['as' => 'admin.auth.logout', 'middleware' => 'auth', 'uses' => 'Auth\AuthController@getLogout']);
//
//// Password Reset Request
//Route::get('auth/remind',
//    ['as' => 'admin.auth.remind', 'middleware' => 'guest', 'uses' => 'Auth\PasswordController@getEmail']);
//Route::post('auth/remind',
//    ['as' => 'admin.auth.remind', 'middleware' => 'guest', 'uses' => 'Auth\PasswordController@postEmail']);
//
//// Password Reset
//Route::get('auth/reset/{token}',
//    ['as' => 'admin.auth.reset', 'middleware' => 'guest', 'uses' => 'Auth\PasswordController@getReset']);
//Route::post('auth/reset',
//    ['as' => 'admin.auth.reset', 'middleware' => 'guest', 'uses' => 'Auth\PasswordController@postReset']);
