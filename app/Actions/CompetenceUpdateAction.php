<?php

declare(strict_types=1);

namespace App\Actions;

use AllowDynamicProperties;
use App\Models\Competence;
use App\Models\CompetenceTranslation;
use Illuminate\Support\Facades\Auth;

#[AllowDynamicProperties] final class CompetenceUpdateAction
{
    public function __construct(private readonly BuildImageAction $buildImage, private readonly TagsSaveAction $saveTags)
    {
        $this->folder = 'uploads/competences';
    }

    public function handle(array $data, Competence $competence): void
    {
        if (isset($data['tags'])) {
            $tags = $data['tags'];
        }
        $image = $data['image'] ?? null;

        $competence->update([
            'title' => $data['title'] ?? $competence->title,
            'slug' => $data['slug'] ?? $competence->slug,
            'user_id' => Auth::id(),
        ]);

        // Update the related CompetenceTranslation if it exists
        $competenceTranslation = $competence->translations()->where('language_id', $data['language_id'])->first();

        if ($competenceTranslation) {
            $competenceTranslation->update([
                'language_id' => $data['language_id'] ?? $competenceTranslation->language_id,
                'user_id' => Auth::id(),
                'title' => $data['translation_title'] ?? $competenceTranslation->title,
                'excerpt' => $data['excerpt'] ?? $competenceTranslation->excerpt,
                'body' => $data['body'] ?? $competenceTranslation->body,
                'image' => $image ?? $competenceTranslation->image,
                'link' => $data['link'] ?? $competenceTranslation->link,
                'published_at' => $data['published_at'] ?? $competenceTranslation->published_at,
                'published_through' => $data['published_through'] ?? $competenceTranslation->published_through,
                'order' => $data['order'] ?? $competenceTranslation->order,
                'status' => $data['status'] ?? $competenceTranslation->status,
                'status_by' => $data['status_by'] ?? $competenceTranslation->status_by,
                'status_note' => 'Competence updated',
                'views' => $data['views'] ?? $competenceTranslation->views,
            ]);
        }

        if (isset($tags)) {
            $this->saveTags->handle($tags, $competenceTranslation);
        }

        if (isset($image) && $competenceTranslation) {
            $image = $this->buildImage->handle($this->folder, $competenceTranslation->slug, $image);
        }
    }
}
