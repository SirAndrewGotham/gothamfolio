<?php

declare(strict_types=1);

namespace App\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function (Model $model) {
            if (empty($model->slug)) {
                $slug = Str::slug($model->title);
                $originalSlug = $slug;
                $count = 2;
                while (static::whereSlug($slug)->exists()) {
                    $slug = $originalSlug.'-'.$count++;
                }
                $model->slug = $slug;
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
