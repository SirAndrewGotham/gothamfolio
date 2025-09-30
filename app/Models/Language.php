<?php

declare(strict_types=1);

namespace App\Models;

use App\Concerns\HasSlug;
use Database\Factories\LanguageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 *
 * @extends \Illuminate\Database\Eloquent\Model<\Database\Factories\LanguageFactory>
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
