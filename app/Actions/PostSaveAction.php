<?php

namespace App\Actions;

use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

class PostSaveAction
{
    public function __construct()
    {
    }

    public function handle(array $data = [], $post = null): void
    {
        $tags = $data['tags'];
        $image = $data['image'];

        // We create the Post
        if ($post === null) {
            $data['user_id'] = Auth::id();
            $post = Post::create($data);
            if (isset($image))
            {
                $image = $this->buildImage($post->slug, $image);
            }
            PostTranslation::create([
                'post_id' => $post->id,
                'language_id' => $data['language_id'],
                'user_id' => Auth::id(),
                'title' => $data['title'],
                'excerpt' => $data['excerpt'],
                'body' => $data['body'],
                'image' => $image ?? null,
                'published_at' => $data['published_at'] ?? null,
                'views' => 0,
            ]);
        } else {
            $post->find($post);
            $post->update($data);
        }

        if(isset($tags))
        {
            $this->saveTags($tags, $post);
        }
    }

    protected function buildImage($slug, $image)
    {
        $filePath = '/uploads/posts/'.$slug.'.'.$image->getClientOriginalExtension();
        Image::read($image)->save(public_path($filePath));

        return $filePath;
    }

    private function saveTags($data, $post): void
    {
        $tagIds = collect();
        $tags = explode(',', $data);
        foreach ($tags as $tag) {
            $tagId = Tag::firstOrCreate(['name' => $tag]);
            $tagIds->push($tagId);
        }
        $post->tags()->sync($tagIds->pluck('id')->toArray());
    }
}
