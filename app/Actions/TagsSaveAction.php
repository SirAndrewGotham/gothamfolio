<?php

namespace App\Actions;

use App\Models\Tag;

class TagsSaveAction
{
    public function handle($data, $model)
    {
        if(isset($data['tags']))
        {
            $tagIds = collect();
            $tags = explode(',', $data['tags']);
            foreach ($tags as $tag) {
                $tagId = Tag::firstOrCreate(['name' => $tag]);
                $tagIds->push($tagId);
            }
            $model->tags()->sync($tagIds->pluck('id')->toArray());
        }
    }
}
