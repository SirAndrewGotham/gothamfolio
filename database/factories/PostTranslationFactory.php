<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\Post;
use App\Models\PostTranslation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<PostTranslation>
 */
class PostTranslationFactory extends Factory
{
    /**
     * Provide default attribute values for creating PostTranslation records via the factory.
     *
     * The definition selects a random active language ID, generates a 3–7 word title
     * (trailing period removed) and slug, creates associated User and Post instances
     * via their factories, wraps Faker-generated excerpt and body HTML in `<p>` tags,
     * produces an image URL (750x346, 'cats'), and sets `published_at`, `created_at`
     * and `updated_at` to the current timestamp.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $languages = Language::where('is_active', true)->pluck('id')->toArray();
        $title = substr($this->faker->sentence(rand(3, 7)), 0, -1);

        return [
            'language_id' => $this->faker->randomElement($languages),
            'user_id' => User::factory(),
            'post_id' => Post::factory(), // Automatically create and associate a Post
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => '<p>'.$this->faker->realText(200).'</p>',
            'body' => '<p>'.$this->faker->realText(2000).'</p>',
            'image' => $this->faker->imageUrl(750, 346, 'cats', false),
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
