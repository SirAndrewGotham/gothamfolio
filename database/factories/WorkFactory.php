<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Work>
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
            'user_id' => User::factory(),
            'title'     => $title,
            'slug'      => Str::slug($title),
        ];
    }
}
