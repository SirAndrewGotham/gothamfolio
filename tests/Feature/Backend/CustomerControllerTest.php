<?php

use App\Models\Customer;
use App\Models\Language;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function () {
    Language::factory()->create(['code' => 'en', 'name' => 'English', 'default' => true, 'is_active' => true]);
    Storage::fake('public');

    Route::middleware(['web', 'auth'])
        ->prefix('admin')
        ->name('admin.')
        ->group(base_path('routes/admin.php'));
});

test('customers index page can be rendered for authenticated user', function () {
    $user = User::factory()->create();

    actingAs($user)->get(route('admin.customers.index'))
        ->assertOk()
        ->assertSee('Customers'); // Assuming 'Customers' is present on the customers index page
});

test('customer create page can be rendered for authenticated user', function () {
    $user = User::factory()->create();

    actingAs($user)->get(route('admin.customers.create'))
        ->assertOk()
        ->assertSee('Create a Customer'); // Corrected assertion text
});

test('customer can be stored by authenticated user', function () {
    $user = User::factory()->create();

    actingAs($user)->post(route('admin.customers.store'), [
        'label' => 'Test Customer',
        'description' => 'Test description',
    ])
        ->assertRedirect(route('admin.customers.index'));

    $this->assertDatabaseHas('customers', [
        'label' => 'Test Customer',
        'description' => 'Test description',
    ]);
});

test('customer store fails with invalid data', function () {
    $user = User::factory()->create();

    actingAs($user)->post(route('admin.customers.store'), [
        'label' => '',
        'description' => '',
    ])
        ->assertSessionHasErrors([
            'label',
            'description',
        ]);
});

test('single customer can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    $customer = Customer::factory()->create();

    actingAs($user)->get(route('admin.customers.show', $customer))
        ->assertOk()
        ->assertSee($customer->label); // Assuming customer label is shown on show page
});

test('customer edit page can be rendered for authenticated user', function () {
    $user = User::factory()->create();
    $customer = Customer::factory()->create();

    actingAs($user)->get(route('admin.customers.edit', $customer))
        ->assertOk()
        ->assertSee('Edit Customer') // Assuming 'Edit Customer' is present on the edit customer page
        ->assertSee($customer->label); // Assuming customer label is shown on edit page
});

test('customer can be updated by authenticated user', function () {
    $user = User::factory()->create();
    $customer = Customer::factory()->create();

    $updatedLabel = 'Updated Customer Label';
    $updatedDescription = 'Updated description';

    actingAs($user)->put(route('admin.customers.update', $customer), [
        'label' => $updatedLabel,
        'description' => $updatedDescription,
    ])
        ->assertRedirect(route('admin.customers.index'));

    $this->assertDatabaseHas('customers', [
        'id' => $customer->id,
        'label' => $updatedLabel,
        'description' => $updatedDescription,
    ]);
});

test('customer update fails with invalid data', function () {
    $user = User::factory()->create();
    $customer = Customer::factory()->create();

    actingAs($user)->put(route('admin.customers.update', $customer), [
        'label' => '',
        'description' => '',
    ])
        ->assertSessionHasErrors([
            'label',
            'description',
        ]);
});

test('customer can be soft deleted by authenticated user', function () {
    $user = User::factory()->create();
    $customer = Customer::factory()->create();

    actingAs($user)->delete(route('admin.customers.destroy', $customer))
        ->assertRedirect(route('admin.customers.index'));

    $this->assertSoftDeleted('customers', [
        'id' => $customer->id,
    ]);
});
