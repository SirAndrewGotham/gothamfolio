<?php

use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\User;
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

test('post translations index page can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    actingAs($user)->get(route('admin.postTranslations.index', $post))
        ->assertOk()
        ->assertSee('Post Translations for'); // Corrected assertion text
});

test('post translation create page can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    actingAs($user)->get(route('admin.postTranslations.create', $post))
        ->assertOk()
        ->assertSee('Create a Post'); // Corrected assertion text
});

test('post translation can be stored by authenticated user', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $language = Language::factory()->create(['code' => 'fr', 'name' => 'French', 'is_active' => true]);

    $encryptedPostId = Crypt::encryptString($post->id);
    $encryptedLanguageId = Crypt::encryptString($language->id);

    actingAs($user)->post(route('admin.postTranslations.store', $post), [
        'post_id' => $encryptedPostId,
        'user_id' => $user->id,
        'title' => 'French Title',
        'body' => 'French Body',
        'language' => $encryptedLanguageId, // This is used in prepareForValidation
    ])
        ->assertRedirect(route('admin.postTranslations.index', $post->slug))
        ->assertSessionHas('success', 'Your Post Translation created successfully!');

    $this->assertDatabaseHas('post_translations', [
        'post_id' => $post->id,
        'language_id' => $language->id,
        'title' => 'French Title',
        'body' => 'French Body',
    ]);
});

test('post translation store fails with invalid data', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $language = Language::factory()->create(['code' => 'fr', 'name' => 'French', 'is_active' => true]);

    $encryptedPostId = Crypt::encryptString($post->id);
    $encryptedLanguageId = Crypt::encryptString($language->id);

    actingAs($user)->post(route('admin.postTranslations.store', $post), [
        'post_id' => $encryptedPostId,
        'user_id' => $user->id,
        'title' => '',
        'body' => '',
        'language' => $encryptedLanguageId,
    ])
        ->assertSessionHasErrors([
            'title',
            'body',
        ]);
});

test('post translation translate page can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $postTranslation = PostTranslation::factory()->create(['post_id' => $post->id, 'user_id' => $user->id, 'language_id' => Language::first()->id]);

    actingAs($user)->get(route('admin.postTranslations.translate', $postTranslation))
        ->assertOk()
        ->assertSee('Translate Post'); // Assuming this text is on the translate page
});

test('single post translation can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $postTranslation = PostTranslation::factory()->create(['post_id' => $post->id, 'user_id' => $user->id, 'language_id' => Language::first()->id]);

    actingAs($user)->get(route('admin.postTranslations.show', $postTranslation))
        ->assertOk()
        ->assertSee($postTranslation->title);
});

test('post translation edit page can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $postTranslation = PostTranslation::factory()->create(['post_id' => $post->id, 'user_id' => $user->id, 'language_id' => Language::first()->id]);

    actingAs($user)->get(route('admin.postTranslations.edit', $postTranslation))
        ->assertOk()
        ->assertSee('Edit Post Translation') // Assuming this text is on the edit page
        ->assertSee($postTranslation->title);
});

test('post translation can be updated by authenticated user', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $postTranslation = PostTranslation::factory()->create(['post_id' => $post->id, 'user_id' => $user->id, 'language_id' => Language::first()->id]);

    $updatedTitle = 'Updated Translation Title';
    $updatedBody = 'Updated translation body content.';
    $encryptedLanguageId = Crypt::encryptString(Language::first()->id);

    actingAs($user)->put(route('admin.postTranslations.update', $postTranslation), [
        'post_id' => Crypt::encryptString($post->id),
        'user_id' => $user->id,
        'title' => $updatedTitle,
        'body' => $updatedBody,
        'language' => $encryptedLanguageId,
    ])
        ->assertRedirect(route('admin.postTranslations.index', $postTranslation->post->slug))
        ->assertSessionHas('success', 'Your Post Translation updated successfully!');

    $this->assertDatabaseHas('post_translations', [
        'id' => $postTranslation->id,
        'title' => $updatedTitle,
        'body' => $updatedBody,
    ]);
});

test('post translation update fails with invalid data', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $postTranslation = PostTranslation::factory()->create(['post_id' => $post->id, 'user_id' => $user->id, 'language_id' => Language::first()->id]);

    $encryptedLanguageId = Crypt::encryptString(Language::first()->id);

    actingAs($user)->put(route('admin.postTranslations.update', $postTranslation), [
        'post_id' => Crypt::encryptString($post->id),
        'user_id' => $user->id,
        'title' => '',
        'body' => '',
        'language' => $encryptedLanguageId,
    ])
        ->assertSessionHasErrors([
            'title',
            'body',
        ]);
});

test('post translation can be soft deleted by authenticated user', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $postTranslation = PostTranslation::factory()->create(['post_id' => $post->id, 'user_id' => $user->id, 'language_id' => Language::first()->id]);

    actingAs($user)->delete(route('admin.postTranslations.destroy', $postTranslation))
        ->assertRedirect(route('admin.postTranslations.index', $postTranslation->post->slug));

    $this->assertSoftDeleted('post_translations', [
        'id' => $postTranslation->id,
    ]);
});

test('post translation can be force deleted by authenticated user', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $user->id]);
    $postTranslation = PostTranslation::factory()->create(['post_id' => $post->id, 'user_id' => $user->id, 'language_id' => Language::first()->id]);

    actingAs($user)->delete(route('admin.postTranslations.forceDelete', $postTranslation))
        ->assertRedirect(route('admin.postTranslations.index', $postTranslation->post->slug));

    $this->assertDatabaseMissing('post_translations', [
        'id' => $postTranslation->id,
    ]);
});
