<?php

declare(strict_types=1);

namespace App\Models;

use App\Concerns\HasSlug;
use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    /** @use HasFactory<TagFactory> */
    use HasFactory, HasSlug;

    protected $fillable = ['name', 'slug', 'content'];

    public $timestamps = false;

    protected static function getSluggableField(): string
    {
        return 'name';
    }

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(PostTranslation::class, 'taggable');
    }

    public function works(): MorphToMany
    {
        return $this->morphedByMany(Work::class, 'taggable');
    }

    public function images(): MorphToMany
    {
        return $this->morphedByMany(Image::class, 'taggable');
    }
}
