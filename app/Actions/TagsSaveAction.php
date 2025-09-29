<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Tag;
use Illuminate\Support\Str;

final readonly class TagsSaveAction
{
    /**
     * Synchronizes the given model's tags from a comma-separated tag string.
     *
     * Trims each tag name, ensures a Tag record exists for each name, and syncs the model's tag relationship
     * so the model is associated only with the resulting tags.
     *
     * @param string $data Comma-separated tag names (e.g. "php, laravel, testing").
     * @param \Illuminate\Database\Eloquent\Model $model Eloquent model instance that has a `tags()` relationship.
     */
    public function handle($data, $model)
    {
        $tagIds = collect();
        $tags = explode(',', $data);
        foreach ($tags as $tag) {
            $tagId = Tag::firstOrCreate(['name' => Str::trim($tag)]);
            $tagIds->push($tagId);
        }
        $model->tags()->sync($tagIds->pluck('id')->toArray());
    }
}
