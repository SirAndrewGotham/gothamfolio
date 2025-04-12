<?php

namespace Database\Factories;

use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $galleries = Gallery::pluck('id')->toArray();
        return [
            'gallery_id' => $this->faker->randomElement($galleries),
            'image' => $this->faker->imageUrl(750, 346, 'cats', false),
            'caption' => $this->faker->paragraph,
            'description' => '<p>'.$this->faker->text(2000).'</p>',
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
