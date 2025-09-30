<?php

use App\Models\Language;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function () {
    Language::factory()->create(['code' => 'en', 'name' => 'English', 'default' => true, 'is_active' => true]);

    // Removed admin route setup as this is an authentication test
    // Route::middleware(['web', 'auth'])
    //     ->prefix('admin')
    //     ->name('admin.')
    //     ->group(base_path('routes/admin.php'));
});

test('confirm password screen can be rendered', function () {
    $user = User::factory()->create();

    actingAs($user)->get('/confirm-password')
        ->assertOk();
});

test('password can be confirmed', function () {
    $user = User::factory()->create();

    actingAs($user)->post('/confirm-password', [
        'password' => 'password',
    ])
        ->assertRedirect()
        ->assertSessionHasNoErrors();
});

test('password is not confirmed with invalid password', function () {
    $user = User::factory()->create();

    actingAs($user)->post('/confirm-password', [
        'password' => 'wrong-password',
    ])
        ->assertSessionHasErrors();
});
