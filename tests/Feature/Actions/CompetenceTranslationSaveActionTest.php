<?php

use App\Actions\CompetenceTranslationSaveAction;
use App\Enums\CompetenceStatus;
use App\Models\Competence;
use App\Models\Language;
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

it('can create a new competence translation without image and tags', function () {
    $competence = Competence::factory()->create(['user_id' => Auth::id()]);
    $action = app(CompetenceTranslationSaveAction::class);

    $data = [
        'competence_id' => $competence->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'New Competence Translation',
        'excerpt' => 'Competence translation excerpt',
        'body' => 'Competence translation body content.',
        'order' => 1,
        'status' => CompetenceStatus::Published,
    ];

    $action->handle($data);

    $this->assertDatabaseHas('competence_translations', [
        'competence_id' => $competence->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'New Competence Translation',
        'excerpt' => 'Competence translation excerpt',
        'body' => 'Competence translation body content.',
        'order' => 1,
        'status' => CompetenceStatus::Published,
        'image' => null,
    ]);
});

it('can create a new competence translation with image', function () {
    Storage::fake('public');
    $mockImage = UploadedFile::fake()->image('competence_translation.jpg');
    $competence = Competence::factory()->create(['user_id' => Auth::id()]);

    $action = app(CompetenceTranslationSaveAction::class);

    $data = [
        'competence_id' => $competence->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Competence Translation with Image',
        'excerpt' => 'Competence translation excerpt with image',
        'body' => 'Competence translation body content with image.',
        'order' => 2,
        'status' => CompetenceStatus::Published,
        'image' => $mockImage,
    ];

    $action->handle($data);

    $this->assertDatabaseHas('competence_translations', [
        'title' => 'Competence Translation with Image',
        'image' => $mockImage,
    ]);
});

it('can create a new competence translation with tags', function () {
    $competence = Competence::factory()->create(['user_id' => Auth::id()]);
    $action = app(CompetenceTranslationSaveAction::class);

    $data = [
        'competence_id' => $competence->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Competence Translation with Tags',
        'excerpt' => 'Competence translation excerpt with tags',
        'body' => 'Competence translation body content with tags.',
        'order' => 3,
        'status' => CompetenceStatus::Published,
        'tags' => ['tag1', 'tag2'],
    ];

    $action->handle($data);

    $this->assertDatabaseHas('competence_translations', [
        'title' => 'Competence Translation with Tags',
    ]);
});
