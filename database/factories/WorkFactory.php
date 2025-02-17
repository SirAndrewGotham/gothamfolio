<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Work>
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
//        $languages = Language::where('is_active', true)->pluck('id')->toArray();
        $title = substr($this->faker->sentence(rand(3, 7)), 0, -1);
        $users = User::all();

        return [
//            'language_id' => $this->faker->randomElement($languages),
            'user_id' => $this->faker->randomElement($users),
            'title'     => $title,
            'slug'      => Str::slug($title),
//            'excerpt'   => '<p>'.$this->faker->text(200).'</p>',
//            'body'   => '<p>'.$this->faker->text(2000).'</p>',
//            'image'     => $this->faker->imageUrl(750, 346, 'cats', false),
//            'link'      => 'https://esperantejo.com',
//            'order'     => $this->faker->randomDigit(),
//            'published_at' => $this->faker->dateTimeBetween('-1 year', '+3 days'),
        ];
    }
}
