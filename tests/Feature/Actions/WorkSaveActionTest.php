<?php

use App\Actions\WorkSaveAction;
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

it('can create a new work without image and tags', function () {
    $action = app(WorkSaveAction::class);

    $data = [
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'New Work',
        'excerpt' => 'Work excerpt',
        'body' => 'Work body content.',
        'status' => WorkStatus::Published,
    ];

    $action->handle($data);

    $this->assertDatabaseHas('works', [
        'user_id' => Auth::id(),
        'title' => 'New Work',
    ]);

    $this->assertDatabaseHas('work_translations', [
        'work_id' => Work::first()->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'New Work',
        'excerpt' => 'Work excerpt',
        'body' => 'Work body content.',
        'status' => WorkStatus::Published,
        'image' => null,
    ]);
});

it('can create a new work with image', function () {
    Storage::fake('public');
    $mockImage = UploadedFile::fake()->image('work.jpg');

    $action = app(WorkSaveAction::class);

    $data = [
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Work with Image',
        'excerpt' => 'Work excerpt with image',
        'body' => 'Work body content with image.',
        'order' => 2,
        'status' => WorkStatus::Published,
        'image' => $mockImage,
    ];

    $action->handle($data);

    $this->assertDatabaseHas('works', [
        'title' => 'Work with Image',
    ]);

    $workTranslation = Work::where('title', 'Work with Image')->first()->translations()->where('language_id', Language::first()->id)->first();
    $this->assertNotNull($workTranslation);
    $this->assertStringStartsWith('work-with-image-', $workTranslation->image);
    $this->assertStringEndsWith('.jpg', $workTranslation->image);
});

it('can create a new work with tags', function () {
    $action = app(WorkSaveAction::class);

    $data = [
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Work with Tags',
        'excerpt' => 'Work excerpt with tags',
        'body' => 'Work body content with tags.',
        'order' => 3,
        'status' => WorkStatus::Published,
        'tags' => ['tag1', 'tag2'],
    ];

    $action->handle($data);

    $this->assertDatabaseHas('works', [
        'title' => 'Work with Tags',
    ]);

    $this->assertDatabaseHas('work_translations', [
        'title' => 'Work with Tags',
    ]);
});
