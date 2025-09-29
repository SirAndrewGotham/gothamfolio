<?php

declare(strict_types=1);

namespace App\Actions;

use AllowDynamicProperties;
use App\Enums\PostStatus;
use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;
use Illuminate\Support\Facades\Auth;

#[AllowDynamicProperties] final class PostTranslationSaveAction
{
    public function __construct(private readonly BuildImageAction $buildImage, private readonly TagsSaveAction $saveTags)
    {
        $this->folder = 'uploads/posts';
    }

    public function handle(array $data = [], $postTranslation = null): void
    {
        if (isset($data['tags'])) {
            $tags = $data['tags'];
        }
        $image = $data['image'] ?? null;

        if (isset($image)) {
            $folder = $this->folder.'/'.$data['post_id'];
            $slug = Language::where('id', $data['language_id'])->first()->code;
            $image = $data['image'];
            $image = $this->buildImage->handle($folder, $slug, $image);
        }

        // Create new Post Translation
        if ($postTranslation === null) {
            $postTranslation = PostTranslation::create([
                'post_id' => $data['post_id'],
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
                'status' => $data['status'] ?? PostStatus::Published,
                'status_by' => $data['status_by'] ?? Auth::id(),
                'status_note' => 'Initial Post creation',
                'views' => 0,
            ]);
        } else {
            $postTranslation->find($postTranslation);
            $postTranslation->update($data);
        }

        if (isset($tags)) {
            $this->saveTags->handle($tags, $postTranslation);
        }
    }
}
