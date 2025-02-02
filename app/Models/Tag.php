<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    protected $fillable = ['name', 'slug', 'content'];

    public $timestamps = false;

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    public function works()
    {
        return $this->morphedByMany(Work::class, 'taggable');
    }

    public function images()
    {
        return $this->morphedByMany(Image::class, 'taggable');
    }
}
