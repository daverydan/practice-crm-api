<?php

use function Pest\Laravel\{actingAs, getJson};

test('companies index', function () {
    $response = getJson(route('companies.index', $companies = [
        'data' => [
            'company 1',
            'company 2',
            'company 3',
        ],
    ]));

    $response
        ->assertOk()
        ->assertJson($companies);
})->group('companies');
