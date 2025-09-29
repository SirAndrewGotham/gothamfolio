<?php

namespace Database\Factories;

use App\Models\Translate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Translate>
 */
class TranslateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'language_id' => \App\Models\Language::factory(),
            'translatable_type' => \App\Models\User::class, // Dummy morph type
            'translatable_id' => \App\Models\User::factory(), // Dummy morph ID
        ];
    }
}
