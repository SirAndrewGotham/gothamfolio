<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->create([
                'language_id' => 37,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
            ]);
        $user->languages()->sync([37,42,215]);

        User::factory()
            ->count(15)
            ->create();
    }
}
