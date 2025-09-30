<?php

declare(strict_types=1);

namespace App\Models;

use App\Concerns\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $title
 * @property string $route
 * @property string $url
 * @property string $parameters
 * @property int $order
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property int $menu_id
 * @property int $menu_item_id
 * @property-read \App\Models\Menu $menu
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MenuItem> $children
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class MenuItem extends Model
{
    /** @use HasFactory<\Database\Factories\MenuItemFactory> */
    use HasFactory, Translatable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu_items';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be translated.
     *
     * @var array<int, string>
     */
    protected $translatable = ['title'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->menu->removeMenuFromCache();
        });

        static::saved(function ($model) {
            $model->menu->removeMenuFromCache();
        });

        static::deleted(function ($model) {
            $model->menu->removeMenuFromCache();
        });
    }

    /**
     * Get all of the children for the MenuItem
     *
     * @return \\Illuminate\\Database\\Eloquent\\Relations\\HasMany
     */
    public function children()
    {
        return $this->hasMany(MenuItem::class, 'menu_item_id')
            ->with('children');
    }

    /**
     * Get the menu that owns the MenuItem
     *
     * @return \\Illuminate\\Database\\Eloquent\\Relations\\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Get the link for the menu item.
     *
     * @param  bool  $absolute
     * @return string
     */
    public function link($absolute = false)
    {
        return $this->prepareLink($absolute, $this->route, $this->parameters, $this->url);
    }

    /**
     * Get the translator link for the menu item.
     *
     * @param  mixed  $translator
     * @param  bool  $absolute
     * @return string
     */
    public function translatorLink($translator, $absolute = false)
    {
        return $this->prepareLink($absolute, $translator->route, $translator->parameters, $translator->url);
    }

    /**
     * Prepare the link for the menu item.
     *
     * @param  bool  $absolute
     * @param  string|null  $route
     * @param  array|string|object|null  $parameters
     * @param  string|null  $url
     * @return string
     */
    protected function prepareLink($absolute, $route, $parameters, $url)
    {
        if (is_null($parameters)) {
            $parameters = [];
        }

        if (is_string($parameters)) {
            $parameters = json_decode($parameters, true);
        } elseif (is_object($parameters)) {
            $parameters = json_decode(json_encode($parameters), true);
        }

        if (! is_null($route)) {
            if (! \Illuminate\Support\Facades\Route::has($route)) {
                return '#';
            }

            return route($route, $parameters, $absolute);
        }

        if ($absolute) {
            return url($url);
        }

        return $url;
    }

    /**
     * Get the parameters attribute.
     *
     * @return array<string, mixed>
     */
    public function getParametersAttribute()
    {
        return json_decode($this->attributes['parameters'] ?? '', true);
    }

    /**
     * Set the parameters attribute.
     *
     * @param  array<string, mixed>|string  $value
     */
    public function setParametersAttribute($value)
    {
        if (is_array($value)) {
            $value = json_encode($value);
        }

        $this->attributes['parameters'] = $value;
    }

    /**
     * Set the url attribute.
     *
     * @param  string|null  $value
     */
    public function setUrlAttribute($value)
    {
        if (is_null($value)) {
            $value = '';
        }

        $this->attributes['url'] = $value;
    }

    /**
     * Return the Highest Order Menu Item.
     *
     * @param  number  $parent  (Optional) Parent id. Default null
     * @return number Order number
     */
    public function highestOrderMenuItem($parent = null)
    {
        $order = 1;

        $item = $this->where('menu_item_id', '=', $parent)
            ->orderBy('order', 'DESC')
            ->first();

        if (! is_null($item)) {
            $order = intval($item->order) + 1;
        }

        return $order;
    }
}
