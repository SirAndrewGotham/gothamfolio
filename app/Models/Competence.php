<?php

declare(strict_types=1);

namespace App\Models;

use App\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $title
 * @property string $slug
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $deleted_at
 * @property int $user_id
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompetenceTranslation> $translations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 *
 * @extends \Illuminate\Database\Eloquent\Model<\Database\Factories\CompetenceFactory>
 */
class Competence extends Model
{
    /** @use HasFactory<\Database\Factories\CompetenceFactory> */
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
     * Get all of the translations for the Competence
     */
    public function translations(): HasMany
    {
        return $this->hasMany(CompetenceTranslation::class, 'competence_id', 'id');
    }

    /**
     * Get all of the tags for the Competence
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
