<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    protected $fillable = ['name', 'slug', 'content'];

    public $timestamps = false;

    protected static function boot(): void
    {
        parent::boot();

        self::creating(function ($model) {
            $slug = Str::slug($model->title);
            $originalSlug = $slug;
            $count = 2;
            while (static::whereSlug($slug)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            $model->slug = $slug;
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

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
