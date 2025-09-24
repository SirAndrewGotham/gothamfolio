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
            'is_cover' => $this->faker->randomElement([true, false]),
            'image' => $this->faker->imageUrl(750, 346, 'cats', false),
            'caption' => $this->faker->paragraph,
            'description' => '<p>'.$this->faker->text(2000).'</p>',
            'published_at' => $this->faker->dateTimeBetween('-20 days', now()),
            'published_through' => $this->faker->dateTimeBetween(now(), '+20 days'),
            'order' => $this->faker->randomDigit(),
            'status' => $this->faker->randomElement(['Published', 'Draft', 'Pending', 'Rejected']),
        ];
    }
}
