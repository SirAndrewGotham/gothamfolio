<?php

declare(strict_types=1);

namespace App\Actions;

use AllowDynamicProperties;
use App\Enums\PostStatus;
use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;
use Illuminate\Support\Facades\Auth;

#[AllowDynamicProperties] final class PostSaveAction
{
    public function __construct(private readonly BuildImageAction $buildImage, private readonly TagsSaveAction $saveTags)
    {
        $this->folder = 'uploads/posts';
    }

    /**
     * Create a new post (with translation) or update an existing post, optionally processing an image and saving tags.
     *
     * When $post is null a new Post and corresponding PostTranslation will be created using values from $data.
     * When $post is provided the existing post will be updated. If an image is present it will be processed and associated
     * with the translation. If tags are provided they will be persisted and associated with the post translation.
     *
     * Expected keys in $data include: `language_id`, `title`, `excerpt`, `body`, and optionally `image`, `tags`,
     * `order`, `published_at`, `status`, `status_by`. `user_id` is set automatically for new posts.
     *
     * @param array $data Associative array of post and translation attributes.
     * @param mixed|null $post Optional Post instance or identifier representing the post to update; pass null to create.
     */
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
                $language = Language::query()->findOrFail($data['language_id']);
                $image = $this->buildImage->handle(
                    $this->folder.'/'.$post->id,
                    $language->code,
                    $image
                );
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
