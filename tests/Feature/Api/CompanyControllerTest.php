<?php

use App\Models\Company;

use function Pest\Laravel\{actingAs, getJson, postJson, deleteJson};

test('companies index', function () {
    $companies = Company::factory()->times(3)->create();

    $response = getJson(route('companies.index'));

    $response
        ->assertOk()
        ->assertJson(['data' => $companies->toArray()]);
})->group('companies');

test('show company', function () {
    $company = Company::factory()->create();

    $response = getJson(route('companies.show', $company));

    $response
        ->assertOk()
        ->assertJson(['data' => $company->toArray()]);
})->group('companies');

test('store company', function () {
    $company = Company::factory()->make();

    $response = postJson(route('companies.store', $company->toArray()));

    $response
        ->assertCreated()
        ->assertJson(['data' => $company->toArray()]);
})->group('companies');

test('delete company', function () {
    $company = Company::factory()->create();

    $response = deleteJson(route('companies.destroy', $company));

    $response
        ->assertOk()
        ->assertJson(['success' => true]);
})->group('companies');
