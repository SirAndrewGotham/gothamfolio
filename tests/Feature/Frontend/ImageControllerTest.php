<?php

use App\Models\Image;
use App\Models\Language;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager as ImageManagerAlias;

use function Pest\Laravel\get;
// Removed use function Pest\Laravel\mock;
use function Pest\Laravel\post;

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

test('images index page can be rendered', function () {
    get(route('images.index'))
        ->assertOk()
        ->assertSee('Laravel 11 Image Intervention Example Tutorial - ItSolutionStuff.com');
});

// I do not upload any images from the front at the moment, maybe later
// test('image can be uploaded successfully', function () {
//    // Mock the Intervention Image facade
//    $mockImageManager = \Mockery::mock(ImageManagerAlias::class);
//    app()->instance(ImageManagerAlias::class, $mockImageManager);
//
//    $mockImageManager->shouldReceive('read')->once()->andReturn($mockImageManager);
//    $mockImageManager->shouldReceive('save')->times(2)->andReturnSelf(); // Called twice: once for original, once for thumbnail
//    $mockImageManager->shouldReceive('resize')->once()->andReturnSelf();
//
//    Storage::fake('public');
//
//    $file = UploadedFile::fake()->image('test_image.jpg', 1000, 1000)->size(500);
//
//    post(route('image.store'), [
//        'image' => $file,
//    ])
//        ->assertRedirect()
//        ->assertSessionHas('success', 'Photo Upload successful');
//
//    // Assertions for Storage::fake() are still valid for direct Storage facade usage.
//    // However, since the controller directly uses public_path, these won't work directly.
//    // We are relying on the ImageManager mock to verify the calls.
//
//    // We cannot use ImageFacade::assertSaved or assertResized as fake() is not available.
// });
//
// test('image upload fails with invalid data', function () {
//    // Mock the Intervention Image facade to prevent actual file writing
//    $mockImageManager = \Mockery::mock(ImageManagerAlias::class);
//    app()->instance(ImageManagerAlias::class, $mockImageManager);
//
//    $mockImageManager->shouldNotReceive('read'); // Should not attempt to read an invalid image
//
//    Storage::fake('public');
//
//    // Test with a non-image file
//    $file = UploadedFile::fake()->create('document.pdf', 500, 'application/pdf');
//
//    post(route('image.store'), [
//        'image' => $file,
//    ])
//        ->assertSessionHasErrors(['image']);
//
//    // Test with a too large image
//    $largeFile = UploadedFile::fake()->image('large_image.jpg', 2000, 2000)->size(3000); // 3MB, exceeding 2MB limit if default
//
//    post(route('image.store'), [
//        'image' => $largeFile,
//    ])
//        ->assertSessionHasErrors(['image']);
// });
