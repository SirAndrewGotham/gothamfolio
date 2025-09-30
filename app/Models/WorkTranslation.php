<?php

namespace App\Models;

use App\Concerns\HasSlug;
use App\Enums\WorkStatus;
use Database\Factories\WorkTranslationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkTranslation extends Model
{
    /** @use HasFactory<WorkTranslationFactory> */
    use HasFactory, HasSlug, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'excerpt' => 'string',
        'body' => 'string',
        'order' => 'integer',
        'status' => WorkStatus::class,
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
            'status' => WorkStatus::class,
            'published_at' => 'datetime',
            'published_through' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function work(): BelongsTo
    {
        return $this->belongsTo(Work::class, 'work_id', 'id', 'work_translations');
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
