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
                $slug = Str::slug($model->{static::getSluggableField()});
                $originalSlug = $slug;
                $suffix = 1;

                if (static::whereSlug($originalSlug)->exists()) {
                    $suffix = 2; // Start suffix from 2 if original exists
                    $slug = $originalSlug.'-'.$suffix;
                    while (static::whereSlug($slug)->exists()) {
                        $suffix++;
                        $slug = $originalSlug.'-'.$suffix;
                    }
                }
                $model->slug = $slug;
            }
        });

        static::updating(function (Model $model) {
            if ($model->isDirty(static::getSluggableField()) && empty($model->slug)) {
                $slug = Str::slug($model->{static::getSluggableField()});
                $originalSlug = $slug;
                $suffix = 1;

                if (static::where('id', '!=', $model->id)->where('slug', $originalSlug)->exists()) {
                    $suffix = 2;
                    $slug = $originalSlug.'-'.$suffix;
                    while (static::where('id', '!=', $model->id)->where('slug', $slug)->exists()) {
                        $suffix++;
                        $slug = $originalSlug.'-'.$suffix;
                    }
                }
                $model->slug = $slug;
            }
        });
    }

    protected static function getSluggableField(): string
    {
        return 'title';
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
