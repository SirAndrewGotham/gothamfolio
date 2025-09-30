<?php

use App\Actions\CustomizeLogFormatterAction;
use App\Actions\FilteredLineFormatterAction;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

it('customizes log formatter', function () {
    $mockHandler = Mockery::mock(StreamHandler::class);
    $mockHandler->shouldReceive('setFormatter')
        ->once()
        ->with(Mockery::type(FilteredLineFormatterAction::class));

    $mockLogger = Mockery::mock(Logger::class);
    $mockLogger->shouldReceive('getHandlers')
        ->once()
        ->andReturn([$mockHandler]);

    $action = new CustomizeLogFormatterAction;
    $action($mockLogger);

    // No explicit assertion here as Mockery's expectations handle it.
    // However, we can add a dummy assertion to satisfy Pest if needed.
    expect(true)->toBeTrue();
});
