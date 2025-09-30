<?php

declare(strict_types=1);

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

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function translatable()
    {
        return $this->morphTo();
    }

    public function images()
    {
        return $this->morphToMany(Image::class, 'translatable');
    }
}
