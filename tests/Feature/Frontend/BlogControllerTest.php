<?php

use App\Models\Language;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

beforeEach(function () {
    User::factory()->create();

    if (Language::query()->where('code', 'en')->doesntExist()) {
        Language::factory()->create(['code' => 'en', 'name' => 'English', 'english' => 'English', 'default' => true, 'is_active' => true]);
    }

    // Removed admin route setup as this is a frontend test
    // Route::middleware(['web', 'auth'])
    //     ->prefix('admin')
    //     ->name('admin.')
    //     ->group(base_path('routes/admin.php'));
});

test('blog index page can be rendered', function () {
    Post::factory()->hasTranslations(1)->create();

    get(route('blog.index'))
        ->assertOk()
        ->assertSee('Blog');
});

test('blog posts filtered by tag can be rendered', function () {
    $tag = Tag::factory()->create();
    $post = Post::factory()->hasTranslations(1)->create();
    $post->tags()->attach($tag);

    get(route('blog.tag.show', $tag))
        ->assertOk()
        ->assertSee($tag->name)
        ->assertSee($post->translations->first()->title);
});
