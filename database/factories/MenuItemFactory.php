<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuItem>
 */
class MenuItemFactory extends Factory
{
    /**
     * Defines default attribute values for a MenuItem model factory.
     *
     * @return array<string, mixed> Associative array with keys:
     *  - 'menu_id' => a Menu factory instance to associate the MenuItem,
     *  - 'title' => a unique word,
     *  - 'slug' => a unique slug,
     *  - 'url' => a generated URL,
     *  - 'target' => the string '_self',
     *  - 'order' => an integer between 1 and 10.
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
