<?php

use App\Enums\WorkStatus;
use App\Models\Language;
use App\Models\Tag;
use App\Models\User;
use App\Models\Work;
use App\Models\WorkTranslation;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('generates a slug when creating a work translation without one', function () {
    $workTranslation = WorkTranslation::factory()->create(['title' => 'My First Work Translation', 'slug' => null]);
    expect($workTranslation->slug)->toBe('my-first-work-translation');
});

it('uses the provided slug when creating a work translation with one', function () {
    $workTranslation = WorkTranslation::factory()->create(['title' => 'My Second Work Translation', 'slug' => 'custom-translation-slug']);
    expect($workTranslation->slug)->toBe('custom-translation-slug');
});

it('generates a unique slug when creating work translations with the same title', function () {
    WorkTranslation::factory()->create(['title' => 'Duplicate Translation Title', 'slug' => null]);
    $workTranslation2 = WorkTranslation::factory()->create(['title' => 'Duplicate Translation Title', 'slug' => null]);
    expect($workTranslation2->slug)->toBe('duplicate-translation-title-2');
});

it('can be soft deleted', function () {
    $workTranslation = WorkTranslation::factory()->create();
    $workTranslation->delete();

    // Assert that the translation is not found in regular queries
    expect(WorkTranslation::find($workTranslation->id))->toBeNull();

    // Assert that the translation is found when using withTrashed()
    $softDeletedTranslation = WorkTranslation::withTrashed()->find($workTranslation->id);
    expect($softDeletedTranslation)->not->toBeNull();
    expect($softDeletedTranslation->deleted_at)->not->toBeNull();
});

it('has expected casts', function () {
    $workTranslation = new WorkTranslation;
    $casts = $workTranslation->getCasts();

    expect($casts['excerpt'])->toBe('string');
    expect($casts['body'])->toBe('string');
    expect($casts['order'])->toBe('integer');
    expect($casts['status'])->toBe(WorkStatus::class);
    expect($casts['published_at'])->toBe('datetime');
    expect($casts['published_through'])->toBe('datetime');
    expect($casts['created_at'])->toBe('datetime');
    expect($casts['updated_at'])->toBe('datetime');
    expect($casts['deleted_at'])->toBe('datetime');
});

it('a work translation belongs to a work', function () {
    $work = Work::factory()->create();
    $workTranslation = WorkTranslation::factory()->create(['work_id' => $work->id]);

    expect($workTranslation->work->id)->toBe($work->id);
});

it('a work translation belongs to a user', function () {
    $user = User::factory()->create();
    $workTranslation = WorkTranslation::factory()->create(['user_id' => $user->id]);

    expect($workTranslation->user->id)->toBe($user->id);
});

it('a work translation belongs to a language', function () {
    $language = Language::factory()->create();
    $workTranslation = WorkTranslation::factory()->create(['language_id' => $language->id]);

    expect($workTranslation->language->id)->toBe($language->id);
});

it('a work translation can have many tags', function () {
    $workTranslation = WorkTranslation::factory()->create();
    $tag = Tag::factory()->create();
    $workTranslation->tags()->attach($tag);

    expect($workTranslation->tags)->toHaveCount(1);
    expect($workTranslation->tags->first()->id)->toBe($tag->id);
});
