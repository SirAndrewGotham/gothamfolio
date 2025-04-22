<?php

namespace App\Actions;

class CustomizeLogFormatterAction
{
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(
                tap(
                    new FilteredLineFormatterAction(
                        null, 'Y-m-d H:i:s', true, true
                    ),
                    function ($formatter) {
                        $formatter->includeStacktraces();
                    }
                )
            );
        }
    }
}
