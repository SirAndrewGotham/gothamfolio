<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $label = substr($this->faker->sentence(rand(3, 7)), 0, -1);

        return [
            'label' => $label,
            'description' => '<p>'.$this->faker->text(2000).'</p>',
            'image' => $this->faker->imageUrl(750, 346, 'cats', false),
            'published_at' => now(),
        ];
    }
}
