<?php

use App\Models\Gallery;
use App\Models\Image;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('generates a slug when creating a gallery without one', function () {
    $gallery = Gallery::factory()->create(['title' => 'My First Gallery', 'slug' => null]);
    expect($gallery->slug)->toBe('my-first-gallery');
});

it('uses the provided slug when creating a gallery with one', function () {
    $gallery = Gallery::factory()->create(['title' => 'My Second Gallery', 'slug' => 'custom-gallery-slug']);
    expect($gallery->slug)->toBe('custom-gallery-slug');
});

it('generates a unique slug when creating galleries with the same title', function () {
    Gallery::factory()->create(['title' => 'Duplicate Gallery Title', 'slug' => null]);
    $gallery2 = Gallery::factory()->create(['title' => 'Duplicate Gallery Title', 'slug' => null]);
    expect($gallery2->slug)->toBe('duplicate-gallery-title-2');
});

it('can be soft deleted', function () {
    $gallery = Gallery::factory()->create();
    $gallery->delete();

    // Assert that the gallery is not found in regular queries
    expect(Gallery::find($gallery->id))->toBeNull();

    // Assert that the gallery is found when using withTrashed()
    $softDeletedGallery = Gallery::withTrashed()->find($gallery->id);
    expect($softDeletedGallery)->not->toBeNull();
    expect($softDeletedGallery->deleted_at)->not->toBeNull();
});

it('has guarded attributes', function () {
    $gallery = new Gallery;
    expect($gallery->getGuarded())->toEqual([
        'id',
    ]);
});

it('a gallery has many images', function () {
    $gallery = Gallery::factory()->create();
    $image = Image::factory()->create(['gallery_id' => $gallery->id]);

    expect($gallery->images)->toHaveCount(1);
    expect($gallery->images->first()->id)->toBe($image->id);
});

it('a gallery can belong to a parent gallery', function () {
    $parentGallery = Gallery::factory()->create();
    $childGallery = Gallery::factory()->create(['gallery_id' => $parentGallery->id]);

    expect($childGallery->galleries->id)->toBe($parentGallery->id);
});

it('a gallery can have many tags', function () {
    $gallery = Gallery::factory()->create();
    $tag = Tag::factory()->create();
    $gallery->tags()->attach($tag);

    expect($gallery->tags)->toHaveCount(1);
    expect($gallery->tags->first()->id)->toBe($tag->id);
});
