<?php

declare(strict_types=1);

namespace App\Models;

use App\Concerns\HasSlug;
use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @property string $name
 * @property string $slug
 * @property string $content
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PostTranslation> $posts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Work> $works
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Image> $images
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 *
 * @extends \Illuminate\Database\Eloquent\Model<\Database\Factories\TagFactory>
 */
class Tag extends Model
{
    /** @use HasFactory<TagFactory> */
    use HasFactory, HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'slug', 'content'];

    public $timestamps = false;

    /**
     * Get the sluggable field.
     */
    protected static function getSluggableField(): string
    {
        return 'name';
    }

    /**
     * The posts that belong to the Tag
     */
    public function posts(): MorphToMany
    {
        return $this->morphedByMany(PostTranslation::class, 'taggable');
    }

    /**
     * The works that belong to the Tag
     */
    public function works(): MorphToMany
    {
        return $this->morphedByMany(Work::class, 'taggable');
    }

    /**
     * The images that belong to the Tag
     */
    public function images(): MorphToMany
    {
        return $this->morphedByMany(Image::class, 'taggable');
    }
}
