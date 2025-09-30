<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\TranslateFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property string $name
 * @property string $key
 * @property string $value
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property int $language_id
 * @property-read Language $language
 * @property-read Model $translatable
 * @property-read Collection<int, Image> $images
 *
 * @mixin Builder
 *
 * @extends Model<TranslateFactory>
 */
class Translate extends Model
{
    /** @use HasFactory<TranslateFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = ['id'];

    /**
     * Get the language that owns the Translate
     *
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * Get the parent translatable model.
     *
     * @return MorphTo
     */
    public function translatable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get all the images for the Translate
     *
     * @return MorphToMany
     */
    public function images(): MorphToMany
    {
        return $this->morphToMany(Image::class, 'translatable');
    }
}
