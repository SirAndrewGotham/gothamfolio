<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('generates a slug when creating a post without one', function () {
    $post = Post::factory()->create(['title' => 'My First Post', 'slug' => null]);
    expect($post->slug)->toBe('my-first-post');
});

it('uses the provided slug when creating a post with one', function () {
    $post = Post::factory()->create(['title' => 'My Second Post', 'slug' => 'custom-post-slug']);
    expect($post->slug)->toBe('custom-post-slug');
});

it('generates a unique slug when creating posts with the same title', function () {
    Post::factory()->create(['title' => 'Duplicate Post Title', 'slug' => null]);
    $post2 = Post::factory()->create(['title' => 'Duplicate Post Title', 'slug' => null]);
    expect($post2->slug)->toBe('duplicate-post-title-2');
});

it('can be soft deleted', function () {
    $post = Post::factory()->create();
    $post->delete();

    // Assert that the post is not found in regular queries
    expect(Post::find($post->id))->toBeNull();

    // Assert that the post is found when using withTrashed()
    $softDeletedPost = Post::withTrashed()->find($post->id);
    expect($softDeletedPost)->not->toBeNull();
    expect($softDeletedPost->deleted_at)->not->toBeNull();
});

it('has expected fillable attributes', function () {
    $post = new Post;
    expect($post->getFillable())->toEqual([
        'user_id',
        'title',
        'slug',
    ]);
});

it('a post has many translations', function () {
    $post = Post::factory()->create();
    $translation = \App\Models\PostTranslation::factory()->create(['post_id' => $post->id]);

    expect($post->translations)->toHaveCount(1);
    expect($post->translations->first()->id)->toBe($translation->id);
});

it('a post belongs to a user', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    expect($post->user->id)->toBe($user->id);
});

it('a post can have many tags', function () {
    $post = Post::factory()->create();
    $tag = \App\Models\Tag::factory()->create();
    $post->tags()->attach($tag);

    expect($post->tags)->toHaveCount(1);
    expect($post->tags->first()->id)->toBe($tag->id);
});
