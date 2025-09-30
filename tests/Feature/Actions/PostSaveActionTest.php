<?php

use App\Actions\PostSaveAction;
use App\Enums\PostStatus;
use App\Models\Language;
use App\Models\Post;
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

it('can create a new post without image and tags', function () {
    $action = app(PostSaveAction::class);

    $data = [
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'New Post',
        'excerpt' => 'Post excerpt',
        'body' => 'Post body content.',
        'order' => 1,
        'status' => PostStatus::Published,
    ];

    $action->handle($data);

    $this->assertDatabaseHas('posts', [
        'user_id' => Auth::id(),
        'title' => 'New Post',
        'slug' => 'new-post',
    ]);

    $this->assertDatabaseHas('post_translations', [
        'post_id' => Post::first()->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'New Post',
        'excerpt' => 'Post excerpt',
        'body' => 'Post body content.',
        'order' => 1,
        'status' => PostStatus::Published,
        'image' => null,
    ]);
});

it('can create a new post with image', function () {
    Storage::fake('public');
    $mockImage = UploadedFile::fake()->image('post.jpg');

    $action = app(PostSaveAction::class);

    $data = [
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Post with Image',
        'excerpt' => 'Post excerpt with image',
        'body' => 'Post body content with image.',
        'order' => 2,
        'status' => PostStatus::Published,
        'image' => $mockImage,
    ];

    $action->handle($data);

    $this->assertDatabaseHas('posts', [
        'title' => 'Post with Image',
    ]);

    $post = Post::where('title', 'Post with Image')->first();
    $this->assertNotNull($post);

    $postTranslation = $post->translations()->where('language_id', Language::first()->id)->first();
    $this->assertNotNull($postTranslation);
    $this->assertStringStartsWith('post-with-image-', $postTranslation->image);
    $this->assertStringEndsWith('.jpg', $postTranslation->image);

});

it('can create a new post with tags', function () {
    $action = app(PostSaveAction::class);

    $data = [
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Post with Tags',
        'excerpt' => 'Post excerpt with tags',
        'body' => 'Post body content with tags.',
        'order' => 3,
        'status' => PostStatus::Published,
        'tags' => ['tag1', 'tag2'],
    ];

    $action->handle($data);

    $this->assertDatabaseHas('posts', [
        'title' => 'Post with Tags',
    ]);

    $this->assertDatabaseHas('post_translations', [
        'title' => 'Post with Tags',
    ]);
});
