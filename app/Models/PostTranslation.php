<?php

declare(strict_types=1);

namespace App\Models;

use App\Concerns\HasSlug;
use App\Enums\PostStatus;
use Database\Factories\PostTranslationFactory;
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
 * @property PostStatus $status
 * @property Carbon $published_at
 * @property Carbon $published_through
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property int $post_id
 * @property int $language_id
 * @property int $user_id
 * @property-read Post $post
 * @property-read Language $language
 * @property-read User $user
 * @property-read Collection<int, Tag> $tags
 *
 * @mixin Builder
 *
 * @extends Model<PostTranslationFactory>
 */
class PostTranslation extends Model
{
    /** @use HasFactory<PostTranslationFactory> */
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
            'status' => PostStatus::class,
            'published_at' => 'datetime',
            'published_through' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    /**
     * Get the post that owns the PostTranslation
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id', 'post_translations');
    }

    /**
     * Get all the tags for the PostTranslation
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Get the user that owns the PostTranslation
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the language that owns the PostTranslation
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
