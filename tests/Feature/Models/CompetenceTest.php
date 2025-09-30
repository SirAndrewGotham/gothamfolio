<?php

use App\Models\Competence;
use App\Models\CompetenceTranslation;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('generates a slug when creating a competence without one', function () {
    $competence = Competence::factory()->create(['title' => 'My First Competence', 'slug' => null]);
    expect($competence->slug)->toBe('my-first-competence');
});

it('uses the provided slug when creating a competence with one', function () {
    $competence = Competence::factory()->create(['title' => 'My Second Competence', 'slug' => 'custom-competence-slug']);
    expect($competence->slug)->toBe('custom-competence-slug');
});

it('generates a unique slug when creating competences with the same title', function () {
    Competence::factory()->create(['title' => 'Duplicate Competence Title', 'slug' => null]);
    $competence2 = Competence::factory()->create(['title' => 'Duplicate Competence Title', 'slug' => null]);
    expect($competence2->slug)->toBe('duplicate-competence-title-2');
});

it('can be soft deleted', function () {
    $competence = Competence::factory()->create();
    $competence->delete();

    // Assert that the competence is not found in regular queries
    expect(Competence::find($competence->id))->toBeNull();

    // Assert that the competence is found when using withTrashed()
    $softDeletedCompetence = Competence::withTrashed()->find($competence->id);
    expect($softDeletedCompetence)->not->toBeNull();
    expect($softDeletedCompetence->deleted_at)->not->toBeNull();
});

it('has expected fillable attributes', function () {
    $competence = new Competence;
    expect($competence->getFillable())->toEqual([
        'user_id',
        'title',
        'slug',
    ]);
});

it('a competence has many translations', function () {
    $competence = Competence::factory()->create();
    $translation = CompetenceTranslation::factory()->create(['competence_id' => $competence->id]);

    expect($competence->translations)->toHaveCount(1);
    expect($competence->translations->first()->id)->toBe($translation->id);
});

it('a competence belongs to a user', function () {
    $user = User::factory()->create();
    $competence = Competence::factory()->create(['user_id' => $user->id]);

    expect($competence->user->id)->toBe($user->id);
});

it('a competence can have many tags', function () {
    $competence = Competence::factory()->create();
    $tag = Tag::factory()->create();
    $competence->tags()->attach($tag);

    expect($competence->tags)->toHaveCount(1);
    expect($competence->tags->first()->id)->toBe($tag->id);
});
