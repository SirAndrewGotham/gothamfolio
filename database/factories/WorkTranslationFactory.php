<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\User;
use App\Models\Work;
use App\Models\WorkTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WorkTranslation>
 */
class WorkTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $languages = Language::all();

        return [
            'language_id' => Language::factory()->recycle($languages),
            'user_id' => User::factory(),
            'work_id' => Work::factory(),
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'excerpt' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl,
            'link' => $this->faker->url,
            'published_at' => null,
            'published_through' => null,
            'order' => 0,
            'status' => 'Published', // ['Published', 'Draft', 'Pending', 'Rejected'])->default('Published')
            'status_by' => User::factory(),
            'status_note' => null,
            'views' => 0,
        ];
    }
}
