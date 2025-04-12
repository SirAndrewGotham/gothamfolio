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
     * Define the model's default state.
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
            'post_id' => Post::factory(),
            'title'     => $title,
            'slug'      => Str::slug($title),
            'excerpt'   => '<p>'.$this->faker->realText(200).'</p>',
            'body'   => '<p>'.$this->faker->realText(2000).'</p>',
            'image'     => $this->faker->imageUrl(750, 346, 'cats', false),
            'published_at' => now(),
        ];
    }
}
