<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Competence>
 */
class CompetenceFactory extends Factory
{
    /**
     * Define the default attributes for a Competence model.
     *
     * Generates a three-word fake title, assigns a new User factory to `user_id`,
     * and creates a slug from the generated title.
     *
     * @return array<string,mixed> {
     *     @var \Illuminate\Database\Eloquent\Factories\Factory $user_id Factory that will create the related User.
     *     @var string $title The generated three-word title.
     *     @var string $slug A URL-friendly slug derived from `$title`.
     * }
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(3);

        return [
            'user_id' => \App\Models\User::factory(),
            'title' => $title,
            'slug' => \Illuminate\Support\Str::slug($title),
        ];
    }
}
