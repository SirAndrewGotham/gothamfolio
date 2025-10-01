<?php

declare(strict_types=1);

namespace App\Models;

use App\Concerns\HasSlug;
use Database\Factories\WorkFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * @property string $title
 * @property string $slug
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property int $user_id
 * @property-read User $user
 * @property-read Collection<int, WorkTranslation> $translations
 * @property-read Collection<int, Tag> $tags
 *
 * @mixin Builder
 *
 * @extends Model<WorkFactory>
 */
class Work extends Model
{
    /** @use HasFactory<WorkFactory> */
    use HasFactory, HasSlug, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
    ];

    /**
     * Get all the tags for the Work
     *
     * @return MorphToMany<Tag>
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Get the user that owns the Work
     *
     * @return BelongsTo<User>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all the translations for the Work
     *
     * @return HasMany<WorkTranslation>
     */
    public function translations(): HasMany
    {
        return $this->hasMany(WorkTranslation::class, 'work_id', 'id');
    }

    /**
     * Delete the model from the database.
     */
    public function delete(): ?bool
    {
        return DB::transaction(function () {
            $this->translations()->delete();

            return parent::delete();
        });
    }

    public function forceDelete(): bool
    {
        return DB::transaction(function (): bool {
            $this->translations()->withTrashed()->forceDelete();

            return parent::forceDelete();
        });
    }

    public function restore(): bool
    {
        return DB::transaction(function (): bool {
            $restored = parent::restore();
            if ($restored) {
                $this->translations()->withTrashed()->restore();
            }

            return $restored;
        });
    }
}
