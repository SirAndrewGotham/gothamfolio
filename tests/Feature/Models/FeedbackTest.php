<?php

use App\Models\Feedback;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can be soft deleted', function () {
    $feedback = Feedback::factory()->create();
    $feedback->delete();

    // Assert that the feedback is not found in regular queries
    expect(Feedback::find($feedback->id))->toBeNull();

    // Assert that the feedback is found when using withTrashed()
    $softDeletedFeedback = Feedback::withTrashed()->find($feedback->id);
    expect($softDeletedFeedback)->not->toBeNull();
    expect($softDeletedFeedback->deleted_at)->not->toBeNull();
});

it('has expected fillable attributes', function () {
    $feedback = new Feedback;
    expect($feedback->getFillable())->toEqual([
        'language_id',
        'user_id',
        'name',
        'email',
        'message',
        'read',
    ]);
});
