<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('generates a slug when creating a user without one', function () {
    $user = User::factory()->create(['name' => 'Test User', 'slug' => null]);
    expect($user->slug)->toBe('test-user');
});

it('uses the provided slug when creating a user with one', function () {
    $user = User::factory()->create(['name' => 'Test User', 'slug' => 'custom-slug']);
    expect($user->slug)->toBe('custom-slug');
});

it('generates a unique slug when creating users with the same name', function () {
    User::factory()->create(['name' => 'Duplicate User', 'slug' => null]);
    $user2 = User::factory()->create(['name' => 'Duplicate User', 'slug' => null]);
    expect($user2->slug)->toBe('duplicate-user-2');
});

it('generates a new slug when updating user name and slug is empty', function () {
    $user = User::factory()->create(['name' => 'Old Name', 'slug' => 'old-name']);
    $user->update(['name' => 'New Name', 'slug' => null]);
    expect($user->slug)->toBe('new-name');
});

it('does not change slug when updating user name but slug is not empty', function () {
    $user = User::factory()->create(['name' => 'Old Name', 'slug' => 'my-custom-slug']);
    $user->update(['name' => 'New Name']);
    expect($user->slug)->toBe('my-custom-slug');
});

it('generates a unique slug when updating user name and slug is empty, and name is duplicated', function () {
    User::factory()->create(['name' => 'Another User', 'slug' => 'another-user']);
    $user2 = User::factory()->create(['name' => 'Temporary Name', 'slug' => null]);
    $user2->update(['name' => 'Another User', 'slug' => null]);
    expect($user2->slug)->toBe('another-user-2');
});

it('has expected fillable attributes', function () {
    $user = new User;
    expect($user->getFillable())->toEqual([
        'name',
        'email',
        'password',
        'slug',
        'language_id',
    ]);
});

it('has expected hidden attributes', function () {
    $user = new User;
    expect($user->getHidden())->toEqual([
        'password',
        'remember_token',
    ]);
});

it('has expected casts', function () {
    $user = new User;
    $casts = $user->getCasts();

    expect($casts['email_verified_at'])->toBe('datetime');
    expect($casts['password'])->toBe('hashed');
});

it('a user can have posts', function () {
    $user = User::factory()->create();
    $post = \App\Models\Post::factory()->create(['user_id' => $user->id]);

    expect($user->posts)->toHaveCount(1);
    expect($user->posts->first()->id)->toBe($post->id);
});

it('a user can have works', function () {
    $user = User::factory()->create();
    $work = \App\Models\Work::factory()->create(['user_id' => $user->id]);

    expect($user->works)->toHaveCount(1);
    expect($user->works->first()->id)->toBe($work->id);
});

it('a user can belong to many languages', function () {
    $user = User::factory()->create();
    $language = \App\Models\Language::factory()->create();
    $user->languages()->attach($language);

    expect($user->languages)->toHaveCount(1);
    expect($user->languages->first()->id)->toBe($language->id);
});
