<?php

namespace App\Actions;

use AllowDynamicProperties;
use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\PostTranslation;
use Illuminate\Support\Facades\Auth;

#[AllowDynamicProperties] class PostSaveAction
{
    public function __construct(private readonly BuildImageAction $buildImage, private readonly TagsSaveAction $saveTags)
    {
        $this->folder = 'uploads/posts';
    }

    public function handle(array $data = [], $post = null): void
    {
        if (isset($data['tags'])) {
            $tags = $data['tags'];
        }
        $image = $data['image'] ?? null;

        // We create the Post
        if ($post === null) {
            $data['user_id'] = Auth::id();
            $post = Post::create($data);
            if (isset($image)) {
                $image = $this->buildImage->handle($this->folder, $post->slug, $image);
            }
            $postTranslation = PostTranslation::create([
                'post_id' => $post->id,
                'language_id' => $data['language_id'],
                'user_id' => Auth::id(),
                'title' => $data['title'],
                'excerpt' => $data['excerpt'],
                'body' => $data['body'],
                'order' => $data['order'] ?? 0,
                'image' => $image ?? null,
                'published_at' => $data['published_at'] ?? null,
                'published_through' => $data['published_at'] ?? null,
                'status' => $data['status'] ?? PostStatus::Published,
                'status_by' => $data['status_by'] ?? Auth::id(),
                'status_note' => 'Initial post creation',
                'views' => 0,
            ]);
        } else {
            $post->find($post);
            $post->update($data);
        }

        if (isset($tags)) {
            $this->saveTags->handle($tags, $postTranslation);
        }
    }
}
