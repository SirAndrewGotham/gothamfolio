<?php

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;

uses(RefreshDatabase::class);

it('removes menu from cache on save', function () {
    Cache::shouldReceive('forget')
        ->once()
        ->with('menu_test-menu'); // For the initial creation

    Cache::shouldReceive('forget')
        ->once()
        ->with('menu_Updated Name'); // For the update

    $menu = Menu::factory()->create(['name' => 'test-menu', 'slug' => 'test-menu-slug']);

    $menu->update(['name' => 'Updated Name']);
});

it('removes menu from cache on delete', function () {
    $menu = Menu::factory()->create(['name' => 'test-menu', 'slug' => 'test-menu-slug']);

    Cache::shouldReceive('forget')
        ->once()
        ->with('menu_test-menu');

    $menu->delete();
});

it('a menu has many items', function () {
    $menu = Menu::factory()->create();
    $menuItem = MenuItem::factory()->create(['menu_id' => $menu->id]);

    expect($menu->items)->toHaveCount(1);
    expect($menu->items->first()->id)->toBe($menuItem->id);
});

it('a menu has many parent items', function () {
    $menu = Menu::factory()->create();
    $parentMenuItem = MenuItem::factory()->create(['menu_id' => $menu->id, 'menu_item_id' => null]);
    $childMenuItem = MenuItem::factory()->create(['menu_id' => $menu->id, 'menu_item_id' => $parentMenuItem->id]);

    expect($menu->parent_items)->toHaveCount(1);
    expect($menu->parent_items->first()->id)->toBe($parentMenuItem->id);
    expect($menu->parent_items->first()->children)->toHaveCount(1);
    expect($menu->parent_items->first()->children->first()->id)->toBe($childMenuItem->id);
});
