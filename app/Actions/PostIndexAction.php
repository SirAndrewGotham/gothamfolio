<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Language;
use App\Models\PostTranslation;
use App\Models\Tag;
use App\Models\User;
use App\Models\WorkTranslation;
use Illuminate\Database\Eloquent\Builder;
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
