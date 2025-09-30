<?php

use App\Models\Language;
use App\Models\User;
use App\Models\Work;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

beforeEach(function () {
    if (Language::query()->where('code', 'en')->doesntExist()) {
        Language::factory()->create(['code' => 'en', 'name' => 'English', 'english' => 'English', 'default' => true, 'is_active' => true]);
    }
    User::factory()->create();

    // Removed admin route setup as this is a frontend test
    // Route::middleware(['web', 'auth'])
    //     ->prefix('admin')
    //     ->name('admin.')
    //     ->group(base_path('routes/admin.php'));
});

test('works index page can be rendered', function () {
    Work::factory()->hasTranslations(1)->create();

    get(route('works.index'))
        ->assertOk()
        ->assertSee('Works'); // Assuming 'Works' is present on the works index page
});

test('single work can be rendered', function () {
    $work = Work::factory()->hasTranslations(1)->create();

    get(route('works.show', $work->translations->first()->slug))
        ->assertOk()
        ->assertSee($work->translations->first()->title);
});
