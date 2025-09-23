<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\FeedbackFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    /** @use HasFactory<FeedbackFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'language_id',
        'user_id',
        'name',
        'email',
        'message',
        'read',
    ];
}
