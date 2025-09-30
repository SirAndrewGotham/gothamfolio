<?php

namespace Tests\Feature\Concerns\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\Feature\Concerns\Models\TestTranslatableModelFeature;

class TestTranslatableModelFeatureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TestTranslatableModelFeature::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
        ];
    }
}
