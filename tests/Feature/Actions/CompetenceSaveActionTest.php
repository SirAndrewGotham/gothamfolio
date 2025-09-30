<?php

use App\Actions\CompetenceSaveAction;
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

it('can create a new competence without image and tags', function () {
    $action = app(CompetenceSaveAction::class);

    $data = [
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'New Competence',
        'excerpt' => 'Competence excerpt',
        'body' => 'Competence body content.',
        'order' => 1,
        'status' => CompetenceStatus::Published,
    ];

    $action->handle($data);

    $this->assertDatabaseHas('competences', [
        'user_id' => Auth::id(),
    ]);

    $this->assertDatabaseHas('competence_translations', [
        'competence_id' => Competence::first()->id,
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'New Competence',
        'excerpt' => 'Competence excerpt',
        'body' => 'Competence body content.',
        'order' => 1,
        'status' => CompetenceStatus::Published,
        'image' => null,
    ]);
});

it('can create a new competence with image', function () {
    Storage::fake('public');
    $mockImage = UploadedFile::fake()->image('competence.jpg');

    $action = app(CompetenceSaveAction::class);

    $data = [
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Competence with Image',
        'excerpt' => 'Competence excerpt with image',
        'body' => 'Competence body content with image.',
        'order' => 2,
        'status' => CompetenceStatus::Published,
        'image' => $mockImage,
    ];

    $action->handle($data);

    $this->assertDatabaseHas('competence_translations', [
        'title' => 'Competence with Image',
    ]);

    $competenceTranslation = Competence::where('title', 'Competence with Image')->first()->translations()->where('language_id', Language::first()->id)->first();
    $this->assertNotNull($competenceTranslation);
    $this->assertStringStartsWith('competence-with-image-', $competenceTranslation->image);
    $this->assertStringEndsWith('.jpg', $competenceTranslation->image);
});

it('can create a new competence with tags', function () {
    $action = app(CompetenceSaveAction::class);

    $data = [
        'language_id' => Language::first()->id,
        'user_id' => Auth::id(),
        'title' => 'Competence with Tags',
        'excerpt' => 'Competence excerpt with tags',
        'body' => 'Competence body content with tags.',
        'order' => 3,
        'status' => CompetenceStatus::Published,
        'tags' => ['tag1', 'tag2'],
    ];

    $action->handle($data);

    $this->assertDatabaseHas('competence_translations', [
        'title' => 'Competence with Tags',
    ]);
});
