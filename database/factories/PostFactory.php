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
            'title'     => $title,
            'slug'      => Str::slug($title),
        ];
    }
}
