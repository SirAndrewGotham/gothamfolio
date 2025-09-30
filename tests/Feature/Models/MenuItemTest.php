<?php

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;

uses(RefreshDatabase::class);

it('removes menu from cache on create', function () {
    $menu = Menu::factory()->create(['name' => 'test-menu', 'slug' => 'test-menu-slug']);

    Cache::shouldReceive('forget')
        ->twice() // Expect twice due to `created` and `saved` events
        ->with('menu_test-menu');

    MenuItem::factory()->create(['menu_id' => $menu->id]);
});

it('removes menu from cache on save', function () {
    $menu = Menu::factory()->create(['name' => 'test-menu', 'slug' => 'test-menu-slug']);
    $menuItem = MenuItem::factory()->create(['menu_id' => $menu->id]);

    Cache::shouldReceive('forget')
        ->once()
        ->with('menu_test-menu');

    $menuItem->update(['title' => 'Updated Title']);
});

it('removes menu from cache on delete', function () {
    $menu = Menu::factory()->create(['name' => 'test-menu', 'slug' => 'test-menu-slug']);
    $menuItem = MenuItem::factory()->create(['menu_id' => $menu->id]);

    Cache::shouldReceive('forget')
        ->once()
        ->with('menu_test-menu');

    $menuItem->delete();
});

it('a menu item has children', function () {
    $menu = Menu::factory()->create();
    $parentMenuItem = MenuItem::factory()->create(['menu_id' => $menu->id, 'menu_item_id' => null]);
    $childMenuItem = MenuItem::factory()->create(['menu_id' => $menu->id, 'menu_item_id' => $parentMenuItem->id]);

    expect($parentMenuItem->children)->toHaveCount(1);
    expect($parentMenuItem->children->first()->id)->toBe($childMenuItem->id);
});

it('a menu item belongs to a menu', function () {
    $menu = Menu::factory()->create();
    $menuItem = MenuItem::factory()->create(['menu_id' => $menu->id]);

    expect($menuItem->menu->id)->toBe($menu->id);
});

it('gets the highest order menu item', function () {
    $menu = Menu::factory()->create();
    MenuItem::factory()->create(['menu_id' => $menu->id, 'menu_item_id' => null, 'order' => 5]);
    MenuItem::factory()->create(['menu_id' => $menu->id, 'menu_item_id' => null, 'order' => 10]);

    $menuItem = new MenuItem;
    expect($menuItem->highestOrderMenuItem(null))->toBe(11);
});

it('resolves a route link', function () {
    // Test uses a mocked URL generator to ensure link generation works correctly.
    $mockUrlGenerator = Mockery::mock(Illuminate\Routing\UrlGenerator::class);

    $menu = Menu::factory()->create();
    $routeMenuItem = MenuItem::factory()->create(['menu_id' => $menu->id, 'route' => 'dashboard', 'url' => null, 'parameters' => json_encode([])]);

    $this->app->instance('url', $mockUrlGenerator);

    $mockUrlGenerator->shouldReceive('route')
        ->once()
        ->with('dashboard', [], false)
        ->andReturn('/dashboard');

    expect($routeMenuItem->link())->toBe('/dashboard');
});

it('resolves a URL link', function () {
    $menu = Menu::factory()->create();
    $urlMenuItem = MenuItem::factory()->create(['menu_id' => $menu->id, 'route' => null, 'url' => '/custom-url']);

    expect($urlMenuItem->link())->toBe('/custom-url');
});

it('gets and sets parameters attribute', function () {
    $menuItem = new MenuItem;
    $parameters = ['param1' => 'value1', 'param2' => 'value2'];
    $menuItem->setParametersAttribute($parameters);

    expect($menuItem->getParametersAttribute())->toEqual($parameters);
});

it('sets url attribute to empty string if null', function () {
    $menuItem = new MenuItem;
    $menuItem->url = null;

    expect($menuItem->url)->toBe('');
});
