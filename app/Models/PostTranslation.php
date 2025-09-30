<?php

declare(strict_types=1);

namespace App\Models;

use App\Concerns\HasSlug;
use App\Enums\PostStatus;
use Database\Factories\PostTranslationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 * @property string $slug
 * @property string $excerpt
 * @property string $body
 * @property int $order
 * @property \App\Enums\PostStatus $status
 * @property \Illuminate\Support\Carbon $published_at
 * @property \Illuminate\Support\Carbon $published_through
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $deleted_at
 * @property int $post_id
 * @property int $language_id
 * @property int $user_id
 * @property-read \App\Models\Post $post
 * @property-read \App\Models\Language $language
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 *
 * @extends \Illuminate\Database\Eloquent\Model<\Database\Factories\PostTranslationFactory>
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
     * Get all of the tags for the PostTranslation
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
