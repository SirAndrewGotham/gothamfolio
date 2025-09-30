<?php

use App\Enums\CompetenceStatus;
use App\Models\Competence;
use App\Models\CompetenceTranslation;
use App\Models\Language;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('generates a slug when creating a competence translation without one', function () {
    $competenceTranslation = CompetenceTranslation::factory()->create(['title' => 'My First Competence Translation', 'slug' => null]);
    expect($competenceTranslation->slug)->toBe('my-first-competence-translation');
});

it('uses the provided slug when creating a competence translation with one', function () {
    $competenceTranslation = CompetenceTranslation::factory()->create(['title' => 'My Second Competence Translation', 'slug' => 'custom-translation-slug']);
    expect($competenceTranslation->slug)->toBe('custom-translation-slug');
});

it('generates a unique slug when creating competence translations with the same title', function () {
    CompetenceTranslation::factory()->create(['title' => 'Duplicate Translation Title', 'slug' => null]);
    $competenceTranslation2 = CompetenceTranslation::factory()->create(['title' => 'Duplicate Translation Title', 'slug' => null]);
    expect($competenceTranslation2->slug)->toBe('duplicate-translation-title-2');
});

it('can be soft deleted', function () {
    $competenceTranslation = CompetenceTranslation::factory()->create();
    $competenceTranslation->delete();

    // Assert that the translation is not found in regular queries
    expect(CompetenceTranslation::find($competenceTranslation->id))->toBeNull();

    // Assert that the translation is found when using withTrashed()
    $softDeletedTranslation = CompetenceTranslation::withTrashed()->find($competenceTranslation->id);
    expect($softDeletedTranslation)->not->toBeNull();
    expect($softDeletedTranslation->deleted_at)->not->toBeNull();
});

it('has expected casts', function () {
    $competenceTranslation = new CompetenceTranslation;
    $casts = $competenceTranslation->getCasts();

    expect($casts['excerpt'])->toBe('string');
    expect($casts['body'])->toBe('string');
    expect($casts['order'])->toBe('integer');
    expect($casts['status'])->toBe(CompetenceStatus::class);
    expect($casts['published_at'])->toBe('datetime');
    expect($casts['published_through'])->toBe('datetime');
    expect($casts['created_at'])->toBe('datetime');
    expect($casts['updated_at'])->toBe('datetime');
    expect($casts['deleted_at'])->toBe('datetime');
});

it('a competence translation belongs to a competence', function () {
    $competence = Competence::factory()->create();
    $competenceTranslation = CompetenceTranslation::factory()->create(['competence_id' => $competence->id]);

    expect($competenceTranslation->competence->id)->toBe($competence->id);
});

it('a competence translation belongs to a user', function () {
    $user = User::factory()->create();
    $competenceTranslation = CompetenceTranslation::factory()->create(['user_id' => $user->id]);

    expect($competenceTranslation->user->id)->toBe($user->id);
});

it('a competence translation belongs to a language', function () {
    $language = Language::factory()->create();
    $competenceTranslation = CompetenceTranslation::factory()->create(['language_id' => $language->id]);

    expect($competenceTranslation->language->id)->toBe($language->id);
});

it('a competence translation can have many tags', function () {
    $competenceTranslation = CompetenceTranslation::factory()->create();
    $tag = Tag::factory()->create();
    $competenceTranslation->tags()->attach($tag);

    expect($competenceTranslation->tags)->toHaveCount(1);
    expect($competenceTranslation->tags->first()->id)->toBe($tag->id);
});
