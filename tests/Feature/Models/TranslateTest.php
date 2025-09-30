<?php

use App\Models\Language;
use App\Models\Translate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can be soft deleted', function () {
    $translate = Translate::factory()->create();
    $translate->delete();

    // Assert that the translate is not found in regular queries
    expect(Translate::find($translate->id))->toBeNull();

    // Assert that the translate is found when using withTrashed()
    $softDeletedTranslate = Translate::withTrashed()->find($translate->id);
    expect($softDeletedTranslate)->not->toBeNull();
    expect($softDeletedTranslate->deleted_at)->not->toBeNull();
});

it('has guarded attributes', function () {
    $translate = new Translate;
    expect($translate->getGuarded())->toEqual([
        'id',
    ]);
});

it('belongs to a language', function () {
    $language = Language::factory()->create();
    $translate = Translate::factory()->create(['language_id' => $language->id]);

    expect($translate->language->id)->toBe($language->id);
});

it('has a translatable owner', function () {
    $user = User::factory()->create();
    $translate = Translate::factory()->create(['translatable_type' => User::class, 'translatable_id' => $user->id]);

    expect($translate->translatable)->toBeInstanceOf(User::class);
    expect($translate->translatable->id)->toBe($user->id);
});
