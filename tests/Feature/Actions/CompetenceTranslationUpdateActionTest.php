<?php

use App\Actions\CompetenceTranslationUpdateAction;
use App\Enums\CompetenceStatus;
use App\Models\Competence;
use App\Models\CompetenceTranslation;
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

it('can update an existing competence translation without image and tags', function () {
    $competence = Competence::factory()->create(['user_id' => Auth::id()]);
    $competenceTranslation = CompetenceTranslation::factory()->create([
        'competence_id' => $competence->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Original Title',
        'excerpt' => 'Original excerpt',
        'body' => 'Original body content.',
        'order' => 1,
        'status' => CompetenceStatus::Published,
    ]);

    $action = app(CompetenceTranslationUpdateAction::class);

    $updatedData = [
        'title' => 'Updated Competence Translation',
        'excerpt' => 'Updated excerpt',
        'body' => 'Updated body content.',
        'order' => 2,
        'status' => CompetenceStatus::Draft,
    ];

    $action->handle($updatedData, $competenceTranslation);

    $this->assertDatabaseHas('competence_translations', [
        'id' => $competenceTranslation->id,
        'title' => 'Updated Competence Translation',
        'excerpt' => 'Updated excerpt',
        'body' => 'Updated body content.',
        'order' => 2,
        'status' => CompetenceStatus::Draft,
    ]);
});

it('can update an existing competence translation with image', function () {
    Storage::fake('public');
    $mockImage = UploadedFile::fake()->image('updated_competence_translation.jpg');
    $competence = Competence::factory()->create(['user_id' => Auth::id()]);
    $competenceTranslation = CompetenceTranslation::factory()->create([
        'competence_id' => $competence->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Original Title with Image',
        'image' => 'original.jpg',
    ]);

    $action = app(CompetenceTranslationUpdateAction::class);

    $updatedData = [
        'title' => 'Updated Title with Image',
        'image' => $mockImage,
    ];

    $action->handle($updatedData, $competenceTranslation);

    $this->assertDatabaseHas('competence_translations', [
        'id' => $competenceTranslation->id,
        'title' => 'Updated Title with Image',
        'image' => $mockImage,
    ]);
});

it('can update an existing competence translation with tags', function () {
    $competence = Competence::factory()->create(['user_id' => Auth::id()]);
    $competenceTranslation = CompetenceTranslation::factory()->create([
        'competence_id' => $competence->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Original Title with Tags',
    ]);

    $action = app(CompetenceTranslationUpdateAction::class);

    $updatedData = [
        'title' => 'Updated Title with Tags',
        'tags' => ['new_tag1', 'new_tag2'],
    ];

    $action->handle($updatedData, $competenceTranslation);

    $this->assertDatabaseHas('competence_translations', [
        'id' => $competenceTranslation->id,
        'title' => 'Updated Title with Tags',
    ]);
});
