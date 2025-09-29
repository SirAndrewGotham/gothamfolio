<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Tag;
use Illuminate\Support\Str;

final readonly class TagsSaveAction
{
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
