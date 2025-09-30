<?php

use App\Models\Language;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

beforeEach(function () {
    Language::factory()->create(['code' => 'en', 'name' => 'English', 'default' => true, 'is_active' => true]);
    config(['gothamfolio.frontend.registration' => 'on']);
    require __DIR__.'/../../../routes/admin.php'; // Explicitly load admin routes
    require __DIR__.'/../../../routes/auth.php'; // Explicitly load auth routes
});

test('new users can register', function () {
    $language = Language::factory()->create(['code' => 'es', 'name' => 'Spanish', 'default' => false, 'is_active' => true]);
    $response = post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'language_id' => $language->id,
    ]);

    $response->assertRedirect(route('dashboard', absolute: false));
    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
        'slug' => 'test-user',
        'language_id' => $language->id,
    ]);
    $this->assertAuthenticated();
});

test('registration screen redirects to home when registration is disabled', function () {
    config(['gothamfolio.frontend.registration' => 'off']);
    $this->app->make(\Illuminate\Contracts\Console\Kernel::class)->call('route:clear');
    require __DIR__.'/../../../routes/auth.php';

    get('/register')
        ->assertStatus(302)
        ->assertRedirect('/');
});
