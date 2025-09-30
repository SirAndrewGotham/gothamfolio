<?php

use App\Models\Language;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('generates a slug when creating a language without one', function () {
    $language = Language::factory()->create(['english' => 'English Language', 'slug' => null]);
    expect($language->slug)->toBe('english-language');
});

it('uses the provided slug when creating a language with one', function () {
    $language = Language::factory()->create(['english' => 'French Language', 'slug' => 'custom-language-slug']);
    expect($language->slug)->toBe('custom-language-slug');
});

it('generates a unique slug when creating languages with the same english name', function () {
    Language::factory()->create(['english' => 'Duplicate Language', 'slug' => null]);
    $language2 = Language::factory()->create(['english' => 'Duplicate Language', 'slug' => null]);
    expect($language2->slug)->toBe('duplicate-language-2');
});

it('generates a new slug when updating language english name and slug is empty', function () {
    $language = Language::factory()->create(['english' => 'Old English', 'slug' => 'old-english']);
    $language->update(['english' => 'New English', 'slug' => null]);
    expect($language->slug)->toBe('new-english');
});

it('does not change slug when updating language english name but slug is not empty', function () {
    $language = Language::factory()->create(['english' => 'Old English', 'slug' => 'my-custom-slug']);
    $language->update(['english' => 'New English']);
    expect($language->slug)->toBe('my-custom-slug');
});

it('can be soft deleted', function () {
    $language = Language::factory()->create();
    $language->delete();

    // Assert that the language is not found in regular queries
    expect(Language::find($language->id))->toBeNull();

    // Assert that the language is found when using withTrashed()
    $softDeletedLanguage = Language::withTrashed()->find($language->id);
    expect($softDeletedLanguage)->not->toBeNull();
    expect($softDeletedLanguage->deleted_at)->not->toBeNull();
});

it('has guarded attributes', function () {
    $language = new Language;
    expect($language->getGuarded())->toEqual([
        'id',
    ]);
});

it('a language can belong to many users', function () {
    $language = Language::factory()->create();
    $user = User::factory()->create();
    $language->users()->attach($user);

    expect($language->users)->toHaveCount(1);
    expect($language->users->first()->id)->toBe($user->id);
});
