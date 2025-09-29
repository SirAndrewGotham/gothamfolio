<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Provide default attribute values for creating a Post model instance.
     *
     * Returns an associative array containing attributes for a Post:
     * - `user_id`: a User factory instance to associate an author.
     * - `title`: a generated short title.
     * - `slug`: a URL-friendly slug derived from the title.
     *
     * @return array<string, mixed> Associative array of Post attributes (`user_id`, `title`, `slug`)
     */
    public function definition(): array
    {
        $languages = Language::where('is_active', true)->pluck('id')->toArray();
        $title = substr($this->faker->sentence(rand(3, 7)), 0, -1);

        return [
            // 'language_id' => $this->faker->randomElement($languages),
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
        ];
    }
}
