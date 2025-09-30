<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Tag;
use Illuminate\Support\Str;

final readonly class TagsSaveAction
{
    public function handle(array $data, $model): void
    {
        $tagIds = collect();
        foreach ($data as $tag) {
            $tagId = Tag::firstOrCreate(['name' => Str::trim($tag)]);
            $tagIds->push($tagId);
        }
        $model->tags()->sync($tagIds->pluck('id')->toArray());
    }
}
