<?php

use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\WorkController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', DashboardController::class)->name('dashboard');

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

// Languages
Route::resource('languages', LanguageController::class);

// Profile
Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
