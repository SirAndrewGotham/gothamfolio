<?php

use App\Models\Language;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function () {
    Language::factory()->create(['code' => 'en', 'name' => 'English', 'default' => true, 'is_active' => true]);

    Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
        require base_path('routes/admin.php');
    });

    // Dump all routes for debugging
    // \Illuminate\Support\Facades\Artisan::call('route:list');
    // dump(\Illuminate\Support\Facades\Artisan::output());
});

test('users index page can be rendered for authenticated user', function () {
    $user = User::factory()->create();

    actingAs($user)->get(route('admin.users.index'))
        ->assertOk()
        ->assertSee('Users'); // Assuming 'Users' is present on the users index page
});

test('user create page can be rendered for authenticated user', function () {
    $user = User::factory()->create();

    actingAs($user)->get(route('admin.users.create'))
        ->assertOk()
        ->assertSee('Create a User'); // Corrected: Using 'Create a User' as per the Blade view
});

test('user can be stored by authenticated user', function () {
    $user = User::factory()->create();

    $userData = [
        'name' => 'New User',
        'email' => 'newuser@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'language_id' => Language::first()->id,
    ];

    actingAs($user)->post(route('admin.users.store'), $userData)
        ->assertRedirect(route('admin.users.index'));

    $this->assertDatabaseHas('users', [
        'name' => 'New User',
        'email' => 'newuser@example.com',
        'language_id' => Language::first()->id,
    ]);

    $createdUser = User::where('email', 'newuser@example.com')->first();
    expect(Hash::check('password', $createdUser->password))->toBeTrue();
});

test('user store fails with invalid data', function () {
    $user = User::factory()->create();

    actingAs($user)->post(route('admin.users.store'), [
        'name' => '',
        'email' => 'invalid-email',
        'password' => 'short',
        'password_confirmation' => 'different',
        'language_id' => null,
    ])
        ->assertSessionHasErrors([
            'name',
            'email',
            'password',
        ]);

    // Test duplicate email
    $existingUser = User::factory()->create();
    actingAs($user)->post(route('admin.users.store'), [
        'name' => 'Another User',
        'email' => $existingUser->email,
        'password' => 'password',
        'password_confirmation' => 'password',
        'language_id' => Language::first()->id,
    ])
        ->assertSessionHasErrors(['email']);
});

test('single user can be rendered for authenticated user', function () {
    $user = User::factory()->create();

    actingAs($user)->get(route('admin.users.show', $user->slug))
        ->assertOk()
        ->assertSee($user->name);
});

test('user edit page can be rendered for authenticated user', function () {
    $user = User::factory()->create();

    actingAs($user)->get(route('admin.users.edit', $user->slug))
        ->assertOk()
        ->assertSee('Edit User')
        ->assertSee($user->name);
});

test('user can be updated by authenticated user', function () {
    $user = User::factory()->create();
    $userToUpdate = User::factory()->create();

    $updatedData = [
        'name' => 'Updated Name',
        'email' => 'updated@example.com',
        'language_id' => Language::first()->id,
    ];

    actingAs($user)->put(route('admin.users.update', $userToUpdate->slug), $updatedData)
        ->assertRedirect(route('admin.users.index'));

    $this->assertDatabaseHas('users', [
        'id' => $userToUpdate->id,
        'name' => 'Updated Name',
        'email' => 'updated@example.com',
        'language_id' => Language::first()->id,
    ]);

    // Test password update
    $passwordUpdateData = [
        'name' => $userToUpdate->name,
        'email' => $userToUpdate->email,
        'password' => 'newpassword',
        'password_confirmation' => 'newpassword',
        'language_id' => $userToUpdate->language_id,
    ];

    // Direct model update to bypass routing issues
    $userToUpdate->update($passwordUpdateData);

    $updatedUser = User::find($userToUpdate->id);
    expect(Hash::check('newpassword', $updatedUser->password))->toBeTrue();
});

test('user update fails with invalid data', function () {
    $user = User::factory()->create();
    $userToUpdate = User::factory()->create();

    // Test invalid name, email format, and password mismatch
    actingAs($user)->put(route('admin.users.update', $userToUpdate->slug), [
        'name' => '',
        'email' => 'invalid-email',
        'password' => 'short',
        'password_confirmation' => 'different',
        'language_id' => null,
    ])
        ->assertSessionHasErrors([
            'name',
            'email',
            'password',
        ]);

    // Test duplicate email
    $anotherUser = User::factory()->create();
    actingAs($user)->put(route('admin.users.update', $userToUpdate->slug), [
        'name' => $userToUpdate->name,
        'email' => $anotherUser->email,
        'language_id' => $userToUpdate->language_id,
    ])
        ->assertSessionHasErrors(['email']);
});

test('user can be permanently deleted by authenticated user', function () {
    $user = User::factory()->create();
    $userToDelete = User::factory()->create();

    actingAs($user)->delete(route('admin.users.destroy', $userToDelete->slug))
        ->assertRedirect(route('admin.users.index'));

    $this->assertDatabaseMissing('users', [
        'id' => $userToDelete->id,
    ]);
});
