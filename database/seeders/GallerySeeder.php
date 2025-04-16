<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gallery::factory()
            ->has(Image::factory()->count(5))
            ->count(7)
            ->create();

        $galleries = Gallery::where('gallery_id', null)->get();
        foreach($galleries as $gallery)
        {
            Gallery::factory()
                ->count(11)
                ->create([
                    'gallery_id' => $gallery->id,
                ]);

        }
    }
}
