<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompetenceTranslation>
 */
class CompetenceTranslationFactory extends Factory
{
    /**
     * Provide the model's default attribute values for testing and seeding.
     *
     * The default state sets related model factories for competence_id, language_id, user_id, and status_by,
     * and populates translation attributes: title, slug, excerpt, body, order, status, published_at,
     * published_through, status_note, and views.
     *
     * @return array<string, mixed> The attribute array to assign to the model.
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(rand(3, 7));

        return [
            'competence_id' => \App\Models\Competence::factory(),
            'language_id' => \App\Models\Language::factory(),
            'user_id' => \App\Models\User::factory(),
            'title' => $title,
            'slug' => \Illuminate\Support\Str::slug($title),
            'excerpt' => '<p>'.$this->faker->realText(200).'</p>',
            'body' => '<p>'.$this->faker->realText(2000).'</p>',
            'order' => $this->faker->numberBetween(1, 10),
            'status' => \App\Enums\CompetenceStatus::Published,
            'published_at' => now(),
            'published_through' => now()->addMonths(6),
            'status_by' => \App\Models\User::factory(),
            'status_note' => $this->faker->sentence(),
            'views' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
