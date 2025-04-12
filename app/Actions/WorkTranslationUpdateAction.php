<?php

namespace App\Actions;

use AllowDynamicProperties;
use App\Enums\WorkStatus;
use App\Models\Work;
use App\Models\WorkTranslation;
use Illuminate\Support\Facades\Auth;

#[AllowDynamicProperties] class WorkTranslationUpdateAction
{
//    public function __construct(private readonly BuildImageAction $buildImage, private readonly TagsSaveAction $saveTags)
//    {
//        $this->folder = 'uploads/works';
//    }

    public function handle(array $data = [], $workTranslation = null): void
    {
        if (isset($data['tags'])) {
            $tags = $data['tags'];
        }
        $image = $data['image'] ?? null;

        // Create new Work Translation
        if ($workTranslation === null) {
            $data['user_id'] = Auth::id();
            $data['status_note'] = 'Work Translation updated';
            $workTranslation->find($workTranslation);
            $workTranslation = WorkTranslation::create($data);
            if (isset($image)) {
                $image = $this->buildImage->handle($this->folder, $workTranslation->slug, $image);
            }
//            $workTranslation = WorkTranslation::create([
//                'work_id' => $work->id,
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
//                'status' => $data['status'] ?? WorkStatus::Published,
//                'status_by' => $data['status_by'] ?? Auth::id(),
//                'status_note' => 'Initial Work creation',
//                'views' => 0,
//            ]);
        } else {
            $workTranslation->find($workTranslation);
            $data['status_note'] = 'Work Translation updated';
            $workTranslation->update($data);
        }

        if (isset($tags)) {
            $this->saveTags->handle($tags, $workTranslation);
        }
    }
}
