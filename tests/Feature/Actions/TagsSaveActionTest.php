<?php

use App\Actions\TagsSaveAction;
use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

uses(RefreshDatabase::class);

beforeEach(function () {
    Language::factory()->create(['code' => 'en', 'name' => 'English', 'default' => true, 'is_active' => true]);
    User::factory()->create();
});

it('can create and sync new tags with a model', function () {
    $post = Post::factory()->create(['user_id' => Auth::id()]);
    $model = PostTranslation::factory()->create([
        'post_id' => $post->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
    ]);

    $action = new TagsSaveAction;
    $action->handle(['tag1', 'tag2', 'tag3'], $model);

    $this->assertDatabaseHas('tags', ['name' => 'tag1']);
    $this->assertDatabaseHas('tags', ['name' => 'tag2']);
    $this->assertDatabaseHas('tags', ['name' => 'tag3']);

    expect($model->tags)->toHaveCount(3);
    expect($model->tags->pluck('name')->toArray())->toContain('tag1', 'tag2', 'tag3');
});

it('can update and sync existing tags with a model', function () {
    $post = Post::factory()->create(['user_id' => Auth::id()]);
    $model = PostTranslation::factory()->create([
        'post_id' => $post->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
    ]);

    // Initial tags
    $action = new TagsSaveAction;
    $action->handle(['tag1', 'tag2'], $model);

    expect($model->tags)->toHaveCount(2);

    // Update tags
    $action->handle(['tag2', 'tag3', 'tag4'], $model);

    $this->assertDatabaseHas('tags', ['name' => 'tag2']);
    $this->assertDatabaseHas('tags', ['name' => 'tag3']);
    $this->assertDatabaseHas('tags', ['name' => 'tag4']);

    expect($model->fresh()->tags)->toHaveCount(3);
    expect($model->fresh()->tags->pluck('name')->toArray())->toContain('tag2', 'tag3', 'tag4');
    expect($model->fresh()->tags->pluck('name')->toArray())->not->toContain('tag1');
});

it('handles empty tags string', function () {
    $post = Post::factory()->create(['user_id' => Auth::id()]);
    $model = PostTranslation::factory()->create([
        'post_id' => $post->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
    ]);

    $action = new TagsSaveAction;
    $action->handle(['tag1', 'tag2'], $model);

    expect($model->tags)->toHaveCount(2);

    // Pass empty string for tags
    $action->handle([], $model);

    expect($model->fresh()->tags)->toHaveCount(0);
});
