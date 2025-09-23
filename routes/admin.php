<?php

declare(strict_types=1);

use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\FeedbackController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\PostTranslationController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\WorkController;
use App\Http\Controllers\Backend\WorkTranslationController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', DashboardController::class)->name('dashboard');

// Settings
Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

// Posts
Route::resource('posts', PostController::class);

// Posts Translations
Route::get('postTranslations/{postTranslation}', [PostTranslationController::class, 'show'])->name('postTranslations.show');
Route::get('post/translations/{post}', [PostTranslationController::class, 'index'])->name('postTranslations.index');
Route::get('postTranslations/{post}/create', [PostTranslationController::class, 'create'])->name('postTranslations.create');
Route::post('postTranslations/{post}', [PostTranslationController::class, 'store'])->name('postTranslations.store');
Route::get('postTranslations/{postTranslation}/translate', [PostTranslationController::class, 'translate'])->name('postTranslations.translate');
Route::get('postTranslations/{postTranslation}/edit', [PostTranslationController::class, 'edit'])->name('postTranslations.edit');
Route::put('postTranslations/{postTranslation}', [PostTranslationController::class, 'update'])->name('postTranslations.update');
Route::delete('postTranslations/{postTranslation}', [PostTranslationController::class, 'destroy'])->name('postTranslations.destroy');

// Works
Route::resource('works', WorkController::class);

// Works Translations
Route::get('workTranslations/{workTranslation}', [WorkTranslationController::class, 'show'])->name('workTranslations.show');
Route::get('work/translations/{work}', [WorkTranslationController::class, 'index'])->name('workTranslations.index');
Route::get('workTranslations/{work}/create', [WorkTranslationController::class, 'create'])->name('workTranslations.create');
Route::post('workTranslations/{work}', [WorkTranslationController::class, 'store'])->name('workTranslations.store');
Route::get('workTranslations/{workTranslation}/translate', [WorkTranslationController::class, 'translate'])->name('workTranslations.translate');
Route::get('workTranslations/{workTranslation}/edit', [WorkTranslationController::class, 'edit'])->name('workTranslations.edit');
Route::put('workTranslations/{workTranslation}', [WorkTranslationController::class, 'update'])->name('workTranslations.update');
Route::delete('workTranslations/{workTranslation}', [WorkTranslationController::class, 'destroy'])->name('workTranslations.destroy');

// Customers
Route::resource('customers', CustomerController::class);

// Users
Route::resource('users', UserController::class);

// Tags
Route::get('tags.json', [TagController::class, 'indexRaw'])->name('tags.indexRaw');
Route::resource('tags', TagController::class);

// Languages
Route::resource('languages', LanguageController::class);

// Feedback
Route::get('feedback/read', [FeedbackController::class, 'read'])->name('feedback.read');
Route::get('forceDelete/{feedback}', [FeedbackController::class, 'forceDelete'])->name('feedback.forceDelete');
Route::get('feedback/{feedback}/mark-as-read', [FeedbackController::class, 'markAsRead'])->name('feedback.mark-as-read');
Route::get('feedback/{feedback}/unread', [FeedbackController::class, 'unread'])->name('feedback.unread');
Route::resource('feedback', FeedbackController::class)->only(['index', 'show', 'destroy']);

// Profile
Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
