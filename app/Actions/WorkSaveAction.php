<?php

declare(strict_types=1);

namespace App\Actions;

use AllowDynamicProperties;
use App\Enums\WorkStatus;
use App\Models\Work;
use App\Models\WorkTranslation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

#[AllowDynamicProperties] final class WorkSaveAction
{
    public function __construct(private readonly BuildImageAction $buildImage, private readonly TagsSaveAction $saveTags)
    {
        $this->folder = 'uploads/works';
    }

    public function handle(array $data = [], $work = null): void
    {
        if (isset($data['tags'])) {
            $tags = $data['tags'];
        }
        $image = $data['image'] ?? null;

        // Create new Work
        if ($work === null) {
            $work = Work::create([
                'user_id' => Auth::id(),
                'title' => $data['title'] ?? null,
                'slug' => $data['slug'] ?? null,
            ]);
            if (isset($image)) {
                $image = $this->buildImage->handle($this->folder.'/'.$work->id, Str::slug($data['title']), $image);
            }
            $workTranslation = WorkTranslation::create([
                'work_id' => $work->id,
                'language_id' => $data['language_id'],
                'user_id' => Auth::id(),
                'title' => $data['title'],
                'excerpt' => $data['excerpt'],
                'body' => $data['body'],
                'order' => $data['order'] ?? 0,
                'image' => $image ?? null,
                'link' => $data['link'] ?? null,
                'published_at' => $data['published_at'] ?? null,
                'published_through' => $data['published_through'] ?? null,
                'status' => $data['status'] ?? WorkStatus::Published,
                'status_by' => $data['status_by'] ?? Auth::id(),
                'status_note' => 'Initial Work creation',
                'views' => 0,
            ]);
        }

        if (isset($tags)) {
            $this->saveTags->handle($tags, $workTranslation);
        }
    }
}
