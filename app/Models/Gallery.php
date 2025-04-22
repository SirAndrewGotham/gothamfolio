<?php

namespace App\Models;

use Database\Factories\GalleryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Gallery extends Model
{
    /** @use HasFactory<GalleryFactory> */
    use HasFactory, SoftDeletes;

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

    protected $guarded = ['id'];

    public function tags(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function galleries(): BelongsTo
    {
        return $this->belongsTo(Gallery::class, 'gallery_id', 'id');
    }
}
