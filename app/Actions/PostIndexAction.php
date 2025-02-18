<?php

namespace App\Actions;

use App\Models\Language;
use App\Models\PostTranslation;
use App\Models\Tag;
use App\Models\User;
use App\Models\WorkTranslation;
use Illuminate\Database\Eloquent\Builder;
use phpDocumentor\Reflection\Types\Collection;

class PostIndexAction
{
    public $posts = Collection::class;
    public $tags = Collection::class;
    public function __construct()
    {
    }

    public function handle()
    {
        // to be implemented
    }
}
