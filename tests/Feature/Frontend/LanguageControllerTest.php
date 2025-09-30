<?php

use App\Models\Language;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

beforeEach(function () {
    Language::factory()->create(['code' => 'en', 'name' => 'English', 'default' => true, 'is_active' => true]);
    Language::factory()->create(['code' => 'fr', 'name' => 'French', 'is_active' => true]);

    Route::middleware(['web', 'auth'])
        ->prefix('admin')
        ->name('admin.')
        ->group(base_path('routes/admin.php'));
});

test('language can be changed successfully', function () {
    get(route('locale', 'fr'))
        ->assertSessionHas('language', 'fr')
        ->assertRedirect();
});

test('language cannot be changed to inactive language', function () {
    Language::factory()->create(['code' => 'de', 'name' => 'German', 'is_active' => false]);

    get(route('locale', 'de'))
        ->assertSessionMissing('language', 'de')
        ->assertRedirect();
});
