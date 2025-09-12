<?php

namespace App\Actions;

use AllowDynamicProperties;
use App\Enums\CompetenceStatus;
use App\Models\Competence;
use App\Models\CompetenceTranslation;
use Illuminate\Support\Facades\Auth;

#[AllowDynamicProperties] class CompetenceTranslationUpdateAction
{
    public function __construct(private readonly BuildImageAction $buildImage, private readonly TagsSaveAction $saveTags)
    {
        $this->folder = 'uploads/competences';
    }

    public function handle(array $data = [], $competenceTranslation = null): void
    {
        if (isset($data['tags'])) {
            $tags = $data['tags'];
        }
        $image = $data['image'] ?? null;

        // Create new Competence Translation
        if ($competenceTranslation === null) {
            $data['user_id'] = Auth::id();
            $data['status_note'] = 'Competence Translation updated';
            $competenceTranslation->find($competenceTranslation);
            $competenceTranslation = CompetenceTranslation::create($data);
            if (isset($image)) {
                $image = $this->buildImage->handle($this->folder, $competenceTranslation->slug, $image);
            }
//            $competenceTranslation = CompetenceTranslation::create([
//                'competence_id' => $competence->id,
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
//                'status' => $data['status'] ?? competenceStatus::Published,
//                'status_by' => $data['status_by'] ?? Auth::id(),
//                'status_note' => 'Initial Competence creation',
//                'views' => 0,
//            ]);
        } else {
            $competenceTranslation->find($competenceTranslation);
            $data['status_note'] = 'Competence Translation updated';
            $competenceTranslation->update($data);
        }

        if (isset($tags)) {
            $this->saveTags->handle($tags, $competenceTranslation);
        }
    }
}
