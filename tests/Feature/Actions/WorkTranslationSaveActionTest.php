<?php

use App\Actions\WorkTranslationSaveAction;
use App\Enums\WorkStatus;
use App\Models\Language;
use App\Models\User;
use App\Models\Work;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(function () {
    Language::factory()->create(['code' => 'en', 'name' => 'English', 'default' => true, 'is_active' => true]);
    User::factory()->create();
});

it('can create a new work translation without image and tags', function () {
    $work = Work::factory()->create(['user_id' => Auth::id()]);
    $action = app(WorkTranslationSaveAction::class);

    $data = [
        'work_id' => $work->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'New Work Translation',
        'excerpt' => 'Work translation excerpt',
        'body' => 'Work translation body content.',
        'order' => 1,
        'status' => WorkStatus::Published,
    ];

    $action->handle($data);

    $this->assertDatabaseHas('work_translations', [
        'work_id' => $work->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'New Work Translation',
        'excerpt' => 'Work translation excerpt',
        'body' => 'Work translation body content.',
        'order' => 1,
        'status' => WorkStatus::Published,
        'image' => null,
    ]);
});

it('can create a new work translation with image', function () {
    Storage::fake('public');
    $mockImage = UploadedFile::fake()->image('work_translation.jpg');
    $work = Work::factory()->create(['user_id' => Auth::id()]);

    $action = app(WorkTranslationSaveAction::class);

    $data = [
        'work_id' => $work->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Work Translation with Image',
        'excerpt' => 'Work translation excerpt with image',
        'body' => 'Work translation body content with image.',
        'order' => 2,
        'status' => WorkStatus::Published,
        'image' => $mockImage,
    ];

    $action->handle($data);

    $this->assertDatabaseHas('work_translations', [
        'title' => 'Work Translation with Image',
        'image' => $mockImage,
    ]);
});

it('can create a new work translation with tags', function () {
    $work = Work::factory()->create(['user_id' => Auth::id()]);
    $action = app(WorkTranslationSaveAction::class);

    $data = [
        'work_id' => $work->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Work Translation with Tags',
        'excerpt' => 'Work translation excerpt with tags',
        'body' => 'Work translation body content with tags.',
        'order' => 3,
        'status' => WorkStatus::Published,
        'tags' => ['tag1', 'tag2'],
    ];

    $action->handle($data);

    $this->assertDatabaseHas('work_translations', [
        'title' => 'Work Translation with Tags',
    ]);
});
