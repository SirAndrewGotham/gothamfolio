<?php

use App\Actions\PostTranslationUpdateAction;
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

it('can update an existing post translation without image and tags', function () {
    $post = Post::factory()->create(['user_id' => Auth::id()]);
    $postTranslation = PostTranslation::factory()->create([
        'post_id' => $post->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Original Title',
        'excerpt' => 'Original excerpt',
        'body' => 'Original body content.',
        'order' => 1,
        'status' => PostStatus::Published,
    ]);

    $action = app(PostTranslationUpdateAction::class);

    $updatedData = [
        'title' => 'Updated Post Translation',
        'excerpt' => 'Updated excerpt',
        'body' => 'Updated body content.',
        'order' => 2,
        'status' => PostStatus::Draft,
    ];

    $action->handle($updatedData, $postTranslation);

    $this->assertDatabaseHas('post_translations', [
        'id' => $postTranslation->id,
        'title' => 'Updated Post Translation',
        'excerpt' => 'Updated excerpt',
        'body' => 'Updated body content.',
        'order' => 2,
        'status' => PostStatus::Draft,
    ]);
});

it('can update an existing post translation with image', function () {
    Storage::fake('public');
    $mockImage = UploadedFile::fake()->image('updated_post_translation.jpg');
    $post = Post::factory()->create(['user_id' => Auth::id()]);
    $postTranslation = PostTranslation::factory()->create([
        'post_id' => $post->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Original Title with Image',
        'image' => 'original_image.jpg',
    ]);

    $action = app(PostTranslationUpdateAction::class);

    $updatedData = [
        'title' => 'Updated Title with Image',
        // No image provided to simulate keeping existing image
    ];

    $action->handle($updatedData, $postTranslation);

    $this->assertDatabaseHas('post_translations', [
        'id' => $postTranslation->id,
        'title' => 'Updated Title with Image',
        'image' => 'original_image.jpg',
    ]);
});

it('can update an existing post translation with tags', function () {
    $post = Post::factory()->create(['user_id' => Auth::id()]);
    $postTranslation = PostTranslation::factory()->create([
        'post_id' => $post->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Original Title with Tags',
    ]);

    $action = app(PostTranslationUpdateAction::class);

    $updatedData = [
        'title' => 'Updated Title with Tags',
        'tags' => ['new_tag1', 'new_tag2'],
    ];

    $action->handle($updatedData, $postTranslation);

    $this->assertDatabaseHas('post_translations', [
        'id' => $postTranslation->id,
        'title' => 'Updated Title with Tags',
    ]);
});
