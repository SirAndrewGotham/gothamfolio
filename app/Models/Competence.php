<?php

declare(strict_types=1);

namespace App\Models;

use App\Concerns\HasSlug;
use Database\Factories\CompetenceFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property string $title
 * @property string $slug
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property int $user_id
 * @property-read User $user
 * @property-read Collection<int, CompetenceTranslation> $translations
 * @property-read Collection<int, Tag> $tags
 *
 * @mixin Builder
 *
 * @extends Model<CompetenceFactory>
 */
class Competence extends Model
{
    /** @use HasFactory<CompetenceFactory> */
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
     * Get all the translations for the Competence
     */
    public function translations(): HasMany
    {
        return $this->hasMany(CompetenceTranslation::class, 'competence_id', 'id');
    }

    /**
     * Get all the tags for the Competence
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Get the user that owns the Competence
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
