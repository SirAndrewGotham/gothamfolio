<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Work extends Model
{
    /** @use HasFactory<\Database\Factories\WorkFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
    ];

    protected static function boot(): void
    {
        parent::boot();

        self::creating(function ($model) {
            $slug = Str::slug($model->title);
            $originalSlug = $slug;
            $count = 2;
            while (static::whereSlug($slug)->exists()) {
                $slug = $originalSlug.'-'.$count++;
            }
            $model->slug = $slug;
        });
    }

    protected $casts = [
        'excerpt' => 'string',
        'order' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function translations(): HasMany
    {
        return $this->hasMany(WorkTranslation::class, 'work_id', 'id');
    }
}
