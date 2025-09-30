<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Language>
 */
class LanguageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'default' => false,
            'fallback' => false,
            'code' => fake()->unique()->countryCode(),
            'regional' => '',
            'script' => 'Latn',
            'dir' => 'ltr',
            'flag' => 'ace.png',
            'name' => $this->faker->unique()->word(),
            'english' => $this->faker->unique()->word().' Language',
            'slug' => $this->faker->unique()->slug(),
            'is_active' => true,
            'is_available' => true,
        ];
    }
}
