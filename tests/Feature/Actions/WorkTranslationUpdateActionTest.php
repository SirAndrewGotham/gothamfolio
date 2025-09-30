<?php

use App\Actions\WorkTranslationUpdateAction;
use App\Enums\WorkStatus;
use App\Models\Language;
use App\Models\User;
use App\Models\Work;
use App\Models\WorkTranslation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(function () {
    Language::factory()->create(['code' => 'en', 'name' => 'English', 'default' => true, 'is_active' => true]);
    User::factory()->create();
});

it('can update an existing work translation without image and tags', function () {
    $work = Work::factory()->create(['user_id' => Auth::id()]);
    $workTranslation = WorkTranslation::factory()->create([
        'work_id' => $work->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Original Title',
        'excerpt' => 'Original excerpt',
        'body' => 'Original body content.',
        'order' => 1,
        'status' => WorkStatus::Published,
    ]);

    $action = app(WorkTranslationUpdateAction::class);

    $updatedData = [
        'title' => 'Updated Work Translation',
        'excerpt' => 'Updated excerpt',
        'body' => 'Updated body content.',
        'order' => 2,
        'status' => WorkStatus::Draft,
    ];

    $action->handle($updatedData, $workTranslation);

    $this->assertDatabaseHas('work_translations', [
        'id' => $workTranslation->id,
        'title' => 'Updated Work Translation',
        'excerpt' => 'Updated excerpt',
        'body' => 'Updated body content.',
        'order' => 2,
        'status' => WorkStatus::Draft,
    ]);
});

it('can update an existing work translation with image', function () {
    Storage::fake('public');
    $mockImage = UploadedFile::fake()->image('updated_work_translation.jpg');
    $work = Work::factory()->create(['user_id' => Auth::id()]);
    $workTranslation = WorkTranslation::factory()->create([
        'work_id' => $work->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Original Title with Image',
        'image' => 'original_image.jpg',
    ]);

    $action = app(WorkTranslationUpdateAction::class);

    $updatedData = [
        'title' => 'Updated Title with Image',
        // No image provided to simulate keeping existing image
    ];

    $action->handle($updatedData, $workTranslation);

    $this->assertDatabaseHas('work_translations', [
        'id' => $workTranslation->id,
        'title' => 'Updated Title with Image',
        'image' => 'original_image.jpg',
    ]);
});

it('can update an existing work translation with tags', function () {
    $work = Work::factory()->create(['user_id' => Auth::id()]);
    $workTranslation = WorkTranslation::factory()->create([
        'work_id' => $work->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Original Title with Tags',
    ]);

    $action = app(WorkTranslationUpdateAction::class);

    $updatedData = [
        'title' => 'Updated Title with Tags',
        'tags' => ['new_tag1', 'new_tag2'],
    ];

    $action->handle($updatedData, $workTranslation);

    $this->assertDatabaseHas('work_translations', [
        'id' => $workTranslation->id,
        'title' => 'Updated Title with Tags',
    ]);
});
