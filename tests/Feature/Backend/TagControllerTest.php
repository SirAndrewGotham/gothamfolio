<?php

use App\Models\Language;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Ensure a default active language exists for SetLocale middleware
    Language::factory()->create(['code' => 'en', 'name' => 'English', 'default' => true, 'is_active' => true]);

    Route::middleware(['web', 'auth'])
        ->prefix('admin')
        ->name('admin.')
        ->group(base_path('routes/admin.php'));
});

test('tags index page can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    Tag::factory()->count(3)->create();

    actingAs($user)->get(route('admin.tags.index'))
        ->assertOk()
        ->assertSee('Tags')
        ->assertSee(Tag::first()->name);
});

test('tags indexRaw method returns all tags as json', function () {
    $user = User::factory()->create();
    Tag::factory()->create(['name' => 'Test Tag 1', 'slug' => 'test-tag-1']);
    Tag::factory()->create(['name' => 'Test Tag 2', 'slug' => 'test-tag-2']);

    actingAs($user)->get(route('admin.tags.indexRaw'))
        ->assertOk()
        ->assertJsonFragment(['Test Tag 1'])
        ->assertJsonFragment(['Test Tag 2']);
});

test('tag create page can be rendered for authenticated user', function () {
    $user = User::factory()->create();

    actingAs($user)->get(route('admin.tags.create'))
        ->assertOk()
        ->assertSee('Create a Tag'); // Assuming 'Create a Tag' is present on the create tag page
});

test('tag can be stored by authenticated user', function () {
    $user = User::factory()->create();

    actingAs($user)->post(route('admin.tags.store'), [
        'name' => 'New Tag',
        'content' => 'New tag content',
    ])
        ->assertRedirect(route('admin.tags.index'));

    $this->assertDatabaseHas('tags', [
        'name' => 'New Tag',
        'slug' => 'new-tag',
        'content' => 'New tag content',
    ]);
});

test('tag store fails with invalid data', function () {
    $user = User::factory()->create();

    actingAs($user)->post(route('admin.tags.store'), [
        'name' => '',
        'content' => 'short',
    ])
        ->assertSessionHasErrors([
            'name',
        ]);

    // Test duplicate name
    Tag::factory()->create(['name' => 'Existing Tag']);
    actingAs($user)->post(route('admin.tags.store'), [
        'name' => 'Existing Tag',
        'content' => 'Some content',
    ])
        ->assertSessionHasErrors(['name']);
});

test('single tag can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    $tag = Tag::factory()->create();

    actingAs($user)->get(route('admin.tags.show', $tag->slug))
        ->assertOk()
        ->assertSee($tag->name);
});

test('tag edit page can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    $tag = Tag::factory()->create();

    actingAs($user)->get(route('admin.tags.edit', $tag->slug))
        ->assertOk()
        ->assertSee('Edit Tag') // Assuming 'Edit Tag' is present on the edit tag page
        ->assertSee($tag->name);
});

test('tag can be updated by authenticated user', function () {
    $user = User::factory()->create();
    $tag = Tag::factory()->create();

    actingAs($user)->put(route('admin.tags.update', $tag->slug), [
        'name' => 'Updated Tag Name',
        'content' => 'Updated tag content',
        'slug' => null,
    ])
        ->assertRedirect(route('admin.tags.index'));

    $this->assertDatabaseHas('tags', [
        'id' => $tag->id,
        'name' => 'Updated Tag Name',
        'slug' => 'updated-tag-name',
        'content' => 'Updated tag content',
    ]);
});

test('tag update fails with invalid data', function () {
    $user = User::factory()->create();
    $tag = Tag::factory()->create();

    actingAs($user)->put(route('admin.tags.update', $tag->slug), [
        'name' => '',
        'content' => 'short',
    ])
        ->assertSessionHasErrors([
            'name',
        ]);

    // Test duplicate name
    Tag::factory()->create(['name' => 'Another Existing Tag']);
    actingAs($user)->put(route('admin.tags.update', $tag->slug), [
        'name' => 'Another Existing Tag',
        'content' => 'Some other content',
    ])
        ->assertSessionHasErrors(['name']);
});

test('tag can be permanently deleted by authenticated user', function () {
    $user = User::factory()->create();
    $tag = Tag::factory()->create();

    actingAs($user)->delete(route('admin.tags.destroy', $tag->slug))
        ->assertRedirect(route('admin.tags.index'));

    $this->assertDatabaseMissing('tags', [
        'id' => $tag->id,
    ]);
});
