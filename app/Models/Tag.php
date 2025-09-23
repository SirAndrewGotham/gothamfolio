<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Tag extends Model
{
    /** @use HasFactory<TagFactory> */
    use HasFactory;

    protected $fillable = ['name', 'slug', 'content'];

    public $timestamps = false;

    protected static function boot(): void
    {
        parent::boot();

        self::creating(function ($model) {
            $slug = Str::slug($model->name);
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

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(PostTranslation::class, 'taggable');
    }

    public function works(): MorphToMany
    {
        return $this->morphedByMany(Work::class, 'taggable');
    }

    public function images(): MorphToMany
    {
        return $this->morphedByMany(Image::class, 'taggable');
    }
}
