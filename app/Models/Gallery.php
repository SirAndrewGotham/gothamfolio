<?php

namespace App\Models;

use Database\Factories\GalleryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    /** @use HasFactory<GalleryFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

}
