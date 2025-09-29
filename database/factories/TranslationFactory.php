<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Translation>
 */
class TranslationFactory extends Factory
{
    /**
     * Provide default attribute values for the Translation model factory.
     *
     * Returns an associative array of model attributes mapped to fake values:
     * - `table_name`: table identifier as a word string
     * - `column_name`: column identifier as a word string
     * - `foreign_key`: numeric foreign key
     * - `locale`: language code
     * - `value`: translated text sentence
     *
     * @return array<string,mixed>
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
