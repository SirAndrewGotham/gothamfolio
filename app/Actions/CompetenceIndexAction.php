<?php

declare(strict_types=1);

namespace App\Actions;

use phpDocumentor\Reflection\Types\Collection;

final readonly class CompetenceIndexAction
{
    public string $competences;

    public string $tags;

    public function __construct()
    {
        $this->competences = Collection::class;
        $this->tags = Collection::class;
    }

    public function handle()
    {
        // to be implemented
    }
}
