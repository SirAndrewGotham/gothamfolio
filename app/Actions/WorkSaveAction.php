<?php

namespace App\Actions;

use App\Enums\WorkStatus;
use App\Models\Work;
use App\Models\Tag;
use App\Models\WorkTranslation;
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

        // Create new Work
        if ($work === null) {
            $data['user_id'] = Auth::id();
            $work = Work::create($data);
            if (isset($image))
            {
                $image = $this->buildImage($work->slug, $image);
            }
            WorkTranslation::create([
                'work_id' => $work->id,
                'language_id' => $data['language_id'],
                'user_id' => Auth::id(),
                'title' => $data['title'],
                'excerpt' => $data['excerpt'],
                'body' => $data['body'],
                'image' => $image ?? null,
                'link' => $data['link'] ?? null,
                'published_at' => $data['published_at'] ?? null,
                'published_through' => $data['published_through'] ?? null,
                'order' => $data['order'] ?? 0,
                'status' => $data['status'] ?? WorkStatus::Published,
                'status_by' => $data['status_by'] ?? Auth::id(),
                'status_note' => 'Initial Work creation',
                'views' => 0,
            ]);
        } else {
            $work->find($work);
            $work->update($data);
        }

        if(isset($tags))
        {
            $this->saveTags($tags, $work);
        }
    }

    protected function buildImage($slug, $image): string
    {
        $imageName = $slug.'.'.$image->extension();

        $image->move(public_path('uploads/works'), $imageName);

        return $imageName;
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
