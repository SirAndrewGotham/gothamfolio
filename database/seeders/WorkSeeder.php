<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Work;
use App\Models\WorkTranslation;
use Database\Factories\WorkTranslationFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Work::factory()
//            ->has(WorkTranslation::factory())
            ->count(24)
            ->create();
    }
}
