<?php

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can be soft deleted', function () {
    $customer = Customer::factory()->create();
    $customer->delete();

    // Assert that the customer is not found in regular queries
    expect(Customer::find($customer->id))->toBeNull();

    // Assert that the customer is found when using withTrashed()
    $softDeletedCustomer = Customer::withTrashed()->find($customer->id);
    expect($softDeletedCustomer)->not->toBeNull();
    expect($softDeletedCustomer->deleted_at)->not->toBeNull();
});

it('has guarded attributes', function () {
    $customer = new Customer;
    expect($customer->getGuarded())->toEqual([
        'id',
    ]);
});
