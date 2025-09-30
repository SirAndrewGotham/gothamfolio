<?php

declare(strict_types=1);

namespace App\Models;

use App\Concerns\HasSlug;
use Database\Factories\LanguageFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property string $name
 * @property string $slug
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 * @property-read Collection<int, User> $users
 *
 * @mixin Builder
 *
 * @extends Model<LanguageFactory>
 */
class Language extends Model
{
    /** @use HasFactory<LanguageFactory> */
    use HasFactory, HasSlug, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = ['id'];

    /**
     * Get the sluggable field.
     */
    protected static function getSluggableField(): string
    {
        return 'english';
    }

    /**
     * The users that belong to the Language
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
