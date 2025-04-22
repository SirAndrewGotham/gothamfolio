<?php

namespace Database\Factories;

use App\Models\Gallery;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Gallery>
 */
class GalleryFactory extends Factory
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
            'gallery_id' => null,
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => '<p>'.$this->faker->text(2000).'</p>',
            'cover' => $this->faker->imageUrl,
            'published_at' => $this->faker->dateTimeBetween('-20 days', now()),
            'published_through' => $this->faker->dateTimeBetween(now(), '+20 days'),
            'order' => $this->faker->randomDigit(),
            'status' => $this->faker->randomElement(['Published', 'Draft', 'Pending', 'Rejected']),
        ];
    }
}
