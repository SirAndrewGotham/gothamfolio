<?php

declare(strict_types=1);

namespace App\Models;

use App\Concerns\HasSlug;
use Database\Factories\PostFactory;
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
 * @property-read Collection<int, PostTranslation> $translations
 * @property-read Collection<int, Tag> $tags
 *
 * @mixin Builder
 *
 * @extends Model<PostFactory>
 */
class Post extends Model
{
    /** @use HasFactory<PostFactory> */
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
     * Get all the translations for the Post
     */
    public function translations(): HasMany
    {
        return $this->hasMany(PostTranslation::class, 'post_id', 'id');
    }

    /**
     * Get all the tags for the Post
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Get the user that owns the Post
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
