<?php

use App\Models\Tag;
use App\Models\User;
use App\Models\Work;
use App\Models\WorkTranslation;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('generates a slug when creating a work without one', function () {
    $work = Work::factory()->create(['title' => 'My First Work', 'slug' => null]);
    expect($work->slug)->toBe('my-first-work');
});

it('uses the provided slug when creating a work with one', function () {
    $work = Work::factory()->create(['title' => 'My Second Work', 'slug' => 'custom-work-slug']);
    expect($work->slug)->toBe('custom-work-slug');
});

it('generates a unique slug when creating works with the same title', function () {
    Work::factory()->create(['title' => 'Duplicate Work Title', 'slug' => null]);
    $work2 = Work::factory()->create(['title' => 'Duplicate Work Title', 'slug' => null]);
    expect($work2->slug)->toBe('duplicate-work-title-2');
});

it('can be soft deleted', function () {
    $work = Work::factory()->create();
    $work->delete();

    // Assert that the work is not found in regular queries
    expect(Work::find($work->id))->toBeNull();

    // Assert that the work is found when using withTrashed()
    $softDeletedWork = Work::withTrashed()->find($work->id);
    expect($softDeletedWork)->not->toBeNull();
    expect($softDeletedWork->deleted_at)->not->toBeNull();
});

it('has expected fillable attributes', function () {
    $work = new Work;
    expect($work->getFillable())->toEqual([
        'user_id',
        'title',
        'slug',
    ]);
});

it('a work has many translations', function () {
    $work = Work::factory()->create();
    $translation = WorkTranslation::factory()->create(['work_id' => $work->id]);

    expect($work->translations)->toHaveCount(1);
    expect($work->translations->first()->id)->toBe($translation->id);
});

it('a work belongs to a user', function () {
    $user = User::factory()->create();
    $work = Work::factory()->create(['user_id' => $user->id]);

    expect($work->user->id)->toBe($user->id);
});

it('a work can have many tags', function () {
    $work = Work::factory()->create();
    $tag = Tag::factory()->create();
    $work->tags()->attach($tag);

    expect($work->tags)->toHaveCount(1);
    expect($work->tags->first()->id)->toBe($tag->id);
});
