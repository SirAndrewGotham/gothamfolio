<?php

use App\Models\Language;
use App\Models\User;
use App\Models\Work;
use App\Models\WorkTranslation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
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

test('work translations index page can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    $work = Work::factory()->create(['user_id' => $user->id]);

    actingAs($user)->get(route('admin.workTranslations.index', $work))
        ->assertOk()
        ->assertSee('Work Translations for'); // Assuming this text is on the index page
});

test('work translation create page can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    $work = Work::factory()->create(['user_id' => $user->id]);

    actingAs($user)->get(route('admin.workTranslations.create', $work))
        ->assertOk()
        ->assertSee('Create a Work');
});

test('work translation can be stored by authenticated user', function () {
    $user = User::factory()->create();
    $work = Work::factory()->create(['user_id' => $user->id]);
    $language = Language::factory()->create(['code' => 'fr', 'name' => 'French', 'is_active' => true]);

    $encryptedWorkId = Crypt::encryptString($work->id);
    $encryptedLanguageId = Crypt::encryptString($language->id);

    actingAs($user)->post(route('admin.workTranslations.store', $work), [
        'work_id' => $encryptedWorkId,
        'user_id' => $user->id,
        'language_id' => $language->id,
        'title' => 'French Work Translation Title',
        'body' => 'French Work Translation Body',
        'language' => $encryptedLanguageId, // This is used in prepareForValidation
    ])
        ->assertRedirect(route('admin.workTranslations.index', $work->slug))
        ->assertSessionHas('success', 'Your Work Translation created successfully!');

    $this->assertDatabaseHas('work_translations', [
        'work_id' => $work->id,
        'language_id' => $language->id,
        'title' => 'French Work Translation Title',
        'body' => 'French Work Translation Body',
    ]);
});

test('work translation store fails with invalid data', function () {
    $user = User::factory()->create();
    $work = Work::factory()->create(['user_id' => $user->id]);
    $language = Language::factory()->create(['code' => 'fr', 'name' => 'French', 'is_active' => true]);

    $encryptedWorkId = Crypt::encryptString($work->id);
    $encryptedLanguageId = Crypt::encryptString($language->id);

    actingAs($user)->post(route('admin.workTranslations.store', $work), [
        'work_id' => $encryptedWorkId,
        'user_id' => $user->id,
        'language_id' => $language->id,
        'title' => '',
        'body' => '',
        'language' => $encryptedLanguageId,
    ])
        ->assertSessionHasErrors([
            'title',
            'body',
        ]);
});

test('work translation translate page can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    $work = Work::factory()->create(['user_id' => $user->id]);
    $workTranslation = WorkTranslation::factory()->create(['work_id' => $work->id, 'user_id' => $user->id, 'language_id' => Language::first()->id]);

    actingAs($user)->get(route('admin.workTranslations.translate', $workTranslation))
        ->assertOk()
        ->assertSee('Translate Work'); // Assuming this text is on the translate page
});

test('single work translation can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    $work = Work::factory()->create(['user_id' => $user->id]);
    $workTranslation = WorkTranslation::factory()->create(['work_id' => $work->id, 'user_id' => $user->id, 'language_id' => Language::first()->id]);

    actingAs($user)->get(route('admin.workTranslations.show', $workTranslation))
        ->assertOk()
        ->assertSee($workTranslation->title);
});

test('work translation edit page can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    $work = Work::factory()->create(['user_id' => $user->id]);
    $workTranslation = WorkTranslation::factory()->create(['work_id' => $work->id, 'user_id' => $user->id, 'language_id' => Language::first()->id]);

    actingAs($user)->get(route('admin.workTranslations.edit', $workTranslation))
        ->assertOk()
        ->assertSee('Edit Work Translation') // Assuming this text is on the edit page
        ->assertSee($workTranslation->title);
});

test('work translation can be updated by authenticated user', function () {
    $user = User::factory()->create();
    $work = Work::factory()->create(['user_id' => $user->id]);
    $workTranslation = WorkTranslation::factory()->create(['work_id' => $work->id, 'user_id' => $user->id, 'language_id' => Language::first()->id]);

    $updatedTitle = 'Updated Work Translation Title';
    $updatedBody = 'Updated work translation body content.';
    $updatedExcerpt = 'Updated work translation excerpt.';
    $encryptedLanguageId = Crypt::encryptString(Language::first()->id);

    actingAs($user)->put(route('admin.workTranslations.update', $workTranslation), [
        'work_id' => Crypt::encryptString($work->id),
        'user_id' => $user->id,
        'language_id' => Language::first()->id,
        'title' => $updatedTitle,
        'excerpt' => $updatedExcerpt,
        'body' => $updatedBody,
        'language' => $encryptedLanguageId,
    ])
        ->assertRedirect(route('admin.workTranslations.index', $workTranslation->work->slug))
        ->assertSessionHas('success', 'Your Work Translation updated successfully!');

    $this->assertDatabaseHas('work_translations', [
        'id' => $workTranslation->id,
        'title' => $updatedTitle,
        'excerpt' => $updatedExcerpt,
        'body' => $updatedBody,
    ]);
});

test('work translation update fails with invalid data', function () {
    $user = User::factory()->create();
    $work = Work::factory()->create(['user_id' => $user->id]);
    $workTranslation = WorkTranslation::factory()->create(['work_id' => $work->id, 'user_id' => $user->id, 'language_id' => Language::first()->id]);

    $encryptedLanguageId = Crypt::encryptString(Language::first()->id);

    actingAs($user)->put(route('admin.workTranslations.update', $workTranslation), [
        'work_id' => Crypt::encryptString($work->id),
        'user_id' => $user->id,
        'language_id' => Language::first()->id,
        'title' => '',
        'body' => '',
        'language' => $encryptedLanguageId,
    ])
        ->assertSessionHasErrors([
            'title',
            'body',
        ]);
});

test('work translation can be soft deleted by authenticated user', function () {
    $user = User::factory()->create();
    $work = Work::factory()->create(['user_id' => $user->id]);
    $workTranslation = WorkTranslation::factory()->create(['work_id' => $work->id, 'user_id' => $user->id, 'language_id' => Language::first()->id]);

    actingAs($user)->delete(route('admin.workTranslations.destroy', $workTranslation))
        ->assertRedirect(); // Redirects back

    $this->assertSoftDeleted('work_translations', [
        'id' => $workTranslation->id,
    ]);
});

test('work translation can be force deleted by authenticated user', function () {
    $user = User::factory()->create();
    $work = Work::factory()->create(['user_id' => $user->id]);
    $workTranslation = WorkTranslation::factory()->create(['work_id' => $work->id, 'user_id' => $user->id, 'language_id' => Language::first()->id]);

    actingAs($user)->get(route('admin.workTranslations.forceDelete', $workTranslation))
        ->assertRedirect(); // Redirects back

    $this->assertDatabaseMissing('work_translations', [
        'id' => $workTranslation->id,
    ]);
});
