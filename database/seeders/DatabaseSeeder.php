<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LanguageSeeder::class);

//        $user = User::factory()
//            ->create([
//                'language_id' => 37,
//                'name' => 'Andrew Gotham',
//                'slug' => 'andrew-gotham',
//                'email' => 'andreogotema@gmail.com',
//                'password' => Hash::make('password'),
//            ]);

        $this->call([
            UserSeeder::class,
            PostSeeder::class,
            WorkSeeder::class,
            CustomerSeeder::class,
            TagSeeder::class,
            GallerySeeder::class,
            ImageSeeder::class,
            FeedbackSeeder::class,
        ]);
    }
}
