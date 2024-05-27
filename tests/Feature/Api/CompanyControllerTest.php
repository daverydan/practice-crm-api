<?php

use App\Models\Company;

use function Pest\Laravel\{actingAs, getJson};

test('companies index', function () {
    $companies = Company::factory()->times(3)->create();

    $response = getJson(route('companies.index'));

    $response
        ->assertOk()
        ->assertJson(['data' => $companies->toArray()]);
})->group('companies');

test('companies show', function () {
    $company = Company::factory()->create();

    $response = getJson(route('companies.show', $company));

    $response
        ->assertOk()
        ->assertJson(['data' => $company->toArray()]);
})->group('companies');
