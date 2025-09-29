<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompetenceTranslation>
 */
class CompetenceTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
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
