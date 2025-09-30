<?php

declare(strict_types=1);

namespace App\Actions;

use AllowDynamicProperties;
use App\Enums\CompetenceStatus;
use App\Models\Competence;
use App\Models\CompetenceTranslation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

#[AllowDynamicProperties] final class CompetenceSaveAction
{
    public function __construct(private readonly BuildImageAction $buildImage, private readonly TagsSaveAction $saveTags)
    {
        $this->folder = 'uploads/competences';
    }

    public function handle(array $data = [], $competence = null): void
    {
        if (isset($data['tags'])) {
            $tags = $data['tags'];
        }
        $image = $data['image'] ?? null;

        // We create a Competence
        if ($competence === null) {
            $competence = Competence::create([
                'user_id' => Auth::id(),
                'title' => $data['title'] ?? null, // Assuming title is used for slug generation
                'slug' => $data['slug'] ?? null, // If slug is pre-generated
            ]);
            if (isset($image)) {
                $image = $this->buildImage->handle($this->folder.'/'.$competence->id, Str::slug($data['title']), $image);
            }
            $competenceTranslation = CompetenceTranslation::create([
                'competence_id' => $competence->id,
                'language_id' => $data['language_id'],
                'user_id' => Auth::id(),
                'title' => $data['title'],
                'excerpt' => $data['excerpt'],
                'body' => $data['body'],
                'order' => $data['order'] ?? 0,
                'image' => $image ?? null,
                'published_at' => $data['published_at'] ?? null,
                'published_through' => $data['published_at'] ?? null,
                'status' => $data['status'] ?? CompetenceStatus::Published,
                'status_by' => $data['status_by'] ?? Auth::id(),
                'status_note' => 'Initial competence creation',
                'views' => 0,
            ]);
        } else {
            $competence->find($competence);
            $competence->update($data);
        }

        if (isset($tags)) {
            $this->saveTags->handle($tags, $competenceTranslation);
        }
    }
}
