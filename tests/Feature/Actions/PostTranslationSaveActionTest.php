<?php

use App\Actions\PostTranslationSaveAction;
use App\Enums\PostStatus;
use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(function () {
    Language::factory()->create(['code' => 'en', 'name' => 'English', 'default' => true, 'is_active' => true]);
    User::factory()->create();
});

it('can create a new post translation without image and tags', function () {
    $post = Post::factory()->create(['user_id' => Auth::id()]);
    $action = app(PostTranslationSaveAction::class);

    $data = [
        'post_id' => $post->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'New Post Translation',
        'excerpt' => 'Post translation excerpt',
        'body' => 'Post translation body content.',
        'order' => 1,
        'status' => PostStatus::Published,
    ];

    $action->handle($data);

    $this->assertDatabaseHas('post_translations', [
        'post_id' => $post->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'New Post Translation',
        'excerpt' => 'Post translation excerpt',
        'body' => 'Post translation body content.',
        'order' => 1,
        'status' => PostStatus::Published,
        'image' => null,
    ]);
});

it('can create a new post translation with image', function () {
    Storage::fake('public');
    $mockImage = UploadedFile::fake()->image('post_translation.jpg');
    $post = Post::factory()->create(['user_id' => Auth::id()]);

    $action = app(PostTranslationSaveAction::class);

    $data = [
        'post_id' => $post->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Post Translation with Image',
        'excerpt' => 'Post translation excerpt with image',
        'body' => 'Post translation body content with image.',
        'order' => 2,
        'status' => PostStatus::Published,
        'image' => $mockImage,
    ];

    $action->handle($data);

    $this->assertDatabaseHas('post_translations', [
        'title' => 'Post Translation with Image',
    ]);

    $postTranslation = PostTranslation::where('title', 'Post Translation with Image')->first();
    $this->assertNotNull($postTranslation);
    $this->assertStringStartsWith('post-translation-with-image-', $postTranslation->image);
    $this->assertStringEndsWith('.jpg', $postTranslation->image);
});

it('can create a new post translation with tags', function () {
    $post = Post::factory()->create(['user_id' => Auth::id()]);
    $action = app(PostTranslationSaveAction::class);

    $data = [
        'post_id' => $post->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Post Translation with Tags',
        'excerpt' => 'Post translation excerpt with tags',
        'body' => 'Post translation body content with tags.',
        'order' => 3,
        'status' => PostStatus::Published,
        'tags' => ['tag1', 'tag2'],
    ];

    $action->handle($data);

    $this->assertDatabaseHas('post_translations', [
        'title' => 'Post Translation with Tags',
    ]);
});
