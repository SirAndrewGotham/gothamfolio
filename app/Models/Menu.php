<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\MenuFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

/**
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection<int, MenuItem> $items
 * @property-read Collection<int, MenuItem> $parent_items
 *
 * @mixin Builder
 *
 * @extends Model<MenuFactory>
 */
class Menu extends Model
{
    /** @use HasFactory<MenuFactory> */
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menus';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = [];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        static::saved(function ($model) {
            $model->removeMenuFromCache();
        });

        static::deleted(function ($model) {
            $model->removeMenuFromCache();
        });
    }

    /**
     * Get all the items for the Menu
     *
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }

    /**
     * Get all the parent_items for the Menu
     *
     * @return HasMany
     */
    public function parent_items(): HasMany
    {
        return $this->hasMany(MenuItem::class)
            ->whereNull('menu_item_id');
    }

    /**
     * Display menu.
     *
     * @param  string  $menuName
     * @param  string|null  $type
     * @return string
     */
    public static function display(string $menuName, string $type = null, array $options = []): HtmlString|false|string|\Illuminate\Support\Collection
    {
        // GET THE MENU - sort collection in blade
        $menu = \Cache::remember('menu_'.$menuName, \Carbon\Carbon::now()->addDays(30), function () use ($menuName) {
            return static::where('name', '=', $menuName)
                ->with(['parent_items.children' => function ($q) {
                    $q->orderBy('order');
                }])
                ->first();
        });

        // Check for Menu Existence
        if (! isset($menu)) {
            return false;
        }

        //        event(new MenuDisplay($menu));

        // Convert options array into object
        $options = (object) $options;

        $items = $menu->parent_items->sortBy('order');

        if ($menuName == 'admin' && $type == '_json') {
            $items = static::processItems($items);
        }

        if ($type == 'admin') {
            $type = 'menu.'.$type;
        } else {
            if (is_null($type)) {
                $type = 'menu.default';
            } elseif ($type == 'bootstrap' && ! view()->exists($type)) {
                $type = 'menu.bootstrap';
            }
        }

        if (! isset($options->locale)) {
            $options->locale = app()->getLocale();
        }

        if ($type === '_json') {
            return $items;
        }

        return new HtmlString(
            View::make($type, ['items' => $items, 'options' => $options])->render()
        );
    }

    /**
     * Remove the menu from cache.
     */
    public function removeMenuFromCache(): void
    {
        \Cache::forget('menu_'.$this->name);
    }

    /**
     * Process the menu items.
     *
     * @param  \Illuminate\Support\Collection<int, MenuItem>  $items
     * @return \Illuminate\Support\Collection<int, MenuItem>
     */
    protected static function processItems(\Illuminate\Support\Collection $items): \Illuminate\Support\Collection
    {
        // Eager load Translations
        if (config('gothamfolio.multilingual.enabled')) {
            $items->load('translations');
        }

        $items = $items->transform(function ($item) {
            // Translate title
            $item->title = $item->getTranslatedAttribute('title');
            // Resolve URL/Route
            $item->href = $item->link(true);

            if ($item->href == url()->current() && $item->href != '') {
                // The current URL is exactly the URL of the menu-item
                $item->active = true;
            } elseif (Str::startsWith(url()->current(), Str::finish($item->href, '/'))) {
                // The current URL is "below" the menu-item URL. For example "admin/posts/1/edit" => "admin/posts"
                $item->active = true;
            }
            if (($item->href == url('') || $item->href == route('dashboard')) && $item->children->count() > 0) {
                // Exclude sub-menus
                $item->active = false;
            } elseif ($item->href == route('dashboard') && url()->current() != route('dashboard')) {
                // Exclude dashboard
                $item->active = false;
            }

            if ($item->children->count() > 0) {
                $item->setRelation('children', static::processItems($item->children));

                if (! $item->children->where('active', true)->isEmpty()) {
                    $item->active = true;
                }
            }

            return $item;
        });

        // Filter items by permission
        $items = $items->filter(function ($item) {
            return ! $item->children->isEmpty() || Auth::user()->can('browse', $item);
        })->filter(function ($item) {
            // Filter out empty menu-items
            if ($item->url == '' && $item->route == '' && $item->children->count() == 0) {
                return false;
            }

            return true;
        });

        return $items->values();
    }
}
