<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Concerns\HasSlug;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $slug
 * @property Carbon $email_verified_at
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $language_id
 * @property-read Language $language
 * @property-read Collection<int, Post> $posts
 * @property-read Collection<int, Work> $works
 * @property-read Collection<int, Language> $languages
 *
 * @mixin Builder
 *
 * @extends Authenticatable<UserFactory>
 */
class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasSlug, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'slug',
        'language_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get all the posts for the User
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get all the works for the User
     */
    public function works(): HasMany
    {
        return $this->hasMany(Work::class);
    }

    /**
     * The languages that belong to the User
     */
    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class);
    }

    /**
     * Get the sluggable field.
     */
    protected static function getSluggableField(): string
    {
        return 'name';
    }
}
