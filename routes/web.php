<?php

declare(strict_types=1);

use App\Http\Controllers\Backend\PostTranslationController;
use App\Http\Controllers\Frontend\BlogController;
//use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\FeedbackController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ImageController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\ResumeController;
use App\Http\Controllers\Frontend\TagController;
use App\Http\Controllers\Frontend\WorkController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', HomeController::class)->name('home');

// Resume
Route::get('resume', ResumeController::class)->name('resume');

// Contact
// Route::get('contact', [ContactController::class, 'show'])->name('contact.show');
// Route::post('contact', [ContactController::class, 'store'])->name('contact.store');

// Blog
Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('blog/{post}', [BlogController::class, 'show'])->name('blog.show');
// Route::get('blog/tag/{tag}', [TagController::class, 'show'])->name('tag.show');
Route::get('blog/tag/{tag}', [BlogController::class, 'tagShow'])->name('blog.tag.show');

Route::resource('posts', PostTranslationController::class);
// Works
Route::get('works', [WorkController::class, 'index'])->name('works.index');
Route::get('works/{work}', [WorkController::class, 'show'])->name('works.show');

// Galleries
Route::redirect('/gallery', '/galleries');
Route::get('galleries', [GalleryController::class, 'index'])->name('galleries.index');
Route::get('galleries/{gallery}', [GalleryController::class, 'show'])->name('galleries.show');

// Images
Route::get('images', [ImageController::class, 'index'])->name('images.index');
Route::get('images/{image}', [ImageController::class, 'show'])->name('images.show');

// Language switcher
Route::get('/language/{locale}', LanguageController::class)->name('locale');

Route::get('image-upload', [ImageController::class, 'index']);
Route::post('image-upload', [ImageController::class, 'store'])->name('image.store');

// Feedback
Route::get('/contact', [FeedbackController::class, 'index'])->name('feedback.index');
Route::post('/contact', [FeedbackController::class, 'store'])->name('feedback.store');
