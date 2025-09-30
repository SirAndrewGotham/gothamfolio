<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\TranslationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    /** @use HasFactory<TranslationFactory> */
    use HasFactory;

    protected $table = 'translations';

    protected $fillable = ['table_name', 'column_name', 'foreign_key', 'locale', 'value'];
}
