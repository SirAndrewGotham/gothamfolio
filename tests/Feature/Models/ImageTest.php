<?php

use App\Models\Gallery;
use App\Models\Image;
use App\Models\Tag;
use App\Models\Translate;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can be soft deleted', function () {
    $image = Image::factory()->create();
    $image->delete();

    // Assert that the image is not found in regular queries
    expect(Image::find($image->id))->toBeNull();

    // Assert that the image is found when using withTrashed()
    $softDeletedImage = Image::withTrashed()->find($image->id);
    expect($softDeletedImage)->not->toBeNull();
    expect($softDeletedImage->deleted_at)->not->toBeNull();
});

it('has guarded attributes', function () {
    $image = new Image;
    expect($image->getGuarded())->toEqual([
        'id',
    ]);
});

it('an image can have many tags', function () {
    $image = Image::factory()->create();
    $tag = Tag::factory()->create();
    $image->tags()->attach($tag);

    expect($image->tags)->toHaveCount(1);
    expect($image->tags->first()->id)->toBe($tag->id);
});

it('an image can have many translates', function () {
    $image = Image::factory()->create();
    $translate = Translate::factory()->create();
    $image->translates()->attach($translate);

    expect($image->translates)->toHaveCount(1);
    expect($image->translates->first()->id)->toBe($translate->id);
});

it('an image belongs to a gallery', function () {
    $gallery = Gallery::factory()->create();
    $image = Image::factory()->create(['gallery_id' => $gallery->id]);

    expect($image->gallery->id)->toBe($gallery->id);
});
