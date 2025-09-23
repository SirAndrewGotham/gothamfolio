<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Language;
use App\Models\CompetenceTranslation;
use App\Models\Tag;
use App\Models\User;
use App\Models\WorkTranslation;
use Illuminate\Database\Eloquent\Builder;
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
