<?php

use App\Actions\CompetenceIndexAction;

it('can instantiate competence index action', function () {
    $action = new CompetenceIndexAction;
    expect($action)->toBeInstanceOf(CompetenceIndexAction::class);
});
