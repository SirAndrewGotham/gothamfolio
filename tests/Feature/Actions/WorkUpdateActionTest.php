<?php

use App\Actions\WorkUpdateAction;
use App\Enums\WorkStatus;
use App\Models\Language;
use App\Models\User;
use App\Models\Work;
use App\Models\WorkTranslation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(function () {
    Language::factory()->create(['code' => 'en', 'name' => 'English', 'default' => true, 'is_active' => true]);
    User::factory()->create();
});

it('can update an existing work and its translation without image and tags', function () {
    $user = User::factory()->create();
    $work = Work::factory()->create(['user_id' => $user->id, 'title' => 'Original Work Title']);
    $workTranslation = WorkTranslation::factory()->create([
        'work_id' => $work->id,
        'language_id' => Language::first()->id,
        'user_id' => $user->id,
        'title' => 'Original Work Translation Title',
        'excerpt' => 'Original excerpt',
        'body' => 'Original body content.',
        'order' => 1,
        'status' => WorkStatus::Published,
    ]);

    $action = app(WorkUpdateAction::class);

    $updatedData = [
        'language_id' => Language::first()->id,
        'title' => 'Updated Work Title (Main)',
        'translation_title' => 'Updated Work Translation',
        'excerpt' => 'Updated excerpt',
        'body' => 'Updated body content.',
        'order' => 2,
        'status' => WorkStatus::Draft,
    ];

    $action->handle($updatedData, $work);

    $this->assertDatabaseHas('works', [
        'id' => $work->id,
        'title' => 'Updated Work Title (Main)',
    ]);

    $this->assertDatabaseHas('work_translations', [
        'id' => $workTranslation->id,
        'title' => 'Updated Work Translation',
        'excerpt' => 'Updated excerpt',
        'body' => 'Updated body content.',
        'order' => 2,
        'status' => WorkStatus::Draft,
    ]);
});

it('can update an existing work and its translation with image', function () {
    Storage::fake('public');
    $mockImage = UploadedFile::fake()->image('updated_work.jpg');
    $user = User::factory()->create();
    $work = Work::factory()->create(['user_id' => $user->id, 'title' => 'Original Work Title Image']);
    $workTranslation = WorkTranslation::factory()->create([
        'work_id' => $work->id,
        'language_id' => Language::first()->id,
        'user_id' => $user->id,
        'title' => 'Original Work Translation Title Image',
        'image' => 'original_image.jpg',
    ]);

    $action = app(WorkUpdateAction::class);

    $updatedData = [
        'language_id' => Language::first()->id,
        'title' => 'Updated Work Title Image (Main)',
        'translation_title' => 'Updated Work Title Image',
        // No image provided to simulate keeping existing image
    ];

    $action->handle($updatedData, $work);

    $this->assertDatabaseHas('work_translations', [
        'id' => $workTranslation->id,
        'title' => 'Updated Work Title Image',
        'image' => 'original_image.jpg',
    ]);
});

it('can update an existing work and its translation with tags', function () {
    $user = User::factory()->create();
    $work = Work::factory()->create(['user_id' => $user->id, 'title' => 'Original Work Title Tags']);
    $workTranslation = WorkTranslation::factory()->create([
        'work_id' => $work->id,
        'language_id' => Language::first()->id,
        'user_id' => $user->id,
        'title' => 'Original Work Translation Title Tags',
    ]);

    $action = app(WorkUpdateAction::class);

    $updatedData = [
        'language_id' => Language::first()->id,
        'title' => 'Updated Work Title Tags (Main)',
        'translation_title' => 'Updated Work Title Tags',
        'tags' => ['new_tag1', 'new_tag2'],
    ];

    $action->handle($updatedData, $work);

    $this->assertDatabaseHas('work_translations', [
        'id' => $workTranslation->id,
        'title' => 'Updated Work Title Tags',
    ]);
});
