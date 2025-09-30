<?php

use App\Models\Language;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

beforeEach(function () {
    Language::factory()->create(['code' => 'en', 'name' => 'English', 'default' => true, 'is_active' => true]);

    Route::middleware(['web', 'auth'])
        ->prefix('admin')
        ->name('admin.')
        ->group(base_path('routes/admin.php'));
});

test('resume page can be rendered', function () {
    get(route('resume'))
        ->assertOk()
        ->assertSee('Work Experience');
});
