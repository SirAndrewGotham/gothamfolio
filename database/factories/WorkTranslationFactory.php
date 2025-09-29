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
     * Provide the default attribute values for a WorkTranslation model created by the factory.
     *
     * The returned array contains keys used to populate a WorkTranslation: `language_id` chosen by recycling existing Language records, `user_id`, `work_id`, and `status_by` created via factories, text fields (`title`, `slug`, `excerpt`, `body`), media/links (`image`, `link`), publication timestamps (`published_at`, `published_through`), `status` set to "Published", an optional `status_note`, and numeric `views`.
     *
     * @return array<string, mixed> Associative array of model attributes and their default values.
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
            'status' => 'Published', // ['Published', 'Draft', 'Pending', 'Rejected'])->default('Published')
            'status_by' => User::factory(),
            'status_note' => null,
            'views' => 0,
        ];
    }
}
