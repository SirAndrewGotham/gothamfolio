<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\CompetenceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CompetenceTranslation extends Model
{
    /** @use HasFactory<\Database\Factories\CompetenceTranslationFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected $casts = [
        'excerpt' => 'string',
        'body' => 'string',
        'order' => 'integer',
        'status' => CompetenceStatus::class,
        'published_at' => 'datetime',
        'published_through' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected function casts(): array
    {
        return [
            'excerpt' => 'string',
            'body' => 'string',
            'order' => 'integer',
            'status' => CompetenceStatus::class,
            'published_at' => 'datetime',
            'published_through' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    public function competence(): BelongsTo
    {
        return $this->belongsTo(Competence::class, 'competence_id', 'id', 'competence_translations');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
