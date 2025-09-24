<?php

declare(strict_types=1);

namespace App\Actions;

use AllowDynamicProperties;
use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\PostTranslation;
use Illuminate\Support\Facades\Auth;

#[AllowDynamicProperties] final class PostTranslationUpdateAction
{
//        public function __construct(private readonly BuildImageAction $buildImage, private readonly TagsSaveAction $saveTags)
//        {
//            $this->folder = 'uploads/posts';
//        }
    public function __construct()
    {
        $this->folder = 'uploads/posts';
    }

    public function handle(array $data = [], $postTranslation = null): void
    {
        if (isset($data['tags'])) {
            $tags = $data['tags'];
        }
        $image = $data['image'] ?? null;

        // Create new Post Translation
        if ($postTranslation === null) {
            $data['user_id'] = Auth::id();
            $data['status_note'] = 'Post Translation updated';
            $postTranslation->find($postTranslation);
            $postTranslation = PostTranslation::create($data);
            if (isset($image)) {
                $image = $this->buildImage->handle($this->folder, $postTranslation->slug, $image);
            }
            //            $postTranslation = PostTranslation::create([
            //                'post_id' => $post->id,
            //                'language_id' => $data['language_id'],
            //                'user_id' => Auth::id(),
            //                'title' => $data['title'],
            //                'excerpt' => $data['excerpt'],
            //                'body' => $data['body'],
            //                'image' => $image ?? null,
            //                'link' => $data['link'] ?? null,
            //                'published_at' => $data['published_at'] ?? null,
            //                'published_through' => $data['published_through'] ?? null,
            //                'order' => $data['order'] ?? 0,
            //                'status' => $data['status'] ?? PostStatus::Published,
            //                'status_by' => $data['status_by'] ?? Auth::id(),
            //                'status_note' => 'Initial Post creation',
            //                'views' => 0,
            //            ]);
        } else {
            $postTranslation->find($postTranslation);
            $data['status_note'] = 'Post Translation updated';
            $postTranslation->update($data);
        }

        if (isset($tags)) {
            $this->saveTags->handle($tags, $postTranslation);
        }
    }
}
