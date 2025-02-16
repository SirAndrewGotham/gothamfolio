<?php

namespace App\Actions;

use App\Models\Work;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

class WorkSaveAction
{
    public function __construct()
    {
    }

    public function handle(array $data = [], $work = null): void
    {
        if(isset($data['tags']))
        {
            $tags = $data['tags'];
        }
        $image = $data['image'] ?? null;

        // We create the Work
        if ($work === null) {
            $data['user_id'] = Auth::id();
            $work = Work::create($data);
            if (isset($image))
            {
                $image = $this->buildImage($work->slug, $image);
            }
//            WorkTranslation::create([
//                'work_id' => $work->id,
//                'language_id' => $data['language_id'],
//                'user_id' => Auth::id(),
//                'title' => $data['title'],
//                'excerpt' => $data['excerpt'],
//                'body' => $data['body'],
//                'image' => $image ?? null,
//                'published_at' => $data['published_at'] ?? null,
//                'views' => 0,
//            ]);
        } else {
            $work->find($work);
            $work->update($data);
        }

        if(isset($tags))
        {
            $this->saveTags($tags, $work);
        }
    }

    protected function buildImage($slug, $image)
    {
        $filePath = '/uploads/works/'.$slug.'.'.$image->getClientOriginalExtension();
        Image::read($image)->save(public_path($filePath));

        $image = $filePath;
        Work::where('slug', $slug)->first()->update(['image' => $image]);

        return $filePath;
    }

    private function saveTags($data, $work): void
    {
        $tagIds = collect();
        $tags = explode(',', $data);
        foreach ($tags as $tag) {
            $tagId = Tag::firstOrCreate(['name' => $tag]);
            $tagIds->push($tagId);
        }
        $work->tags()->sync($tagIds->pluck('id')->toArray());
    }
}
