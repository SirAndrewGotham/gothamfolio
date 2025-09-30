<?php

use App\Actions\PostIndexAction;

it('can instantiate post index action', function () {
    $action = new PostIndexAction;
    expect($action)->toBeInstanceOf(PostIndexAction::class);
});
