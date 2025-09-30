<?php

use App\Enums\PostStatus;
use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('generates a slug when creating a post translation without one', function () {
    $postTranslation = PostTranslation::factory()->create(['title' => 'My First Post Translation', 'slug' => null]);
    expect($postTranslation->slug)->toBe('my-first-post-translation');
});

it('uses the provided slug when creating a post translation with one', function () {
    $postTranslation = PostTranslation::factory()->create(['title' => 'My Second Post Translation', 'slug' => 'custom-translation-slug']);
    expect($postTranslation->slug)->toBe('custom-translation-slug');
});

it('generates a unique slug when creating post translations with the same title', function () {
    PostTranslation::factory()->create(['title' => 'Duplicate Translation Title', 'slug' => null]);
    $postTranslation2 = PostTranslation::factory()->create(['title' => 'Duplicate Translation Title', 'slug' => null]);
    expect($postTranslation2->slug)->toBe('duplicate-translation-title-2');
});

it('can be soft deleted', function () {
    $postTranslation = PostTranslation::factory()->create();
    $postTranslation->delete();

    // Assert that the translation is not found in regular queries
    expect(PostTranslation::find($postTranslation->id))->toBeNull();

    // Assert that the translation is found when using withTrashed()
    $softDeletedTranslation = PostTranslation::withTrashed()->find($postTranslation->id);
    expect($softDeletedTranslation)->not->toBeNull();
    expect($softDeletedTranslation->deleted_at)->not->toBeNull();
});

it('has expected casts', function () {
    $postTranslation = new PostTranslation;
    $casts = $postTranslation->getCasts();

    expect($casts['excerpt'])->toBe('string');
    expect($casts['body'])->toBe('string');
    expect($casts['order'])->toBe('integer');
    expect($casts['status'])->toBe(PostStatus::class);
    expect($casts['published_at'])->toBe('datetime');
    expect($casts['published_through'])->toBe('datetime');
    expect($casts['created_at'])->toBe('datetime');
    expect($casts['updated_at'])->toBe('datetime');
    expect($casts['deleted_at'])->toBe('datetime');
});

it('a post translation belongs to a post', function () {
    $post = Post::factory()->create();
    $postTranslation = PostTranslation::factory()->create(['post_id' => $post->id]);

    expect($postTranslation->post->id)->toBe($post->id);
});

it('a post translation belongs to a user', function () {
    $user = User::factory()->create();
    $postTranslation = PostTranslation::factory()->create(['user_id' => $user->id]);

    expect($postTranslation->user->id)->toBe($user->id);
});

it('a post translation belongs to a language', function () {
    $language = Language::factory()->create();
    $postTranslation = PostTranslation::factory()->create(['language_id' => $language->id]);

    expect($postTranslation->language->id)->toBe($language->id);
});

it('a post translation can have many tags', function () {
    $postTranslation = PostTranslation::factory()->create();
    $tag = Tag::factory()->create();
    $postTranslation->tags()->attach($tag);

    expect($postTranslation->tags)->toHaveCount(1);
    expect($postTranslation->tags->first()->id)->toBe($tag->id);
});
