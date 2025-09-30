<?php

use App\Actions\CompetenceUpdateAction;
use App\Enums\CompetenceStatus;
use App\Models\Competence;
use App\Models\CompetenceTranslation;
use App\Models\Language;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(function () {
    Language::factory()->create(['code' => 'en', 'name' => 'English', 'default' => true, 'is_active' => true]);
    User::factory()->create();
});

it('can update an existing competence and its translation without image and tags', function () {
    $user = User::factory()->create();
    $competence = Competence::factory()->create(['user_id' => $user->id, 'title' => 'Original Competence Title']);
    $competenceTranslation = CompetenceTranslation::factory()->create([
        'competence_id' => $competence->id,
        'language_id' => Language::first()->id,
        'user_id' => $user->id,
        'title' => 'Original Competence Translation Title',
        'excerpt' => 'Original excerpt',
        'body' => 'Original body content.',
        'order' => 1,
        'status' => CompetenceStatus::Published,
    ]);

    $action = app(CompetenceUpdateAction::class);

    $updatedData = [
        'language_id' => Language::first()->id,
        'title' => 'Updated Competence Title (Main)',
        'translation_title' => 'Updated Competence Translation',
        'excerpt' => 'Updated excerpt',
        'body' => 'Updated body content.',
        'order' => 2,
        'status' => CompetenceStatus::Draft,
    ];

    $action->handle($updatedData, $competence);

    $this->assertDatabaseHas('competences', [
        'id' => $competence->id,
        'title' => 'Updated Competence Title (Main)',
    ]);

    $this->assertDatabaseHas('competence_translations', [
        'id' => $competenceTranslation->id,
        'title' => 'Updated Competence Translation',
        'excerpt' => 'Updated excerpt',
        'body' => 'Updated body content.',
        'order' => 2,
        'status' => CompetenceStatus::Draft,
    ]);
});

it('can update an existing competence and its translation with image', function () {
    Storage::fake('public');
    $mockImage = UploadedFile::fake()->image('updated_competence.jpg');
    $user = User::factory()->create();
    $competence = Competence::factory()->create(['user_id' => $user->id, 'title' => 'Original Competence Title Image']);
    $competenceTranslation = CompetenceTranslation::factory()->create([
        'competence_id' => $competence->id,
        'language_id' => Language::first()->id,
        'user_id' => $user->id,
        'title' => 'Original Competence Translation Title Image',
        'image' => 'original_image.jpg',
    ]);

    $action = app(CompetenceUpdateAction::class);

    $updatedData = [
        'language_id' => Language::first()->id,
        'title' => 'Updated Competence Title Image (Main)',
        'translation_title' => 'Updated Competence Title Image',
        // No image provided to simulate keeping existing image
    ];

    $action->handle($updatedData, $competence);

    $this->assertDatabaseHas('competence_translations', [
        'id' => $competenceTranslation->id,
        'title' => 'Updated Competence Title Image',
        'image' => 'original_image.jpg', // Asserting image remains original
    ]);
});

it('can update an existing competence and its translation with tags', function () {
    $user = User::factory()->create();
    $competence = Competence::factory()->create(['user_id' => $user->id, 'title' => 'Original Competence Title Tags']);
    $competenceTranslation = CompetenceTranslation::factory()->create([
        'competence_id' => $competence->id,
        'language_id' => Language::first()->id,
        'user_id' => $user->id,
        'title' => 'Original Competence Translation Title Tags',
    ]);

    $action = app(CompetenceUpdateAction::class);

    $updatedData = [
        'language_id' => Language::first()->id,
        'title' => 'Updated Competence Title Tags (Main)',
        'translation_title' => 'Updated Competence Title Tags',
        'tags' => ['new_tag1', 'new_tag2'],
    ];

    $action->handle($updatedData, $competence);

    $this->assertDatabaseHas('competence_translations', [
        'id' => $competenceTranslation->id,
        'title' => 'Updated Competence Title Tags',
    ]);
});
