<?php

use App\Models\Gallery;
use App\Models\Language;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

beforeEach(function () {
    if (Language::query()->where('code', 'en')->doesntExist()) {
        Language::factory()->create(['code' => 'en', 'name' => 'English', 'english' => 'English', 'default' => true, 'is_active' => true]);
    }

    // Removed admin route setup as this is a frontend test
    // Route::middleware(['web', 'auth'])
    //     ->prefix('admin')
    //     ->name('admin.')
    //     ->group(base_path('routes/admin.php'));
});

test('galleries index page can be rendered', function () {
    Gallery::factory()->create();

    get(route('galleries.index'))
        ->assertOk()
        ->assertSee('Galleries'); // Assuming 'Galleries' is present on the galleries index page
});

test('single gallery can be rendered', function () {
    $gallery = Gallery::factory()->hasImages(1)->create();

    get(route('galleries.show', $gallery->slug))
        ->assertOk()
        ->assertSee($gallery->title);
});
