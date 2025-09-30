<?php

use App\Models\Language;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function () {
    Language::factory()->create(['code' => 'en', 'name' => 'English', 'default' => true, 'is_active' => true]);

    Route::middleware(['web', 'auth'])
        ->prefix('admin')
        ->name('admin.')
        ->group(base_path('routes/admin.php'));
});

test('settings edit page can be rendered for authenticated user', function () {
    $user = User::factory()->create();

    actingAs($user)->get(route('admin.settings.edit', 1))
        ->assertOk()
        ->assertSee('Settings'); // Assuming 'Settings' is present on the settings edit page
});

test('settings can be updated by authenticated user', function () {
    $user = User::factory()->create();

    actingAs($user)->put(route('admin.settings.update', 1), [
        // No actual data being updated in the controller, so an empty array is fine
    ])
        ->assertOk(); // Controller returns 'OK', 200
});
