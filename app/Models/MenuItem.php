<?php

declare(strict_types=1);

namespace App\Models;

use App\Concerns\Translatable;
use Database\Factories\MenuItemFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

/**
 * @property string $title
 * @property string $route
 * @property string $url
 * @property string $parameters
 * @property int $order
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $menu_id
 * @property int $menu_item_id
 * @property-read Menu $menu
 * @property-read Collection<int, MenuItem> $children
 *
 * @mixin Builder
 */
class MenuItem extends Model
{
    /** @use HasFactory<MenuItemFactory> */
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
    protected array $translatable = ['title'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        static::created(function ($model) {
            $model->menu?->removeMenuFromCache();
        });

        static::saved(function ($model) {
            $model->menu?->removeMenuFromCache();
        });

        static::deleted(function ($model) {
            $model->menu?->removeMenuFromCache();
        });
    }

    /**
     * Get all the children for the MenuItem
     *
     * @return Builder|HasMany \Illuminate\\Database\\Eloquent\\Relations\\HasMany
     */
    public function children(): Builder|HasMany
    {
        return $this->hasMany(MenuItem::class, 'menu_item_id')
            ->with('children');
    }

    /**
     * Get the menu that owns the MenuItem
     *
     * @return BelongsTo \Illuminate\\Database\\Eloquent\\Relations\\BelongsTo
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Get the link for the menu item.
     *
     * @param  bool  $absolute
     * @return string|null
     */
    public function link(bool $absolute = false): ?string
    {
        return $this->prepareLink($absolute, $this->route, $this->parameters, $this->url);
    }

    /**
     * Get the translator link for the menu item.
     *
     * @param  mixed  $translator
     * @param  bool  $absolute
     * @return string|null
     */
    public function translatorLink(mixed $translator, bool $absolute = false): ?string
    {
        return $this->prepareLink($absolute, $translator->route, $translator->parameters, $translator->url);
    }

    /**
     * Prepare the link for the menu item.
     *
     * @param  bool  $absolute
     * @param  string|null  $route
     * @param  object|array|string|null  $parameters
     * @param  string|null  $url
     * @return string|null
     */
    protected function prepareLink(bool $absolute, ?string $route, object|array|string|null $parameters, ?string $url): ?string
    {
        if (is_null($parameters)) {
            $parameters = [];
        }

        if (is_string($parameters)) {
            $parameters = json_decode($parameters, true);
        } elseif (is_object($parameters)) {
            $parameters = (array) $parameters;
        }

        if (! is_null($route)) {
            if (! Route::has($route)) {
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
    public function getParametersAttribute(): mixed
    {
        return json_decode($this->attributes['parameters'] ?? '', true);
    }

    /**
     * Set the parameters attribute.
     *
     * @param  string|array<string, mixed>  $value
     */
    public function setParametersAttribute(array|string $value): void
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
    public function setUrlAttribute(?string $value): void
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
    public function highestOrderMenuItem($parent = null): int
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
