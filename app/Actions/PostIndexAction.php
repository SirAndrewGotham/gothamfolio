<?php

declare(strict_types=1);

namespace App\Actions;

use phpDocumentor\Reflection\Types\Collection;

final readonly class PostIndexAction
{
    public string $posts;

    public string $tags;

    public function __construct()
    {
        $this->posts = Collection::class;
        $this->tags = Collection::class;
    }

    public function handle()
    {
        // to be implemented
    }
}
