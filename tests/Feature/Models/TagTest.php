<?php

use App\Models\Image;
use App\Models\PostTranslation;
use App\Models\Tag;
use App\Models\Work;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('generates a slug when creating a tag without one', function () {
    $tag = Tag::factory()->create(['name' => 'My First Tag', 'slug' => null]);
    expect($tag->slug)->toBe('my-first-tag');
});

it('uses the provided slug when creating a tag with one', function () {
    $tag = Tag::factory()->create(['name' => 'My Second Tag', 'slug' => 'custom-tag-slug']);
    expect($tag->slug)->toBe('custom-tag-slug');
});

it('generates a unique slug when creating tags with the same name', function () {
    Tag::factory()->create(['name' => 'Duplicate Tag Name', 'slug' => null]);
    $tag2 = Tag::factory()->create(['name' => 'Duplicate Tag Name', 'slug' => null]);
    expect($tag2->slug)->toBe('duplicate-tag-name-2');
});

it('generates a new slug when updating tag name and slug is empty', function () {
    $tag = Tag::factory()->create(['name' => 'Old Name', 'slug' => 'old-name']);
    $tag->update(['name' => 'New Name', 'slug' => null]);
    expect($tag->slug)->toBe('new-name');
});

it('does not change slug when updating tag name but slug is not empty', function () {
    $tag = Tag::factory()->create(['name' => 'Old Name', 'slug' => 'my-custom-slug']);
    $tag->update(['name' => 'New Name']);
    expect($tag->slug)->toBe('my-custom-slug');
});

it('has expected fillable attributes', function () {
    $tag = new Tag;
    expect($tag->getFillable())->toEqual([
        'name',
        'slug',
        'content',
    ]);
});

it('does not use timestamps', function () {
    $tag = new Tag;
    expect($tag->timestamps)->toBeFalse();
});

it('a tag can be associated with many post translations', function () {
    $tag = Tag::factory()->create();
    $postTranslation = PostTranslation::factory()->create();
    $tag->posts()->attach($postTranslation);

    expect($tag->posts)->toHaveCount(1);
    expect($tag->posts->first()->id)->toBe($postTranslation->id);
});

it('a tag can be associated with many works', function () {
    $tag = Tag::factory()->create();
    $work = Work::factory()->create();
    $tag->works()->attach($work);

    expect($tag->works)->toHaveCount(1);
    expect($tag->works->first()->id)->toBe($work->id);
});

it('a tag can be associated with many images', function () {
    $tag = Tag::factory()->create();
    $image = Image::factory()->create();
    $tag->images()->attach($image);

    expect($tag->images)->toHaveCount(1);
    expect($tag->images->first()->id)->toBe($image->id);
});
