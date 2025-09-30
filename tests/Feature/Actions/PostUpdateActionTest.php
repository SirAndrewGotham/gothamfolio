<?php

use App\Actions\PostUpdateAction;
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

it('can update an existing post and its translation without image and tags', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id, 'title' => 'Original Post Title']);
    $postTranslation = PostTranslation::factory()->create([
        'post_id' => $post->id,
        'language_id' => Language::first()->id,
        'user_id' => $user->id,
        'title' => 'Original Post Translation Title',
        'excerpt' => 'Original excerpt',
        'body' => 'Original body content.',
        'order' => 1,
        'status' => PostStatus::Published,
    ]);

    $action = app(PostUpdateAction::class);

    $updatedData = [
        'language_id' => Language::first()->id,
        'title' => 'Updated Post Title (Main)',
        'translation_title' => 'Updated Post Translation',
        'excerpt' => 'Updated excerpt',
        'body' => 'Updated body content.',
        'order' => 2,
        'status' => PostStatus::Draft,
    ];

    $action->handle($updatedData, $post);

    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => 'Updated Post Title (Main)',
    ]);

    $this->assertDatabaseHas('post_translations', [
        'id' => $postTranslation->id,
        'title' => 'Updated Post Title (Main)',
        'excerpt' => 'Updated excerpt',
        'body' => 'Updated body content.',
        'order' => 2,
        'status' => PostStatus::Draft,
    ]);
});

it('can update an existing post and its translation with image', function () {
    Storage::fake('public');
    $originalImage = UploadedFile::fake()->image('original_image.jpg');

    $post = Post::factory()->create([
        'user_id' => Auth::id(),
        'title' => 'Post with Image Original',
        'slug' => 'post-with-image-original',
    ]);
    $postTranslation = PostTranslation::factory()->create([
        'post_id' => $post->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Post with Image Original',
        'image' => $originalImage->hashName(),
    ]);

    $mockImage = UploadedFile::fake()->image('new_image.jpg');
    $mockImageName = 'post-with-image-original-new_image.jpg';

    $action = app(PostUpdateAction::class);

    $updatedData = [
        'language_id' => Language::first()->id,
        'title' => 'Updated Post Title Image (Main)',
        'excerpt' => 'Updated excerpt image',
        'body' => 'Updated body content image.',
        'order' => 3,
        'status' => PostStatus::Published,
        'image' => $mockImage,
    ];

    $action->handle($updatedData, $post);

    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => 'Updated Post Title Image (Main)',
    ]);

    $post->refresh(); // Refresh the post to get the updated translation
    $postTranslation->refresh(); // Refresh the translation

    $this->assertStringStartsWith('updated-post-title-image-main-', $postTranslation->image);
    $this->assertStringEndsWith('.jpg', $postTranslation->image);

    Storage::disk('public')->assertExists('uploads/posts/'.$post->id.'/'.$postTranslation->image);
    Storage::disk('public')->assertMissing('uploads/posts/'.$post->id.'/'.$originalImage->hashName());
});

it('can update an existing post and its translation with tags', function () {
    $post = Post::factory()->create([
        'user_id' => Auth::id(),
        'title' => 'Post with Tags Original',
        'slug' => 'post-with-tags-original',
    ]);
    $postTranslation = PostTranslation::factory()->create([
        'post_id' => $post->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Post with Tags Original',
    ]);

    $action = app(PostUpdateAction::class);

    $updatedData = [
        'language_id' => Language::first()->id,
        'title' => 'Updated Post Title Tags (Main)',
        'excerpt' => 'Updated excerpt tags',
        'body' => 'Updated body content tags.',
        'order' => 4,
        'status' => PostStatus::Draft,
        'tags' => ['updated_tag1', 'updated_tag2'],
    ];

    $action->handle($updatedData, $post);

    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => 'Updated Post Title Tags (Main)',
    ]);

    $this->assertDatabaseHas('post_translations', [
        'id' => $postTranslation->id,
        'title' => 'Updated Post Title Tags (Main)',
    ]);

    $this->assertDatabaseHas('tags', ['name' => 'updated_tag1']);
    $this->assertDatabaseHas('tags', ['name' => 'updated_tag2']);
});
