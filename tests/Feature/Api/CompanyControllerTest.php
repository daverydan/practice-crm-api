<?php

use App\Models\Company;

use function Pest\Laravel\{actingAs, getJson};

test('companies index', function () {
    $response = getJson(route('companies.index', $companies = [
        'data' => Company::factory()->times(3)->create()->toArray(),
    ]));

    $response
        ->assertOk()
        ->assertJson($companies);
})->group('companies');
