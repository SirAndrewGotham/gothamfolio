<?php

namespace App\Actions;

use App\Models\Language;
use App\Models\CompetenceTranslation;
use App\Models\Tag;
use App\Models\User;
use App\Models\WorkTranslation;
use Illuminate\Database\Eloquent\Builder;
use phpDocumentor\Reflection\Types\Collection;

class CompetenceIndexAction
{
    public $competences = Collection::class;
    public $tags = Collection::class;
    public function __construct()
    {
    }

    public function handle()
    {
        // to be implemented
    }
}
