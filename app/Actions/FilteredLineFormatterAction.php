<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Support\Str;
use Monolog\Formatter\LineFormatter;

final  class FilteredLineFormatterAction extends LineFormatter
{
    protected const FILTERED_REPLACEMENT = '[FILTERED]';

    protected const CONFIG_KEYS_TO_FILTER = [
        'database.connections.mysql.password',
    ];

    public function format(array|\Monolog\LogRecord $record): string
    {
        $log = parent::format($record);

        foreach (self::CONFIG_KEYS_TO_FILTER as $key) {
            $log = Str::replace(config($key), self::FILTERED_REPLACEMENT, $log);
        }

        return $log;
    }
}
