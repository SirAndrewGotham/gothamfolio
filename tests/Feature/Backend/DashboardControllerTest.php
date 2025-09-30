<?php

use App\Models\Customer;
use App\Models\Language;
use App\Models\Post;
use App\Models\User;
use App\Models\Work;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

beforeEach(function () {
    if (Language::query()->where('code', 'en')->doesntExist()) {
        Language::factory()->create(['code' => 'en', 'name' => 'English', 'english' => 'English', 'default' => true, 'is_active' => true]);
    }

    Route::middleware(['web', 'auth'])
        ->prefix('admin')
        ->name('admin.')
        ->group(base_path('routes/admin.php'));
});

test('dashboard page can be rendered for authenticated user', function () {
    $user = User::factory()->create(); // 1 user

    Post::factory()->count(5)->create(['user_id' => $user->id]);
    Work::factory()->count(3)->create(['user_id' => $user->id]);
    Customer::factory()->count(2)->create();

    // Create additional users explicitly, ensuring they don't have a specific language_id if not needed
    User::factory()->count(9)->create(); // 1 existing + 9 new = 10 users

    // Dump the total user count right before the request
    dump('Users count before request: '.User::all()->count());

    actingAs($user)->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('Dashboard')
        ->assertSee('5') // Posts count
        ->assertSee('3') // Works count
        ->assertSee('2') // Customers count
        ->assertSee('10'); // Users count (1 existing + 9 new = 10 total)

    // dump($this->get(route('admin.dashboard'))->content());
});
