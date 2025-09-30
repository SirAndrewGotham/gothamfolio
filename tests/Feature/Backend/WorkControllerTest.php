<?php

use App\Models\Language;
use App\Models\User;
use App\Models\Work;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function () {
    Language::factory()->create(['code' => 'en', 'name' => 'English', 'default' => true, 'is_active' => true]);

    Route::middleware(['web', 'auth'])
        ->prefix('admin')
        ->name('admin.')
        ->group(base_path('routes/admin.php'));
});

test('works index page can be rendered for authenticated user', function () {
    $user = User::factory()->create();

    actingAs($user)->get(route('admin.works.index'))
        ->assertOk()
        ->assertSee('Works'); // Assuming 'Works' is present on the works index page
});

test('work create page can be rendered for authenticated user', function () {
    $user = User::factory()->create();

    actingAs($user)->get(route('admin.works.create'))
        ->assertOk()
        ->assertSee('Create a Work'); // Corrected assertion text
});

test('work can be stored by authenticated user', function () {
    $user = User::factory()->create();

    actingAs($user)->post(route('admin.works.store'), [
        'user_id' => $user->id,
        'language_id' => Language::first()->id,
        'title' => 'Test Work Title',
        'body' => 'This is the test work body.',
        'language' => 'en', // This is used in prepareForValidation
    ])
        ->assertRedirect(route('admin.works.index'))
        ->assertSessionHas('success', 'Your Work created successfully!');

    $this->assertDatabaseHas('works', [
        'user_id' => $user->id,
    ]);

    $this->assertDatabaseHas('work_translations', [
        'title' => 'Test Work Title',
        'body' => 'This is the test work body.',
    ]);
});

test('work store fails with invalid data', function () {
    $user = User::factory()->create();

    actingAs($user)->post(route('admin.works.store'), [
        'user_id' => $user->id,
        'language_id' => Language::first()->id,
        'title' => '',
        'body' => '',
        'language' => 'en',
    ])
        ->assertSessionHasErrors([
            'title',
            'body',
        ]);
});

test('single work can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    $work = Work::factory()->hasTranslations(1)->create(['user_id' => $user->id]);

    actingAs($user)->get(route('admin.works.show', $work))
        ->assertOk()
        ->assertSee($work->translations->first()->title);
});

test('works edit page can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    $work = Work::factory()->hasTranslations(1)->create(['user_id' => $user->id]);

    actingAs($user)->get(route('admin.works.edit', $work))
        ->assertOk()
        ->assertSee('Edit Work')
        ->assertSee($work->title);
});

test('work can be updated by authenticated user', function () {
    $user = User::factory()->create();
    $work = Work::factory()->hasTranslations(1)->create(['user_id' => $user->id]);

    $updatedTitle = 'Updated Work Title';
    $updatedBody = 'Updated work body content.';
    $updatedExcerpt = 'Updated work excerpt.';

    actingAs($user)->put(route('admin.works.update', $work), [
        'title' => $updatedTitle,
        'translation_title' => $updatedTitle, // Add this line
        'excerpt' => $updatedExcerpt,
        'body' => $updatedBody,
        'language_id' => Language::first()->id,
    ])
        ->assertRedirect(route('admin.works.index'));

    $this->assertDatabaseHas('work_translations', [
        'work_id' => $work->id,
        'title' => $updatedTitle,
        'excerpt' => $updatedExcerpt,
        'body' => $updatedBody,
    ]);
});

test('work update fails with invalid data', function () {
    $user = User::factory()->create();
    $work = Work::factory()->hasTranslations(1)->create(['user_id' => $user->id]);

    actingAs($user)->put(route('admin.works.update', $work), [
        'title' => '',
    ])
        ->assertSessionHasErrors([
            'title',
        ]);
});

test('work can be deleted by authenticated user', function () {
    $user = User::factory()->create();
    $work = Work::factory()->hasTranslations(1)->create(['user_id' => $user->id]);

    actingAs($user)->delete(route('admin.works.destroy', $work))
        ->assertRedirect(route('admin.works.index'));

    $this->assertSoftDeleted('works', [
        'id' => $work->id,
    ]);

    $this->assertSoftDeleted('work_translations', [
        'work_id' => $work->id,
    ]);
});
