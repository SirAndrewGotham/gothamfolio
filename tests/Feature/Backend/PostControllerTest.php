<?php

use App\Models\Language;
use App\Models\Post;
use App\Models\User;
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

test('posts index page can be rendered for authenticated user', function () {
    $user = User::factory()->create();

    actingAs($user)->get(route('admin.posts.index'))
        ->assertOk()
        ->assertSee('Posts'); // Assuming 'Posts' is present on the posts index page
});

test('posts create page can be rendered for authenticated user', function () {
    $user = User::factory()->create();

    actingAs($user)->get(route('admin.posts.create'))
        ->assertOk()
        ->assertSee('Create a Post'); // Corrected assertion text
});

test('post can be stored by authenticated user', function () {
    $user = User::factory()->create();

    actingAs($user)->post(route('admin.posts.store'), [
        'user_id' => $user->id,
        'language_id' => Language::first()->id,
        'title' => 'Test Post Title',
        'body' => 'This is the test post body.',
        'excerpt' => 'This is a test excerpt.',
        'language' => 'en', // This is used in prepareForValidation
    ])
        ->assertRedirect(route('admin.posts.index'))
        ->assertSessionHas('message', 'Post created successfully');

    $this->assertDatabaseHas('posts', [
        'user_id' => $user->id,
    ]);

    $this->assertDatabaseHas('post_translations', [
        'title' => 'Test Post Title',
        'body' => 'This is the test post body.',
    ]);
});

test('post store fails with invalid data', function () {
    $user = User::factory()->create();

    actingAs($user)->post(route('admin.posts.store'), [
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

test('single post can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    $post = Post::factory()->hasTranslations(1)->create(['user_id' => $user->id]);

    actingAs($user)->get(route('admin.posts.show', $post))
        ->assertOk()
        ->assertSee($post->translations->first()->title);
});

test('posts edit page can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    $post = Post::factory()->hasTranslations(1)->create(['user_id' => $user->id]);

    actingAs($user)->get(route('admin.posts.edit', $post))
        ->assertOk()
        ->assertSee('Editing Post')
        ->assertSee($post->title);
});

test('post can be updated by authenticated user', function () {
    $user = User::factory()->create();
    $post = Post::factory()->hasTranslations(1)->create(['user_id' => $user->id]);

    $updatedTitle = 'Updated Post Title';
    $updatedBody = 'Updated post body content.';

    actingAs($user)->put(route('admin.posts.update', $post), [
        'user_id' => $user->id,
        'language_id' => Language::first()->id,
        'title' => $updatedTitle,
        'body' => $updatedBody,
        'excerpt' => 'Updated post excerpt.',
        'language' => 'en',
    ])
        ->assertRedirect(route('admin.posts.index'));

    $this->assertDatabaseHas('post_translations', [
        'post_id' => $post->id,
        'title' => $updatedTitle,
        'body' => $updatedBody,
    ]);
});

test('post update fails with invalid data', function () {
    $user = User::factory()->create();
    $post = Post::factory()->hasTranslations(1)->create(['user_id' => $user->id]);

    actingAs($user)->put(route('admin.posts.update', $post), [
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

test('post can be deleted by authenticated user', function () {
    $user = User::factory()->create();
    $post = Post::factory()->hasTranslations(1)->create(['user_id' => $user->id]);

    actingAs($user)->delete(route('admin.posts.destroy', $post))
        ->assertRedirect(route('admin.posts.index'))
        ->assertSessionHas('message', 'Post deleted successfully');

    $this->assertSoftDeleted('posts', [
        'id' => $post->id,
    ]);
});
