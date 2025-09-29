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
     * Provide default attributes for creating a Translate model instance.
     *
     * The returned array sets:
     * - `language_id` to a Language factory instance for the related language.
     * - `translatable_type` to `\App\Models\User::class` as a dummy morph type.
     * - `translatable_id` to a User factory instance as a dummy morphable ID.
     *
     * @return array<string, mixed> The attribute array suitable for creating a Translate model.
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
