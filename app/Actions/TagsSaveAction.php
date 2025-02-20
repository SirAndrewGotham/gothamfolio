<?php

namespace App\Actions;

use App\Models\Tag;

class TagsSaveAction
{
    public function handle($data, $model)
    {
        $tagIds = collect();
        $tags = explode(',', $data);
        foreach ($tags as $tag) {
            $tagId = Tag::firstOrCreate(['name' => $tag]);
            $tagIds->push($tagId);
        }
        $model->tags()->sync($tagIds->pluck('id')->toArray());
    }
}
