<?php

declare(strict_types=1);

namespace App\Models;

use App\Concerns\HasSlug;
use Database\Factories\LanguageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    /** @use HasFactory<LanguageFactory> */
    use HasFactory, HasSlug, SoftDeletes;

    protected $guarded = ['id'];

    protected static function getSluggableField(): string
    {
        return 'english';
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
