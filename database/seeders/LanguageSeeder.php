<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('seeders/json/languages.json'));
        $languages = collect(json_decode($json));

        $languages->each(function ($language) {
            Language::create([
                'default' => $language->default,
                'fallback' => $language->fallback,
                'code' => $language->code,
                'regional' => $language->regional,
                'script' => $language->script,
                'dir' => $language->dir,
                'flag' => $language->flag,
                'name' => $language->name,
                'english' => $language->english,
                'slug' => $language->slug,
                'is_active' => $language->is_active,
                'is_available' => $language->is_available,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}
