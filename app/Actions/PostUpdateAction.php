<?php

declare(strict_types=1);

namespace App\Actions;

use AllowDynamicProperties;
use App\Enums\PostStatus;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

#[AllowDynamicProperties] final class PostUpdateAction
{
    public function __construct(private readonly BuildImageAction $buildImage, private readonly TagsSaveAction $saveTags)
    {
        $this->folder = 'uploads/posts';
    }

    public function handle(array $data, Post $post): void
    {
        if (isset($data['tags'])) {
            $tags = $data['tags'];
        }
        $image = $data['image'] ?? null;

        $post->update([
            'title' => $data['title'] ?? $post->title,
            'slug' => $data['slug'] ?? $post->slug,
            'user_id' => Auth::id(),
        ]);

        $postTranslation = $post->translations()->where('language_id', $data['language_id'])->first();

        if ($postTranslation) {
            $postTranslation->update([
                'language_id' => $data['language_id'] ?? $postTranslation->language_id,
                'user_id' => Auth::id(),
                'title' => $data['title'] ?? $postTranslation->title,
                'excerpt' => $data['excerpt'] ?? $postTranslation->excerpt,
                'body' => $data['body'] ?? $postTranslation->body,
                'image' => $image ? $this->buildImage->handle($this->folder.'/'.$post->id, Str::slug($data['title']), $image) : $postTranslation->image,
                'link' => $data['link'] ?? $postTranslation->link,
                'published_at' => $data['published_at'] ?? $postTranslation->published_at,
                'published_through' => $data['published_through'] ?? $postTranslation->published_through,
                'order' => $data['order'] ?? $postTranslation->order,
                'status' => $data['status'] ?? PostStatus::Published,
                'status_by' => $data['status_by'] ?? Auth::id(),
                'status_note' => 'Post updated',
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
