<?php

namespace Tests\Feature\Concerns;

use App\Models\Translation;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Tests\Feature\Concerns\Models\TestTranslatableModelFeature;

uses(RefreshDatabase::class);

// Removed beforeEach to simplify test setup and avoid database locking issues.

it('returns a HasMany relationship for translations', function () {
    // Ensure migrations are run for the dummy model
    // RefreshDatabase trait handles migrations, no need to call artisan here

    // Seed some translations for testing for this specific test
    $model = TestTranslatableModelFeature::create([
        'title' => 'Initial Title',
        'body' => 'Initial Body',
    ]);

    Translation::create([
        'table_name' => $model->getTable(),
        'foreign_key' => $model->getKey(),
        'column_name' => 'title',
        'locale' => 'en',
        'value' => 'English Title',
    ]);
    Translation::create([
        'table_name' => $model->getTable(),
        'foreign_key' => $model->getKey(),
        'column_name' => 'title',
        'locale' => 'fr',
        'value' => 'French Title',
    ]);
    Translation::create([
        'table_name' => $model->getTable(),
        'foreign_key' => $model->getKey(),
        'column_name' => 'body',
        'locale' => 'en',
        'value' => 'English Body',
    ]);

    $relation = $model->translations();

    expect($relation)->toBeInstanceOf(HasMany::class);
    expect($relation->getRelated())->toBeInstanceOf(Translation::class);
    expect($relation->getForeignKeyName())->toBe('foreign_key');
    expect($relation->getLocalKeyName())->toBe($model->getKeyName());

    // Assert that the relationship correctly filters by table_name
    $this->assertCount(2, $model->translations()->where('column_name', 'title')->get());
    $this->assertCount(1, $model->translations()->where('column_name', 'body')->get());
});

it('scopeWithTranslation eager loads translations for default locale', function () {
    // Configure multilingual settings directly
    Config::set('gothamfolio.multilingual.enabled', true);
    Config::set('app.locale', 'en');
    Config::set('app.fallback_locale', 'en');
    Config::set('gothamfolio.multilingual.locales', ['en', 'fr']);
    Config::set('gothamfolio.multilingual.default', 'en');
    Config::set('database.default', 'sqlite');

    App::shouldReceive('getLocale')->andReturn('en');

    // Seed data for this test
    $model = TestTranslatableModelFeature::create([
        'title' => 'Another Title',
        'body' => 'Another Body',
    ]);

    Translation::create([
        'table_name' => $model->getTable(),
        'foreign_key' => $model->getKey(),
        'column_name' => 'title',
        'locale' => 'en',
        'value' => 'Another English Title',
    ]);
    Translation::create([
        'table_name' => $model->getTable(),
        'foreign_key' => $model->getKey(),
        'column_name' => 'title',
        'locale' => 'fr',
        'value' => 'Another French Title',
    ]);

    $loadedModel = TestTranslatableModelFeature::withTranslation()->find($model->id);

    expect($loadedModel->relationLoaded('translations'))->toBeTrue();
    expect($loadedModel->translations)->toHaveCount(1);
    expect($loadedModel->translations->first()->locale)->toBe('en');
});

it('scopeWithTranslations eager loads translations for specified locales', function () {
    // Configure multilingual settings directly
    Config::set('gothamfolio.multilingual.enabled', true);
    Config::set('app.locale', 'en');
    Config::set('app.fallback_locale', 'en');
    Config::set('gothamfolio.multilingual.locales', ['en', 'fr', 'de']);
    Config::set('gothamfolio.multilingual.default', 'en');
    Config::set('database.default', 'sqlite');

    App::shouldReceive('getLocale')->andReturn('en');

    // Seed data for this test
    $model = TestTranslatableModelFeature::create([
        'title' => 'Yet Another Title',
        'body' => 'Yet Another Body',
    ]);

    Translation::create([
        'table_name' => $model->getTable(),
        'foreign_key' => $model->getKey(),
        'column_name' => 'title',
        'locale' => 'en',
        'value' => 'Yet Another English Title',
    ]);
    Translation::create([
        'table_name' => $model->getTable(),
        'foreign_key' => $model->getKey(),
        'column_name' => 'title',
        'locale' => 'fr',
        'value' => 'Yet Another French Title',
    ]);
    Translation::create([
        'table_name' => $model->getTable(),
        'foreign_key' => $model->getKey(),
        'column_name' => 'title',
        'locale' => 'de',
        'value' => 'Yet Another German Title',
    ]);

    $loadedModel = TestTranslatableModelFeature::withTranslations(['fr', 'de'])->find($model->id);

    expect($loadedModel->relationLoaded('translations'))->toBeTrue();
    // We expect two translations: 'fr' and 'de' (fallback locale is 'en', but not in specified locales)
    expect($loadedModel->translations)->toHaveCount(2);
    expect($loadedModel->translations->pluck('locale')->toArray())->toContain('fr', 'de');
});
