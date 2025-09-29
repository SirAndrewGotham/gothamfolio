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

    /**
     * Creates a new post translation or updates an existing one, and persists optional tags and image.
     *
     * When $data contains an `image`, the image is processed and the resulting value is saved on creation.
     * If $postTranslation is null a new PostTranslation record is created using values from $data;
     * otherwise the provided translation is updated with $data.
     *
     * Accepted keys in $data:
     * - post_id (int) — ID of the parent post.
     * - language_id (int) — Language ID for the translation (used for image processing when present).
     * - title (string), excerpt (string), body (string) — primary translation fields.
     * - image (mixed, optional) — image payload to be processed and stored on creation.
     * - link (string|null, optional), published_at (string|null, optional), published_through (string|null, optional)
     * - order (int, optional), status (int|string, optional), status_by (int, optional)
     * - tags (array, optional) — tags to associate with the translation.
     *
     * @param array $data Associative array of translation attributes and optional keys described above.
     * @param mixed|null $postTranslation Existing PostTranslation instance to update, or null to create a new one.
     */
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
