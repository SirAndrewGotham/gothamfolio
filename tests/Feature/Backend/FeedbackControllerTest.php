<?php

use App\Models\Feedback;
use App\Models\Language;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Ensure a default language exists for the SetLocale middleware
    if (Language::query()->where('code', 'en')->doesntExist()) {
        Language::factory()->create(['code' => 'en', 'name' => 'English', 'english' => 'English', 'default' => true, 'is_active' => true]);
    }

    Route::middleware(['web', 'auth'])
        ->prefix('admin')
        ->name('admin.')
        ->group(base_path('routes/admin.php'));
});

test('unread feedback index page can be rendered for authenticated user', function () {
    $user = User::factory()->create();

    Feedback::factory()->count(3)->create(['read' => false]);

    actingAs($user)->get(route('admin.feedback.index'))
        ->assertOk()
        ->assertSee('New Feedback') // Corrected: Using 'New Feedback' as per the Blade view
        ->assertSee(Feedback::where('read', false)->first()->message); // Adjust assertion based on actual view content
});

test('read feedback index page can be rendered for authenticated user', function () {
    $user = User::factory()->create();

    Feedback::factory()->count(3)->create(['read' => true]);

    actingAs($user)->get(route('admin.feedback.read'))
        ->assertOk()
        ->assertSee('Read Feedback') // Assuming this text is on the read feedback index page
        ->assertSee(Feedback::where('read', true)->first()->message); // Adjust assertion based on actual view content
});

test('single feedback can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    $feedback = Feedback::factory()->create();

    $response = actingAs($user)->get(route('admin.feedback.show', $feedback));

    $response->assertOk()
        ->assertSee($feedback->name)
        ->assertSee($feedback->email)
        ->assertSee('This is a test feedback message.');
});

test('feedback can be marked as read by an authenticated user', function () {
    $user = User::factory()->create();
    $feedback = Feedback::factory()->create(['read' => false]);

    actingAs($user)->put(route('admin.feedback.mark-as-read', $feedback))
        ->assertRedirect(route('admin.feedback.index'));

    $this->assertDatabaseHas('feedback', [
        'id' => $feedback->id,
        'read' => true,
    ]);
});

test('feedback can be marked as unread by authenticated user', function () {
    $user = User::factory()->create();
    $feedback = Feedback::factory()->create(['read' => true]);

    actingAs($user)->put(route('admin.feedback.mark-as-unread', $feedback))
        ->assertRedirect(route('admin.feedback.read'));

    $this->assertDatabaseHas('feedback', [
        'id' => $feedback->id,
        'read' => false,
    ]);
});

test('feedback can be soft deleted by authenticated user', function () {
    $user = User::factory()->create();
    $feedback = Feedback::factory()->create();

    actingAs($user)->delete(route('admin.feedback.destroy', $feedback))
        ->assertRedirect(route('admin.feedback.index'));

    $this->assertSoftDeleted('feedback', [
        'id' => $feedback->id,
    ]);
});

test('feedback can be force deleted by authenticated user', function () {
    $user = User::factory()->create();
    $feedback = Feedback::factory()->create();

    actingAs($user)->delete(route('admin.feedback.forceDelete', $feedback))
        ->assertRedirect(route('admin.feedback.read'));

    $this->assertDatabaseMissing('feedback', [
        'id' => $feedback->id,
    ]);
});
