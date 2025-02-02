<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    /** @use HasFactory<\Database\Factories\WorkFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
