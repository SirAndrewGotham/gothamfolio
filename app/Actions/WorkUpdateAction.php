<?php

declare(strict_types=1);

namespace App\Actions;

use AllowDynamicProperties;
use App\Enums\WorkStatus;
use App\Models\Work;
use App\Models\WorkTranslation;
use Illuminate\Support\Facades\Auth;

#[AllowDynamicProperties] final class WorkUpdateAction
{
    public function __construct(private readonly BuildImageAction $buildImage, private readonly TagsSaveAction $saveTags)
    {
        $this->folder = 'uploads/works';
    }

    public function handle(array $data, Work $work): void
    {
        if (isset($data['tags'])) {
            $tags = $data['tags'];
        }
        $image = $data['image'] ?? null;

        $work->update([
            'title' => $data['title'] ?? $work->title,
            'slug' => $data['slug'] ?? $work->slug,
            'user_id' => Auth::id(),
        ]);

        if (! isset($data['language_id'])) {
            return;
        }

        $workTranslation = $work->translations()->where('language_id', $data['language_id'])->first();

        if ($workTranslation) {
            $workTranslation->update([
                'language_id' => $data['language_id'] ?? $workTranslation->language_id,
                'user_id' => Auth::id(),
                'title' => $data['translation_title'] ?? $workTranslation->title,
                'excerpt' => $data['excerpt'] ?? $workTranslation->excerpt,
                'body' => $data['body'] ?? $workTranslation->body,
                'image' => $image ?? $workTranslation->image,
                'link' => $data['link'] ?? $workTranslation->link,
                'published_at' => $data['published_at'] ?? $workTranslation->published_at,
                'published_through' => $data['published_through'] ?? $workTranslation->published_through,
                'order' => $data['order'] ?? $workTranslation->order,
                'status' => $data['status'] ?? $workTranslation->status,
                'status_by' => $data['status_by'] ?? Auth::id(),
                'status_note' => 'Work updated',
            ]);
        } else {
            // Create new Work Translation if it doesn't exist
            $workTranslation = WorkTranslation::create([
                'work_id' => $work->id,
                'language_id' => $data['language_id'],
                'user_id' => Auth::id(),
                'title' => $data['translation_title'] ?? null,
                'excerpt' => $data['excerpt'] ?? null,
                'body' => $data['body'],
                'image' => $image ?? null,
                'link' => $data['link'] ?? null,
                'published_at' => $data['published_at'] ?? null,
                'published_through' => $data['published_through'] ?? null,
                'order' => $data['order'] ?? 0,
                'status' => $data['status'] ?? WorkStatus::Published,
                'status_by' => Auth::id(),
                'status_note' => 'Work Translation created',
            ]);
        }

        if (isset($tags)) {
            $this->saveTags->handle($tags, $workTranslation);
        }

        if (isset($image) && $workTranslation) {
            $image = $this->buildImage->handle($this->folder, $workTranslation->slug, $image);
        }
    }
}
