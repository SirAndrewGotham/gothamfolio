<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuItem>
 */
class MenuItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'menu_id' => \App\Models\Menu::factory(),
            'title' => $this->faker->unique()->word(),
            'slug' => $this->faker->unique()->slug(),
            'url' => $this->faker->url(),
            'target' => '_self',
            'order' => $this->faker->numberBetween(1, 10),
        ];
    }
}
