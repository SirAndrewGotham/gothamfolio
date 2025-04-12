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
            'code' => 'ace',
            'regional' => '',
            'script' => 'Latn',
            'dir' => 'ltr',
            'flag' => 'ace.png',
            'name' => 'Aceh',
            'english' => 'Achinese',
            'slug' => 'achinese',
            'is_active' => false,
            'is_available' => true
        ];
    }
}
