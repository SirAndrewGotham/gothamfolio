<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Translation>
 */
class TranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'table_name' => $this->faker->word(),
            'column_name' => $this->faker->word(),
            'foreign_key' => $this->faker->randomNumber(),
            'locale' => $this->faker->languageCode(),
            'value' => $this->faker->sentence(),
        ];
    }
}
