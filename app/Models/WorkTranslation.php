<?php

namespace App\Models;

use App\Concerns\HasSlug;
use App\Enums\WorkStatus;
use Database\Factories\WorkTranslationFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property string $name
 * @property string $slug
 * @property string $excerpt
 * @property string $body
 * @property int $order
 * @property WorkStatus $status
 * @property Carbon $published_at
 * @property Carbon $published_through
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property int $work_id
 * @property int $language_id
 * @property int $user_id
 * @property-read Language $language
 * @property-read User $user
 * @property-read Work $work
 * @property-read Collection<int, Tag> $tags
 *
 * @mixin Builder
 *
 * @extends Model<WorkTranslationFactory>
 */
class WorkTranslation extends Model
{
    /** @use HasFactory<WorkTranslationFactory> */
    use HasFactory, HasSlug, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = ['id'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
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

    /**
     * Get all the tags for the WorkTranslation
     *
     * @return MorphToMany<Tag>
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Get the user that owns the WorkTranslation
     *
     * @return BelongsTo<User>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the work that owns the WorkTranslation
     *
     * @return BelongsTo<Work>
     */
    public function work(): BelongsTo
    {
        return $this->belongsTo(Work::class);
    }

    /**
     * Get the language that owns the WorkTranslation
     *
     * @return BelongsTo<Language>
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
