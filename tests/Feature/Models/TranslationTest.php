<?php

use App\Models\Translation;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has expected fillable attributes', function () {
    $translation = new Translation;
    expect($translation->getFillable())->toEqual([
        'table_name',
        'column_name',
        'foreign_key',
        'locale',
        'value',
    ]);
});

it('can be created', function () {
    $data = [
        'table_name' => 'posts',
        'column_name' => 'title',
        'foreign_key' => 1,
        'locale' => 'en',
        'value' => 'Hello World',
    ];
    $translation = Translation::create($data);

    expect($translation->exists)->toBeTrue();
    expect($translation->table_name)->toBe('posts');
    expect($translation->column_name)->toBe('title');
    expect($translation->foreign_key)->toBe(1);
    expect($translation->locale)->toBe('en');
    expect($translation->value)->toBe('Hello World');
});

it('can be updated', function () {
    $translation = Translation::factory()->create();
    $newValue = 'Updated Value';
    $translation->update(['value' => $newValue]);

    expect($translation->value)->toBe($newValue);
});

it('can be deleted', function () {
    $translation = Translation::factory()->create();
    $translation->delete();

    expect(Translation::find($translation->id))->toBeNull();
});
