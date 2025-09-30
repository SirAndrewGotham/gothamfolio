<?php

use App\Models\Language;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\get;
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

test('contact form page can be rendered', function () {
    get(route('feedback.index'))
        ->assertOk()
        ->assertSee('Your name');
});

test('contact form can be submitted successfully', function () {
    Mail::fake();

    config()->set('gothamfolio.frontend.feedback-to-requester', 'on');
    config()->set('gothamfolio.frontend.feedback-to-admin', 'on');

    $this->post(route('feedback.store'), [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'message' => 'This is a test message.',
    ])
        ->assertRedirect(route('feedback.index'))
        ->assertSessionHas('success', trans('app.frontend.contact.confirmMailSent'));

    $this->assertDatabaseHas('feedback', [
        'email' => 'test@example.com',
        'name' => 'Test User',
        'message' => 'This is a test message.',
    ]);

    Mail::assertSent(\App\Mail\FeedbackMailer::class, function ($mail) {
        return $mail->hasTo('test@example.com') &&
               $mail->data['name'] === 'Test User';
    });
});

test('contact form submission fails with invalid data', function () {
    post(route('feedback.store'), [
        'name' => '',
        'email' => 'invalid-email',
        'message' => '',
    ])
        ->assertSessionHasErrors([
            'name',
            'email',
            'message',
        ]);
});
