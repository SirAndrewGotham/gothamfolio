<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Work>
 */
class WorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = substr($this->faker->sentence(rand(3, 7)), 0, -1);

        return [
            'title'     => $title,
            'slug'      => Str::slug($title),
            'excerpt'   => '<p>'.$this->faker->text(200).'</p>',
            'content'   => '<p>'.$this->faker->text(2000).'</p>',
            'image'     => $this->faker->imageUrl(750, 346, 'cats', false),
            'link'      => 'https://esperantejo.com',
        ];
    }
}
