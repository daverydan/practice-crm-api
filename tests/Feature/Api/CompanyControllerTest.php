<?php

test('can get all companies', function () {
    $response = $this->getJson(route('companies.index', $companies = [
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
