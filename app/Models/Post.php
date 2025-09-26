<?php

declare(strict_types=1);

namespace App\Models;

use App\Concerns\HasSlug;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory, HasSlug, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
    ];

    protected static function boot(): void
    {
        parent::boot();

        // mmoved to the HasSlug Trait
//        self::creating(function ($model) {
//            $slug = Str::slug($model->title);
//            $originalSlug = $slug;
//            $count = 2;
//            while (static::whereSlug($slug)->exists()) {
//                $slug = $originalSlug.'-'.$count++;
//            }
//            $model->slug = $slug;
//        });
    }

    // This one has moved to the HasSlug trait as well
//    public function getRouteKeyName(): string
//    {
//        return 'slug';
//    }

    public function translations(): HasMany
    {
        return $this->hasMany(PostTranslation::class, 'post_id', 'id');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
