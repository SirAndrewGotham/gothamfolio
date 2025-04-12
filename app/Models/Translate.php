<?php

namespace App\Models;

use Database\Factories\TranslateFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Translate extends Model
{
    /** @use HasFactory<TranslateFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function images()
    {
        return $this->morphedByMany(Image::class, 'taggable');
    }
}
